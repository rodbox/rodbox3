<?php extract($d);  ?>
<form action="exec/save-palette.php" method="POST" class="css-color no-border">
    <nav class="navbar bg-transparent no-border">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse no-pad">
            <ul class="nav navbar-nav ">
                <li><input type="text"  placeholder="Title"  name="title" value="<?php echo $d["title"]; ?>"	/></li>
                <li><input type="text"  placeholder="Suffix"  name="suf" value="<?php echo $d["suf"]; ?>"	/></li>
            </ul>
            <ul class="nav navbar-nav navbar-right marg-right-2">
            <li><span class="btn c-7 ">
    <input type="hidden" class="date" value="<?php echo $d["date"]; ?>">
    <input type="hidden" class="png" name="png" value="">
            <?php echo $d["date"]; ?></span></li>
                <li>
                    <div class="btn-group">
                        <button class="btn no-marg bg-2 c-7 no-border btn-default add-color" data-toggle="tooltip" data-placement="bottom" title="Ajouter une couleur" ><i class="glyphicon glyphicon-plus"></i></button>
                    </div>
                    <div class="btn-group">
                    <a href="#" class="btn no-marg bg-2 c-7 no-border btn-default png-palette" data-toggle="tooltip" data-placement="bottom" title="Générer une image" ><i class="glyphicon glyphicon-picture"></i></a>
                    <a href="<?php $c->routeExecUrl("colors_exec_export-palette","",false); ?>" class="btn no-marg bg-2 c-7 no-border btn-default export-palette" data-toggle="tooltip" data-placement="bottom" title="Export format LESS" ><i class="glyphicon glyphicon-export"></i></a>
                    <a href="<?php $c->routeExecUrl("colors_exec_save-palette","",false); ?>" class="btn no-marg bg-2 c-7 no-border btn-default save-palette" data-toggle="tooltip" data-placement="bottom" title="Enregistrer" ><i class="glyphicon glyphicon-floppy-disk"></i></a>
                   
                    </div>
                </li>
            </ul>
         </div><!-- /.navbar-collapse -->
        </nav>
        <ul class="color-list no-marg no-pad">
            <?php foreach ($palette["key"]as $keyColor => $valueColor): ?>
            <li>
                <span class=" block color-ref "><?php echo $keyColor+1; ?>.</span>
                <div class="color-preview color-preview-thumb" style="background-color: <?php echo $valueColor; ?>;"> </div>
                <input name="color-value[]" type="hidden" class=" color-hex" value="<?php echo $valueColor; ?>"	/>
                <input name="color-name[]" type="hidden" value="<?php echo $palette["name"][$keyColor];  ?>"	/>
            </li>
            <?php endforeach ?>
        </ul>
    <div class="clearfix"></div>
</form>
   <div class="clearfix"></div>