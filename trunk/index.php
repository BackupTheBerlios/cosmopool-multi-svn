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

require_once 'PEAR.php';

include './inc/formrules.php';
include './inc/isbn_config.php';

// DB_DataObj config
$config = parse_ini_file('./config/config.ini', true);
foreach($config as $class=>$values) {
    $options = &PEAR::getStaticProperty($class,'options');
    $options = $values;
}

require_once './obj/data/userPhotos.php';
require_once './obj/data/adressbook.php';
require_once './obj/data/forumThreads.php';
require_once './obj/data/forumEntries.php';
require_once './obj/data/resources.php';
require_once './obj/data/pools.php';
require_once './obj/data/poolsFetcher.php';
require_once './obj/data/poolsUser.php';
require_once './obj/data/poolsAdmin.php';
require_once './obj/data/poolsResources.php';
require_once './obj/data/user.php';
require_once './obj/data/userPreferences.php';
require_once './obj/data/resWait.php';
require_once './obj/data/resBorrowed.php';
require_once './obj/data/collectivesTime.php';
require_once './obj/data/categories.php';
require_once './obj/data/attributes.php';
require_once './obj/data/attributesString.php';
require_once './obj/data/attributesSelect.php';
require_once './obj/data/attributesSelectKeys.php';
require_once './obj/data/resFetcher.php';
require_once './obj/data/news.php';
require_once './obj/data/pm.php';

require_once './obj/services/services.php';

$page_params = services::getService('pageParams');
$config = services::getService('config');


// default
$pagename = "home";
if($page_params->getParam('page'))
  $pagename = $page_params->getParam('page');

switch ($pagename) {
  case 'home':
    include('./obj/pages/pageHome.php');
    $page = new pageHome;
    break;
  case 'mailinglist':
    include('./obj/pages/pageMailinglist.php');
    $page = new pageMailinglist;
    break;
  case 'software':
    include('./obj/pages/pageSoftware.php');
    $page = new pageSoftware;
    break;
  case 'logout':
    include('./obj/pages/pageLogout.php');
    $page = new pageLogout;
    break;
  case 'mysite':
    include('./obj/pages/pageMySite.php');
    $page = new pageMySite;
    break;
  case 'help':
    include('./obj/pages/pageHelp.php');
    $page = new pageHelp;
    break;
  case 'search':
    include('./obj/pages/pageSearch.php');
    $page = new pageSearch;
    break;
  case 'news':
    include('./obj/pages/pageNews.php');
    $page = new pageNews;
    break;
  case 'resdata':
    include('./obj/pages/pageResData.php');
    $page = new pageResData;
    break;
  case 'resmanager':
    include('./obj/pages/pageResManager.php');
    $page = new pageResManager;
    break;
  case 'userdata':
    include('./obj/pages/pageUserData.php');
    $page = new pageUserData;
    break;
  case 'register':
    include('./obj/pages/pageRegister.php');
    $page = new pageRegister;
    break;
  case 'userdatapassword':
    include('./obj/pages/pageUserDataPassword.php');
    $page = new pageUserDataPassword;
    break;
  case 'poolbrowser':
    include('./obj/pages/pagePoolBrowser.php');
    $page = new pagePoolBrowser;
    break;
  case 'showpool':
    include('./obj/pages/pageShowPool.php');
    $page = new pageShowPool;
    break;
  case 'showmember':
    include('./obj/pages/pageShowMember.php');
    $page = new pageShowMember;
    break;
  case 'threadbrowser':
    include('./obj/pages/pageThreadBrowser.php');
    $page = new pageThreadBrowser;
    break;
  case 'resbrowser':
    include('./obj/pages/pageResBrowser.php');
    $page = new pageResBrowser;
    break;
  case 'showres':
    include('./obj/pages/pageResBrowser.php');
    $page = new pageResBrowser;
    break;
  case 'showuser':
    include('./obj/pages/pageShowUser.php');
    $page = new pageShowUser;
    break;
  case 'pooldata':
    include('./obj/pages/pagePoolData.php');
    $page = new pagePoolData;
    break;
  case 'pooladmin':
    include('./obj/pages/pagePoolAdmin.php');
    $page = new pagePoolAdmin;
    break;
  case 'mypools':
    include('./obj/pages/pageMyPools.php');
    $page = new pageMyPools;
    break;
  case 'showpicture':
    include('./obj/pages/pageShowPicture.php');
    $page = new pageShowPicture;
    break;
  case 'pm':
    include('./obj/pages/pagePM.php');
    $page = new pagePM;
    break;
  case 'invite':
    include('./obj/pages/pageInvite.php');
    $page = new pageInvite;
    break;
  case 'freeres':
    include('./obj/pages/pageFreeRes.php');
    $page = new pageFreeRes;
    break;
  case 'static':
    include('./obj/pages/pageStatic.php');
    if($_GET['pageid'])
      $page = new pageStatic($_GET['pageid']);
    else
      $page = new pageStatic("error");
    break;
}

$page_params->unsetParams();

?>