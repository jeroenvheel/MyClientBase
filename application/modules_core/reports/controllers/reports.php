<?php

class Reports extends Admin_Controller {

	public function standardize_date() {

		$date = $this->input->post('date');

		log_message('DEBUG', 'Date Received: ' . $date);
		log_message('DEBUG', 'Date Sent: ' . standardize_date($date));

		echo strtotime(standardize_date($date));

	}

}

?>
