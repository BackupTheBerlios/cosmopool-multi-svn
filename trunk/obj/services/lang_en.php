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
 * language-service
 */
 
require_once('./obj/services/lang.php');

class lang_en extends lang {

    // constructor
    public function lang_en() {
    
      $this->lang = 'en';
    
      $this->msg = array(
      
      // countries
      
      "country_DE" => "germany",
      "country_AT" => "austria",
      "country_CH" => "switzerland",
      "country_GR" => "greece",
      "country_GB" => "great britain",
      "country_US" => "usa",

      // header texts

      "html_title" => "whopools.net - resource sharing network",
      "language_changer" => "Language:",

      // messages, the ones written in red
      "msg_login_correct" => "you're logged in",
      "msg_login_wrong" => "wrong login",
      "msg_logged_out" => "you're logged out",
      "msg_login_first" => "you have to login first",
      "msg_changeres_success" => "Resources have been changed successfully",
      "msg_delng_success" => "Pool rejected.",
      "msg_delpool_success" => "Pool deleted.",
      "msg_freeng_success" => "Pool enabled.",
      "msg_delres_success" => "Resources deleted successfully",
      "msg_found_success" => "Your pool is online but is beeing re-checked.",
      "msg_new_success" => "Entity was entered successfully",
      "msg_data_change_success" => "Data successfully modified",
      "msg_res_insert_success" => "Resource successfully entered",
      "msg_register_success" => "Registration finished!",
      "msg_apply_is_proven" => "Your request was queued. You will receive an email upon activation.",
      "msg_add_admin" => "New admin appointed.",
      "msg_kick_member" => "Member expelled.",
      "msg_kickadmin_success" => "Admin expelled.",
      "msg_kickadmin_notenourghusers" => "The admin could not be expelled, as beeing the only member of the pool.",
      "msg_leave_pool" => "Disconnected from pool.",
      "msg_leave_pool_last_admin" => "You're the last admin. So you can't leave this pool.",
      "msg_added_request" => "Request has been sent.",
      "msg_added_given" => "You are on the list.",
      "msg_added_borrow" => "You are on the list.",
      "msg_give_success" => "Resource was handed over.",
      "msg_borrow_success" => "Resource was lent out.",
      "msg_request_success" => "Contact data sent.",
      "msg_res_back" => "Resource is available again.",
      "msg_no_results" => "Nothing found.",
      "msg_free_res_success" => "The resources have been released.",
      "msg_accept_user_success" => "The user is now a member.",
      "msg_refuse_user_success" => "the user has been refused.",
      "msg_news_submitted" => "news submitted",
      "msg_nice_try" => "nice try...",
      "msg_pw_sent" => "You were sent a new password.",
      "msg_forum_entry_made" => "Message entered.",
      
      // tables
      
      "tableheaders_contact" => "contact",
      "tableheaders_when" => "what time",
      "tableheaders_what" => "what",
      "tableheaders_owner" => "owner",
      "tableheaders_type" => "type",
      "tableheaders_is_public" => "public",
      "tableheaders_adress" => "what place",
      "tableheaders_rescount" => "resources",
      "tables_is_public_yes" => "yes",
      "tables_is_public_no" => "no",
      "tables_borrowed" => "lent out",
      "tables_allready_borrowed" => "allready lent out",
      "tables_request_running" => "your request is running",
      "tables_comment_for_the_owner" => "Comments for the owner(optional)",
      "tables_contactdata" => "Contact data",
      "tables_contactdata_youdontneed" => "No need to do this for it's your own resource.",
      "tables_contactdata_isinvisible" => " invisible, since this resource belongs to somebody who is not within any of your pools. Use the form please.",
      "tables_contactbutton_noitem" => "Requests",
      "tables_contactbutton_gift" => "take it (as a gift)",
      "tables_contactbutton_borrow" => "borrow it",
      "tableheaders_name" => "Name",
      "tableheaders_area" => "Area",
      
      // page commons
      
      "common_footerlinks_search" => "Search",
      "common_footerlinks_resdata_new" => "Resource input",
      "common_footerlinks_resmanager" => "Resource admin",
      "common_footerlinks_poolbrowser" => "all pools",
      "common_footerlinks_pooldata_new" => "found pool",
      "common_help_link" => "help",
      "common_bottom_developers" => "developers",
      "common_bottom_about" => "about",
      "common_bottom_contact" => "contact",
      "common_bottom_supersite" => "supersite",

      // linktexts

      "link_logout" => "Logout",
      "link_waiting_users" => "Users waiting",
      "link_waiting_res" => "Request",
      "link_register" => "Register",
      "link_mysite" => "My page",

      // text on the homepage

      "homepage_backlink" => "back to the homepage",      
      "home_header" => "Welcome!",
      "home_lostpasswordheader" => "Lost password",
      "home_lostpassword_link" => "Lost password?",
      "home_lostpassword_text" => "Type your email-adress. So a new password will be sent.",
      "home_welcome-1" => "Welcome to who<b>pools</b>.<i>net</i>, an online-tool to share any kinds of <font color=green>resources</font>. Become member of resource<b>pools</b>, found own ones, borrow, lend, give, leave your <font color=gold>money</font> at home, make your day! Just register and then begin.<br><br>",
      "home_links_1" => "the SuperSite",
      "home_links_2" => "this software",
      "home_links_3" => "the new software(-plan)",
      "home_ng_res_count-1" => "On this server there are ",
      "home_ng_res_count-2" => " pools and ",
      "home_ng_res_count-3" => " resources",
      "home_login_header" => "login",
      "home_login_registertext-1" => "You have to be registered, otherwise:",
      "home_login_registertext-2" => "Register",
      "home_news_name" => "&Uuml;berschrift",
      "home_news_lang" => "Sprache",
      "home_news_abstract" => "Abstract",
      "home_news_text" => "Text",
      "home_news_submit" => "submit",
      
      // news page
      
      "news_header" => "News",
      
      // resdata-page
      
      "resdata_link1" => "put in another resource",
      "resdata_link2" => "manage resources",
      "resdata_form_name" => "headline",
      "resdata_all_header" => "back to \"All resources\"",
      "resdata_form_description" => "description",
      "resdata_form_category" => "category",
      "resdata_form_type" => "type",
      "resdata_form_type_borrow" => "to lend",
      "resdata_form_type_give" => "to give away",
      "resdata_form_pools" => "Activate for pools",
      "resdata_form_submit" => "Enter",
      "resdata_form_namenecessary" => "Headline required. ",
      "resdata_form_descnecessary" => "Description required. ",
      "resdata_form_catnecessary" => "Category required. ",
      "resdata_form_typenecessary" => "Please choose something. ",
      
      // additional attributes
      "resdata_form_isbn" => "isbn",      
      "resdata_form_authors" => "author(s)",      
      "resdata_form_keywords" => "keywords",      
      "resdata_form_isbn_submit" => "lookup",      
      "resdata_form_title" => "title",      
      "resdata_form_binding" => "binding",      
      "resdata_form_publication_date" => "publication year",      
      "resdata_form_publisher" => "publisher",      
      "resdata_form_number_of_pages" => "number of pages",      
      "resdata_form_signature" => "signature",      

      // books keywords
      "resdata_form_select_philosophy" => "philosophy",
      "resdata_form_select_aesthetics" => "aesthetics",
      "resdata_form_select_theory of history" => "theory of history",
      "resdata_form_select_history" => "history",
      "resdata_form_select_theory of culture" => "theory of culture",
      "resdata_form_select_theory of art" => "theory of art",
      "resdata_form_select_economy" => "economy",
      "resdata_form_select_gender" => "gender",
      "resdata_form_select_political economy" => "political economy",
      "resdata_form_select_sociology" => "sociology",
      "resdata_form_select_theory of the state" => "theory of the state",
      "resdata_form_select_theory of faschism" => "theory of faschism",
      "resdata_form_select_psychology" => "psychology",
      "resdata_form_select_psychoanalysis" => "psychoanalysis",
      "resdata_form_select_repression" => "repression",
      "resdata_form_select_military" => "military",
      "resdata_form_select_art" => "art",
      "resdata_form_select_music" => "music",
      "resdata_form_select_film" => "film",
      "resdata_form_select_visual arts" => "visual arts",
      "resdata_form_select_kids and youth" => "kids and youth",
      "resdata_form_select_law" => "law",
      "resdata_form_select_religion" => "religion",
      "resdata_form_select_islam" => "islam",
      "resdata_form_select_buddhism" => "buddhism",
      "resdata_form_select_christian" => "christian",
      "resdata_form_select_hinduism" => "hinduism",
      "resdata_form_select_sects" => "sects",
      "resdata_form_select_criticism of religion" => "criticism of religion",
      "resdata_form_select_slavery" => "slavery",
      "resdata_form_select_drugs" => "drugs",
      "resdata_form_select_racism" => "racism",
      "resdata_form_select_anti-semitism" => "anti-semitism",
      "resdata_form_select_travel" => "travel",
      "resdata_form_select_childrens book" => "childrens book",
      "resdata_form_select_novel" => "novel",
      "resdata_form_select_biography" => "biography",
      "resdata_form_select_lyric" => "lyric",
      "resdata_form_select_thriller" => "thriller",
      "resdata_form_select_germany" => "germany",
      "resdata_form_select_prussia" => "prussia",
      "resdata_form_select_habsburgian" => "habsburgian",
      "resdata_form_select_ireland" => "ireland",
      "resdata_form_select_great brittain" => "great brittain",
      "resdata_form_select_spain" => "spain",
      "resdata_form_select_italy" => "italy",
      "resdata_form_select_portugal" => "portugal",
      "resdata_form_select_france" => "france",
      "resdata_form_select_europe" => "europe",
      "resdata_form_select_turkey" => "turkey",
      "resdata_form_select_israel/palestine" => "israel/palestine",
      "resdata_form_select_middle east" => "middle east",
      "resdata_form_select_kurdistan" => "kurdistan",
      "resdata_form_select_iran" => "iran",
      "resdata_form_select_iraq" => "iraq",
      "resdata_form_select_afghanistan" => "afghanistan",
      "resdata_form_select_india" => "india",
      "resdata_form_select_vietnam" => "vietnam",
      "resdata_form_select_cambodia" => "cambodia",
      "resdata_form_select_korea" => "korea",
      "resdata_form_select_china" => "china",
      "resdata_form_select_japan" => "japan",
      "resdata_form_select_asia" => "asia",
      "resdata_form_select_africa" => "africa",
      "resdata_form_select_north africa" => "north africa",
      "resdata_form_select_namibia" => "namibia",
      "resdata_form_select_south africa" => "south africa",
      "resdata_form_select_egypt" => "egypt",
      "resdata_form_select_australia" => "australia",
      "resdata_form_select_oceania" => "oceania",
      "resdata_form_select_america" => "america",
      "resdata_form_select_usa" => "usa",
      "resdata_form_select_canada" => "canada",
      "resdata_form_select_mexico" => "mexico",
      "resdata_form_select_guatemala" => "guatemala",
      "resdata_form_select_nicaragua" => "nicaragua",
      "resdata_form_select_caribbean" => "caribbean",
      "resdata_form_select_central america" => "central america",
      "resdata_form_select_cuba" => "cuba",
      "resdata_form_select_colombia" => "colombia",
      "resdata_form_select_el salvador" => "el salvador",
      "resdata_form_select_bolivia" => "bolivia",
      "resdata_form_select_chile" => "chile",
      "resdata_form_select_peru" => "peru",
      "resdata_form_select_argentina" => "argentina",
      "resdata_form_select_brazil" => "brazil",
      "resdata_form_select_south america" => "south america",
      "resdata_form_select_anarchism" => "anarchism",
      "resdata_form_select_early socialism" => "early socialism",
      "resdata_form_select_marxism" => "marxism",
      "resdata_form_select_leninism" => "leninism",
      "resdata_form_select_stalinism" => "stalinism",
      "resdata_form_select_maoism" => "maoism",
      "resdata_form_select_trotzkism" => "trotzkism",
      "resdata_form_select_s.i." => "s.i.",
      "resdata_form_select_feminism" => "feminism",
      "resdata_form_select_critical theory" => "critical theory",
      "resdata_form_select_theory of the left" => "theory of the left",
      "resdata_form_select_social movements" => "social movements",
      "resdata_form_select_workers movement" => "workers movement",
      "resdata_form_select_womens movement" => "womens movement",
      "resdata_form_select_environmental movement" => "environmental movement",
      "resdata_form_select_students movement" => "students movement",
      "resdata_form_select_class struggle" => "class struggle",
      "resdata_form_select_prehistory" => "prehistory",
      "resdata_form_select_ancient world" => "ancient world",
      "resdata_form_select_middle ages" => "middle ages",
      "resdata_form_select_modern times till 1789" => "modern times till 1789",
      "resdata_form_select_history of culture" => "history of culture",
      "resdata_form_select_history of music" => "history of music",
      "resdata_form_select_history of art" => "history of art",
      "resdata_form_select_history of film" => "history of film",
      "resdata_form_select_history of literature" => "history of literature",
      "resdata_form_select_history of speech" => "history of speech",
      "resdata_form_select_history of technology" => "history of technology",
      "resdata_form_select_history of economy" => "history of economy",
      "resdata_form_select_military history" => "military history",
      "resdata_form_select_1st world war" => "1st world war",
      "resdata_form_select_2nd world war" => "2nd world war",
      "resdata_form_select_history of revolutions" => "history of revolutions",
      "resdata_form_select_french revolution" => "french revolution",
      "resdata_form_select_russian revolution" => "russian revolution",
      "resdata_form_select_1848 revolution" => "1848 revolution",
      "resdata_form_select_paris commune" => "paris commune",
      "resdata_form_select_german history" => "german history",
      "resdata_form_select_3rd reich" => "3rd reich",
      "resdata_form_select_shoah" => "shoah",
      "resdata_form_select_faschism" => "faschism",
      "resdata_form_select_history after 1945" => "history after 1945",
            
      "resdata_header_change" => "Resource bearbeiten",
      "resdata_header_new" => "Resource eingeben",
      
      // pooldata-page
      
      "pooldata_header_change" => " manage",
      "pooldata_header_found" => "Found a pool",
      "pooldata_text" => "The founder of a pool will become its first administrator.
        Later on you may assign this role to somebody else, or share it with other members.",
      "pooldata_form_name" => "name for your pool",
      "pooldata_form_description" => "description",
      "pooldata_form_area" => "area",
      "pooldata_form_is_located_no" => "no",
      "pooldata_form_is_located_yes" => "yes",
      "pooldata_form_is_located" => "is located",
      "pooldata_form_is_public" => "is public",
      "pooldata_form_country" => "country",
      "pooldata_form_country_none" => "none chosen",
      "pooldata_form_submit" => "Enter pool",
      "pooldata_form_namenecessary" => "Name required. ",
      "pooldata_form_securehtml" => "The text contains insecure HTML/JavaScript-Code. ",
      "pooldata_form_descnecessary" => "Description required. ",
      "pooldata_form_areanecessary" => "Area required. ",
      "pooldata_link1" => "modify again",
      "pooldata_link2" => "show pool",
      
      // search-page
      
      "search_text" => "Please separate searchwords with spaces.",
      "search_header" => "Search resources",
      "search_option_all_pools" => "my pools",

      // userdatapassword-page

      "userdatapassword_text" => "On this page you can change your password.",
      "userdata_password_incorrect" => "wrong password",
      "userdatapassword_oldpassword" => "actual password",
      "userdatapassword_newpassword" => "new password",
      "userdatapassword_newpassword2" => "repeat new password",
      "userdatapassword_header" => "Change password",

      // userdata-page

      "userdata_header_change" => "Personal data",
      "userdata_text_change" => "On this page you can change your personal data.",
      "userdata_name" => "username",
      "userdata_password" => "password",
      "userdata_password2" => "repeat password",
      "userdata_email" => "email",
      "userdata_email2" => "repeat email",
      "userdata_emailpublic" => "email public?",
      "userdata_phone" => "phonenumber",
      "userdata_phonepublic" => "phonenumber public?",
      "userdata_adress1" => "street and housenumber.",
      "userdata_adress2" => "zipcode and city",
      "userdata_country" => "country",
      "userdata_adresspublic" => "adress public?",
      "userdata_description" => "description",
      "userdata_name_required" => "username required. ",
      "userdata_password_required" => "password required. ",
      "userdata_nameuniqueness" => "Someone else allready chose this name. ",
      "userdata_emailuniqueness" => "Your email-adress allready exists within the system. ",
      "userdata_submit" => "submit",
      "userdata_password_inlist" => "The password is to common. ",
      "userdata_password_tooshort" => "The password has to consist of at least 6 characters. ",
      "userdata_passwords_differ" => "The passwords differ. ",
      "userdata_email_necessary" => "Email required. ",
      "userdata_emails_differ" => "The adresses differ. ",
      "userdata_not_an_email" => "Email not valid. ",
      "userdata_street_necessary" => "Street required. ",
      "userdata_house_necessary" => "Housenumber required. ",
      "userdata_plz_necessary" => "Zipcode required. ",
      "userdata_plz_numeric" => "Zipcodes consist of just digits. ",
      "userdata_city_necessary" => "City required. ",

      // register-page
      
      "register_submit1" => "Ok. Create account.",
      "register_submit2" => "Create account now.",
      "register_agb" => "terms of service",
      "register_text1" => "If you <font color=gold>register</font>, you can instantly sign into whopools.net. You can change the submitted data <font color=green>afterwards</font>.",
      "register_text2" => "Please enter your contact data. After that, your account is ready.
      Your email should be public. Otherwise, its difficult to get through to you for a stranger.
      Spambots can't see your data.",
      "register_agb_desc-1" => "Please check the data you've entered above and review the <br>
      terms of service below.",
      "register_agb_desc-2" => "Click \"Ok\", to accept the terms of service above.",
      "register_header1" => "Register - Step 1",
      "register_header2" => "Register - Step 2",

      // mysite-page

      "mysite_header" => "My page",
      "mysite_welcome" => "Hello. On this page you can reach all main functions of whopools: search and manage resources, pools you're a member of(or want to become). Remaining questions hopefully are answered <a href=\"./index.php?page=help\">here</a>.",
      "mysite_res_header" => "My resources",
      "mysite_userdata_header" => "My pers. data",
      "mysite_searchres_header" => "Search 4 resources",
      "mysite_freeres_header-1" => "Release resources for ",
      "mysite_freeres_header-2" => " ",
      "mysite_freeres_msg-1" => "You are now a member of ",
      "mysite_freeres_msg-2" => ". Choose resources, you want to release for this pool.",
      "mysite_freerestable_header_category" => "Category",
      "mysite_freerestable_header_name_description" => "Resource",
      "mysite_freerestable_header_since" => "Since",
      "mysite_freerestable_header_type" => "Type",
      "mysite_freeres_button_submit-1" => "Release marked resources for ",
      "mysite_freeres_button_submit-2" => "",
      "mysite_freeres_button_clear" => "Release no resources",
      "mysite_borrowed_header" => "Borrowed resources",
      "mysite_borrowedtable_header_what" => "What",
      "mysite_borrowedtable_header_fromwhom" => "From whom",
      "mysite_mypools_header" => "My pools",
      "mysite_poolsadmin_header" => "pool-admin",
      "mysite_links_userdata_name" => "My pers. data",
      "mysite_links_poolbrowser_name" => "All pools on this server",
      "mysite_links_search_name" => "Look for resources",
      "mysite_links_resdata_name" => "Put in resources",
      "mysite_links_resmanager_name" => "Manage resources",
      "mysite_links_pooldata_name" => "Found a new pool",
      "mysite_links_userdatapassword_name" => "Change password",
      "mysite_poolsadmintable_changedatalink" => "Change poolData",
      "mysite_poolsadmintable_adminlink" => "Administration",
      "mysite_freeres_header" => "Release resources",
      "mysite_fun" => "Do.",
      
      // help-page
      
      "help_header" => "Help",
      "help_link" => "./images/header-links-en-1.png",
      "logout_link" => "./images/header-links-en-2.png",
      "help_content" => "== When will this page be available in english? ==

When someone translates it. See <a href=\"http://www.nutzigems.org/wiki/\">Wiki!</a>",
      
      // pooladmin-page
      
      "pooladmin_header" => " Administration",
      "pooladmin_adminlist_header" => "Admins",
      "pooladmin_memberlist_header" => "Members",
      "pooladmin_addadmins_header" => "Name other admins",
      "pooladmin_addadmins_reallyadd_text-1" => "Really declare ",
      "pooladmin_addadmins_reallyadd_text-2" => " an admin?: ",
      "pooladmin_addadmins_reallyadd_yes" => "Yes",
      "pooladmin_addadmins_reallyadd_no" => "No",
      "pooladmin_kickmember_header" => "Expell user",
      "pooladmin_kickmember_reallykick_text-1" => "Really expell member ",
      "pooladmin_kickmember_reallykick_text-2" => "?: ",
      "pooladmin_kickmember_reallykick_yes" => "Yes",
      "pooladmin_kickmember_reallykick_no" => "Of course not",
      "pooladmin_freemembers_header" => "Users waiting for membership",
      "pooladmin_freemembers_tableheader_name" => "Name",
      "pooladmin_freemembers_tableheader_email" => "Email",
      "pooladmin_freemembers_tableheader_adress" => "Adress",
      "pooladmin_freemembers_tableheader_phone" => "Telephone",
      "pooladmin_freemembers_tableheader_comment" => "Comments",
      "pooladmin_freemembers_table_phonenotpublic" => "Phonenumber is not public",
      "pooladmin_freemembers_table_submit" => "accept marked ones",
      "pooladmin_freemembers_table_clear" => "reject marked ones",
      "pooladmin_delpool_header" => "Delete pool",
      "pooladmin_delpool_link" => "delete this pool now",
      "pooladmin_delpool_reallydel_text-1" => "Really delete this pool?: ",
      "pooladmin_delpool_reallydel_yes" => "Yes",
      "pooladmin_delpool_reallydel_no" => "No",
      
      // resbrowser-page
      
      "resbrowser_header_search" => "Search-results:",
      "resbrowser_header_browse" => "Resources in ",
      "resbrowser_refinesearch_header" => "Refine search: ",
      "resbrowser_page" => "Seite: ",
      
      // resmanager-page

      "resmanager_header" => "Manage resources",
      "resmanager_myrestable_header_category" => "Category",
      "resmanager_myrestable_header_name" => "Name",
      "resmanager_myrestable_header_since" => "Since",
      "resmanager_myrestable_header_type" => "Type",
      "resmanager_myrestable_changelink" => "modify",
      "resmanager_myrestable_noentrys" => "no entrys made yet",
      "resmanager_myrestable_delmarked" => "delete the marked ones",
      "resmanager_borrowed_header" => "Lent out resources",
      "resmanager_all_header" => "All resources",
      "resmanager_myres_header" => "My resources",
      "resmanager_borrowed_tableheader_what" => "What",
      "resmanager_borrowed_tableheader_whom" => "To whom",
      "resmanager_borrowed_isback" => "is back",
      "resmanager_offers_header" => "Requests concerning your resources",
      "resmanager_offers_tableheader_what" => "What",
      "resmanager_offers_tableheader_offers" => "Requests",
      "resmanager_offers_comment" => "Comments",
      "resmanager_offers_sendcontact" => "send contact-data",
      "resmanager_offers_give" => "give",
      "resmanager_offers_lend" => "lend it",
      "resmanager_offers_clear" => "reject",
      
      // showpool-page
      
      "showpool_become_member_header" => "become a member",
      "showpool_become_member_cancomment" => "You can comment your request for membership if you want to.",
      "showpool_become_member_submit" => "request membership",
      "showpool_become_member_link" => "request membership",
      "showpool_become_member_public_link" => "become a member",
      "showpool_become_member_msg_isproven" => "Your request is beeing checked. Maybe it will take a while until you will be a member. You will be sent an email.",
      "showpool_leavepool_link" => "Give up membership",
      "showpool_res_header" => "Resources",
      "showpool_admin_header" => "Administration",
      "showpool_res_category" => "Category",
      "showpool_res_goods" => "Resources",
      "showpool_forum_header" => "Forum",
      "showpool_forum_thread" => "Thread",
      "showpool_forum_lastentry" => "Last Entry",
      "showpool_forum_lastentry_by" => "by",
      "showpool_forum_new_thread" => "new Thread",
      "showpool_forum_headline" => "Headline",
      "showpool_forum_headline_required" => "Headline is required",
      "showpool_forum_text_required" => "Text is required",
      "showpool_membercount_text-1" => "There are ",
      "showpool_membercount_text-2" => " resources in this pool",
      "showpool_members_header" => "members",
      "showpool_nocountry_header" => "no/every country",
      "showpool_do" => "Do",
      "showpool_description" => "description",
      "showpool_area" => "area",
      "showpool_place" => "place",
      "showpool_public" => "public?",

      // threadbrowser
      
      "threadbrowser_by" => "by",
      "threadbrowser_newentry_link" => "make entry",
      "threadbrowser_newentry_hier" => "make entry",
      "threadbrowser_" => "",
      "threadbrowser_" => "",
      "threadbrowser_" => "",
      "threadbrowser_" => "",
      "threadbrowser_" => "",
      "threadbrowser_" => "",

      // poolbrowser-page

      "poolbrowser_all_header" => "Pools on this server",
      
      // search-page
      
      "search_form_searchstring" => "Searchwords",
      "search_form_category" => "Category",
      "search_form_where_inmine" => " in my pools",
      "search_form_where_pooltoo" => " also in \"main Pool\"",
      "search_form_where" => "where",
      "search_form_submit" => "search",

      // forms
      
      "forms_note_staredarenecessary-1" => "Fields marked with ",
      "forms_cat_choosefirst" => "choose first",
      "forms_note_staredarenecessary-2" => " have to be filled.",

      // formular-element-names

      "form_login" => "Login",
      "form_password" => "Password",
      "form_guest_login" => "guest login",
      "form_submit_login" => "Login",

      // formular-validation failures

      "required_name" => "Name required.",
      "required_password" => "Password required.",
      
      // categories
      
      "cat_all" => "All",
      "cat_advising" => "Advice",
      "cat_arts" => "Arts/culture",
      "cat_audio" => "Audio and HiFi",
      "cat_books" => "Books",
      "cat_cds" => "CDs",
      "cat_caretaking" => "Care",
      "cat_common" => "General",
      "cat_computer_knowledge" => "Computers/IT",
      "cat_computer" => "Computers and accessories",
      "cat_dvd" => "DVD",
      "cat_electronic" => "Electronics",
      "cat_food" => "Food",
      "cat_foto" => "Photographing",
      "cat_games" => "Games",
      "cat_garden" => "Garden",
      "cat_handworks" => "Crafts",
      "cat_health" => "Health",
      "cat_helping" => "Support/assistance",
      "cat_household" => "Housekeeping",
      "cat_infrastructure" => "Infrastructure",
      "cat_kitchen" => "Kitchen",
      "cat_knowledge" => "Skills/knowledge",
      "cat_languages" => "Languages",
      "cat_learning" => "Literacy/learning",
      "cat_magazines" => "Magazines",
      "cat_media" => "Media",
      "cat_move" => "Rides/mobility",
      "cat_furniture" => "Furniture",
      "cat_office" => "Office",
      "cat_officematerial" => "Office equipment",
      "cat_no" => "Miscellaneous",
      "cat_other" => "Other",
      "cat_repairing" => "Repairing",
      "cat_rooms" => "Rooms",
      "cat_sleeping" => "Sleeping accommodation",
      "cat_sports" => "Sports",
      "cat_technology" => "Technology/materials",
      "cat_things" => "Things",
      "cat_tools" => "Tools",
      "cat_vehicles" => "Vehicles and accessories",
      "cat_video" => "Video",
      "cat_vinyl" => "Records",      
      "cat_video" => "Video",
      
      // mails
      
      "mails_registered_header" => "whopools.net: Registered" ,
      "mails_registered_body" => "Hello,

You have just registered on whopools.net.
Your login-data is:

Login: [USERNAME]
Passwort: [PASSWORD]

Have fun!" ,
      "mails_lostpassword_header" => "whopools.net: Your password" ,
      "mails_lostpassword_body" => "Hello,

You wanted your password to be send.     
Here's your password: [PASSWORD]

It has been generated automatically, so please change it as fast as possible.

Fun!" ,
      "mails_found_pool_founder_header" => "whopools.net: Pool founded" ,
      "mails_found_pool_founder_body" => "Hello,

Your data is beeing checked. This should not take too much time.
As soon as the pool will be accepted, you will be sent an email." ,
      "mails_found_pool_admin_header" => "whopools.net: Neuer Pool gegründet" ,
      "mails_found_pool_admin_body" => "Guten Tag,

Es wurde ein neuer Pool gegründet, bitte schalte den jemand frei,
oder halt nicht." ,
      "mails_found_pool_accepted_header" => "whopools.net: Your new pool has been accepted" ,
      "mails_found_pool_accepted_body" => "Hello,
      
The pool you founded has now been accepted." ,
      "mails_found_pool_refused_header" => "whopools.net: New pool refused" ,
      "mails_found_pool_refused_body" => "Hello,

For some reason, your pool has not been accepted.

Have fun anyway!" ,
      "mails_new_admin_header" => "whopools.net: You became admin of [POOLNAME].", 
      "mails_new_admin_body" => "Hello,

You became admin of [POOLNAME]." ,
      "mails_kick_member_header" => "whopools.net: You were expelled from [POOLNAME].", 
      "mails_kick_member_body" => "Hello,

Some admin of [POOLNAME] has kicked you right out of it." ,
      "mails_new_member_header" => "whopools.net: New member for [POOLNAME]" ,
      "mails_new_member_body" => "Hello,

Someone wants to become a member of [POOLNAME]. 
Please, somebody out of its admins accept/refuse his membership." ,
      "mails_user_accepted_header" => "whopools.net: [POOLNAME] accepts you.", 
      "mails_user_accepted_body" => "Hello,

The pool \"[POOLNAME]\" you wanted to become a member of 
has accepted your membership.

Soon as you login next, you may choose which
resources you want to release for this pool." ,
      "mails_user_refused_header" => "whopools.net: \"[POOLNAME]\" has not accept your membership", 
      "mails_user_refused_body" => "Hello,

The pool \"[POOLNAME]\", you wanted to become a member of, has
not accepted your membership." ,
      "mails_give_order_header" => "whopools.net: Request for \"[RESNAME]\"." ,
      "mails_give_order_body" => "Hello,

Someone would like to be given \"[RESNAME]\". So please answer his/her request." ,
      "mails_give_accepted_header" => "whopools.net: You were given \"[RESNAME]\"", 
      "mails_give_accepted_body" => "Hello,

Your request for \"[RESNAME]\" has been accepted.
Get this clear together." ,
      "mails_nogood_order_header" => "whopools.net: Request for [RESNAME]" ,
      "mails_nogood_order_body" => "Hello,

There is a request for \"[RESNAME]\". Please answer it." ,
      "mails_nogood_accepted_header" => "whopools.net: You were lent \"[RESNAME]\"", 
      "mails_nogood_accepted_body" => "Hello,

Your request for \"[RESNAME]\" has been accepted.
Get this clear together." ,
      "mails_borrow_order_header" => "whopools.net: Request for [RESNAME]" ,
      "mails_borrow_order_body" => "Hello,

There's a request for your resource \"[RESNAME]\". Please answer it." ,
      "mails_borrow_accepted_header" => "whopools.net: \"[RESNAME]\" was lent to you", 
      "mails_borrow_accepted_body" => "Hello,

Your request for \"[RESNAME]\" has just been accepted.
Get this clear together." ,
      "mails_refused_header" => "whopools.net: Request refused" ,
      "mails_refused_body" => "Hello,

Your request for \"[RESNAME]\" has been refused. So sorry." ,
      "mails_goodbye" => "

---
http://www.whopools.net/" 
    
      );
    
    }
    
}

?>