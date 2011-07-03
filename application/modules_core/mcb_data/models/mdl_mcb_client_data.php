<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_MCB_Client_Data extends MY_Model {

    public $settings;

	public function get($client_id, $key) {

		$this->db->select('mcb_client_value');

		$this->db->where('mcb_client_key', $key);

		$this->db->where('client_id', $client_id);

		$query = $this->db->get('mcb_client_data');

		if ($query->row()) {

			return $query->row()->mcb_client_value;

		}

		else {

			return NULL;

		}

	}

	public function save($client_id, $key, $value) {

		if (!is_null($this->get($client_id, $key))) {

			$this->db->where('mcb_client_key', $key);

			$this->db->where('client_id', $client_id);

			$db_array = array(
				'mcb_client_value'	=>	$value
			);

			$this->db->update('mcb_client_data', $db_array);

		}

		else {

			$db_array = array(
				'client_id'			=>	$client_id,
				'mcb_client_key'	=>	$key,
				'mcb_client_value'	=>	$value
			);

			$this->db->insert('mcb_client_data', $db_array);

		}

	}

	public function delete($client_id, $key) {

		$this->db->where('mcb_client_key', $key);

		$this->db->where('client_id', $client_id);

		$this->db->delete('mcb_client_data');

	}

	public function set_session_data($client_id) {

		$this->db->where('client_id', $client_id);

		$mcb_client_data = $this->db->get('mcb_client_data')->result();

		foreach ($mcb_client_data as $data) {

			$this->settings->{$data->mcb_client_key} = $data->mcb_client_value;

		}

	}

	public function setting($key) {

		return (isset($this->settings->$key)) ? $this->settings->$key : NULL;

	}

}

?>