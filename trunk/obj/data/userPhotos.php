<?php
/*
    Copyright 2004, 2005 Robert Griesel

    This file is part of NutziGems.

    NutziGems is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    NutziGems is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with NutziGems; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
 * Table Definition for pools_collectives_time
 */
require_once 'DB/DataObject.php';

class userPhotos extends DB_DataObject 
{
    var $file;
    ###START_AUTOCODE
    /* the code below is auto generated do not remove the above tag */

    var $__table = 'pools_user_photos';          // table name
    var $id;
    var $user_id;
    var $name;
    var $description;
    var $width = null;
    var $height = null;
    var $path = null;    

    /* ZE2 compatibility trick*/
    function __clone() { return $this;}

    /* Static get */
    function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('data_obj_Pools_collectives_time',$k,$v); }

    /* the code above is auto generated do not remove the tag below */
    ###END_AUTOCODE
    
    function getHeight() {
      $config = services::getService('config');

        // BILDGRÖSSE DES AUSGANGBILDES ERMITTELN
        $size = getimagesize($config->getSetting('doc_root').'images/uploads/_'.$this->name);
        
        $this->width = $size[0];
        $this->height = $size[1];
        return $this->height+32;
    }

    function getFile() {
      $config = services::getService('config');
        
        // BILDGRÖSSE DES AUSGANGBILDES ERMITTELN
        $size = getimagesize($config->getSetting('doc_root').'images/uploads/'.$this->name);
        
        $this->width = $size[0];
        $this->height = $size[1];

        switch ($size[2]) {
            // GIF
            case 1:
                $this->file = imagecreatefromgif($config->getSetting('doc_root').'images/uploads/'.$this->name);
            break;
            // JPEG
            case 2:
                $this->file = imagecreatefromjpeg($config->getSetting('doc_root').'images/uploads/'.$this->name);
            break;
            // PNG
            case 3:
                $this->file = imagecreatefrompng($config->getSetting('doc_root').'images/uploads/'.$this->name);
            break;
            default:
                die('Es können nur JPG, GIF oder PNG Dateien verändert werden.');
            break;
        }
        return true;
    }

    function cropMaxImage($width, $height) {
        
        if ($width === 0 || $height === 0) {
            die('division by zero. Thrown by Image::cropMaxImage();');
        }
        
        $ratio_width = $this->width/$width;
        $ratio_height =  $this->height/$height;
        
        
        // Bild zu breit
        if ($ratio_width > $ratio_height) {
            $final_width = $width * $ratio_height;
            $final_height = $this->height;
        // Bild zu hoch    
        } else {
            $final_width = $this->width;
            $final_height = $height * $ratio_width;
        }
        $final_width = number_format($final_width, 0, '.', '');
        $final_height = number_format($final_height, 0, '.', '');
        
        
        $new_img = imagecreatetruecolor($final_width, $final_height);
        
        //int ImageCopy(int dst_im, int src_im, int dst_x, int dst_y, int src_x, int src_y, int src_w, int src_h)
        imagecopy($new_img, $this->file, 0, 0, 0, 0, $final_width, $final_height); 
        imagedestroy($this->file);
        $this->file = $new_img;
        $this->width = $final_width;
        $this->height = $final_height;
        //$img = imagecreatetruecolor();
    }


    /**
    * RESIZE_IMAGE
    *
    * Ändert die Grösse eines Bildes und schärft dieses proportional zur Grössenänderung.
    * @access    public
    * @param    string    $file_name_src    Ausgangsbild
    * @param    string    $file_name_dest    Zielbild
    * @param    int     $width            Neue Bildbreite, 0 = Proportional
    * @param    int     $height            Neue Bildhöhe, 0 = Proportional
    * @param    int     $quality        Bildqualität
    * @return    bool                    true / false
    */
    function resizeImage($width = 0, $height = 0)    {
        // WENN KEINE BREITE UND KEINE HÖHE ANGEGEBEN WRUDEN
        if ($width == 0 && $height == 0) {
            // RÜCKGABEWERT
            die('Es muss entweder die Breite oder die Höhe des neuen Bildes angegeben werden!');
        }
        
        // WENN NUR HÖHE DEFINIERT
        if ($height !== 0 && $width === 0) {
            // HÖHE = HÖHE
            $h = number_format($height, 0, ',', '');
            // BREITE = PROPORTIONAL ZUR HÖHE
            $w = number_format(($this->width/$this->height)*$height,0,',','');
        }
        // WENN NUR BREITE DEFINIERT
        else if ($height === 0 && $width !== 0) {
            // BREITE = BREITE
            $w = number_format($width, 0, ',', '');
            // HÖHE = PROPORTIONAL ZUR BREITE
            $h = number_format(($this->height/$this->width)*$width,0,',','');
        }
        // WENN BREITE UND HÖHE DEFINIERT
        else {
            // HÖHE = HÖHE
            $h = number_format($height, 0, ',', '');
            // BREITE = BREITE
            $w = number_format($width, 0, ',', '');
        }

        
        // NEUES BILD ERSTELLEN MIT DEN RICHTIGEN MASSEN
        $dest = imagecreatetruecolor($w, $h);
        
        // ANTIALIAS ANWENDEN FALLS VORHANDEN
        if (function_exists("imageantialias")) {
            // ANTIALIAS VERWENDEN
            imageantialias($dest, true);
        }
        
        
        // BILD KOPIEREN UND GRÖSSE ÄNDERN
        imagecopyresampled($dest, $this->file, 0, 0, 0, 0, $w, $h, $this->width, $this->height);
        // AUFRUF DER FUNKTION UNSCHARFMASKIEREN UM BILD MIT DER ERMITTELTEN STÄRKE ZU SCHÄRFEN
        if (defined('SHARPEN') && SHARPEN == 1) {
            // VERHÄLTNIS DER URSPRÜNGLICHEN ZUR NEUEN BREITE / HÖHE BERECHNEN
            $percent = $this->width / $w;
            // STÄRKE (AMOUNT) FÜR UNSCHARFMASKIEREN BERECHNEN MIT DURCHSCHNITTSWERT 25
            $staerke = $percent * (int)SHARPEN_FACTOR;
            // NIE MEHR ALS MIT 100 STÄRKE UNSCHARFMASKIEREN
            if ($staerke > 100) {
                $staerke = 100;
            }
            $dest = $this->unsharpImage($dest, $staerke, 1, 0);
        }
        // ORIGINAL BILD ZERSTÖREN
        imagedestroy($this->file);

        // SKALIERTES BILD ZUWEISEN
        $this->file = $dest;
        // RÜCKGABEWERT
        return true;
    }
    
    
    /**
    * UNSHARP_IMAGE
    *
    * Schärft ein Bild (unscharfmaskieren).
    * @access    private
    * @param    object    $img        Bildobjekt, das mit «imgcreatetruecolor» der GD-Library erzeugt wurde (KEINE URL!)
    * @param    int     $amount        Stärke
    * @param    int     $radius        Radius
    * @param    int     $threshold    Schwellenwert
    * @return     object     $img        Geschärftes Bildobjekt
    */
    function unsharpImage($img, $amount, $radius, $threshold)    {
        // STÄRKE MAX 500
        if ($amount > 500) {
            $amount = 500;
        }
        // STÄRKE AN PHOTOSHOP ANPASSEN
        $amount = $amount * 0.016;
        // RADIUS MAX 50
        if ($radius > 50) {
            $radius = 50;
        }
        // RADIUS AN PHOTOSHOP ANPASSEN
        $radius = $radius * 2;
        // SCHWELLENWERT MAX 255
        if ($threshold > 255) {
            $threshold = 255;
        }
        // GANZE ZAHLEN FÜR RADIUS ERZWINGEN
        $radius = abs(round($radius));     // Only integers make sense.
        // WENN RADIUS 0
        if ($radius == 0) {
            // ABBRUCH, BILD UNVERÄNDERT LASSEN
            return $img;
            imagedestroy($img);
            break;
        }
        // BILDABMESSUNGEN ERMITTELN
        $w = imagesx($img);
        $h = imagesy($img);
        // 2 LEERE FLÄCHEN FÜRS ORIGINALBILD ERZEUGEN
        $imgCanvas = imagecreatetruecolor($w, $h);
        $imgCanvas2 = imagecreatetruecolor($w, $h);
        // 2 LEERE FLÄCHEN FÜR BLUR MATRIX ERZEUGEN
        $imgBlur = imagecreatetruecolor($w, $h);
        $imgBlur2 = imagecreatetruecolor($w, $h);
        // BILD IN 2 FLÄCHEN FÜR ORIGINALBILD HINEINKOPIEREN
        imagecopy($imgCanvas, $img, 0, 0, 0, 0, $w, $h);
        imagecopy($imgCanvas2, $img, 0, 0, 0, 0, $w, $h);
        ////////////////////////////
        //  GAUSSIAN BLUR MATRIX  //
        //     1    2    1              //
        //     2    4    2              //
        //     1    2    1              //
        ////////////////////////////
        // PLATZIERE KOPIEN DES BILDES RUND UM EINEN PIXEL AUF EINMAL UND MISCHE DIESE NACH
        // DER GAUSSIAN BLUR MATRIX. DIE SELBE MATRIX WIRD FÜR HÖHERE RADIEN VERWENDET.
        for ($i = 0; $i < $radius; $i++)    {
            imagecopy($imgBlur, $imgCanvas, 0, 0, 1, 1, $w - 1, $h - 1); // up left
            imagecopymerge($imgBlur, $imgCanvas, 1, 1, 0, 0, $w, $h, 50); // down right
            imagecopymerge($imgBlur, $imgCanvas, 0, 1, 1, 0, $w - 1, $h, 33.33333); // down left
            imagecopymerge($imgBlur, $imgCanvas, 1, 0, 0, 1, $w, $h - 1, 25); // up right
            imagecopymerge($imgBlur, $imgCanvas, 0, 0, 1, 0, $w - 1, $h, 33.33333); // left
            imagecopymerge($imgBlur, $imgCanvas, 1, 0, 0, 0, $w, $h, 25); // right
            imagecopymerge($imgBlur, $imgCanvas, 0, 0, 0, 1, $w, $h - 1, 20 ); // up
            imagecopymerge($imgBlur, $imgCanvas, 0, 1, 0, 0, $w, $h, 16.666667); // down
            imagecopymerge($imgBlur, $imgCanvas, 0, 0, 0, 0, $w, $h, 50); // center
            imagecopy ($imgCanvas, $imgBlur, 0, 0, 0, 0, $w, $h);
            // WÄHREND DES OBIGEN LOOPS, VERDUNKELT DAS MISCHBILD. AUS DIESEM GRUND MACHEN
            // WIR EIN ZWEITES MISCHBILD OHNE DIE MATRIX. DIES IST EIGENTLICH KEINE GUTE SACHE,
            // DA DER PROZESS VIEL ZEIT BEANSPRUCHT.
            imagecopy($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h);
            imagecopymerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 50);
            imagecopymerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 33.33333);
            imagecopymerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 25);
            imagecopymerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 33.33333);
            imagecopymerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 25);
            imagecopymerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 20 );
            imagecopymerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 16.666667);
            imagecopymerge($imgBlur2, $imgCanvas2, 0, 0, 0, 0, $w, $h, 50);
            imagecopy($imgCanvas2, $imgBlur2, 0, 0, 0, 0, $w, $h);
        }
        // WIR BERECHNEN DIE DIFFERENZ ZWISCHEN DEN VERMISCHTEN PIXEL UND DER ORIGINAL
        // UND SETZEN DIE PIXEL NEU
        // WIR GEHEN JEDE PIXEL-ZEILE DURCH
        for ($x = 0; $x < $w; $x++)    {
            // WIR GEHEN JEDE EINZELNEN PIXEL DURCH
            for ($y = 0; $y < $h; $y++)    {
                // RGB-WERT DES ORIGNALBILDS PIXELS ERMITTELN
                $rgbOrig = imagecolorat($imgCanvas2, $x, $y);
                $rOrig = (($rgbOrig >> 16) & 0xFF);
                $gOrig = (($rgbOrig >> 8) & 0xFF);
                $bOrig = ($rgbOrig & 0xFF);
                // RGB-WERT DES MISCHBILDS PIXELS ERMITTELN
                $rgbBlur = imagecolorat($imgCanvas, $x, $y);
                $rBlur = (($rgbBlur >> 16) & 0xFF);
                $gBlur = (($rgbBlur >> 8) & 0xFF);
                $bBlur = ($rgbBlur & 0xFF);
                // WENN DIE MASKIERTEN PIXEL SICH VOM ORIGINAL WENIGER UNTERSCHEIDEN,
                // ALS DER SCHWELLENWERT VERLANGT, VERWENDE DIE ORIGINAL RGB-WERTE
                $rNew = (abs($rOrig - $rBlur) >= $threshold) 
                    ? max(0, min(255, ($amount * ($rOrig - $rBlur)) + $rOrig)) 
                    : $rOrig;
                $gNew = (abs($gOrig - $gBlur) >= $threshold) 
                    ? max(0, min(255, ($amount * ($gOrig - $gBlur)) + $gOrig)) 
                    : $gOrig;
                $bNew = (abs($bOrig - $bBlur) >= $threshold) 
                    ? max(0, min(255, ($amount * ($bOrig - $bBlur)) + $bOrig)) 
                    : $bOrig;
                // WENN RGB-WERTE SICH GEÄNDERT HABEN
                if (($rOrig != $rNew) || ($gOrig != $gNew) || ($bOrig != $bNew)) {
                    // PIXEL LOKALISIEREN
                    $pixCol = imagecolorallocate($img, $rNew, $gNew, $bNew);
                    // PIXEL NEU SETZEN
                    imagesetpixel($img, $x, $y, $pixCol);
                }
            }
        }
        // ORIGINALBILDER UND MISCHBILDER ZERSTÖREN
        imagedestroy($imgCanvas);
        imagedestroy($imgCanvas2);
        imagedestroy($imgBlur);
        imagedestroy($imgBlur2);
        // RÜCKGABEWERT ALS ZEIGER DER GD LIB
        return $img;
    }
    
    
    function saveAs($file_name, $quality = 100) {
        $dest_info = pathinfo(strtolower($file_name));
        switch ($dest_info['extension']) {
            case 'gif':
            case 'jpg':
                imagejpeg($this->file, $file_name, $quality);
                break;

            case 'png':
                imagepng($this->file, $file_name);
                break;
                
            default:
                return false;
                break;
        }
        imagedestroy($this->file);
        return true;
    }


    function drawBorder($thickness, $color = 'FFFFFF') {
        // Hex in RGB umwandeln
        $red   = hexdec(substr($color,1,2));
        $green = hexdec(substr($color,3,2));
        $blue  = hexdec(substr($color,5,2));

        
        
        $height = imagesy($this->file);
        $width = imagesx($this->file);
        // Farbe alloziieren
        $color = imagecolorallocate($this->file, 255, 255, 255);
        
        // Array für die Linien ahnand der Rahmendicke
        $rangeTop = range( 0, $thickness-1);
        $rangeBottom = range($height - $thickness, $height);
        $rangeRight = range(0, $thickness-1);
        $rangeLeft = range($width - $thickness, $width);
        
        $borderHor = array_merge($rangeTop, $rangeBottom);
        $borderVer = array_merge($rangeRight, $rangeLeft);
                
        // Rahmen zeichnen
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                if (in_array($y, $borderHor) || in_array($x, $borderVer)) {
                    imagesetpixel ($this->file, $x, $y, $color);
                }
            }
        }
    }
    
    function write() {
      $config = services::getService('config');
        
      $this->resizeImage(400);
      $path = $config->getSetting('doc_root').'images/uploads/_';
      $path .= $this->name;
      $this->saveAs($path);
      $this->getFile();
      $this->resizeImage(143);
      $this->saveAs($config->getSetting('doc_root').'images/uploads/thumb_'.$this->name);
      $this->insert();
      unlink($config->getSetting('doc_root').'images/uploads/'.$this->name);
    }
    
    function erase() {;
    }
    
}
?>