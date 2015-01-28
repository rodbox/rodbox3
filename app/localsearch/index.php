<?php  include('../include.php');?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
        <meta name="apple-mobile-web-app-capable" content="no" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <link rel="apple-touch-icon" href="images/ios_icon.png"/>
        <link rel="apple-touch-startup-image" href="images/ios_startup.png" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="http://demo.rodbox.fr/appdemo/css/style.css">
        <link rel="stylesheet" href="style.css">
        <title>Test</title>
    </head>
    <body>

            <div class="col-md-4  col-md-offset-4 top-1 ">
                <h1 class="big-5"><i class="glyphicon glyphicon-search small-1 "></i> search <span class="small-1 light">&</span> order</h1>
                <div class="padv-5 padh-5 bg-7 ">
                    <input type="text" id="localsearch" name="localsearch" data-target="#list-complete" value=""  class="w-100 big-2 pad-2" />
                    <div class="pad-top-5">
                        <ul id="list-complete" class="no-padv no-padh no-margv big list-group">
                            <?php  include('list.php');?>
                        </ul>
                    </div>
                </div>
                </div>
                <div class="col-md-2 top-1"><h1 class="big-5">&nbsp;</h1>
                <ol class="no-pad no-marg">
                    <li class="pad-bottom-6"><strong>Fonction de recherche sur une liste en locale</strong></li>
                    <li class="pad-bottom-6"><span class="small">(en cours)</span> <strong>Ordonne le résultat en fonction de la pertinance entre ce qui est saisie et le resultat <a href="#" class="help" title="attribue 1pt a chaque erreur de saisie"><i class="glyphicon glyphicon-question-sign"></i></a></strong></li>
                    </ol>
                </div>

            <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
            <script src="http://static.rodbox.fr/mobile-events/jquery.mobile-events.min.js"></script>
            <script src="http://static.rodbox.fr/appmobile/jquery-appmobile.js"></script>
            <script src="plugins/jquery-localsearch.js"></script>
            <script src="app.js"></script>
        </body>
    </html>