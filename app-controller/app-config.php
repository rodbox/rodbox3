<?php 

define("WEB_ROOT", 'http://192.168.1.15/rodbox3');

define("DIR_ROOT", '/Applications/MAMP/htdocs/rodbox3');

define("TITLE_PREFIX", 'Rodbox : ');

define("DIR_PACK", DIR_ROOT."/app");
define("WEB_PACK", WEB_ROOT."/app");

define("DIR_APP", DIR_ROOT."/app");
define("WEB_APP", WEB_ROOT."/app");


define("DIR_EXEC", DIR_ROOT."/app/app-exec.php");
define("WEB_EXEC", WEB_ROOT."/app/app-exec.php");

define("DIR_PAGE", DIR_ROOT."/app/app-page.php");
define("WEB_PAGE", WEB_ROOT."/app/app-page.php");

// define("DIR_PAGE_REWRITE", DIR_ROOT);
define("WEB_PAGE_REWRITE", WEB_ROOT);

define("WEB_USERS", WEB_ROOT."/app-users");
define("DIR_USERS", DIR_ROOT."/app-users");

define("WEB_PROJECTS", WEB_ROOT."/app-projects");
define("DIR_PROJECTS", DIR_ROOT."/app-projects");

define("WEB_PUBLIC", WEB_ROOT."/app-public");
define("DIR_PUBLIC", DIR_ROOT."/app-public");

define("DIR_META", DIR_ROOT."/.meta");
define("DIR_TEMPLATES", DIR_ROOT."/app-controller/templates");
define("DIR_AUTOLOAD", DIR_ROOT."/app-controller/autoload.json");
define("DIR_ROUTING", DIR_ROOT."/app-controller/config/routing.json");
define("DIR_SERVICES", DIR_ROOT."/app-controller/config/services.json");

define("DIR_PALETTES", DIR_PUBLIC."/palettes");
define("WEB_PALETTES", WEB_PUBLIC."/palettes");

define("DIR_RESSOURCES", DIR_ROOT."/ressources/ressources");
define("WEB_RESSOURCES", WEB_ROOT."/ressources/ressources");

define("WEB_LIB", WEB_ROOT."/app-controller/lib");
define("DIR_LIB", DIR_ROOT."/app-controller/lib");

define("DIR_MOD", DIR_ROOT."/app-controller/mod");

define("DIR_PAPERTOOL", DIR_ROOT."/paper/tools");
define("DIR_PAPERPRESET", DIR_ROOT."/paper/presets");

define("WEB_SPRITES_EXPORT", WEB_ROOT."/test/tmp");

define("WEB_FILE_EDITOR", WEB_ROOT."/appfile/index.php");

define("DEBUG_MODE", true);

?>