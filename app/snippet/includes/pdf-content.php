<?php 
$snippetList = $_GET["snippet-file"];

$configCat = json_decode(file_get_contents('../config.json'),true);



// On parcour la liste pour generer le tableau de données ordonné.
foreach ($snippetList as $key => $value) {

	// on ouvre chaque fichier
	$src 		= $dir."/".$value.'.sublime-snippet';
	$xmlObj 	= simplexml_load_file($src);
	$infos 		= pathinfo($value);
	$file 		= $infos["filename"];
	$trigger 	= (string)$xmlObj->tabTrigger;
	$content 	= $xmlObj->content;
	if(isset($xmlObj->category) && $xmlObj->category!="")
		$cat =  (string)$xmlObj->category;
	else
		$cat = "all";

	$desc 		=  $xmlObj->description;

	$dorder[$cat][$trigger] = compact("trigger","content","desc","file");
}

/* On crée le contenue du pdf */
$html="";

ksort($dorder);
foreach ($dorder as $cat => $catList) {
	$colorCat = $configCat["category"][$cat]["color"];
ksort($catList);


	$html .= '<table cellspacing="0" cellpadding="'.$pdf->config['tcellpadding'].'" border="0" style="border-spacing:4px 6px; padding:5px;">';

	// header table
	$html .= '<tr>';
		$html .= '<td colspan="3" style=" width:'.($pdf->colW - $pdf->config['tborder']).'mm; background-color: '.$colorCat.'; color:#fff;">'.$cat.'</td>';
	$html .= '</tr>';
	foreach ($catList as $key => $value) {
		extract($value);

		$html .= '<tr >';

		$html .= '<td style=" width:'.$pdf->config['tborder'].'mm;background-color: '.$colorCat.';"> </td>';
		$html .= '<td style=" width:'.($pdf->colW-$pdf->config['tborder']).'mm;">';
			$html .= '<font size="'.$pdf->config['fontSize_2'].'" color="'.$pdf->config['color_1'].'" >';
			$html .= $file;
			$html .= "</font><br/>";

			$html .= "<strong>".$trigger."</strong>";
			
			if ($desc!="")
				$html .= '<br/><font size="'.$pdf->config['fontSize_2'].'" >' . $desc.'</font>';

			$html .= '<i><font size="'.$pdf->config['fontSize_2'].'" color="'.$pdf->config['color_2'].'">';
			if($cat=="color"){
				$color = $content;
				$content = ' <div class="color-preview" style="height:5mm;background-color: '.$content.';"> </div>';
				$content .= $color;
				$html .= $content;
			}
			else{

				$html .= "<br/><code>".htmlentities(substr($content, 0,$pdf->config['strLimit']));
				if (strlen($content)>=$pdf->config['strLimit']) {
					$html .= "...";
				}
				$html .="</code>";
			}
			$html .= "</i></font>";
		$html .= "</td>";
		$html .= '<td style=" width:'.$pdf->config['tborder'].'mm;"> </td>';
		$html .= "</tr>";
	}
$html .= '<tr style="line-height: 0mm; font-size:4px;"><td colspan="2"> </td></tr>';
$html .= "</table>";
}
 ?>