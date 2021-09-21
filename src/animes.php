<?php

require("./sys/init.php");
if (!class_exists("ALLNIME_Init")) {
  exit("<!DOCTYPE html><html lang=\"en\"> <head> <meta charset=\"utf-8\"> <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> <link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\"> </head> <body style=\"background-color: #EFEFEF;\"> <div style=\"width: 100%; background-color: #525552;\"> <p style=\"font-size: 250%; color: #FFFFFF; padding: 10px;\">Server Error</p> </div><div style=\"background-color: #FFFFFF; margin: 10px; padding: 10px;\"> <div style=\"background-color: #FFFFFF; margin: 10px; border: 1px solid black; padding: 15px;\"> <p style=\"font-size: 200%; color: #FF0000;\">500 - ALLNIME_Sys Error</p> <p style=\"font-size: 100%; color: #000000;\">Error loading ALLNIME_Sys, Init class not definied ?!</p> </div> </div> </body></html>\n");
}
global $ALLNIME_Sys;
global $ALLNIME_Styler;
$ALLNIME_Styler->setTitle('Allnimes - Animes');
$ALLNIME_Styler->initPage();
$ALLNIME_Styler->setTemplate('animes');
$ALLNIME_Styler->output();

?>