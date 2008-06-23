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
 * geoinfo-service
 use it to calculate distances between users
 */
 
class geoinfo {

//    private static $countries = array();
 
    // constructor
    public function geoinfo() {
      ;
    }
    
    function getDistance($user1, $user2) {
      $code1 = $this->geoCode($user1);
      $code2 = $this->geoCode($user2);
      
      if($code1 === false)
        return "userfalse";
      if($code2 === false)
        return "memberfalse";
      
      return $this->distance($code1, $code2);
    }
    
    function geoCode($user) {
      $url = "http://maps.google.com/maps/geo?q=".
             str_replace(" ", "+", $user->street)."+".str_replace(" ", "+", $user->house).",+".
             str_replace(" ", "+", $user->plz)."+".str_replace(" ", "+", $user->city);
      if($user->country) 
        $url .= ",+".$user->country;
      $url .= "&output=xml&key=ABQIAAAAOeWMbczOaT7d3mXzP_D7ORRD4AAQayHHXPnuhDQmZ-vG96N1eBR7C0LOtMH3ghzK1tQIamrHOnZHLQ";
      $xml = file_get_contents($url);

      // returns array of lat and long
      // or if something went wrong return false

      if(strpos($xml, '<code>200</code>') !== false) {
        $latlong = array();
        $first = strpos($xml, '<coordinates>')+13;
        $sec = strpos($xml, '</coordinates>');
        $coords = substr($xml, $first, $sec-$first);
        
        $latlong = explode(",", $coords);
      
        return $latlong;
      }
      else return false;
    }
    
    function distance($user1, $user2) {
    
    $Aa = $user1[0];
    $Ba = $user1[1];
    $Ca = $user2[0];
    $Da = $user2[1];

    $input = array($Aa, $Ba, $Ca, $Da);

    foreach($input as $name){

        if (ereg("[[:alpha:]]",$name)){

            echo "You cannot enter letters into this function<br>\n";

            die;

        }

        if(ereg("\.",$name)){

            $dot = ".";

            $pos = strpos($name, $dot);

            //echo $pos." <br>\n";

            if($pos > 3){

                echo "The input cannot exceed more than 3 digits left of the

decimal<br>\n";

                die;

            }

        }

        if($name > 365){

            echo "The input cannot exceed 365 degrees <BR>\n";

            die;

 

        }

    }

 

    $A = $Aa/57.29577951;

    $B = $Ba/57.29577951;

      $C = $Ca/57.29577951;

    $D = $Da/57.29577951;

    //convert all to radians: degree/57.29577951

 

   if ($A == $C && $B == $D ){

     $dist = 0;

   }

   else if ( (sin($A)* sin($C)+ cos($A)* cos($C)* cos($B-$D)) > 1){

   $dist = 3963.1* acos(1);// solved a prob I ran into.  I haven't fullyanalyzed it yet

 

   }
   else{
           $dist = 3963.1* acos(sin($A)*sin($C)+ cos($A)* cos($C)*

        cos($B-$D));

    }

return (round($dist*1.609,2));
} 

}

?>
