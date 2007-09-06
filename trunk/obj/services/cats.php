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
 * categories-class
 */

class cats {
 
    private $cats = array();
    private $cat_names = array();
 
    function cats() {
      $this->fetchAll();
    }

    function fetchAll() {
      $cats = new categories;
      $cats->parent = 0;
      $cats->find();

      while($cats->fetch()) {
        $this->cat_names[$cats->id] = $cats->name;
        $this->cats[$cats->id] = 0;

        $cats2 = new categories;
        $cats2->parent = $cats->id;
        
        if($cats2->find()) {
          $this->cats[$cats->id] = array();
          while($cats2->fetch()) {
            $this->cat_names[$cats2->id] = $cats2->name;
            $this->cats[$cats->id][$cats2->id] = 0;

            $cats3 = new categories;
            $cats3->parent = $cats2->id;

            if($cats3->find()) {
              $this->cats[$cats->id][$cats2->id] = array();
              while($cats3->fetch()) {
                $this->cat_names[$cats3->id] = $cats3->name;
                $this->cats[$cats->id][$cats2->id][$cats3->id] = 0;
              }
            }
          }
        }
      }
      $temp = $this->cats;
      $this->cats = array();
      $this->cats[] = $temp;
    }

    function getName($id) {
      $lang = services::getService('lang');
      if($id != 0)
        return $lang->getMsg('cat_'.$this->cat_names[$id]);
      else return $lang->getMsg('cat_all');
    }

    function getChildren($id = 0) {
      foreach($this->cats as $cats) {
        if(isset($cats[$id]))
          $tree = $cats;
        else if(is_array($cats))
          foreach($cats as $cats2) {
            if(isset($cats2[$id]))
              $tree = $cats2;
            else if(is_array($cats2))
              foreach($cats2 as $cats3) {
                if(isset($cats3[$id]))
                  $tree = $cats3;
              }
          }
      }
      if(!isset($tree))
        $tree = $this->cats;

      if(is_array($tree[$id])) {
        $list = array();
        foreach($tree[$id] as $cat_id => $unimportant) {
          $list[$cat_id] = $this->getName($cat_id);
        }
        return $list;
      }
      else return false;
    }

    function getThisAndBelow($id) {
      $list = array();
      if($id != 0)
        $list[$id] = $this->getName($id);

      $children = $this->getChildren($id);
      if(is_array($children)) {
        $list = $list + $children;
        
        foreach($children as $child_id => $name) {
          $grand_children = $this->getChildren($child_id);
        
          if(is_array($grand_children)) {
            $list = $list + $grand_children;

            foreach($grand_children as $grand_child_id => $grand_name) {
              $great_grand_children = $this->getChildren($grand_child_id);
              if(is_array($great_grand_children)) {
                $list = $list + $great_grand_children;
              }
            }
          }
        }
      }
      return($list);
    }
	
    function getParent($id) {
      $cats = new categories;
      $cats->id = $id;
      $cats->find(true);
      return $cats->parent;
    }

    function getAll() {
      $list = array();
      $list[0] = "---";
      foreach($this->cats[0] as $id => $child) {
        $list["$id"] = $this->getName($id);
        if(is_array($child))
          foreach($child as $id2 => $child2) {
            $list["$id2"] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$this->getName($id2);
            if(is_array($child2))
              foreach($child2 as $id3 => $child3) {
                $list["$id3"] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$this->getName($id3);
              }
          }
      }
      return $list;
    }
    
}
?>