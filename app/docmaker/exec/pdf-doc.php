<?php
$r = ["response"=>false];
// Include the main TCPDF library (search for installation path).
// require_once('../plugins/class-mypdf.php');
// $appAutoload->getLibPhp("tcpdf");

// $loader = require_once "../vendor/autoload.php";
// use use Doctrine\ORM\EntityManage;;

// use \com\tecnick\tcpdf;

// $html = "tptpt";

// echo $html;



// use \Imagine;


// $img = new Imagine\Gd\Imagine();

// echo"<pre>";
// print_r($loader);
// echo"</pre>";

// $size    = new Imagine\Image\Box(40, 40);

// $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
// // or
// $mode    = Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND;

// $img->open(DIR_MY."/log.jpg")
//     ->thumbnail($size, $mode)
//     ->save(DIR_MY."/log-40.jpg");



$tmpRand = substr( md5(rand()), 0, 8);
$tmpFile = DIR_TMP."/tmp-".$tmpRand.".php";


$models = $_GET["doc-list"];

if($models!=""){
$dir = DIR_DOC."/".$models;
$jsonDir = $dir."/".$models.".json";
$pdfDir = $dir."/".$models.".pdf";
$json = json_decode(file_get_contents($jsonDir),true);

$json["fontSizeRatio"] = "1";
$json["nbCol"] = "1";
$json["strLimit"] = "0";
$json["tcellpadding"] = "5";


$json["title"] = $models ;
$json["author"] = "Rodolphe";
$json["source"] = "http://rodbox.fr/docmaker";
// print_r($json);

$pdfFile = $models.".pdf";

include('style.php');

$css .= $json["stylesCss"];
$html = "<style>";
$html .= $css;
$html .= "</style>";

$paletteList = $json["palettes-list"];
$paletteDir = DIR_PALETTES.'/'.$paletteList.'/'.$paletteList.'.json';
$palette = $c->getJson($paletteDir);

ob_start();
    file_put_contents($tmpFile,stripcslashes($json["myTextarea"]));
    include($tmpFile);
    $html .= ob_get_contents();
    unlink($tmpFile);
ob_end_clean();



//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */





/* La configuration */
$config = array(
    'author'        => $json["author"],
    'title'         => $json["title"],
    'source'        => $json["source"],
    'file'          => $pdfFile,
    'date'          => '<strong>'.date("d-m-Y").'</strong> '.date("H:i"),

    'unit'          => 'mm',

    'marginTop'     => $json["marginTop"],
    'marginBottom'  => $json["marginBottom"],
    'marginLeft'    => $json["marginLeft"],
    'marginRight'   => $json["marginRight"],

    'fontSizeRatio' => $json["fontSizeRatio"],
    'nbCol'         => $json["nbCol"],
    'strLimit'      => $json["strLimit"],

    'tcellpadding'  => $json["tcellpadding"]*$json["fontSizeRatio"],
    
    'format'        => $json["format"],
    'orientation'   => $json["orientation"],

    'fontSize_1'    => 7*$json["fontSizeRatio"],
    'fontSize_2'    => 5*$json["fontSizeRatio"],

    'color_1'       => '#a2a2a2',
    'color_2'       => '#696969',
    
    'fileSrc'       => isset($json['fileSrc'])?$json['fileSrc']:false,
    'authorSrc'     => isset($json['authorSrc'])?$json['authorSrc']:false,
    'dateSrc'       => isset($json['dateSrc'])?$json['dateSrc']:false,
    'generateSrc'   => isset($json['generateSrc'])?$json['generateSrc']:false,
    'filePage'      => isset($json['filePage'])?$json['filePage']:false,

    'cHeader'       => $json["cHeader"],
    'bgHeader'      => $json["bgHeader"],
    
    'cFooter'       => $json["cFooter"],
    'bgFooter'      => $json["bgFooter"],

    'cContent'      => $json["cContent"],
    'bgContent'     => $json["bgContent"],

    'palette'       => $palette,

    'tborder'       => 1*$json["fontSizeRatio"],

    'docHeader'     => "<style>".$css."</style>".$json["docHeader"]
);

$i= 1;




// create new PDF document
$pdf = new MYPDF();
/* On charge la configuration par défault */
$pdf->setConfig($config);
/* On execute les fonctions par défault a partir de la config*/
$pdf->setDefault();
/*On crée la page */
$pdf->AddPage();

/* On ecrit le contenue du pdf */
$pdf->writeHTML($html,false,false,true, false);


if (isset($json["style-export-show"])&&$json["style-export-show"]) {
    /* CSS AFFICHAGE */
    $cssContent = '<pre class="c-9">';
    $cssContent .= $css;
    $cssContent .= "</pre>";
    // $html = "";
    $pdf->AddPage();
    /* On ecrit le contenue du pdf */
    $pdf->writeHTML($cssContent,false,false,true, false);
}


// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
// $pdf->Output($dirTarget.$pdfFile, 'F');
$pdf->Output($pdfDir, 'FI');

//============================================================+
// END OF FILE
//============================================================+
//
// echo "oflkm";
}