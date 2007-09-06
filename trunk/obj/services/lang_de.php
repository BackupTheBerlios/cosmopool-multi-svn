<?php

/*
    Copyright 2004, 2005 Robert Griesel

    This file is part of Pools.

    Pools is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    Pools is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Pools; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
/**
 * language-service
 */
 
require_once('./obj/services/lang.php');

class lang_de extends lang {

    // constructor
    public function lang_de() {
    
      $this->lang = 'de';
    
      $this->    msg = array(
      
      // countries
      
      "country_DE" => "Deutschland",
      "country_AT" => "&Ouml;stereich",
      "country_CH" => "Schweiz",
      "country_GR" => "Griechenland",
      "country_GB" => "Gro&szlig;britannien",
      "country_US" => "USA",

      // header texts

      "html_title" => "whopools.net - resource sharing project",
      "language_changer" => "Sprache:",

      // messages, the ones written in red
      "msg_login_correct" => "Du bist jetzt eingeloggt",
      "msg_login_wrong" => "Falscher Login!",
      "msg_logged_out" => "Du bist jetzt ausgeloggt!",
      "msg_login_first" => "Du must dich erst einloggen.",
      "msg_changeres_success" => "Ressourcen erfolgreich ge&auml;ndert!",
      "msg_delng_success" => "Pool(s) abgelehnt.",
      "msg_delpool_success" => "Pool gel&ouml;scht.",
      "msg_freeng_success" => "Pool(s) freigeschaltet.",
      "msg_delres_success" => "Ressourcen erfolgreich gel&ouml;scht!",
      "msg_found_success" => "Der Pool ist Online, wird aber nochmal &uuml;berpr&uuml;ft.",
      "msg_new_success" => "Ressource erfolgreich eingestellt!",
      "msg_data_change_success" => "Daten erfolgreich ge&auml;ndert!",
      "msg_res_insert_success" => "Resource erfolgreich eingegeben!",
      "msg_register_success" => "Registrierung abgeschlossen!",
      "msg_apply_is_proven" => "Dein Antrag wird bearbeitet. Du bekommst eine E-mail, wenn Du freigeschaltet bist.",
      "msg_add_admin" => "Neuer Admin ernannt.",
      "msg_kick_member" => "Mitglied ausgeschlossen.",
      "msg_kickadmin_success" => "Admin ausgeschlossen.",
      "msg_kickadmin_notenourghusers" => "Der Admin konnte nicht ausgeschlossen werden, weil er das einzige Mitglied des Pools ist.",
      "msg_leave_pool" => "Von Pool abgemeldet.",
      "msg_leave_pool_last_admin" => "Du bist der letzte Admin. Also kannst Du den Pool nicht verlassen.",
      "msg_added_request" => "Anfrage wurde abgeschickt.",
      "msg_added_given" => "Du stehst auf der Liste.",
      "msg_added_borrow" => "Du stehst auf der Liste.",
      "msg_give_success" => "Ressource verschenkt.",
      "msg_borrow_success" => "Ressource verliehen.",
      "msg_request_success" => "Kontaktdaten gesendet.",
      "msg_res_back" => "Resource ist wieder verfügbar.",
      "msg_no_results" => "Nichts gefunden.",
      "msg_free_res_success" => "Die Ressourcen wurden freigeschaltet.",
      "msg_accept_user_success" => "der User ist jetzt Mitglied.",
      "msg_refuse_user_success" => "der User wurde abgelehnt.",
      "msg_news_submitted" => "News abgeschickt",
      "msg_nice_try" => "netter Versuch...",
      "msg_pw_sent" => "Dir wurde ein neues Passwort zugeschickt.",
      "msg_forum_entry_made" => "Eintrag gemacht.",
      
      // tables
      
      "tableheaders_contact" => "Kontakt",
      "tableheaders_when" => "Wann",
      "tableheaders_what" => "Was",
      "tableheaders_owner" => "Besitzer",
      "tableheaders_type" => "Typ",
      "tableheaders_is_public" => "&Ouml;ffentlich",
      "tableheaders_adress" => "Wo",
      "tableheaders_rescount" => "Ressourcen",
      "tables_is_public_yes" => "Ja",
      "tables_is_public_no" => "Nein",
      "tables_borrowed" => "verliehen",
      "tables_allready_borrowed" => "ist bereits verliehen",
      "tables_request_running" => "ihre Anfrage läuft",
      "tables_comment_for_the_owner" => "Bemerkungen f&uuml;r den Besitzer(optional)",
      "tables_contactdata" => "Kontaktdaten",
      "tables_contactdata_youdontneed" => "brauchst Du nicht, ist ja deine eigene Ressource.",
      "tables_contactdata_isinvisible" => "sind unsichtbar, weil diese &ouml;ffentliche Ressource jemandem geh&ouml;rt, der in keiner Ihrer Pools ist. Nutze das Formular.",
      "tables_contactbutton_noitem" => "Anfragen",
      "tables_contactbutton_gift" => "Schenken lassen",
      "tables_contactbutton_borrow" => "Ausleihen",
      "tableheaders_name" => "Name",
      "tableheaders_area" => "Bereich",
      
      // page commons
      
      "common_footerlinks_search" => "Suche",
      "common_footerlinks_resdata_new" => "RessourcenEingabe",
      "common_footerlinks_resmanager" => "RessourcenAdmin",
      "common_footerlinks_poolbrowser" => "alle Pools",
      "common_footerlinks_pooldata_new" => "Pool gr&uuml;nden",
      "common_help_link" => "Hilfe",
      "common_bottom_developers" => "Entwicklerseite",
      "common_bottom_about" => "&Uuml;ber whopools.net",
      "common_bottom_contact" => "Kontakt",
      "common_bottom_supersite" => "SuperSite",

      // linktexts

      "link_logout" => "Logout",
      "link_waiting_users" => "Benutzer warten",
      "link_waiting_res" => "Anfragen",
      "link_register" => "Registrieren",
      "link_mysite" => "Meine Seite",

      // text on the homepage

      "homepage_backlink" => "zur&uuml;ck zur Homepage",      
      "home_header" => "Willkommen!",
      "home_lostpasswordheader" => "Passwort vergessen",
      "home_lostpassword_link" => "Passwort vergessen?",
      "home_lostpassword_text" => "Tippe deine E-Mail Adresse ein, und das Passwort wird dir zugeschickt.",
      "home_welcome-1" => "Who<b>pools</b>.<i>net</i> ist ein Online-Tool um jegliche Art von Ressourcen mit anderen zu teilen. Gründe Ressourcen<b>pools</b>, tritt welchen bei, leihe, schenke, werde beschenkt. Einfach registrieren und dann loslegen.<br>",
      "home_links_1" => "die SuperSite",
      "home_links_2" => "die Software hier",
      "home_links_3" => "die neue Software(-planung)",
      "home_ng_res_count-1" => "Auf diesem Server gibt es ",
      "home_ng_res_count-2" => " Pools und ",
      "home_ng_res_count-3" => " Ressourcen",
      "home_login_header" => "Login",
      "home_login_registertext-1" => "Du musst registriert sein, sonst:",
      "home_login_registertext-2" => "Registrieren",
      "home_news_name" => "&Uuml;berschrift",
      "home_news_abstract" => "Abstract",
      "home_news_lang" => "Sprache",
      "home_news_text" => "Text",
      "home_news_submit" => "Abschicken",
      
      // news page
      
      "news_header" => "News",
      
      // resdata-page
      
      "resdata_link1" => "noch eine Ressource eingeben",
      "resdata_link2" => "Ressourcen verwalten",
      "resdata_all_header" => "zur&uuml;ck zu \"Alle Ressourcen\"",
      "resdata_form_name" => "&Uuml;berschrift",
      "resdata_form_description" => "Beschreibung",
      "resdata_form_category" => "Kategorie",
      "resdata_form_type" => "Typ",
      "resdata_form_type_borrow" => "Verleihe",
      "resdata_form_type_give" => "Verschenke",
      "resdata_form_pools" => "F&uuml;r Pools freischalten",
      "resdata_form_submit" => "Eintragen",
      "resdata_form_namenecessary" => "&Uuml;berschrift ist notwendig. ",
      "resdata_form_descnecessary" => "Beschreibung ist notwendig. ",
      "resdata_form_catnecessary" => "Kategorie ist notwendig. ",
      "resdata_form_typenecessary" => "Bitte etwas w&auml;hlen. ",
      
      // additional attributes
      "resdata_form_isbn" => "ISBN",      
      "resdata_form_authors" => "Autor(en)",      
      "resdata_form_keywords" => "Stichwörter",      
      "resdata_form_isbn_submit" => "Suchen",      
      "resdata_form_title" => "Titel",      
      "resdata_form_binding" => "Bindung",      
      "resdata_form_publication_date" => "Jahr der Herausgabe",      
      "resdata_form_publisher" => "Verlag",      
      "resdata_form_number_of_pages" => "Seitenzahl",      
      "resdata_form_signature" => "Signatur",      

      // books keywords
      "resdata_form_select_philosophy" => "Philosophie",
      "resdata_form_select_aesthetics" => "Ästhetik",
      "resdata_form_select_theory of history" => "Geschichtstheorie",
      "resdata_form_select_history" => "Geschichte",
      "resdata_form_select_theory of culture" => "Kulturtheorie",
      "resdata_form_select_theory of art" => "Kunsttheorie",
      "resdata_form_select_economy" => "Ökonomie",
      "resdata_form_select_gender" => "Geschlechterverhältnisse",
      "resdata_form_select_political economy" => "Kritik der politischen Ökonomie",
      "resdata_form_select_sociology" => "Soziologie",
      "resdata_form_select_theory of the state" => "Staatstheorie",
      "resdata_form_select_theory of faschism" => "Faschismustheorie",
      "resdata_form_select_psychology" => "Psychologie",
      "resdata_form_select_psychoanalysis" => "Psychoanalyse",
      "resdata_form_select_repression" => "Repression",
      "resdata_form_select_military" => "Militär",
      "resdata_form_select_art" => "Kunst",
      "resdata_form_select_music" => "Musik",
      "resdata_form_select_film" => "Film",
      "resdata_form_select_visual arts" => "Bildende Kunst",
      "resdata_form_select_kids and youth" => "Kinder/Jugendliche",
      "resdata_form_select_law" => "Recht",
      "resdata_form_select_religion" => "Religion",
      "resdata_form_select_islam" => "Islam",
      "resdata_form_select_buddhism" => "Buddhismus",
      "resdata_form_select_christian" => "Christentum",
      "resdata_form_select_hinduism" => "Hinduismus",
      "resdata_form_select_sects" => "religiöse Sekten",
      "resdata_form_select_criticism of religion" => "Religionskritik",
      "resdata_form_select_slavery" => "Sklaverei",
      "resdata_form_select_drugs" => "Drogen",
      "resdata_form_select_racism" => "Rassismus",
      "resdata_form_select_anti-semitism" => "Antisemitismus",
      "resdata_form_select_travel" => "Reisebericht",
      "resdata_form_select_childrens book" => "Kinder und Jugendbuch",
      "resdata_form_select_novel" => "Roman",
      "resdata_form_select_biography" => "Biographie",
      "resdata_form_select_lyric" => "Lyrik",
      "resdata_form_select_thriller" => "Krimi",
      "resdata_form_select_germany" => "Deutschland",
      "resdata_form_select_prussia" => "Preußen",
      "resdata_form_select_habsburgian" => "Habsburger Monarchie",
      "resdata_form_select_ireland" => "Irland",
      "resdata_form_select_great brittain" => "Großbritannien",
      "resdata_form_select_spain" => "Spanien",
      "resdata_form_select_italy" => "Italien",
      "resdata_form_select_portugal" => "Portugal",
      "resdata_form_select_france" => "Frankreich",
      "resdata_form_select_europe" => "Europa",
      "resdata_form_select_turkey" => "Türkei",
      "resdata_form_select_israel/palestine" => "Israel/Palästina",
      "resdata_form_select_middle east" => "Naher Osten",
      "resdata_form_select_kurdistan" => "Kurdistan",
      "resdata_form_select_iran" => "Iran",
      "resdata_form_select_iraq" => "Irak",
      "resdata_form_select_afghanistan" => "Afghanistan",
      "resdata_form_select_india" => "Indien",
      "resdata_form_select_vietnam" => "Vietnam",
      "resdata_form_select_cambodia" => "Kambodscha",
      "resdata_form_select_korea" => "Korea",
      "resdata_form_select_china" => "China",
      "resdata_form_select_japan" => "Japan",
      "resdata_form_select_asia" => "Asien",
      "resdata_form_select_africa" => "Afrika",
      "resdata_form_select_north africa" => "Nordafrika",
      "resdata_form_select_namibia" => "Namibia",
      "resdata_form_select_south africa" => "Südafrika",
      "resdata_form_select_egypt" => "Ägypten",
      "resdata_form_select_australia" => "Australien",
      "resdata_form_select_oceania" => "Ozeanien",
      "resdata_form_select_america" => "Amerika",
      "resdata_form_select_usa" => "USA",
      "resdata_form_select_canada" => "Kanada",
      "resdata_form_select_mexico" => "Mexiko",
      "resdata_form_select_guatemala" => "Guatemala",
      "resdata_form_select_nicaragua" => "Nicaragua",
      "resdata_form_select_caribbean" => "Karibik",
      "resdata_form_select_central america" => "Mittelamerika",
      "resdata_form_select_cuba" => "Kuba",
      "resdata_form_select_colombia" => "Kolumbien",
      "resdata_form_select_el salvador" => "El Salvador",
      "resdata_form_select_bolivia" => "Bolivien",
      "resdata_form_select_chile" => "Chile",
      "resdata_form_select_peru" => "Peru",
      "resdata_form_select_argentina" => "Argentinien",
      "resdata_form_select_brazil" => "Brasilien",
      "resdata_form_select_south america" => "Südamerika",
      "resdata_form_select_anarchism" => "Anarchismus",
      "resdata_form_select_early socialism" => "Frühsozialismus",
      "resdata_form_select_marxism" => "Marxismus",
      "resdata_form_select_leninism" => "Leninismus",
      "resdata_form_select_stalinism" => "Stalinismus",
      "resdata_form_select_maoism" => "Maoismus",
      "resdata_form_select_trotzkism" => "Trotzkismus",
      "resdata_form_select_s.i." => "S.I.",
      "resdata_form_select_feminism" => "Feminismus",
      "resdata_form_select_critical theory" => "kritische Theorie",
      "resdata_form_select_theory of the left" => "linke Theorie",
      "resdata_form_select_social movements" => "soziale Bewegungen",
      "resdata_form_select_workers movement" => "Arbeiterbewegung",
      "resdata_form_select_womens movement" => "Frauenbewegung",
      "resdata_form_select_environmental movement" => "Umweltbewegung",
      "resdata_form_select_students movement" => "Studentenbewegung",
      "resdata_form_select_class struggle" => "Klassenkämpfe",
      "resdata_form_select_prehistory" => "Vor- und Frühgeschichte",
      "resdata_form_select_ancient world" => "Antike",
      "resdata_form_select_middle ages" => "Mittelalter",
      "resdata_form_select_modern times till 1789" => "Neuzeit bis 1789",
      "resdata_form_select_history of culture" => "Kulturgeschichte",
      "resdata_form_select_history of music" => "Musikgeschichte",
      "resdata_form_select_history of art" => "Kunstgeschichte",
      "resdata_form_select_history of film" => "Filmgeschichte",
      "resdata_form_select_history of literature" => "Literaturgeschichte",
      "resdata_form_select_history of speech" => "Sprachtheorie",
      "resdata_form_select_history of technology" => "Technikgeschichte",
      "resdata_form_select_history of economy" => "Wirtschaftsgeschichte",
      "resdata_form_select_military history" => "Militärgeschichte",
      "resdata_form_select_1st world war" => "1. Weltkrieg",
      "resdata_form_select_2nd world war" => "2. Weltkrieg",
      "resdata_form_select_history of revolutions" => "Revolutionsgeschichte",
      "resdata_form_select_french revolution" => "Französische Revolution",
      "resdata_form_select_russian revolution" => "Russische Revolution",
      "resdata_form_select_1848 revolution" => "Revolution von 1848",
      "resdata_form_select_paris commune" => "Pariser Commune",
      "resdata_form_select_german history" => "Deutsche Geschichte",
      "resdata_form_select_3rd reich" => "3. Reich",
      "resdata_form_select_shoah" => "Shoa",
      "resdata_form_select_faschism" => "Faschismus",
      "resdata_form_select_history after 1945" => "Geschichte nach 1945",

      "resdata_header_change" => "Resource bearbeiten",
      "resdata_header_new" => "Resource eingeben",
      
      // pooldata-page
      
      "pooldata_header_change" => " verwalten",
      "pooldata_header_found" => "Pool gr&uuml;nden",
      "pooldata_text" => "Wer einen Pool gr&uuml;ndet, wird dessen erster Administrator.
        Du kannst sp&auml;ter dieses Amt an andere Mitglieder abgeben oder es mit ihnen teilen.",
      "pooldata_form_name" => "Name f&uuml;r den Pool",
      "pooldata_form_description" => "Beschreibung",
      "pooldata_form_area" => "Bereich",
      "pooldata_form_is_located_no" => "Nein",
      "pooldata_form_is_located_yes" => "Ja",
      "pooldata_form_is_located" => "Ortsgebunden",
      "pooldata_form_is_public" => "&Ouml;ffentlich",
      "pooldata_form_country" => "Land",
      "pooldata_form_country_none" => "keine Angabe",
      "pooldata_form_submit" => "Pool Anmelden",
      "pooldata_form_namenecessary" => "Du musst einen Namen eingeben. ",
      "pooldata_form_descnecessary" => "Du musst eine Beschreibung eingeben. ",
      "pooldata_form_areanecessary" => "Du musst ein Gebiet angeben. ",
      "pooldata_form_securehtml" => "The text contains insecure HTML/JavaScript-Code. ",
      "pooldata_link1" => "nochmal ver&auml;ndern",
      "pooldata_link2" => "zum Pool wechseln",
      
      // search-page
      
      "search_text" => "Suchbegriffe durch Leerzeichen getrennt eingeben.",
      "search_header" => "Ressourcen suchen",
      "search_option_all_pools" => "meine Pools",

      // userdatapassword-page

      "userdatapassword_text" => "Auf dieser Seite kannst Du dein Passwort &auml;ndern.",
      "userdata_password_incorrect" => "Falsches Passwort",
      "userdatapassword_oldpassword" => "Aktuelles Passwort",
      "userdatapassword_newpassword" => "neues Passwort",
      "userdatapassword_newpassword2" => "neues Passwort wiederholen",
      "userdatapassword_header" => "Passwort &auml;ndern",

      // userdata-page

      "userdata_header_change" => "Pers&ouml;hnliche Daten",
      "userdata_text_change" => "Auf dieser Seite kannst Du deine pers&ouml;nlichen Daten &auml;ndern.",
      "userdata_name" => "Benutzername",
      "userdata_password" => "Passwort",
      "userdata_password2" => "Passwort wiederholen",
      "userdata_email" => "E-Mail",
      "userdata_email2" => "E-Mail wiederholen",
      "userdata_emailpublic" => "E-Mail &ouml;ffentlich?",
      "userdata_phone" => "Telefon",
      "userdata_phonepublic" => "Telefon &ouml;ffentlich?",
      "userdata_adress1" => "Strasse und Nr.",
      "userdata_adress2" => "PLZ und Ort",
      "userdata_country" => "Land",
      "userdata_adresspublic" => "Adresse &ouml;ffentlich?",
      "userdata_description" => "Beschreibung",
      "userdata_name_required" => "Du musst einen Namen eingeben. ",
      "userdata_password_required" => "Du musst ein Passwort eingeben. ",
      "userdata_nameuniqueness" => "Der gew&auml;hlte Benutzer-Name existiert bereits. ",
      "userdata_emailuniqueness" => "Diese E-Mail-Adresse existiert bereits im System. ",
      "userdata_submit" => "Abschicken",
      "userdata_password_inlist" => "Das Passwort ist zu gängig. Versuch was ausgefalleneres. ",
      "userdata_password_tooshort" => "Das Passwort musst aus mindestens 6 Zeichen bestehen. ",
      "userdata_passwords_differ" => "Die Passw&ouml;rter unterscheiden sich. ",
      "userdata_email_necessary" => "E-Mail ist notwendig. ",
      "userdata_emails_differ" => "Die Adressen unterscheiden sich. ",
      "userdata_not_an_email" => "Keine g&uuml;ltige E-Mail Adresse. ",
      "userdata_street_necessary" => "Strasse ist erforderlich. ",
      "userdata_house_necessary" => "Hausnummer ist erforderlich. ",
      "userdata_plz_necessary" => "PLZ ist erforderlich. ",
      "userdata_plz_numeric" => "Postleitzahlen bestehen aus Ziffern. ",
      "userdata_city_necessary" => "Ort ist erforderlich. ",
      
      // register-page
      
      "register_submit1" => "Einverstanden. Konto einrichten.",
      "register_submit2" => "Das Konto jetzt einrichten.",
      "register_agb" => "Nutzungsbedingungen",
      "register_text1" => "Wenn Du dich <font color=gold>registrierst</font>, kannst Du dich sofort bei whopools.net einloggen. Die angegebenen Daten kannst <font color=green>nachtr&auml;glich</font> noch <font color=green>&auml;ndern</font>.",
      "register_text2" => "Bitte gib noch deine Kontaktdaten an. Danach ist die Registrierung abgeschlossen.
      Die E-Mail-Adresse sollte &ouml;ffentlich sein, sonst bist Du f&uuml;r Fremde schlecht zu erreichen.
      Spambots k&ouml;nnen die Daten nat&uuml;rlich nicht sehen.",
      "register_agb_desc-1" => "&Uuml;berpr&uuml;fe die oben eingegebenen
Daten und lies die <br>nachstehenden
allgemeinen Nutzungsbedingungen durch.",
      "register_agb_desc-2" => "Klick auf \"Einverstanden\", um die
oben genannten <br>allgemeinen Nutzungsbedingungen
anzunehmen",
      "register_header1" => "Registrieren - Schritt 1",
      "register_header2" => "Registrieren - Schritt 2",

      // mysite-page

      "mysite_header" => "Meine Seite",
      "mysite_welcome" => "Willkommen. Von dieser Seite aus kannst du auf alle Hauptfunktionen von whopools.net zugreifen: auf die Ressourcenverwaltung und -suche, die &Auml;u&szlig;erung von Bed&uuml;rfnissen sowie die Nutzungsgemeinschaften(Pools), in denen du Mitglied bist (oder noch werden kannst...). Die wichtigsten Fragen, die dabei aufkommen k&ouml;nnen, werden hoffentlich <a href=\"./index.php?page=help\">hier</a> beantwortet.",
      "mysite_res_header" => "Meine Ressourcen",
      "mysite_userdata_header" => "Meine Daten",
      "mysite_searchres_header" => "Ressourcensuche",
      "mysite_freeres_header-1" => "Ressourcen für ",
      "mysite_freeres_header-2" => " freischalten",
      "mysite_freeres_msg-1" => "Du wurdest bei ",
      "mysite_freeres_msg-2" => " aufgenommen. W&auml;hl die Ressourcen, die Du für die Pool freischalten willst.",
      "mysite_freerestable_header_category" => "Kategorie",
      "mysite_freerestable_header_name_description" => "Resource",
      "mysite_freerestable_header_since" => "Seit",
      "mysite_freerestable_header_type" => "Typ",
      "mysite_freeres_button_submit-1" => "markierte Ressourcen für ",
      "mysite_freeres_button_submit-2" => " freischalten",
      "mysite_freeres_button_clear" => "keine Resourcen freischalten",
      "mysite_borrowed_header" => "Ausgeliehene Ressourcen",
      "mysite_borrowedtable_header_what" => "Was",
      "mysite_borrowedtable_header_fromwhom" => "Von wem",
      "mysite_mypools_header" => "Meine Pools",
      "mysite_poolsadmin_header" => "Pools-Admin",
      "mysite_links_userdata_name" => "Meine Daten",
      "mysite_links_poolbrowser_name" => "alle Pools auf diesem Server",
      "mysite_links_search_name" => "Ressourcen Suchen",
      "mysite_links_resdata_name" => "Ressourcen Eingeben",
      "mysite_links_resmanager_name" => "Ressourcen Verwalten",
      "mysite_links_pooldata_name" => "Pool gr&uuml;nden",
      "mysite_links_userdatapassword_name" => "Passwort &auml;ndern",
      "mysite_poolsadmintable_changedatalink" => "Daten &auml;ndern",
      "mysite_poolsadmintable_adminlink" => "Administration",
      "mysite_freeres_header" => "Ressourcen freischalten",
      "mysite_fun" => "Do.",
      
      // help-page
      
      "help_header" => "Hilfe",
      "help_link" => "./images/header-links-de-1.png",
      "logout_link" => "./images/header-links-de-2.png",
      "help_content" => "== Wie finde ich was ich suche? ==
===Suche über die Ressourcensuche===
Ein bis mehrere Suchbegriffe (UND-Verknüpfung; Worte durch Leerzeichen getrennt, Großschreibung egal) eingeben, eine Kategorie wählen (Gegenstände, Infastruktur usw.) die angeklickten Datenbanken (nur eigene Nutzigems oder auch der Pool) durchsucht. Dies zeigt alle Einträge an, in denen das Wort bzw alle Worte vorkommen. Auch werden in der aktuellen Programmversion alle Einträge angezeigt, in denen eine Buchstabenkombination vorkommt...
 
Beispiele

'kabel' oder 'Kabel' findet 'verlängerungskabel'  
'was' findet z.B. auch den Eintrag: Bohrmaschine. Auch Schlagbohren, mit Bohrern, ggf. mal was ersetzen...  
Falls nichts gefunden wird, muss vorläufig nach synonymen Worten (Bsp. Auto=PKW), sowie in Ein- und Vielzahl gesucht werden (Bsp. Buch, Bücher). Andernfalls wird die Ressource (noch) nicht angeboten. Dann ist zu überlegen, ob sie zu deinem und aller Nutzen beschaffbar oder sonstwie organisierbar ist. 

===Suche über die Ressourcenlisten===
Zum Anderen können die Ressourcen in den NutziGems, in denen Du Mitglied bist, in einer Liste durchgesehen werden. Zu finden über Meine Seite, NutziGem wählen und anklicken, unter 'Ressourcen' eine Kategorie auswählen.


== Das Eingeben und Verwalten deiner Ressourcen==
===Wie und wann kann ich meine Ressourcen in die software eingeben?  ===
Das Eigeben dessen, was Du an Ressourcen anbieten kannst, ist für eine größere Zahl zugegebenermaßen etwas mühsam. Über den Link 'RessourcenEingabe' in der kleinen Box rechts oben findest Du ein entsprechendes Fenster.
Hier gilt bei der Auswahl der KATEGORIE wie auch bei der Überschrift die Frage: wie würden andere dein spezielles Angebot wohl suchen? 

Die ÜBERSCHRIFT kann auch mehrteilig sein. Hier ist gegbenenfalls z.B. eine Nennung in Einzahl und Mehrzahl sinnvoll, wenn die Worte sich stärker unterscheiden. (Bsp.: 'Sachbuch' und 'Sachbücher', nicht aber 'CD' und 'CD's'). WICHTIG ZUM ORT: ist dein Angebot ortsgebunden (z.B. Umzugshilfe, Verleih oder Verschenken nicht verschickbarer Gegenstände usw.), der Pool, in dem Du die Ressource anbieten willst aber nicht, so gib' gleich in der Überschrift den Ort mit an!

In der BESCHREIBUNG kannst Du dann weitere Einzelheiten über deine Ressource eintragen bzw. über die Bedingungen, zu denen Du sie anbietest. Ein Minimum an Beschreibung ist in der Software obligatorisch... Ist dir das zu mühsam, trage hier ein beliebiges Zeichen ein.

Die Pools, in denen Du die Ressource schließlich freischaltest, d.h. konkret zugänglich machst, klickst Du direkt oder später an. Das bedeutet auch, dass Du schon einmal diverse Einträge vornehmen kannst, sie aber erst zu einem späteren Zeitpunkt überhaupt irgendwo anbietest.

Mit dem Button Eintragen speicherst Du die Angaben ab, weitere Eingaben oder den Überblick deiner bisherigen Ressourcen erreichst Du direkt über die entsprechenden Links (oder über die Links 'RessorcenEingabe' bzw. 'RessourcenAdmin' oben rechts).

btw.: Vielleicht wird es einmal ein kleines Programm für schnelleres Eintragen von Ressourcen (auch offline) geben. Sicher aber lohnt sich schon jetzt, viele deiner Ressourcen einzugeben. Tipp: eine einfache Liste auf deinem eigenen Rechner offline schreiben und online die Einträge in die Felder kopieren.

=== Wie ändere oder lösche ich solche eingetragenen Ressourcen?===

Über den Link 'RessourcenAdmin' rechts oben gelangst Du auf eine Seite, die alle eingetragenen Ressourcen als Liste darstellt. Hier findest Du jeweils rechts den Link für's Ändern. Mit dem Anklicken des linken Kästchens kannst Du am Ende der Liste alle markierten Einträge löschen.
== Wie kann man Pools löschen? ==

Der letzte verbleibende Administrator eines Pools kann diesen löschen. Um einen Pool zu löschen, müssen sich alle Administratoren abmelden, bis auf einen, der kann dann den Pool löschen (auf der Seite Pool-Administration).

== Wenn man einen Pool gründet, der lokal sein soll, wie beschreibt man seinen Ort am besten? ==

Es gibt relativ kleine Gebiete, die aber mehrerer Postleitzahlen haben, weil dort so viele Menschen wohnen. Darum ist die Postleitzahl geteilt. Die Pools werden nach den ersten beiden Ziffern geordnet.

Wenn man einen Pool gründen will, der nur einen Bereich mit einer Postleitzahl umfasst, gebe man alle 5 PLZ-Ziffern an, und den Ort dahinter.

Will man in einem größeren Gebiet aktiv sein, gebe man nur die ersten beiden Ziffern ein, oder sogar nur die erste, und den Ort dahinter, oder eine Liste von Orten.",
      
      // pooladmin-page
      
      "pooladmin_header" => " Administration",
      "pooladmin_adminlist_header" => "Admins",
      "pooladmin_memberlist_header" => "Mitglieder",
      "pooladmin_addadmins_header" => "andere Admins ernennen",
      "pooladmin_addadmins_reallyadd_text-1" => "Wirklich ",
      "pooladmin_addadmins_reallyadd_text-2" => " zum Admin ernennen: ",
      "pooladmin_addadmins_reallyadd_yes" => "Ja",
      "pooladmin_addadmins_reallyadd_no" => "Doch nicht",
      "pooladmin_kickmember_header" => "Mitglieder kicken",
      "pooladmin_kickmember_reallykick_text-1" => "Wirklich ",
      "pooladmin_kickmember_reallykick_text-2" => " kicken: ",
      "pooladmin_kickmember_reallykick_yes" => "Ja",
      "pooladmin_kickmember_reallykick_no" => "Doch nicht",
      "pooladmin_freemembers_header" => "Benutzer, die auf ihre Freischaltung warten",
      "pooladmin_freemembers_tableheader_name" => "Name",
      "pooladmin_freemembers_tableheader_email" => "E-Mail",
      "pooladmin_freemembers_tableheader_adress" => "Adresse",
      "pooladmin_freemembers_tableheader_phone" => "Telefon",
      "pooladmin_freemembers_tableheader_comment" => "Kommentar",
      "pooladmin_freemembers_table_phonenotpublic" => "Telefonnummer nicht &ouml;ffentlich",
      "pooladmin_freemembers_table_submit" => "markierte freischalten",
      "pooladmin_freemembers_table_clear" => "markierte ablehnen",
      "pooladmin_delpool_header" => "Pool aufl&ouml;sen",
      "pooladmin_delpool_link" => "diesen Pool jetzt l&ouml;schen",
      "pooladmin_delpool_reallydel_text-1" => "Wirklich diesen Pool löschen: ",
      "pooladmin_delpool_reallydel_yes" => "Ja",
      "pooladmin_delpool_reallydel_no" => "Doch nicht",
      
      // resbrowser-page
      
      "resbrowser_header_search" => "Suchergebnisse:",
      "resbrowser_header_browse" => "Ressourcen in ",
      "resbrowser_refinesearch_header" => "Suche verfeinern: ",
      "resbrowser_page" => "Seite: ",
      
      // resmanager-page

      "resmanager_header" => "Ressourcen verwalten",
      "resmanager_myrestable_header_category" => "Kategorie",
      "resmanager_myrestable_header_name" => "Angebot",
      "resmanager_myrestable_header_since" => "Seit",
      "resmanager_myrestable_header_type" => "Typ",
      "resmanager_myrestable_changelink" => "&auml;ndern",
      "resmanager_myrestable_noentrys" => "bisher keine Eintr&auml;ge",
      "resmanager_myrestable_delmarked" => "markierte l&ouml;schen",
      "resmanager_borrowed_header" => "Verliehene Ressourcen",
      "resmanager_all_header" => "Alle Ressourcen",
      "resmanager_myres_header" => "Meine Ressourcen",
      "resmanager_borrowed_tableheader_what" => "Angebot",
      "resmanager_borrowed_tableheader_whom" => "An wen",
      "resmanager_borrowed_isback" => "ist zurück",
      "resmanager_offers_header" => "Anfragen bezüglich Deiner Ressourcen",
      "resmanager_offers_tableheader_what" => "Angebot",
      "resmanager_offers_tableheader_offers" => "Anfragen",
      "resmanager_offers_comment" => "Kommentar",
      "resmanager_offers_sendcontact" => "Kontaktdaten zusenden",
      "resmanager_offers_give" => "Verschenken",
      "resmanager_offers_lend" => "Verleihen",
      "resmanager_offers_clear" => "Ablehnen",
      
      // showpool-page
      
      "showpool_become_member_header" => "Mitglied werden",
      "showpool_become_member_cancomment" => "Sie k&ouml;nnen noch einen Kommentar abgeben, warum sie hier Mitglied werden wollen.",
      "showpool_become_member_submit" => "Mitgliedschaft beantragen",
      "showpool_become_member_link" => "Mitgliedschaft beantragen",
      "showpool_become_member_public_link" => "Anmelden",
      "showpool_become_member_msg_isproven" => "Antrag wird &uuml;berpr&uuml;ft, es kann etwas dauern, bis sie freigeschaltet werden. Sie bekommen dann eine E-Mail.",
      "showpool_leavepool_link" => "Von Pool abmelden",
      "showpool_res_header" => "Ressourcen",
      "showpool_admin_header" => "Administration",
      "showpool_res_category" => "Kategorie",
      "showpool_res_goods" => "Ressourcen",
      "showpool_forum_header" => "Forum",
      "showpool_forum_thread" => "Thread",
      "showpool_forum_lastentry" => "Letzer Eintrag",
      "showpool_forum_lastentry_by" => "von",
      "showpool_forum_new_thread" => "Thread erstellen",
      "showpool_forum_headline" => "&Uuml;berschrift",
      "showpool_forum_headline_required" => "&Uuml;berschrift muss eingegeben werden",
      "showpool_forum_text_required" => "Text muss eingegeben werden",
      "showpool_membercount_text-1" => "Es gibt ",
      "showpool_membercount_text-2" => " Ressourcen in diesem Pool",
      "showpool_members_header" => "Mitglieder",
      "showpool_nocountry_header" => "kein/jedes Land",
      "showpool_do" => "Funktionen",
      "showpool_description" => "Beschreibung",
      "showpool_area" => "Bereich",
      "showpool_place" => "Ort",
      "showpool_public" => "&Ouml;ffentlich?",
      
      // threadbrowser
      
      "threadbrowser_by" => "von",
      "threadbrowser_newentry_link" => "neuer Eintrag",
      "threadbrowser_newentry_hier" => "neuer Eintrag",
      "threadbrowser_" => "",
      "threadbrowser_" => "",
      "threadbrowser_" => "",
      "threadbrowser_" => "",
      "threadbrowser_" => "",
      "threadbrowser_" => "",

      // poolbrowser-page

      "poolbrowser_all_header" => "Pools auf diesem Server",
      
      // search-page
      
      "search_form_searchstring" => "Suchbegriffe",
      "search_form_category" => "Kategorie",
      "search_form_where_inmine" => " in meinen Pools",
      "search_form_where_pooltoo" => " auch im \"main Pool\"",
      "search_form_where" => "Wo suchen",
      "search_form_submit" => "Suchen",

      // forms
      
      "forms_cat_choosefirst" => "zuerst w&auml;hlen",
      "forms_note_staredarenecessary-1" => "Felder mit ",
      "forms_note_staredarenecessary-2" => " m&uuml;ssen ausgef&uuml;llt werden.",

      // formular-element-names

      "form_login" => "Login",
      "form_password" => "Passwort",
      "form_guest_login" => "Gastzugang",
      "form_submit_login" => "Einloggen",

      // formular-validation failures

      "required_name" => "Du musst einen Namen eingeben.",
      "required_password" => "Du musst ein Passwort eingeben.",
      
      // categories
      
      "cat_all" => "Alle",
      "cat_advising" => "Beratung",
      "cat_arts" => "Kunst/Kultur",
      "cat_audio" => "Audio und HiFi",
      "cat_books" => "B&uuml;cher",
      "cat_cds" => "CDs",
      "cat_caretaking" => "Betreuung",
      "cat_common" => "Allgemein",
      "cat_computer_knowledge" => "Computer/EDV",
      "cat_computer" => "Computer und Zubeh&ouml;r",
      "cat_dvd" => "DVD",
      "cat_electronic" => "Elektronik",
      "cat_food" => "Ern&auml;hrung",
      "cat_foto" => "Foto und Zubeh&ouml;r",
      "cat_games" => "Spiele",
      "cat_garden" => "Garten",
      "cat_handworks" => "Handwerk",
      "cat_health" => "Gesundheit",
      "cat_helping" => "Mithilfe",
      "cat_household" => "Haushalt",
      "cat_infrastructure" => "Infrastruktur",
      "cat_kitchen" => "K&uuml;che",
      "cat_knowledge" => "Fertigkeiten/Wissen",
      "cat_languages" => "Sprachen",
      "cat_learning" => "Bildung/Lernen",
      "cat_magazines" => "Zeitschriften",
      "cat_media" => "Medien",
      "cat_move" => "Fahrgelegenheiten/Mobilit&auml;t",
      "cat_furniture" => "M&ouml;bel",
      "cat_office" => "B&uuml;ro",
      "cat_officematerial" => "B&uuml;romaterial",
      "cat_no" => "Sonstiges",
      "cat_other" => "andere",
      "cat_repairing" => "Reparaturen",
      "cat_rooms" => "Raumnutzung",
      "cat_sleeping" => "Schlafpl&auml;tze",
      "cat_sports" => "Sport",
      "cat_technology" => "Technik/Material",
      "cat_things" => "Gegenst&auml;nde",
      "cat_tools" => "Werkzeuge",
      "cat_vehicles" => "Fahrzeuge und Zubeh&ouml;r",
      "cat_video" => "Video",
      "cat_vinyl" => "Schallplatten",      
      "cat_video" => "Video" ,
      
      // mails
      
      "mails_registered_header" => "whopools.net: Registriert" ,
      "mails_registered_body" => "Hallo,

Du hast dich bei whopools.net registriert.
Deine Login-Daten sind:

Login: [USERNAME]
Passwort: [PASSWORD]

Viel Spaß" ,
      "mails_lostpassword_header" => "whopools.net: Dein Passwort" ,
      "mails_lostpassword_body" => "Hallo,

Du hast dir dein Passwort zuschicken lassen.
Es lautet: [PASSWORD]

Es wurde automatisch generiert. Bitte ändere es bald.

Viel Spaß" ,
      "mails_found_pool_founder_header" => "Pool gegründet" ,
      "mails_found_pool_founder_body" => "Guten Tag,

Deine Daten werden überprüft. Das sollte nicht allzu lange dauern.
Wenn der Pool freigeschaltet wurde, bekommst Du eine E-Mail." ,
      "mails_found_pool_admin_header" => "neuer Pool gegründet" ,
      "mails_found_pool_admin_body" => "Guten Tag,

Es wurde ein neuer Pool gegründet, bitte schalte den jemand frei,
oder halt nicht." ,
      "mails_found_pool_accepted_header" => "neuer Pool freigeschaltet" ,
      "mails_found_pool_accepted_body" => "Guten Tag,

Dein neuer Pool ist jetzt freigeschaltet." ,
      "mails_found_pool_refused_header" => "neuer Pool abgelehnt" ,
      "mails_found_pool_refused_body" => "Guten Tag,

Der Pool, den Du gründen wolltest, ist leider abgelehnt worden.

Viel Spaß trotzdem!" ,
      "mails_new_admin_header" => "Du bist neuer Admin von [POOLNAME].", 
      "mails_new_admin_body" => "Guten Tag,

Du wurdest zum Admin von [POOLNAME] ernannt." ,
      "mails_kick_member_header" => "Du wurdest aus [POOLNAME] ausgeschlossen.", 
      "mails_kick_member_body" => "Guten Tag,

[POOLNAME] hat dich leider ausgeschlossen." ,
      "mails_new_member_header" => "Neues Mitglied für [POOLNAME]" ,
      "mails_new_member_body" => "Guten Tag,

Jemand hat sich bei [POOLNAME] um eine
Mitgliedschaft beworben. Bitte schalte denjenigen frei,
oder auch nicht." ,
      "mails_user_accepted_header" => "Du bist für [POOLNAME] freigeschaltet.", 
      "mails_user_accepted_body" => "Guten Tag,

Der Pool [POOLNAME], bei dem Du dich beworben hast, hat deine
Mitgliedschaft akzeptiert.

Wenn Du dich das nächste Mal einloggst, kannst Du auswählen, welche
Ressourcen Du für den Pool freischalten willst." ,
      "mails_user_refused_header" => "\"[POOLNAME]\" hat deine Mitgliedschaft nicht akzeptiert.", 
      "mails_user_refused_body" => "Guten Tag,

Der Pool \"[POOLNAME]\", bei der Du dich beworben hast, hat deine
Mitgliedschaft leider nicht akzeptiert." ,
      "mails_give_order_header" => "Anfrage nach \"[RESNAME]\"." ,
      "mails_give_order_body" => "Guten Tag,

Jemand möchte sich \"[RESNAME]\" schenken lassen, bitte beantworte seine Anfrage." ,
      "mails_give_accepted_header" => "Dir wurde \"[RESNAME]\" geschenkt.", 
      "mails_give_accepted_body" => "Guten Tag,

Deine Anfrage bezüglich der Resource \"[RESNAME]\" wurde angenommen. Macht das untereinander klar." ,
      "mails_nogood_order_header" => "Anfrage nach [RESNAME]" ,
      "mails_nogood_order_body" => "Guten Tag,

Es gibt eine Anfrage bezüglich der Resource \"[RESNAME]\". Bitte beantworte diese Anfrage." ,
      "mails_nogood_accepted_header" => "Dir wurde \"[RESNAME]\" ausgeliehen.", 
      "mails_nogood_accepted_body" => "Guten Tag,

Deine Anfrage bezüglich der Resource \"[RESNAME]\" wurde angenommen. Macht das untereinander klar." ,
      "mails_borrow_order_header" => "Anfrage nach [RESNAME]" ,
      "mails_borrow_order_body" => "Guten Tag,

Es gibt eine Anfrage bezüglich der Resource \"[RESNAME]\". Bitte beantworte diese Anfrage." ,
      "mails_borrow_accepted_header" => "Dir wurde \"[RESNAME]\" ausgeliehen.", 
      "mails_borrow_accepted_body" => "Guten Tag,

Deine Anfrage bezüglich der Resource \"[RESNAME]\" wurde angenommen. Macht das untereinander klar." ,
      "mails_refused_header" => "Anfrage abgelehnt" ,
      "mails_refused_body" => "Guten Tag,

Deine Anfrage bezüglich der Resource \"[RESNAME]\" wurde abgelehnt." ,
      "mails_goodbye" => "

---
http://www.whopools.net/" 
    
      );
    
    }
    
}

?>