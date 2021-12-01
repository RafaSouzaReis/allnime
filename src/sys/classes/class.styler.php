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
		if(file_exists(ROOT . '/views/base/header.php')) {
			include(ROOT . '/views/base/header.php');
		} else {
			$this->showError('Failed to get Header');
		}
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
		if(file_exists(ROOT . '/views/' . $this->Template . '.php')) {
			include(ROOT . '/views/' . $this->Template . '.php');
		} else {
			$this->showError('Failed to get template \'' . $this->Template. '\'');
		}
		if(file_exists(ROOT . '/views/base/footer.php')) {
			include(ROOT . '/views/base/footer.php');
		} else {
			$this->showError('Failed to get Footer');
		}
  }

	public function getAssign($key) {
		return isset($this->Vars[$key]) ? $this->Vars[$key] : "Missing Assigned Var: " . $key;
	}

	public function existAssign($key) {
		return isset($this->Vars[$key]);
	}

	public function includes($include) {
		if(file_exists(ROOT . '/views/includes/' . $include . '.php')) {
			include(ROOT . '/views/includes/' . $include . '.php');
		} else {
			$this->showError('Failed to get include \'' . $include. '\'');
		}
	}

	public function showError($message) {
		echo '<h5><span style="color: red;">Internal Error:</span> ' . $message . '.</h5>';
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