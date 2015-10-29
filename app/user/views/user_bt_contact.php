<ul class="no-pad no-marg text-center">
    <li class="inline"><?php $c->routeExec("user_exec_sendmail",'<i class="icomoon-envelop2 "></i> ',["id"=>$d["id"]],["class"=>""]);?></li>
    <li class="inline">
        <?php $c->service("userFriend",["id"=>$d["id"]]); ?>
    </li>
</ul>