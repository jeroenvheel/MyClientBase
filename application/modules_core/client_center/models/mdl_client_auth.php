<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Client_Auth extends CI_Model {

	function auth($table, $user_field, $pass_field, $user_value, $pass_value) {

		$this->db->where($user_field, $user_value);

		$this->db->where($pass_field, $pass_value);

		$query = $this->db->get($table);

		if ($query->num_rows() == 1) {

			return $query->row();

		}

		else {

			return FALSE;

		}

	}

	function set_session($user_object, $object_vars, $custom_vars = NULL) {

		$session_data = array();

		foreach ($object_vars as $object_var) {

			$session_data[$object_var] = $user_object->$object_var;

		}

		if ($custom_vars) {

			foreach ($custom_vars as $key=>$var) {

				$session_data[$key] = $var;

			}

		}

		$this->session->set_userdata($session_data);

	}

	function update_timestamp($table, $key_field, $key_id, $value_field, $value_value) {

		$this->db->where($key_field, $key_id);

		$this->db->update($table, array($value_field => $value_value));

	}

}

?>