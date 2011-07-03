<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_MCB_Data extends MY_Model {

	public $settings;

	public function get($key) {

		$this->db->select('mcb_value');

		$this->db->where('mcb_key', $key);

		$query = $this->db->get('mcb_data');

		if ($query->row()) {

			return $query->row()->mcb_value;

		}

		else {

			return NULL;

		}

	}

	public function save($key, $value) {

		if (!is_null($this->get($key))) {

			$this->db->where('mcb_key', $key);

			$db_array = array(
				'mcb_value'	=>	$value
			);

			$this->db->update('mcb_data', $db_array);

		}

		else {

			$db_array = array(
				'mcb_key'	=>	$key,
				'mcb_value'	=>	$value
			);

			$this->db->insert('mcb_data', $db_array);

		}

	}

	public function delete($key) {

		$this->db->where('mcb_key', $key);

		$this->db->delete('mcb_data');

	}

	public function set_session_data() {

		$mcb_data = $this->db->get('mcb_data')->result();

		foreach ($mcb_data as $data) {

			$this->settings->{$data->mcb_key} = $data->mcb_value;

		}

	}

    public function set_application_title() {

        $this->settings->application_title = $this->get('application_title');

    }

	public function setting($key) {

		return (isset($this->settings->$key)) ? $this->settings->$key : NULL;

	}

    public function set_setting($key, $value) {

        $this->settings->$key = $value;

    }

}

?>