<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <?php $c->service("userImg",["id"=>$_SESSION["user"]["id"]],"user-img-xs"); ?>
    <strong><?php echo $_SESSION["user"]["username"]; ?></strong>
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li><?php $c->routePage("user_page_edit","mon compte"); ?></li>
        <li><?php $c->routePage("adminmaster_page_log","log"); ?></li>
        
        <li><?php $c->routeExec("user_exec_logout","se déconnecter","",["class"=>"user-disconnect"]); ?></li>
    </ul>
</li>