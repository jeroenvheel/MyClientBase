<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class DB_Backup {

	public $CI;

	function DB_Backup() {

		$this->CI =& get_instance();

	}

	function backup($prefs) {

		$this->CI->load->dbutil();

		$backup =& $this->CI->dbutil->backup($prefs);

		$this->CI->load->helper('download');

		force_download('mcb_' . date('Y-m-d') . '.zip', $backup);

	}

}

?>