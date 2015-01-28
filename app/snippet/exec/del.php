<?php extract($_GET);
$src = realpath("../snippets")."/".$snippetname.".sublime-snippet";

$infotype = (unlink($src))?"success":"error";

$r = array(
            'infotype'=>$infotype,
            'msg'=>"Snippet supprimé",
            'data'=>''
        );

echo json_encode($r);

?>