<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Redir {

	public $CI;

	function Redir() {

		$this->CI =& get_instance();

	}

	function redirect($module) {

		if (is_array($module)) {

			$modules = $module;

			foreach ($modules as $module) {

				if (substr($this->CI->session->userdata('last_index'), 1, strlen($module)) == $module) {

					redirect($this->CI->session->userdata('last_index'));

				}

			}

			redirect($modules[0]);

		}

		else {

			if (substr($this->CI->session->userdata('last_index'), 1, strlen($module)) == $module) {

				redirect($this->CI->session->userdata('last_index'));

			}

			else {

				redirect($module);

			}

		}

	}

	function set_last_index($last_index = NULL) {

		if (!$last_index) {

			$this->CI->session->set_userdata('last_index', $this->CI->uri->uri_string());

		}

		else {

			$this->CI->session->set_userdata('last_index', $last_index);

		}

	}

}

?>