<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Upload_Logo extends Admin_Controller {

	function index() {

		if ($this->input->post('btn_upload_logo')) {

			$config = array(
				'upload_path'	=>	'./uploads/invoice_logos/',
				'allowed_types'	=>	'gif|jpg|png',
				'max_size'		=>	'100',
				'max_width'		=>	'500',
				'max_height'	=>	'300'
			);

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload()) {

				$data = array(
					'static_error'	=>	$this->upload->display_errors()
				);

				$this->load->view('upload_logo', $data);

			}

			else {
				
				$upload_data = $this->upload->data();

				$this->mdl_mcb_data->save('invoice_logo', $upload_data['file_name']);

				redirect('settings');

			}

		}

		else {

			$this->load->view('upload_logo');

		}

	}

	function delete() {

		unlink('./uploads/invoice_logos/' . uri_assoc('invoice_logo', 4));

		if ($this->mdl_mcb_data->setting('invoice_logo') == uri_assoc('invoice_logo', 4)) {

			$this->mdl_mcb_data->delete('invoice_logo');

			$this->session->unset_userdata('invoice_logo');

		}

		redirect('settings');

	}

}

?>