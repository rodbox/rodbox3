<?php
$c->model("app", "count-app"); ?>
<!-- BEGIN COL : col-md-4 col-lg-4  -->
    <table class="table bg-7">
        <tbody>
            <tr>
                <td><span class="caption-subject strong big   bold uppercase"><?php
echo $c->data["countApp"];
?> Applications </span> <span class="caption-helper">installées</span></td>
                <td><?php
$c->routePage("appfile_page_index", "edit") ?></td>
            </tr>
            <tr>
                <td><span class="caption-subject strong big   bold uppercase"><?php
echo $c->data["countRoute"];
?> Routes </span> <span class="caption-helper">référencées</span>
                    <?php
?> </span></td>
                <td><?php
$c->routePage("adminmaster_page_index", "edit") ?></td>
            </tr>
            <tr>
                <td><span class="caption-subject strong big   bold uppercase"><?php
echo $c->data["countService"];
?> Services </span> <span class="caption-helper">référencées</span></td>
                <td><?php
$c->routePage("adminmaster_page_index", "edit") ?></td>
            </tr>
            <tr>
                <td><span class="caption-subject strong big   bold uppercase"><?php
echo $c->data["countUser"];
?> Utilisateurs </span> <span class="caption-helper">enregistrés</span></td>
                <td><?php
$c->routePage("adminmaster_page_user", "edit") ?></td>
            </tr>
            <tr>
                <td><span class="caption-subject strong big   bold uppercase"><?php
echo $c->data["countSnippet"];
?> Snippets </span> <span class="caption-helper">enregistrés</span></td>
                <td><?php
$c->routePage("snippet_page_index", "edit") ?></td>
            </tr>
            <tr>
                <td><span class="caption-subject strong big   bold uppercase"><?php
echo $c->data["countProject"];
?> Projets </span> <span class="caption-helper">en cours</span></td>
                <td></td>
            </tr>
            <?php if($c->isRole("MASTER")): ?>
            <tr>
                <td colspan="2"><span class="caption-subject strong big   bold uppercase"><?php $c->routePage("adminmaster_page_log","log file") ?></span></td>
            </tr>
            <?php endif; ?>
			<?php if($c->isRole("EDITOR")): ?>
            <tr>
                <td colspan="2"><span class="caption-subject strong big   bold uppercase"><?php $c->routePage("adminmaster_page_translate","traduction") ?></span></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
<!-- END COL : col-md-4 col-lg-4  -->