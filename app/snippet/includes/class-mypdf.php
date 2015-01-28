<?php 
include('../plugins/tcpdf/tcpdf.php');
include('../plugins/tcpdf/config/lang/fra.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	public $config;
	protected $formatRef = array(
		"A5"	=> [210,148],
		"A4"	=> [297,210],
		"A3"	=> [420,297]
	);

	protected $format = "A4";
	protected $sizeH;
	protected $sizeW;

	public $colW = 22;

	protected $unit = "mm";

	public function setConfig($config){
		$this->config = $config;
	}

    // Le header
    public function Header() {
        $html = '<strong>'.$this->config['title'].'</strong> <font size="'.$this->config['fontSize_1'].'">by '.$this->config["author"] .'</font>';
        $this->writeHTMLCell(
        	0,
        	0,
        	$this->config['marginLeft'],
        	$this->config['marginTop']-$this->config['fontSize_1'],
        	$html
        );

        $html = '<font size="'.$this->config['fontSize_1'].'"><strong>'.date("d-m-Y").'</strong> '.date("H:i").'</font>';

        $this->writeHTMLCell(
        	20,
        	30,
        	$this->sizeW-12,
        	$this->config['marginTop']-$this->config['fontSize_1']+1,
        	$html
        );
       
    }

    // Le footer
    public function Footer() {
    	$html = '<font size="'.$this->config['fontSize_1'].'"><strong>'.$this->config['source'].'</strong></font> ';
    	$this->writeHTMLCell(
    		0,
    		0,
    		8,
    		$this->sizeH+$this->config['marginTop']-1,
    		$html
    	);

    	$html = '<font size="'.$this->config['fontSize_1'].'"><strong>'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</strong></font>';
    	$this->writeHTMLCell(
    		28,
    		0,
    		$this->sizeW+2,
    		$this->sizeH+$this->config['marginTop']-1,
    		$html
    	);

        $this->Line( 8,$this->sizeH+$this->config['marginTop']-2,$this->sizeW+$this->config['marginRight'],$this->sizeH+$this->config['marginTop']-2, array('width' => '0.5mm', 'dash' => 0, 'color' => array(210, 210, 210)));
    }

    public function setDefault(){
    	$this->format = $this->config['format'];
    	$this->setPageFormat($this->config['format'],$this->config['orientation']);

    	$this->SetFont('dejavusans', '', $this->config['fontSize_1']	, '', true);

    	$this->SetAutoPageBreak(TRUE, 0);

		$this->SetHeaderMargin($this->config['marginTop']);
		$this->SetFooterMargin($this->config['marginBottom']);


		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


		$this->SetAutoPageBreak(TRUE, 12);

		$this->setMargins(
			$this->config['marginLeft'],
			$this->config['marginTop'],
			$this->config['marginRight'],
			$this->config['marginBottom']
		);

		$this->setSizeRef();
		$this->setColWidth();

		$this->setEqualColumns($this->config['nbCol']);
    }

    public function setSizeRef(){
    	if($this->config["orientation"]=="L"){
    		$this->sizeW = $this->formatRef[$this->format][0]-$this->config['marginLeft']-$this->config['marginRight'];
			$this->sizeH = $this->formatRef[$this->format][1]-$this->config['marginTop']-$this->config['marginBottom'];
    	}
    	else {
    		$this->sizeW = $this->formatRef[$this->format][1]-$this->config['marginLeft']-$this->config['marginRight'];
			$this->sizeH = $this->formatRef[$this->format][0]-$this->config['marginTop']-$this->config['marginBottom'];
    	}

    }

    public function setColWidth(){
    	$this->colW = ($this->sizeW)/$this->config['nbCol'];
    }

}
 ?>