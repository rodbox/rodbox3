<div class="tab-content bg-4 pad-5 clearfix">
    <div id="tab_1_1" class="tab-pane fontawesome-demo active">
        <div class="note note-success">
            <p>
            Font Awesome gives you scalable vector icons that can instantly be customized &mdash; size, color, drop shadow, and anything that can be done with the power of CSS. The complete set of 439 icons in Font Awesome 4.1.0
            </p>
            For more info check out: <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">http://fortawesome.github.io/Font-Awesome/icons/</a>
            <p class="well">font-family: FontAwesome;</p>
        </div>
        <h3>Fontawesome Icons</h3>
        <?php  $c->view('_tool_','icon-list-fa');?>
    </div>
    <div id="tab_1_2" class="tab-pane glyphicons-demo">
        <div class="note note-success">
            <p>
            Includes 200 glyphs in font format from the Glyphicon Halflings set. <a target="_blank" href="http://glyphicons.com/">
            Glyphicons </a>
            Halflings are normally not available for free, but their creator has made them available for Bootstrap free of cost.
            </p>
            For more info check out <a target="_blank" href="http://getbootstrap.com/components/#glyphicons">http://getbootstrap.com/components/#glyphicons</a>
            <p class="well">font-family: "Glyphicons Halflings";</p>
        </div>
        <h3>Glyphicons</h3>
        <?php  $c->view('_tool_','icon-list-bootstrap');?>
    </div>
    <div id="tab_1_3" class="tab-pane">
        <div class="note note-success">
            <p>
            Simple Line Icons. 162 Beautifully Crafted Webfont Icons.<br>
            For more info check out <a target="_blank" href="http://graphicburger.com/simple-line-icons-webfont/">http://graphicburger.com/simple-line-icons-webfont/</a>
            </p>
            <p class="well">font-family: "Simple-Line-Icons";</p>
        </div>
        <h3>Simpleline icons</h3>
        <?php  $c->view('_tool_','icon-list-simpleline');?>
    </div>
    <div id="tab_1_4" class="tab-pane">
        <div class ="note">
            <p>Voir le generateur IcoMoon</p>
            <a href="https://icomoon.io/">https://icomoon.io/</a>
            <p class="well">font-family: "icomoon";</p>
        </div>
        <h3>Ico moon </h3>
        <?php  $c->view('_tool_','icon-list-icomoon');?>
    </div>
   
</div>