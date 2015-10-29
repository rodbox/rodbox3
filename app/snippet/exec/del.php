<?php extract($_GET);
$src = DIR_SNIPPETS."/".$snippetname.".sublime-snippet";

$infotype = (unlink($src))?"success":"error";

$r = array(
            'infotype'=>$infotype,
            'msg'=>"Snippet supprimé",
            'data'=>''
        );



?>