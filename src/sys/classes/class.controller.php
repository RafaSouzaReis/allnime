<?php

function useModel($model) {
  require(ROOT . "/models/model." . $model . ".php");
}

require(ROOT . "/models/model.account.php");

class BaseController {

  protected $app;
  protected $styler;
  protected $loggedAccount;

  public function __construct($app, $styler) {
    $this->app = $app;
    $this->styler = $styler;
  }

  public function loadAccount() {
    if (isset($_SESSION['accountId'])) {
      global $pdo;
      $id = $_SESSION['accountId'];
      $this->loggedAccount = Account::getById($id);
      if ($this->loggedAccount != null) {
        $this->styler->assign('logged', true);
        $this->styler->assign('account', $this->loggedAccount);
      } else {
        $this->styler->assign('logged', false);
      }
    } else {
      $this->styler->assign('logged', false);
    }
  }

  

}

?>