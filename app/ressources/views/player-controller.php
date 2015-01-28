<!-- BEGIN COL : col-md-12 col-lg-12  -->
<div class="col-md-12 col-lg-12 top-4 left  line-3 bg-2 c-7">
    

<div id="bt-player" class=" ">
<h1>Version alpha</h1>
            <!-- BEGIN COL : col-md-3 col-lg-3  -->
            <div class="col-md-3 col-lg-3 no-margh">
                <label  class="block">Item</label>
                <select id="select-perso" name="select-perso" href="exec/list-anim.php" class="selectpicker block">
                    <?php foreach ($list as $key => $value): ?>
                        <?php 
                        $c = count(rscandir(DIR_RESSOURCES.$folderScan."/".$value));
                        ?>
                    <li>
                        <option data-subtext="<?php echo $c; ?>" value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    </li>
                    <?php endforeach ?>
                </select>
                <?php  include('views/additem.php');?>
            </div>
            <!-- END COL : col-md-3 col-lg-3  -->
            <!-- BEGIN COL : col-md-3 col-lg-3  -->
            <div class="col-md-3 col-lg-3 ">
                <label  class="block">Item animation</label>
                <select id="select-anim" name="select-anim" class="selectpicker block">

                </select>
                <?php  include('views/addanim.php');?>
            </div>
            <!-- END COL : col-md-3 col-lg-3  -->
            <!-- BEGIN COL : col-md-6 col-lg-6  -->
            <div class="col-md-6 col-lg-6 ">

            <label class="block">Actions</label>
                            <a href="exec/list.php" id="ressource-open" class="btn btn-default hover-effect"><i class="glyphicon glyphicon-folder-open"></i> <span class="hover-content"> Ouvrir</span></a> <button type="button" class="btn btn-primary hover-effect" data-toggle="modal" data-target="#myModal">
                <i class="glyphicon glyphicon-plus"></i><span class="hover-content"> Upload sprite</span>
                </button>
                <button id="bt-play" data-toggle="button" class="btn btn-default hover-effect" type="button" aria-pressed="false"><i class="glyphicon glyphicon-play"></i> <span class="hover-content"> Play</span></button>
            </div>
            <!-- END COL : col-md-3 col-lg-3  -->
            <!-- BEGIN COL : col-md-3 col-lg-3  -->
            <div class="col-md-3 col-lg-3  marg-top-5">
            <br>
                <label class="block" for="frames">frames</label>
                <input type="range" class="slider-master" id="frames" value="1" min="1" max="1"  step="1">
            </div>
            <div class="col-md-3 col-lg-3  marg-top-5">
            <br>
                
                <label class="block" for="fps">fps</label>
                <input type="range" class="slider-master" id="fps" value="30" min="1" max="240"  step="1">
            </div>
            <!-- END COL : col-md-3 col-lg-3  -->
            <div class="clearfix"></div>
        </div>
</div>
<!-- END COL : col-md-12 col-lg-12  -->