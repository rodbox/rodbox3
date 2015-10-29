<?php $c->routeExec("adminmaster_exec_clearlog","vider","",["class"=>"btn btn-xl bg-2 c-7 bt-clearLog"]); ?>
<?php $c->routeExec("adminmaster_exec_refreshlog","rafraichir","",["class"=>"btn btn-xl bg-2 c-7 bt-refreshLog"]); ?>
<pre>
<?php 

	echo file_get_contents(DIR_LOG);

 ?>
 </pre>