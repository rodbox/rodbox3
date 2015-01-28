<?php  

include('../includes/class-mypdf.php');

$dir = realpath("../snippets");

/* target pdf */
$pdfFile = "snippet-list.pdf";
$rand = substr( md5(rand()), 0, 8);
$dirTarget 	= realpath("../tmp")."/".$rand."/";
$url = "tmp/".$rand."/".$pdfFile;
mkdir($dirTarget);



/* La configuration */
$config = array(
	'author'		=> 'Rodolphe',
	'title'			=> 'Snippet Generator',
	'source'		=> 'http://rodbox.fr/snippet',
	'file'			=> $pdfFile,
	'date'			=> '<strong>'.date("d-m-Y").'</strong> '.date("H:i"),

	'unit'			=> 'mm',

	'marginTop'		=> $_GET["marginTop"],
	'marginBottom'	=> $_GET["marginBottom"],
	'marginLeft'	=> $_GET["marginLeft"],
	'marginRight'	=> $_GET["marginRight"],

	'fontSizeRatio' => $_GET["fontSizeRatio"],
	'nbCol' 		=> $_GET["nbCol"],
	'strLimit' 		=> $_GET["strLimit"],

	'tcellpadding' 	=> $_GET["tcellpadding"]*$_GET["fontSizeRatio"],
	
	'format' 		=> $_GET["format"],
	'orientation' 	=> $_GET["orientation"],

	'fontSize_1'	=> 7*$_GET["fontSizeRatio"],
	'fontSize_2'	=> 5*$_GET["fontSizeRatio"],

	'color_1'		=> '#a2a2a2',
	'color_2'		=> '#696969',

	'tborder'		=> 1*$_GET["fontSizeRatio"],
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

/* On inclue le fichier de contenue qui renvois $html */
include("../includes/pdf-content.php");

/* On ecrit le contenue du pdf */
$pdf->writeHTML($html,false,false,true, false);

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($dirTarget.$pdfFile, 'F');


$r = array(
            'infotype'=>"success",
            'msg'=>"ok",
            'data'=>['url'=>$url]
        );

echo json_encode($r);
//============================================================+
// END OF FILE
//============================================================+

?>
