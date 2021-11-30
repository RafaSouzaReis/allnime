<?php

function useModel($model) {
  require_once(ROOT . "/models/model." . $model . ".php");
}

require_once(ROOT . "/models/model.account.php");

class BaseController {

  protected $app;
  protected $styler;
  protected $account;

  public function __construct($app, $styler) {
    $this->app = $app;
    $this->styler = $styler;
  }

  public function loadAccount() {
    if (isset($_SESSION['accountId'])) {
      global $pdo;
      $id = $_SESSION['accountId'];
      $this->account = Account::getById($id);
      if ($this->account != null) {
        $this->styler->assign('logged', true);
        $this->styler->assign('account', $this->account);
      } else {
        $this->styler->assign('logged', false);
      }
    } else {
      $this->styler->assign('logged', false);
    }
  }

  

}

?>