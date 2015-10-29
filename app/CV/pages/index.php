<!-- BEGIN ROW  -->
<div class="row line-9">
<!-- BEGIN COL : col-md-12 col-lg-12  -->
<div class="col-md-12 col-lg-12 line-7 bg-7 relative shadow	">
	
<!-- BEGIN COL : col-md-5 col-lg-5  -->
<div class="col-md-5 col-lg-5 text-right relative line-9 no-pad">
<h2>Graphisme</h2>
</div>
<!-- END COL : col-md-5 col-lg-5  -->

<!-- BEGIN COL : col-md-5 col-lg-5  -->
<div class="col-md-5 col-lg-5 col-md-offset-2 col-lg-offset-2 relative line-9 no-pad">
<h2>Développement</h2>
</div>
<!-- END COL : col-md-5 col-lg-5  -->
</div>
<!-- END COL : col-md-12 col-lg-12  -->
<!-- BEGIN COL : col-md-12 col-lg-12  -->
<div class="col-md-12 col-lg-12 line-2 bg-4 relative shadow">
	
	<?php $c->img("CV","perso.svg",["id"=>"perso","class"=>"balance"]); ?>

<div class="circle open  centerX">
	<ul id="my-comp" class=" ">
		<li class="circle-1 elem pos-1">
			<a href="#"><input type="text" class="level" value="70" ><?php $c->img("CV","logo-php.svg",["id"=>"log-php","class"=>"logo-pearl"]); ?></a>
			<div class="infos-plus infos-top">
				<ul>
					<li>Développement orienté objet ou procédurale</li>
					<li>Autodidacte et autonome</li>
					<li>Développement d'un framework MVC personnel avec gestion des utilisateurs, des langues et securisation des routes.</li>
				</ul>
			</div>
			
		</li>
		<li class="circle-1 elem pos-2">
			<a href="#"><input type="text" class="level" value="85" ><?php $c->img("CV","logo-html5.svg",["id"=>"log-html5","class"=>"logo-pearl"]); ?></a>
			<div class="infos-plus">
				<ul>
					<li>Le sauveur de l'accéssibilité</li>
				</ul>
			</div>
			
		</li>
		<li class="circle-1 elem pos-3">
			<a href="#"><input type="text" class="level" value="75" ><?php $c->img("CV","logo-jquery.svg",["id"=>"log-jquery","class"=>"logo-pearl"]); ?></a>
			<div class="infos-plus">
				<ul>
					<li>Autodidacte et autonome</li>
					<li>Développement de plugin sur mesure</li>
				</ul>
			</div>
			
		</li>
		<li class="circle-1 elem pos-8">
			<a href="#"><input type="text" class="level" value="30" ><?php $c->img("CV","logo-symfony.svg",["id"=>"log-symfony","class"=>"logo-pearl"]); ?></a>
			<div class="infos-plus infos-left">
				<ul>
					<li>Certificat de réussite Openclassroom : Développer votre site web avec symfony</li>
					<li>Ce n'est qu'un début</li>
				</ul>
			</div>
			
		</li>
		<li class="circle-1 elem pos-9">
			<a href="#"><input type="text" class="level" value="85" ><?php $c->img("CV","logo-css3.svg",["id"=>"log-css3","class"=>"logo-pearl"]); ?></a>
			<div class="infos-plus infos-left">
				<ul>
					<li>Préprocesseur LESS</li>
					<li>Bootstrap 3</li>
				</ul>
			</div>
		</li>
		<li class="circle-center"><a href="#"></a></li>
	</ul>
</div>
	<?php $c->img("CV","nom.png",["id"=>"nom","class"=>""]); ?>
	<?php $c->img("CV","mail-tel.png",["id"=>"mail-tel","class"=>""]); ?>
	<?php $c->img("CV","ombre-jambes.png",["id"=>"ombre-jambes","class"=>""]); ?>
	<?php $c->img("CV","pot-bg.png",["id"=>"pot-bg","class"=>""]); ?>
	<?php $c->img("CV","pot-front.png",["id"=>"pot-front","class"=>""]); ?>
	<?php $c->img("CV","tache-1.png",["id"=>"tache-1","class"=>""]); ?>
	<?php $c->img("CV","tache-2.png",["id"=>"tache-2","class"=>""]); ?>
	<?php $c->img("CV","paper.png",["id"=>"paper","class"=>""]); ?>
</div>
<!-- END COL : col-md-12 col-lg-12  -->


<!-- BEGIN COL : col-md-8 col-lg-8  -->
<div class="col-md-8 col-lg-8 ">
	<?php $c->view("CV","content"); ?>
</div>
<!-- END COL : col-md-8 col-lg-8  -->
</div>
<!-- END ROW  -->