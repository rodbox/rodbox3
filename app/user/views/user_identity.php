<div class="text-center user-identity">
    <div class="bg-2 c-3 big no-pad">
        <?php $c->service("userImg",["id"=>$d["id"]],"no-radius rotate-45"); ?>
        <strong><?php echo $d["User"] ?></strong>
        <div class="margv-4">
        <span class="small-1 block"><?php echo $d["UserFirstname"] ?><br> <?php echo $d["UserLastname"] ?></span>
        <span class="small-2 block "><?php if($c->isRole("MASTER") && $d["id"]!=1): ?></span>
        <?php $form  =  $c->form("user","formSetRole");
                        $form->setLabelShow(false);
                        $form->put([
                            "role"=>$d["UserRole"],
                            "id"=>$d["id"]
                        ]);
        $form->getForm(); ?>
        <?php else: ?>
        <strong><span class="small opacity"><?php echo $d["UserRole"] ?></span></strong>
        <?php endif; ?>
    </div>
    <div class="bg-1 padv-2 marg-top-1 user-identity-footer"><?php $c->service("userContact",["id"=>$d["id"]]) ?></div>
    </div>
</div>