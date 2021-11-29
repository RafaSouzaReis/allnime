<?php

function useModel($model) {
  require(ROOT . "/models/model." . $model . ".php");
}

?>