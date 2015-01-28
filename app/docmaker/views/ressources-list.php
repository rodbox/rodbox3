<?php 

$folderScan = "anim/perso-1/run/";

$web = WEB_RESSOURCES.$folderScan;
$list   = rscandir(DIR_RESSOURCES.$folderScan);

?>
<ul class="no-padh ressources-preview">
    <li><strong>img</strong>
    	<ul>
    		<li>
    			<img src="<?php echo WEB_ROOT ?>/ressources/ressources/img/dot-grid-isometric-460.jpg">
        		<span class="filename small">dot-grid-isometric-460.jpg</span>
    		</li>
    	</ul>
    </li>
    <li><strong>Anim/run</strong>
        <ul>
            <?php foreach ($list as $key => $value): ?>
                <li>
                    <img src="<?php echo $web.$value ?>">
                    <span class="filename small"><?php echo $value; ?></span>
                </li>
            <?php endforeach ?>
        </ul>
    </li>
    <div class="clearfix"></div>
</ul>