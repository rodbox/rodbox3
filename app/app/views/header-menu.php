<ul role="menu" class="dropdown-menu">

<?php if($c->service("ifuser")): ?>
    <li><?php $c->routePage("appfile_page_index","appfile"); ?></li>
    <li><?php $c->routePage("colors_page_index","colors"); ?></li>
<?php endif; ?>

    <li><a href='http://blog.rodbox.fr' ><i class='glyphicon glyphicon-book'></i> Blog</a></li>
</ul>