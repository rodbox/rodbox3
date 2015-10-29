<div class="form-msg">
<h2 class="small c-7 no-marg padv-3 strong"><i class="glyphicon glyphicon-plus"></i> Ajouter au dictionnaire de traduction
<a href="#" class="c-7 pull-right" onClick="$(this).parents('.form-msg').hide()">X</a>
</h2>
<hr class=" marg-top-1 marg-bottom-5">
<form action="<?php echo $c->routeExecUrl("appfile_exec_addmsg");?>" method="post" class="form-addmsg">
<div class="w-50">
<input id="item-addmsgID" type="text" name="key" class="form-control"  placeholder="key" value="1" />
</div>
<div class="w-50">
<?php $c->service("app"); ?>
</div>
<textarea id="item-addmsg" name="msg"  class=" form-control marg-top-3" placeholder="message"></textarea>
<input type="submit" value="Ajouter" class="btn btn-primary w-100 marg-top-3"/>
</form></div>