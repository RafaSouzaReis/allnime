<?php
define("ALLNIME_Init", true);
define("ROOT", realpath(dirname(__FILE__) . "/../"));
include_once ROOT . "/database/dbfunctions.php";

class ALLNIME_Init {
	private $input = array();
	private $config = array();
	private $clean_variables = array("int" => array(0 => "id", 1 => "userid", 2 => "kbcid", 3 => "invoiceid", 4 => "idkb", 5 => "currency"), "a-z" => array(0 => "systpl", 1 => "carttpl", 2 => "language"));
	private $db_host = "";
	private $db_username = "";
	private $db_password = "";
	private $db_name = "";
	private $db_sqlcharset = "";
	public $remote_ip = '';
	private $config_vars = array(0 => 'instaceid');
	private $language = '';
	private $danger_vars = array(0 => "_GET", 1 => "_POST", 2 => "_REQUEST", 3 => "_SERVER", 4 => "_COOKIE", 5 => "_FILES", 6 => "_ENV", 7 => "GLOBALS");

	public function __construct() {
	}

	public function init() {
		$this->load_classes();
		$_GET = $this->sanitize_input_vars($_GET);
		$_POST = $this->sanitize_input_vars($_POST);
		$_REQUEST = $this->sanitize_input_vars($_REQUEST);
		$_SERVER = $this->sanitize_input_vars($_SERVER);
		$_COOKIE = $this->sanitize_input_vars($_COOKIE);
		foreach ($this->danger_vars as $var) {
			if (isset($_REQUEST[$var]) || isset($_FILES[$var])) {
				exit("Access denied!");
				continue;
			}
		}
		$this->load_input();
		$this->clean_input();
		if (!$this->load_config()) {
		}
		if(!$this->connect_database()) {
			$this->throwError("500 - Internal Error", "Database connection error!");
		}
		$this->load_language();
    return $this;
	}

	public function throwError($title, $message) {
		exit("<!DOCTYPE html><html lang=\"en\"> <head> <meta charset=\"utf-8\"> <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"> <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> <link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\"> </head> <body style=\"background-color: #EFEFEF;\"> <div style=\"width: 100%; background-color: #525552;\"> <p style=\"font-size: 250%; color: #FFFFFF; padding: 10px;\">Server Error</p> </div><div style=\"background-color: #FFFFFF; margin: 10px; padding: 10px;\"> <div style=\"background-color: #FFFFFF; margin: 10px; border: 1px solid black; padding: 15px;\"> <p style=\"font-size: 200%; color: #FF0000;\">" . $title . "</p> <p style=\"font-size: 100%; color: #000000;\">" . $message . "</p> </div> </div> </body></html>\n");
	}

  public function getStyler() {
    return new ALLNIME_Styler();
  }

	public function getNavbarMG() {
		return new ALLNIME_Navbar();
	}

  private function load_classes() {
    if(!$this->load_class('styler')) $this->throwError("500 - Internal Error", "Error loading ALLNIMES_Styler class, invalid or nonexistent file!");
		//if(!$this->load_class('navbar')) $this->throwError("500 - Internal Error", "Error loading ALLNIMES_Navbar class, invalid or nonexistent file!");
  }

  private function load_class($class) {
    $class_path = ROOT . "/classes/class." . $class . ".php";
    if(file_exists($class_path)) {
      include_once $class_path;
      return true;
    } else {
      return false;
    }
  }

	private function connect_database() {
	  global $pdo_mysql;
	  $pdo_mysql = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_username, $this->db_password);
	  return true;
  }

	private function load_config() {
		$config_path = ROOT . "/config.php";
		if(file_exists($config_path)) {
			require $config_path;
		    $this->db_host = $db_host;
	    	$this->db_username = $db_username;
	    	$this->db_password = $db_password;
	    	$this->db_name = $db_name;
			$this->db_sqlcharset = $db_sqlcharset;
			return true;
		} else {
		  return false;
		}
	}

	public function get_lang($var) {
		global $_LANG;
		return isset($_LANG[$var]) ? $_LANG[$var] : "Missing Language Var " . $var;
	}

	public function validate_language($lang = '') {
		$lang = strtolower($lang);
		$lang = $this->sanitize("a-z", $lang);
		$languages = $this->get_languages();
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

	public function get_languages() {
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

	public function load_language()  {
		global $_LANG;
		$_LANG = array();
		if(isset($_SESSION['language'])) {
			$lang = $this->validate_language($_SESSION['language']);
			$file = ROOT . "/lang/" . $lang . ".php";
		    if (file_exists($file)) {
			    include $file;
		    } else {
					$this->throwError("500 - Internal Error", "Error loading languages, language " . $file . " not found!");
        }
			return;
		}
		$Accept_Lang = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0];
		$lang = $this->validate_language($Accept_Lang);
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

	public function get_var($k, $k2 = "") {
		if ($k2) {
			return isset($this->input[$k][$k2]) ? $this->input[$k][$k2] : "";
		}
		return isset($this->input[$k]) ? $this->input[$k] : "";
	}

	private function load_input() {
		if (isset($_COOKIE)) {
			foreach ($_COOKIE as $k => $v) {
				unset($_REQUEST[$k]);
			}
		}
		foreach ($_REQUEST as $k => $v) {
			$this->input[$k] = $v;
		}
	}

	private function clean_input() {
		foreach ($this->clean_variables as $type => $vars) {
			foreach ($vars as $var) {
				if (isset($this->input[$var])) {
					$this->input[$var] = $this->sanitize($type, $this->input[$var]);
					continue;
				}
			}
		}
	}

	public function sanitize_input_vars($arr) {
		$cleandata = array();
		if (is_array($arr)) {
			if (isset($arr['sqltype'])) {
				return;
			}
			foreach ($arr as $key => $val) {
				if (ctype_alnum(str_replace(array("_", "-", ".", " "), "", $key))) {
					if (is_array($val)) {
						$cleandata[$key] = $this->sanitize_input_vars($val);
						return;
					}
					$val = str_replace(chr(0), "", $val);
					$cleandata[$key] = htmlspecialchars($val, ENT_QUOTES);
					if (@get_magic_quotes_gpc()) {
						$cleandata[$key] = stripslashes($cleandata[$key]);
						return;
					}
					return;
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
