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

// Server-Administration

require_once 'PEAR.php';

// DB_DataObj config
$config = parse_ini_file('./config/config.ini', true);
foreach($config as $class=>$values) {
    $options = &PEAR::getStaticProperty($class,'options');
    $options = $values;
}

require_once './obj/ui/tables/table.php';
require_once './obj/data/resources.php';
require_once './obj/data/pools.php';
require_once './obj/data/poolsFetcher.php';
require_once './obj/data/poolsUser.php';
require_once './obj/data/poolsAdmin.php';
require_once './obj/data/poolsResources.php';
require_once './obj/data/user.php';
require_once './obj/data/resWait.php';
require_once './obj/data/resBorrowed.php';
require_once './obj/data/collectivesTime.php';
require_once './obj/data/categories.php';
require_once './obj/data/attributes.php';
require_once './obj/data/attributesString.php';
require_once './obj/data/resFetcher.php';
require_once './obj/data/news.php';

require_once './obj/services/services.php';

$config = services::getService('config');
$page_params = services::getService('pageParams');

// messages
if(isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}

// logout
if(isset($_GET['action'])) {
  if($_GET['action'] == "logout") {
    // redirect
    header('Location: '.$config->getSetting('url').'admin.php?msg=logged_out');
    exit();
  }
}

if(isset($_POST['server_password']))
  $submit_server_password = $_POST['server_password'];
if(isset($_GET['server_password'])) 
  $submit_server_password = $_GET['server_password'];

// login
if(!$submit_server_password) {
  include './inc/adminHeader.php';
  echo('<p class="headline">NutziGems Administration</p>');
  echo('<p class="standard">Bitte einloggen</p>
        <form action="admin.php?msg=login_correct" method="post">
          <input type="text" name="server_password">
          <input type="submit" name="server_login" value="einloggen">
        </form>');
}

// form processing
if(isset($submit_server_password))
  if($submit_server_password == $config->getSetting('password')) {


// kick admin-form
if($_GET['action'] == 'kick_admin') {

  // add admin if given
  if(isset($_POST['add_admin_submit'])) {
    $pool = new pools;
    $pool->get($_GET['pool_id']);
    $pool->addAdmin($_POST['add_admin_select']);
  }
    
  $pool_admin_del = new poolsAdmin;
  $pool_admin_del->pool_id = $_GET['pool_id'];
  if($pool_admin_del->find() > 1) {
    $pool_admin_del->user_id = $_GET['user_id'];
    $pool_admin_del->delete();
    $deleted = true;
  }
  // if the pool has only got one admin you have to name a new one
  else {
    $pool_user_new = new poolsUser;
    $pool_user_new->pool_id = $_GET['pool_id'];
    if($pool_user_new->find() > 1) {
      include './inc/adminHeader.php';
      echo('<p class="headline">Neuen Admin ernennen</p>');
      echo('<p class="standard">Die NutziGem deren Admin gelöscht werden soll, hat nur einen, Du musst einen neuen ernennen.</p>');
      echo('<p class="standard">
            <form action="./admin.php?action=kick_admin&pool_id='.$_GET['pool_id'].'&user_id='.$_GET['user_id'].'&server_password='.$submit_server_password.'" method="POST">
              <select name="add_admin_select">');
      while($pool_user_new->fetch()) {
        $pool_user_new->fetchUser();
        if(!$pool_user_new->user->isAdmin($pool_user_new->pool_id))
          echo('<option value="'.$pool_user_new->user->id.'">'.$pool_user_new->user->name.'</option>');
      }
      echo('  </select>
              <input type="submit" name="add_admin_submit" value="ernennen">
           </form>
           </p>');
      exit();
    }
    // if there's no more users you can't kick the admin
    else
      $msg = 'kickadmin_notenourghusers';
  }
  // set $msg
  if($deleted)
    $msg = 'kickadmin_success';
}

// del_ng-form
if($_GET['action'] == 'delete_pool') {
  $pools = new pools;

  // delete ng
  $pools->get($_GET['pool_id']);

  $tos = $pools->getAdmins();
  if($pools->deleteAll()) {
    $msg = 'msg_delng_success';

    // compose emails

    $mail = services::getService('mail');
    foreach($tos as $to) {
      $mail->send('pool_deleted', $to, $pools);
    }
    
    $freed = TRUE;
  }
}

if(isset($_POST['ng_del_submit'])) {
  for($count = 1; $count <= $_POST['ng_free_count']; ++$count) {
    $pools = new pools;
    // delete ng
    $pools->get($_POST['ng_free_'.$count]);
    
    $tos = $pools->getAdmins();
    if($pools->deleteAll()) {
      $deleted = TRUE;
      
      $mail = services::getService('mail');
      foreach($tos as $to) {
        $mail->send('found_pool_refused', $to, $pools);
      }

      $freed = TRUE;
    }
  }
  
  // set $msg
  if($deleted)
    $msg = 'delng_success';
}



// free_ng-form

if(isset($_POST['ng_free_submit'])) {
  for($count = 1; $count <= $_POST['ng_free_count']; ++$count) {
    $pools = new pools;
    
    // free ng
    $curr_id = $_POST['ng_free_'.$count];
    if($curr_id) {
      $pools->get($curr_id);
      $pools->wait = 0;
      $pools->update();
      
      // compose email
      $tos = $pools->getAdmins();
      $mail = services::getService('mail');
      foreach($tos as $to) {
        $mail->send('found_pool_accepted', $to, $pools);
      }

      $freed = TRUE;
    }
  }
  
  // set $msg
  if($freed)
    $msg = 'freeng_success';
}

include './inc/adminHeader.php';
echo('<p class="msg">'.$msg.'</p>');
echo('<p class="headline">NutziGems Administration</p>');
echo('<p class="standard">Das ist also die NutziGems-Administrationsoberfl&auml;che.</p>');
echo('<p class="headline2" id="anzeigen">NutziGems, die auf ihre Freischaltung warten</p>');

// Waiting NGs

echo('<form action="./admin.php" method="post">');
echo('<input type="hidden" name="server_password" value="'.$submit_server_password.'">');

$table = new HTML_Table(array("width" => "100%", "class" => "pools"));
$table -> setAutoGrow(true);
$table -> setAutoFill("n/a");

$table -> setHeaderContents(0, 0, " "); 
$table -> setHeaderContents(0, 1, "Name");
$table -> setHeaderContents(0, 2, "Beschreibung");
$table -> setHeaderContents(0, 3, "Land");
$table -> setHeaderContents(0, 4, "Gebiet");
$table -> setRowAttributes(0, array("class" => "pools"));

// all pools are shown

// Instanciate pools-class
$pools = new pools;

$count = 1;
$pools->wait = 1;

if($pools->find()) {
  while($pools->fetch()) {
    $table -> setCellContents($count, 0, '<input type="checkbox" value="'.$pools->id.'" name="ng_free_'.$count.'">');
    $table -> setCellContents($count, 1, $pools->name);
    $table -> setCellContents($count, 2, $pools->description);
    $table -> setCellContents($count, 3, $pools->country);
    $table -> setCellContents($count, 4, $pools->area);

    $table -> setRowAttributes($count, array("class" => "pools"));

    ++$count;    
  }
  echo($table->toHTML());
  echo('<img src="./images/arrow.png"> ');
  echo('<input type="hidden" name="ng_free_count" value="'.$count.'">');
  echo('<input type="submit" name="ng_free_submit" value="markierte freischalten"> / ');
  echo('<input type="submit" name="ng_del_submit" value="markierte ablehnen">');
}
else {
  $table -> setCellAttributes(1, 0, array("colspan" => "5", "align" => "center"));
  $table -> setCellContents(1, 0, '--- derzeit keine wartenden NutziGems ---');
  echo($table->toHTML());
}

echo('</form>');

// pools to delete

// all pools are shown

// Instanciate pools-class
$pools = new pools;

$pools->wait = 0;

if($pools->find()) {
  echo('<p class="headline2" id="anzeigen">NutziGems l&ouml;schen</p>');
  echo('<p class="standard">');
  while($pools->fetch()) {
    if($pools->name != "Pool")
      echo('<a href="./admin.php?action=delete_pool&pool_id='.$pools->id.'&server_password='.$submit_server_password.'">'.$pools->name.'</a> ');
  }
  echo('</p>');
}

echo('<p class="headline2" id="anzeigen">Admins kicken</p>');

// Admins to kick

// all pools are shown

// Instanciate pools-class
$pools = new pools;

$pools->wait = 0;

if($pools->find()) {
  echo('<p class="standard">');
  while($pools->fetch()) {
    $admins = array();
    $admins = $pools->getAdmins();

    echo('<b>'.$pools->name.'</b>: ');
    foreach($admins as $admin) 
      echo('<a href="./admin.php?action=kick_admin&pool_id='.$pools->id.'&user_id='.$admin->id.'&server_password='.$submit_server_password.'">'.$admin->name.'</a> ');
    echo('<br>');
  }
  echo('</p>');
}

echo('<p class="standard"><a href="./index.php">Ausloggen und zurück zur Homepage</a></p>');

}
else {
  // redirect
  header('Location: '.$config->getSetting('url').'admin.php?msg=login_wrong');
  exit();
}

?>