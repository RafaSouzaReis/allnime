<?php

require("sys/classes/class.init.php");
global $ALLNIME_Sys;
global $ALLNIME_Styler;
$ALLNIME_Sys = new ALLNIME_Init();
$ALLNIME_Sys = $ALLNIME_Sys->init();
$ALLNIME_Styler = $ALLNIME_Sys->getStyler();

?>