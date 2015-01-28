<?php 

function errorManagerExec($errno, $errstr, $errfile, $errline, $errcontext)
	{
		switch ($errno)
		{
			case E_ERROR:
			case E_PARSE:
			case E_CORE_ERROR:
			case E_CORE_WARNING:
			case E_COMPILE_ERROR:
			case E_COMPILE_WARNING:
			case E_USER_ERROR:
				$type_erreur = "Erreur fatale";
				break;

			case E_WARNING:
			case E_USER_WARNING:
				$type_erreur = "Avertissement";
				break;

			case E_NOTICE:
			case E_USER_NOTICE:
				$type_erreur = "Remarque";
				break;

			case E_STRICT:
				$type_erreur = "Syntaxe Obsolète";
				break;

			default:
				$type_erreur = "Erreur inconnue";
				break;
		}


		$fileError = str_replace(DIR_ROOT,"",$errfile);
		$editFileError = editFileLink($fileError,$errline);

		$errorMsg = "<dl>";
			$errorMsg .= "<dt>Erreur : <dt>";
			$errorMsg .= "<dd>".$type_erreur."</dd>";

			$errorMsg .= "<dt>Message : </dt>";
			$errorMsg .= "<dd>".$errstr."</dd>";

			$errorMsg .= "<dt>Fichier : </dt>";
			$errorMsg .= "<dd>".$editFileError." <span class='pull-right'><span class='small opacity'>Ligne</span> <strong>".$errline."</strong></span></dd>";

			$errorMsg .= "<dt>Route : </dt>";
			$errorMsg .= "<dd>".$errcontext["_GET"]["route"]."</dd>";


		$errorMsg .= "</dl>";

		$r = array(
	        'infotype'=>"error",
	        'msg'=>"Erreur",
	        'msgmeta'=>$errorMsg,
	        'data'=>''
	    );

		echo json_encode($r);
		exit;
	}

	function errorManager($errno, $errstr, $errfile, $errline, $errcontext)
	{
		switch ($errno)
		{
			case E_ERROR:
			case E_PARSE:
			case E_CORE_ERROR:
			case E_CORE_WARNING:
			case E_COMPILE_ERROR:
			case E_COMPILE_WARNING:
			case E_USER_ERROR:
				$type_erreur = "Erreur fatale";
				break;

			case E_WARNING:
			case E_USER_WARNING:
				$type_erreur = "Avertissement";
				break;

			case E_NOTICE:
			case E_USER_NOTICE:
				$type_erreur = "Remarque";
				break;

			case E_STRICT:
				$type_erreur = "Syntaxe Obsolète";
				break;

			default:
				$type_erreur = "Erreur inconnue";
				break;
		}


		$fileError = str_replace(DIR_ROOT,"",$errfile);
		$editFileError = editFileLink($fileError,$errline);

		$errorMsg = "<dl class='php-error'>";
			$errorMsg .= "<dt>Erreur : <dt>";
			$errorMsg .= "<dd>".$type_erreur."</dd>";

			$errorMsg .= "<dt>Message : </dt>";
			$errorMsg .= "<dd>".$errstr."</dd>";

			$errorMsg .= "<dt>Fichier : </dt>";
			$errorMsg .= "<dd>".$editFileError."</dd>";

			$errorMsg .= "<dt>Ligne : </dt>";
			$errorMsg .= "<dd>".$errline."</dd>";


		$errorMsg .= "</dl>";

		$r = array(
	        'infotype'=>"error",
	        'msg'=>"Erreur",
	        'msgmeta'=>$errorMsg,
	        'data'=>''
	    );

		echo $errorMsg;
		exit;
	}

/* gestion de présentation des erreurs */

	function editFileLink($dir,$line=1){
		return "<a href='".WEB_FILE_EDITOR."?file=".$dir."&line=".$line."' target='_blank'>".$dir."</a>";
	}
 ?>