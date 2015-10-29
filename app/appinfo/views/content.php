<a href="https://github.com/rodbox/appinfo"><img style="position: absolute; top: 50; left: 0; border: 0;" src="https://camo.githubusercontent.com/82b228a3648bf44fc1163ef44c62fcc60081495e/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_red_aa0000.png"></a>
        <div class="col-md-8 col-md-offset-2 ">
            <h1>jquery-appInfo <strong>Beta</strong></h1>
            <div class="col-md-6"> <h2>Demo</h2>
                <div class=" btn-appinfo">
                    <button class="btn btn-primary" data-msg="mon message" >message</button>
                    <button class="btn btn-primary" data-msg="un message un peu plus long pour voir ce que cela donne sur plusieur ligne" data-open="true" data-timer="0"> message long</button>
                    <button class="btn btn-success" data-type="success" data-msg="mon message success" data-open="true" data-timer="2000">message success timer 2000</button>
                    <button class="btn btn-danger" data-type="danger" data-msg="message danger" >message danger</button>
                    <button class="btn btn-default" data-type="default" data-msg="message open" data-open="true" >message open</button>
                    <button class="btn btn-default" data-type="default" data-msg="message open + ID" data-open="true" data-showID="true">message open + ID</button>
                    <button class="btn btn-default" data-type="star" data-msg="message star" >message star</button>
                    <button class="btn btn-default" data-type="loader" data-msg="Chargement" >message loader</button>
                </div>
                <div>
                    <hr>
                    <button class="btn btn-default toggle-loader-demo" data-to="success" data-msgMeta="" data-timer="500"> loader > success</button>
                    <button class="btn btn-default toggle-loader-demo" data-to="danger" data-msgMeta ="Il y a eu un problème a la ligne X">loader > danger + message meta</button>
                    <button class="btn btn-danger" id="all-delete">delete all</button>
                </div>
            </div>


            <div class="col-md-6" id="source">
                <h3>Source</h3>
                        <pre><code id="source-param">
                            
</code></pre>
            </div>
            <div class="col-md-12">
                <h2>Utilisation</h2>
                <h3>1. Initialisation</h3>
                <p>Initialiser le container de appinfo</p>
<pre><code>$.appinfo.init({
id : "appinfo-container" // id du container par default. default = appinfo-container
});</code></pre>
                <h3>2. Ajouter un message</h3>
                <p>Définition et ajout d'un message</p>
<pre><code>$.appinfo.add({
msg    : "mon message",
timer  : 1000,     // default = 0
        msgmeta: "Message d'information supplémentaire" // default = ""
        showmsgmeta : false// default = true
type   : success   // default = default [default, success, danger, loader]
        showid : true      // default = true
btclose: true      // default = true
});
</code></pre>
                <h3>3. Mis a jours d'un message</h3>
                <p>Mettez a jour un message</p>
<pre><code>// On stock le message dans une variable pour le mettre a jours ou le supprimer
var msgAdd = $.appinfo.add({...});
$.appinfo.upd(msgAdd,{
    msg     : "mon message",
    timer   : 1000,         // default = 0
    msgmeta : "Message d'information supplémentaire" // default = ""
    showmsgmeta : false     // default = true
    from    : type          // default = loader [default, success, danger, loader, star]
    to      : type          // default = success [default, success, danger, loader, star]
    showid  : true          // default = true
    btclose : true          // default = true
});
</code></pre>
                <h3>4. Personnalisation</h3>
                <p>Définissez et personnalisez vos types de message avec le fichier jquery-appinfo.less</p>
                <p>Utiliser comme prefix pour la class de votre type <strong>.appinfo-</strong>/le_nom_de_votre_type/ </p>
       <pre><code>//src jquery-appinfo.less
@typeName:  ... /le_nom_de_mon_type/;
@typeBG:    ... /le_BG_de_mon_type/;
@typeC:     ... /la_couleur_de_mon_type/;
@typeIco:   ... /l_icone_de_mon_type/";
</code></pre>
            </div>
        </div>
        <div class="clearfix"></div>