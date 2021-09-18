<?php
function full_query($query, $userHandle = null) {
	global $CONFIG;
	global $query_count;
	global $mysql_errors;
	global $apmcraft_mysql;

	$handle = (is_resource($userHandle) ? $userHandle : $apmcraft_mysql);
	$result = mysql_query($query, $handle);

	if (!$result && ($CONFIG['SQLErrorReporting'] || $mysql_errors)) {
		logActivity("SQL Error: " . mysql_error($handle) . " - Full Query: " . $query);
	}

	++$query_count;
	return $result;
}

function insert_query($table, $array) {
	global $CONFIG;
	global $query_count;
	global $mysql_errors;
	global $apmcraft_mysql;
	$fieldnamelist = $fieldvaluelist = "";
	$query = "INSERT INTO " . db_make_safe_field($table) . " ";
	foreach ($array as $key => $value) {
		$fieldnamelist .= db_build_quoted_field($key) . ",";

		if ($value === "now()") {
			$fieldvaluelist .= "'" . date("YmdHis") . "',";
			continue;
		}


		if ($value === "NULL") {
			$fieldvaluelist .= "NULL,";
			continue;
		}

		$fieldvaluelist .= "'" . db_escape_string($value) . "',";
	}

	$fieldnamelist = substr($fieldnamelist, 0, 0 - 1);
	$fieldvaluelist = substr($fieldvaluelist, 0, 0 - 1);
	$query .= "(" . $fieldnamelist . ") VALUES (" . $fieldvaluelist . ")";
	if (defined('DEBUG')){
		print_r(date("Y-m-d H:i:s") . ' -> ' . $query . '<br>');
	}
	$result = mysql_query($query, $apmcraft_mysql);
	if (!$result && ($CONFIG['SQLErrorReporting'] || $mysql_errors)) {
		//logActivity("SQL Error: " . mysql_error($apmcraft_mysql) . " - Full Query: " . $query);
	}

	++$query_count;
	$id = mysql_insert_id($apmcraft_mysql);
	return $id;
}

function get_query_val($table, $field, $where, $orderby = "", $orderbyorder = "", $limit = "", $innerjoin = "") {
	$result = select_query($table, $field, $where, $orderby, $orderbyorder, $limit, $innerjoin);
	$data = mysql_fetch_array($result);
	return $data[0];
}

function get_query_vals($table, $field, $where, $orderby = "", $orderbyorder = "", $limit = "", $innerjoin = "") {
	$result = select_query($table, $field, $where, $orderby, $orderbyorder, $limit, $innerjoin);
	$data = mysql_fetch_array($result);
	return $data;
}

function get_query_array($table, $field, $where, $orderby = "", $orderbyorder = "", $limit = "", $innerjoin = "") {
	$result = select_query($table, $field, $where, $orderby, $orderbyorder, $limit, $innerjoin);
	$rows = array();
	while ($row = mysql_fetch_array($result)) {
    $rows[] = $row;
  }
	return $rows;
}

function select_query($table, $fields, $where, $orderby = "", $orderbyorder = "", $limit = "", $innerjoin = "") {
	global $CONFIG;
	global $query_count;
	global $mysql_errors;
	global $apmcraft_mysql;

	if (!$fields) {
		$fields = "*";
	}

	$query = "SELECT " . $fields . " FROM " . db_make_safe_field($table);

	if ($innerjoin) {
		$query .= " INNER JOIN " . db_escape_string($innerjoin) . "";
	}


	if ($where) {
		if (is_array($where)) {
			$criteria = array();
			foreach ($where as $origkey => $value) {
				$key = db_make_safe_field($origkey);

				if (is_array($value)) {
					if ($key == "default") {
						$key = "`default`";
					}


					if ($value['sqltype'] == "LIKE") {
						$criteria[] = "" . $key . " LIKE '%" . db_escape_string($value['value']) . "%'";
						continue;
					}


					if ($value['sqltype'] == "NEQ") {
						$criteria[] = "" . $key . "!='" . db_escape_string($value['value']) . "'";
						continue;
					}


					if ($value['sqltype'] == ">" && db_is_valid_amount($value['value'])) {
						$criteria[] = "" . $key . ">" . $value['value'];
						continue;
					}


					if ($value['sqltype'] == "<" && db_is_valid_amount($value['value'])) {
						$criteria[] = "" . $key . "<" . $value['value'];
						continue;
					}


					if ($value['sqltype'] == "<=" && db_is_valid_amount($value['value'])) {
						$criteria[] = "" . $origkey . "<=" . $value['value'];
						continue;
					}


					if ($value['sqltype'] == ">=" && db_is_valid_amount($value['value'])) {
						$criteria[] = "" . $origkey . ">=" . $value['value'];
						continue;
					}


					if ($value['sqltype'] == "TABLEJOIN") {
						$criteria[] = "" . $key . "=" . db_escape_string($value['value']) . "";
						continue;
					}


					if ($value['sqltype'] == "IN") {
						$criteria[] = "" . $key . " IN (" . db_build_in_array($value['values']) . ")";
						continue;
					}

					exit("Invalid input condition");
					continue;
				}


				if (substr($key, 0, 3) == "MD5") {
					$key = explode("(", $origkey, 2);
					$key = explode(")", $key[1], 2);
					$key = db_make_safe_field($key[0]);
					$key = "MD5(" . $key . ")";
				}
				else {
					$key = db_build_quoted_field($key);
				}

				$criteria[] = "" . $key . "='" . db_escape_string($value) . "'";
			}

			$query .= " WHERE " . implode(" AND ", $criteria);
		}
		else {
			$query .= " WHERE " . $where;
		}
	}


	if ($orderby) {
		$orderbysql = tokenizeOrderby($orderby, $orderbyorder);
		$query .= " ORDER BY " . implode(",", $orderbysql);
	}


	if ($limit) {
		if (strpos($limit, ",")) {
			$limit = explode(",", $limit);
			$limit = (int)$limit[0] . "," . (int)$limit[1];
		}
		else {
			$limit = (int)$limit;
		}

		$query .= " LIMIT " . $limit;
	}
	if (defined('DEBUG')){
		print_r(date("Y-m-d H:i:s") . ' -> ' . $query . '<br>');
	}
	$result = mysql_query($query, $apmcraft_mysql);

	if (!$result && ($CONFIG['SQLErrorReporting'] || $mysql_errors)) {
		//logActivity("SQL Error: " . mysql_error($apmcraft_mysql) . " - Full Query: " . $query);
	}

	++$query_count;
	return $result;
}

function update_query($table, $array, $where) {
	global $CONFIG;
	global $query_count;
	global $mysql_errors;
	global $apmcraft_mysql;

	$query = "UPDATE " . db_make_safe_field($table) . " SET ";
	foreach ($array as $key => $value) {
		$query .= db_build_quoted_field($key) . "=";
		$key = db_make_safe_field($key);

		if ($value === "now()") {
			$query .= "'" . date("YmdHis") . "',";
			continue;
		}


		if ($value === "+1") {
			$query .= "`" . $key . "`+1,";
			continue;
		}


		if ((is_array($value) && isset($value['type'])) && $value['type'] == "AES_ENCRYPT") {
			$query .= sprintf("AES_ENCRYPT('%s','%s'),", db_escape_string($value['text']), db_escape_string($value['hashkey']));
			continue;
		}


		if ($value === "NULL") {
			$query .= "NULL,";
			continue;
		}


		if (substr($value, 0, 2) === "+=" && db_is_valid_amount(substr($value, 2))) {
			$query .= "`" . $key . "`+" . substr($value, 2) . ",";
			continue;
		}


		if (substr($value, 0, 2) === "-=" && db_is_valid_amount(substr($value, 2))) {
			$query .= "`" . $key . "`-" . substr($value, 2) . ",";
			continue;
		}

		$query .= "'" . db_escape_string($value) . "',";
	}

	$query = substr($query, 0, 0 - 1);

	if (is_array($where)) {
		$query .= " WHERE";
		foreach ($where as $key => $value) {

			if (substr($key, 0, 4) == "MD5(") {
				$key = "MD5(" . db_make_safe_field(substr($key, 4, 0 - 1)) . ")";
			}
			else {
				$key = db_make_safe_field($key);

				if ($key == "order") {
					$key = "`order`";
				}
			}

			$query .= " " . $key . "='" . db_escape_string($value) . "' AND";
		}

		$query = substr($query, 0, 0 - 4);
	}
	else {
		if ($where) {
			$query .= " WHERE " . $where;
		}
	}
	if (defined('DEBUG')){
		print_r(date("Y-m-d H:i:s") . ' -> ' . $query . '<br>');
	}
	$result = mysql_query($query, $apmcraft_mysql);

	if (!$result && ($CONFIG['SQLErrorReporting'] || $mysql_errors)) {
		//logActivity("SQL Error: " . mysql_error($apmcraft_mysql) . " - Full Query: " . $query);
	}

	++$query_count;
}

function db_make_safe_field($field) {
	return db_escape_string(preg_replace("/[^a-z0-9_.,]/i", "", $field));
}

function db_build_quoted_field($key) {
	$field_quote = "`";
	$parts = explode(".", $key, 3);
	foreach ($parts as $k => $name) {
		$clean_name = db_make_safe_field($name);

		if ($clean_name !== $name) {
			exit("input error ????.");
		}

		$parts[$k] = $field_quote . $clean_name . $field_quote;
	}

	return implode(".", $parts);
}

function db_escape_string($string) {
	$string = mysql_real_escape_string($string);
	return $string;
}

function db_is_valid_amount($amount) {
	return preg_match('/^-?[0-9\.]+$/', $amount) === 1 ? true : false;
}

$query_count = 0;
?>
