<?php 

$userID = (isset($_SESSION["user"]["id"]))?$_SESSION["user"]["id"]:0;

define("LANG", 'FR');
define("LANG_PRINCIPAL", 'FR');


define("WEB_ROOT", 'http://192.168.1.44/rodbox3');

define("DIR_ROOT", '/Applications/MAMP/htdocs/rodbox3');

define("TITLE_PREFIX", 'Rodbox : ');

define("DIR_PACK", DIR_ROOT."/app");
define("WEB_PACK", WEB_ROOT."/app");

define("DIR_APP", DIR_ROOT."/app");
define("WEB_APP", WEB_ROOT."/app");


define("WEB_FLAGS", WEB_ROOT."/app/app/img/flags");

define("WEB_SAVE", DIR_ROOT."/app-controller/save");
define("DIR_SAVE", DIR_ROOT."/app-controller/save");




define("DIR_EXEC", DIR_ROOT."/app/app-exec.php");
define("WEB_EXEC", WEB_ROOT."/app/app-exec.php");

define("DIR_PAGE", DIR_ROOT."/app/app-page.php");
define("WEB_PAGE", WEB_ROOT."/app/app-page.php");

define("WEB_PAGE_REWRITE", WEB_ROOT);

define("WEB_USERS", WEB_ROOT."/app-users");
define("DIR_USERS", DIR_ROOT."/app-users");

define("WEB_MY", WEB_USERS."/".$userID);
define("DIR_MY", DIR_USERS."/".$userID);

define("WEB_DOC", WEB_MY."/docmaker");
define("DIR_DOC", DIR_MY."/docmaker");

define("WEB_PROJECTS", WEB_ROOT."/app-projects");
define("DIR_PROJECTS", DIR_ROOT."/app-projects");

define("WEB_PUBLIC", WEB_ROOT."/app-public");
define("DIR_PUBLIC", DIR_ROOT."/app-public");

define("DIR_META", DIR_ROOT."/.meta");
define("DIR_MSG", DIR_ROOT."/app-controller/msg");
define("DIR_TEMPLATES", DIR_ROOT."/app-controller/templates");
define("DIR_AUTOLOAD", DIR_ROOT."/app-controller/config/app-autoload.json");
define("DIR_COMPOSER_AUTOLOAD", DIR_ROOT."/vendor/autoload.php");
define("DIR_ROUTING", DIR_ROOT."/app-controller/config/routing.json");
define("DIR_SERVICES", DIR_ROOT."/app-controller/config/services.json");
define("DIR_ENTITY_MANAGER", DIR_ROOT."/bootstrap.php");

define("DIR_PALETTES", DIR_PUBLIC."/palettes");
define("WEB_PALETTES", WEB_PUBLIC."/palettes");

define("DIR_RESSOURCES", DIR_MY."/ressources");
define("WEB_RESSOURCES", WEB_MY."/ressources");

define("DIR_SNIPPETS_CONFIG", DIR_MY."/snippets/config.json");
define("DIR_SNIPPETS", DIR_MY."/snippets/snippets");
define("WEB_SNIPPETS", WEB_MY."/snippets/snippets");

define("WEB_LIB", WEB_ROOT."/app-controller/lib");
define("DIR_LIB", DIR_ROOT."/app-controller/lib");

define("DIR_MOD", DIR_ROOT."/app-controller/mod");

define("DIR_PAPERTOOL", DIR_MY."/paper/tools");
define("DIR_PAPERPRESET", DIR_MY."/paper/presets");

define("WEB_SPRITES_EXPORT", WEB_ROOT."/test/tmp");

define("WEB_FILE_EDITOR", WEB_ROOT."/web/index.php?route=appfile_page_index");

define("DEBUG_MODE", true);
define("DIR_LOG", DIR_ROOT."/app-controller/log/log.txt");

define("WEB_PHOTOS", WEB_PROJECTS."/photos");
define("DIR_PHOTOS", DIR_PROJECTS."/photos");

define("DIR_TMP", DIR_ROOT."/tmp");
define("WEB_TMP", WEB_ROOT."/tmp");

?>