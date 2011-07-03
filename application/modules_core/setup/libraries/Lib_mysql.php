<?php

class Lib_mysql {

	function connect($server, $username, $password) {

		if (@mysql_connect($server, $username, $password)) {

			return TRUE;

		}

		return FALSE;

	}

	function select_db($database) {

		if (@mysql_select_db($database)) {

			return TRUE;

		}

		else {

			return FALSE;

		}

	}

	function query($sql) {

		$result = mysql_query($sql);

		return mysql_fetch_object($result);

	}

}

?>