<?php
class Styler {
	private $Template;
	private $Lang;
	private $Vars = array("title"=>"");

	public function __construct() {
	}

  public function setTitle($title) {
		$this->assign("title", $title);
  }

  public function init() {
    include(ROOT . '/views/base/header.php');
  }

  public function assign($key, $value) {
    $this->Vars[$key] = $value;
  }

	public function getTemplate() {
		return $this->Template;
	}

  public function setTemplate($template) {
    $this->Template = $template;
  }

  public function render() {
    include(ROOT . '/views/' . $this->Template . '.php');
    include(ROOT . '/views/base/footer.php');
  }

	public function getAssign($key) {
		return isset($this->Vars[$key]) ? $this->Vars[$key] : "Missing Assigned Var: " . $key;
	}

	public function existAssign($key) {
		return isset($this->Vars[$key]);
	}

	public function includes($include) {
		include(ROOT . '/views/includes/' . $include . '.php');
	}

	public function getTemplatePath() {
		return '/views/' . $this->Template;
	}
}

function lang($var) {
	global $APP;
	return $APP->getLang($var);
}
?>
