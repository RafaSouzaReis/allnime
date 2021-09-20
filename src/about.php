<?php

require("./sys/init.php");
if (!class_exists("ALLNIME_Init")) {
  exit("<!DOCTYPE html><html lang=\"en\"> <head> <meta charset=\"utf-8\"> <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> <link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\"> </head> <body style=\"background-color: #EFEFEF;\"> <div style=\"width: 100%; background-color: #525552;\"> <p style=\"font-size: 250%; color: #FFFFFF; padding: 10px;\">Server Error</p> </div><div style=\"background-color: #FFFFFF; margin: 10px; padding: 10px;\"> <div style=\"background-color: #FFFFFF; margin: 10px; border: 1px solid black; padding: 15px;\"> <p style=\"font-size: 200%; color: #FF0000;\">500 - ALLNIME_Sys Error</p> <p style=\"font-size: 100%; color: #000000;\">Error loading ALLNIME_Sys, Init class not definied ?!</p> </div> </div> </body></html>\n");
}
global $ALLNIME_Sys;
global $ALLNIME_Styler;
$ALLNIME_Styler->setTitle('Allnimes - About');
$ALLNIME_Styler->initPage();
$ALLNIME_Styler->setTemplate('about');
$ALLNIME_Styler->output();

?>

<html>
  <head>
    <h1>Bem-vindo!!!</h1>
  </head>
  <body>
    Allnimes é uma comunidade criada por quatro estudantes de Ciência da Computação e um bicho preguiça, 
    onde você pode encontrar informações dos seus desenhos favoritos (animes são desenhos, aceite) 
    além de marcar o que você anda assistindo e já assistiu.<br>
    Criado como o intuito de desenvolver um site para disciplina de <i>Desenvolvimento Web</i>, 
    todo conteúdo é gratuito e acessível, onde a única limitação é o seu interesse.
  </body>
</html>