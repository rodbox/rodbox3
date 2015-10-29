<?php
/**
 * autoload required DIR_AUTOLOAD
 */
class appAutoload
{
    private $config;
    
    function __construct($route="") {
        $this->mod("tool");// charge tool pour la fonction merge_unique();
        $autoloadKernel = json_decode(file_get_contents(DIR_AUTOLOAD), true);
        
        if ($route!="") {
            $autoloadRoute = $this->getAppAutoload($route);
            $autoloadComplete = merge_unique($autoloadKernel,$autoloadRoute);
        }
        else{
            $autoloadComplete = $autoloadKernel;
        }
        

        /* End fusion de l'autoload de l'App */
        $this->config = $autoloadComplete;
        $this->getMod();
        $this->getLibPhpInit();
    }
    
    /*** JS ***/
    function js($demo = "app", $file = "app") {
        echo '<script src="'.WEB_APP.'/' . $demo . '/js/' . $file . '.js"></script>'."\n";
    }
    
    function jsInit($url) {
        echo '<script src="' . $url . '.js"></script>'."\n";
    }
    
    function jsLib($lib, $file) {
        echo '<script src="' . WEB_LIB . '/' . $lib . '/' . $file . '.js"></script>'."\n";
    }
    
    function getJs() {
        $json = $this->config;
        
        /* on charge les js init */
        foreach ($json["init"]["js"] as $keyInitApp => $initApp) {
            $this->jsInit($initApp);
        }
        
        /* on charge les lib js init */
        foreach ($json["init"]["lib"] as $keyInitLib => $initLib) {
            $this->getLibJs($initLib);
        }
        
        /* on charge les js app */
        foreach ($json["js"] as $keyApp => $listApp) {
            foreach ($listApp as $keyFile => $valueFile) {
                $this->js($keyApp, $valueFile);
            }
        }
    }
    function getLibJs($name) {
        $json = $this->config;
        
        foreach ($json["lib"][$name]["js"] as $keyFile => $valueFile) {
            $this->jsLib($name, $valueFile);
        }
    }
    
    /*** END JS ***/
    
    /*** CSS ***/
    function css($demo = "app", $file = "style") {
        echo '<link rel="stylesheet" href="'.WEB_APP.'/' . $demo . '/css/' . $file . '.css">'."\n";
    }
    
    function cssInit($url) {
        echo '<link rel="stylesheet" href="' . $url . '.css">'."\n";
    }
    function cssLib($lib, $file) {
        echo '<link rel="stylesheet" href="' . WEB_LIB . '/' . $lib . '/' . $file . '.css">'."\n";
    }
    
    function getCss() {
        $json = $this->config;
        $each = (isset($json["init"]["css"]))?$json["init"]["css"]:[];
        foreach ($each as $keyInitApp => $initApp) {
            $this->cssInit($initApp);
        }
        
        /* on charge les lib js init */
        foreach ($json["init"]["lib"] as $keyInitLib => $initLib) {
            $this->getLibCss($initLib);
        }
        
        $each = (isset($json["css"]))?$json["css"]:[];
        foreach ($each as $keyApp => $listApp) {
            foreach ($listApp as $keyFile => $valueFile) {
                $this->css($keyApp, $valueFile);
            }
        }
    }
    
    function getLibCss($name) {
        $json = $this->config;
        $each = (isset($json["lib"][$name]["css"]))?$json["lib"][$name]["css"]:[];
        foreach ($each as $keyFile => $valueFile) {
            $this->cssLib($name, $valueFile);
        }
    }
    
    /*** END CSS ***/
    
    /*** PHP ***/
    function phpLib($name,$file){
    	require(DIR_LIB.'/'.$name.'/'.$file.'.php');
    }
    function getLibPhp($name) {
        $json = $this->config;
        $each = (isset($json["lib"][$name]["php"]))?$json["lib"][$name]["php"]:[];
        foreach ($each as $keyFile => $valueFile) {
            $this->phpLib($name, $valueFile);
        }
    }
    /*** END PHP ***/

    function mod($name){
        require_once(DIR_MOD.'/mod-'.$name.'.php');
    }
    function getMod(){
        $json = $this->config;
        foreach ($json["init"]["mod"] as $keyInitMod => $initMod) {
            $this->mod($initMod);
        }
    }
    function getLibPhpInit(){
        $json = $this->config;
        foreach ($json["init"]["lib"] as $key => $value){
            $this->getLibPhp($value);
        }
    }

    function getAppAutoload($route){
        /* On recupere le routing kernel */
        $routeList = json_decode(file_get_contents(DIR_ROUTING), true);

        /* on recupere les details de la route 
            $routeList[$route][0] = $app
            $routeList[$route][1] = $file
            $routeList[$route][2] = $type

        */
        $app = $routeList[$route][0];
        $file = $routeList[$route][1];
        $type = $routeList[$route][2];

        /* on recupere l'autoload de l'app de la route */
        $dirAutoload = DIR_APP."/".$app."/config/app-autoload.json";

        $routeAutoload = json_decode(file_get_contents($dirAutoload), true);

        return (isset($routeAutoload[$route])?$routeAutoload[$route]:[]);
    }

} 



?>