<?php
define("APPInit", true);
define("ROOT", realpath(dirname(__FILE__) . "/../"));
class App {
	private $input = array();
	private $headers = array();
	private $config = array();
	private $clean_variables = array("int" => array(0 => "id", 1 => "userid", 2 => "kbcid", 3 => "invoiceid", 4 => "idkb", 5 => "currency"), "a-z" => array(0 => "systpl", 1 => "carttpl", 2 => "language"));
	private $db_host = '';
	private $db_username = '';
	private $db_password = '';
	private $db_name = '';
	private $db_sqlcharset = '';
	private $base_url = '';
	public $remote_ip = '';
	private $config_vars = array(0 => 'instaceid');
	private $language = '';
	private $danger_vars = array(0 => "_GET", 1 => "_POST", 2 => "_REQUEST", 3 => "_SERVER", 4 => "_COOKIE", 5 => "_FILES", 6 => "_ENV", 7 => "GLOBALS");
	private $styler;

	public function __construct() {
		$this->headers = getallheaders();
		$this->loadClasses();
		$_GET = $this->sanitizeInputVars($_GET);
		$_POST = $this->sanitizeInputVars($_POST);
		$_REQUEST = $this->sanitizeInputVars($_REQUEST);
		$_SERVER = $this->sanitizeInputVars($_SERVER);
		$_COOKIE = $this->sanitizeInputVars($_COOKIE);
		foreach ($this->danger_vars as $var) {
			if (isset($_REQUEST[$var]) || isset($_FILES[$var])) {
				exit("Access denied!");
				continue;
			}
		}
		$this->loadInput();
		$this->cleanInput();
		if (!$this->loadConfig()) {
			$this->throwError("500 - Internal Error", "Failed to load config!");
		}
		if(!$this->connectDatabase()) {
			$this->throwError("500 - Internal Error", "Database connection error!");
		}
		$this->loadLanguage();
		$this->styler = new Styler();
		global $APP;
		$APP = $this;
		session_start();
	}

	public function throwError($title, $message) {
		exit("<!DOCTYPE html><html lang=\"en\"> <head> <meta charset=\"utf-8\"> <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> <link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\"> </head> <body style=\"background-color: #EFEFEF;\"> <div style=\"width: 100%; background-color: #525552;\"> <p style=\"font-size: 250%; color: #FFFFFF; padding: 10px;\">Server Error</p> </div><div style=\"background-color: #FFFFFF; margin: 10px; padding: 10px;\"> <div style=\"background-color: #FFFFFF; margin: 10px; border: 1px solid black; padding: 15px;\"> <p style=\"font-size: 200%; color: #FF0000;\">" . $title . "</p> <p style=\"font-size: 100%; color: #000000;\">" . $message . "</p> </div> </div> </body></html>\n");
	}

  public function getStyler() {
    return $this->styler;
  }

	public function processRequest() {
		$url = $this->parseUrl();
		if (!isset($url)) $this->throwError("Failed to parse url.", "Url is invalid.");
		if (empty($url[0])) {
			$controller = $this->loadController('home');
			if ($controller == null) $this->throwError("404 Not Found", "Path not found.");
		} else {
			if (empty($url[0])) $this->throwError("404 Not Found", "Path not found.");
			if ($url[0] == "?i=1") $url[0] = 'home';
			$controller = $this->loadController($url[0]);
			if ($controller == null) $this->throwError("404 Not Found", "Path not found.");
		}
		$controller->process();
	}

	private function parseUrl() {
		$url = filter_input(INPUT_SERVER, 'REQUEST_URI');
		$url = str_replace($this->base_url, '', $url);
		$url = explode("?", $url, 2);
    return explode('/', $url[0]);
  }

  private function loadClasses() {
    if(!$this->loadClass('styler')) $this->throwError("500 - Internal Error", "Error loading Styler class, invalid or nonexistent file!");
		if(!$this->loadClass('controller')) $this->throwError("500 - Internal Error", "Error loading Controller class, invalid or nonexistent file!");
  }

  private function loadController($controller) {
		$controllerPath = ROOT . "/controllers/controller." . $controller . ".php";
    if(file_exists($controllerPath)) {
      include_once($controllerPath);
			if(!class_exists('Controller')) $this->throwError("500 Failed to load", "Failed to load controller, class Controller not found.");
			return new Controller($this, $this->getStyler());
    } else {
      return null;
    }
	}

  private function loadClass($class) {
    $classPath = ROOT . "/classes/class." . $class . ".php";
    if(file_exists($classPath)) {
      include_once($classPath);
      return true;
    } else {
      return false;
    }
  }

	private function connectDatabase() {
	  global $pdo;
	  $pdo = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_username, $this->db_password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  return true;
  }

	private function loadConfig() {
		$configPath = ROOT . "/config.php";
		if(file_exists($configPath)) {
			require($configPath);
		  $this->db_host = $db_host;
	   	$this->db_username = $db_username;
	   	$this->db_password = $db_password;
	   	$this->db_name = $db_name;
			$this->db_sqlcharset = $db_sqlcharset;
			$this->base_url = $base_url;
			return true;
		} else {
		  return false;
		}
	}

	public function getLang($var) {
		global $_LANG;
		return isset($_LANG[$var]) ? $_LANG[$var] : "Missing Language Var: " . $var;
	}

	public function validateLanguage($lang = '') {
		$lang = strtolower($lang);
		$lang = $this->sanitize("a-z", $lang);
		$languages = $this->getLanguages();
		if (!in_array($lang, $languages)) {
			if (in_array("pt-br", $languages)) {
				$lang = "pt-br";
			} else {
				$lang = $languages[0];
			}
		}
		if (!$lang) {
			$this->throwError("500 - Internal Error", "Error loading language, language file not found!");
		}
		return $lang;
	}

	public function getLanguages() {
		$langs = array();
		$dirpath = ROOT . "/lang/";
		if (!is_dir($dirpath)) {
			$this->throwError("500 - Internal Error", "Error loading languages, languages folder not found!");
		}
		$dirinfo = opendir($dirpath);
		while (false !== $file = readdir($dirinfo)) {
			if (!is_dir(ROOT . ("/lang/" . $file))) {
				$pieces = explode(".", $file);
				if ($pieces[1] == "php") {
					$langs[] = $pieces[0];
				}
			}
		}
		closedir($dirinfo);
		sort($langs);
		return  $langs;
	}

	public function loadLanguage()  {
		global $_LANG;
		$_LANG = array();
		if(isset($_SESSION['language'])) {
			$lang = $this->validateLanguage($_SESSION['language']);
			$file = ROOT . "/lang/" . $lang . ".php";
		    if (file_exists($file)) {
			    include $file;
		    } else {
					$this->throwError("500 - Internal Error", "Error loading languages, language " . $file . " not found!");
        }
			return;
		}
		if (isset($this->headers['Accept-Language'])) {
			$Accept_Lang = explode(",", $this->headers['Accept-Language'])[0];
		} else {
			$Accept_Lang = "en";
		}
		$lang = $this->validateLanguage($Accept_Lang);
		$file = ROOT . "/lang/" . $lang . ".php";
		if (file_exists($file)) {
			    $_SESSION['language'] = $lang;
			    $this->language = $lang;
	        include $file;
	  } else {
			$this->throwError("500 - Internal Error", "Error loading languages, language " . $file . " not found!");
    }
	}
	
	public function sanitize($type, $var) {
		if ($type == "int") {
			$var = (int)$var;
		}
		else {
			if ($type == "a-z") {
				$var = preg_replace("/[^0-9a-z-]/i", "", $var);
			} else {
				$var = preg_replace("/[^" . $type . "]/i", "", $var);
			}
		}

		return $var;
	}

	public function getVar($k, $k2 = "") {
		if ($k2) {
			return isset($this->input[$k][$k2]) ? $this->input[$k][$k2] : "";
		}
		return isset($this->input[$k]) ? $this->input[$k] : "";
	}

	private function loadInput() {
		if (isset($_COOKIE)) {
			foreach ($_COOKIE as $k => $v) {
				unset($_REQUEST[$k]);
			}
		}
		if (isset($_REQUEST)) {
		  foreach ($_REQUEST as $k => $v) {
			  $this->input[$k] = $v;
		  }
	  }
	}

	private function cleanInput() {
		foreach ($this->clean_variables as $type => $vars) {
			foreach ($vars as $var) {
				if (isset($this->input[$var])) {
					$this->input[$var] = $this->sanitize($type, $this->input[$var]);
					continue;
				}
			}
		}
	}

	public function sanitizeInputVars($arr) {
		$cleandata = array();
		if (is_array($arr)) {
			if (isset($arr['sqltype'])) {
				return;
			}
			foreach ($arr as $key => $val) {
				if (ctype_alnum(str_replace(array("_", "-", ".", " "), "", $key))) {
					if (is_array($val)) {
						$cleandata[$key] = $this->sanitizeInputVars($val);
						continue;
					}
					$val = str_replace(chr(0), "", $val);
					$cleandata[$key] = htmlspecialchars($val, ENT_QUOTES);
					if (@get_magic_quotes_gpc()) {
						$cleandata[$key] = stripslashes($cleandata[$key]);
						continue;
					}
				}
			}
		} else {
		  $arr = str_replace(chr(0), "", $arr);
			$cleandata = htmlspecialchars($arr, ENT_QUOTES);
			if (@get_magic_quotes_gpc()) {
				$cleandata = stripslashes($cleandata);
			}
		}
		return $cleandata;
	}
}
?>