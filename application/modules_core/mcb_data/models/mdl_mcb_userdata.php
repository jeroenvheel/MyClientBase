<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_MCB_Userdata extends MY_Model {

	public $settings;

	public function get($user_id, $key) {

		$this->db->select('mcb_userdata_value');

		$this->db->where('mcb_userdata_user_id', $user_id);
		$this->db->where('mcb_userdata_key', $key);

		$query = $this->db->get('mcb_userdata');

		if ($query->row()) {

			return $query->row()->mcb_userdata_value;

		}

		else {

			return NULL;

		}

	}

	public function save($user_id, $key, $value) {

		if (!is_null($this->get($user_id, $key))) {

			$this->db->where('mcb_userdata_user_id', $user_id);
			$this->db->where('mcb_userdata_key', $key);

			$db_array = array(
				'mcb_userdata_value'	=>	$value
			);

			$this->db->update('mcb_userdata', $db_array);

		}

		else {

			$db_array = array(
				'mcb_userdata_user_id'	=>	$user_id,
				'mcb_userdata_key'		=>	$key,
				'mcb_userdata_value'	=>	$value
			);

			$this->db->insert('mcb_userdata', $db_array);

		}

	}

	public function delete($user_id, $key) {

		$this->db->where('mcb_userdata_user_id', $user_id);
		$this->db->where('mcb_userdata_key', $key);

		$this->db->delete('mcb_userdata');

	}

	public function set_session_data($user_id) {

		$this->db->where('mcb_userdata_user_id', $user_id);

		$mcb_userdata = $this->db->get('mcb_userdata')->result();

		foreach ($mcb_userdata as $data) {

			$this->settings->{$data->mcb_userdata_key} = $data->mcb_userdata_value;

		}

	}

	public function setting($key) {

		return (isset($this->settings->$key)) ? $this->settings->$key : NULL;

	}

	public function set_setting($key, $value) {

		$this->settings->$key = $value;

	}

	public function save_settings($user_id, $user_settings) {

		foreach ($user_settings as $key=>$value) {

			$this->mdl_mcb_userdata->save($user_id, $key, $value);

		}

	}

}

?>