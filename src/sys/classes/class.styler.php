<?php
class ALLNIME_Styler {
	private $Template;
	private $Lang;
	private $Vars = array("title"=>"");

	public function __construct() {
	}

  public function setTitle($var) {
		$this->assign("title", $var);
  }

  public function initPage() {
		global $ALLNIME_Sys;
		global $ALLNIME_Styler;
    include(ROOT . '/template/base/header.php');
  }

  public function assign($var, $var2) {
    $this->Vars[$var] = $var2;
  }

  public function setTemplate($var) {
    $this->Template = $var;
  }

  public function output() {
		global $ALLNIME_Sys;
		global $ALLNIME_Styler;
    include(ROOT . '/template/' . $this->Template . '.php');
    include(ROOT . '/template/base/footer.php');
  }

	public function getAssign($var) {
		return isset($this->Vars[$var]) ? $this->Vars[$var] : "Missing Assigned Var: " . $var;
	}

	public function existAssign($var) {
		return isset($this->Vars[$var]);
	}

	public function includes($var) {
		global $ALLNIME_Sys;
		global $ALLNIME_Styler;
		include(ROOT . '/template/includes/' . $var . '.php');
	}

	public function get_path() {
		return '/template/' . $this->Template;
	}
}

function lang($var) {
	global $ALLNIME_Sys;
	return $ALLNIME_Sys->get_lang($var);
}
?>
