<ul role="menu" class="dropdown-menu">

<?php if($c->service("ifuser")): ?>
    <li><?php $c->routePage("app_page_index",'<i class="icomoon-home"></i> Dashboard'); ?></li>
  	<li class="divider" role="presentation"></li>
    <li><?php $c->routePage("_tool__page_index-icon",'<i class="glyphicon glyphicon-search"></i> Iconfinder'); ?></li>
    <li><?php $c->routePage("snippet_page_index",'<i class="fa fa-code "></i> Snippet'); ?></li>
  	<li><?php $c->routePage("appfile_page_index",'<i class="icomoon-tree6"></i> Fichiers'); ?></li>
    <li><?php $c->routePage("colors_page_index",'<i class="icomoon-palette "></i> Colors'); ?></li>
	<li class="divider" role="presentation"></li>
    <li><?php $c->routePage("adminmaster_page_index",'<i class="icomoon-chess-king"></i> Adminmaster'); ?></li>
    <li><?php $c->routePage("adminmaster_page_user",'<i class="glyphicon glyphicon-user"></i> User'); ?></li>
    <li class="divider" role="presentation"></li>
  	<li><?php $c->routePage("docmaker_page_index",'<i class="glyphicon glyphicon-file"></i> Docmaker'); ?></li>
  	<li><?php $c->routePage("photos_page_index",'<i class="fa fa-photo"></i> Photos'); ?></li>
  	<li class="divider" role="presentation"></li>
  <li><?php $c->routePage("adminmaster_page_doctrine_test",'<i class="icomoon-lab "></i> Doctrine Labo'); ?></li>
  	<li class="divider" role="presentation"></li>
<?php endif; ?>

    <li><a href='http://blog.rodbox.fr' ><i class='glyphicon glyphicon-book'></i> Blog</a></li>
</ul>