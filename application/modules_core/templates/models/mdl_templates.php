<?php

class Mdl_Templates extends MY_Model {

	public $template_dir;
	
	function __construct() {

		parent::__construct();

		/* Referenced multiple times below... */
		$this->template_dir = array(
			'invoices'			=>	APPPATH . 'modules_core/invoices/views/invoice_templates/',
			'payment_receipts'	=>	APPPATH . 'modules_core/payments/views/receipt_templates/'
		);

	}

	public function validate() {

		$this->form_validation->set_rules('template_name', $this->lang->line('template_name'), 'required');
		$this->form_validation->set_rules('template_content', $this->lang->line('template_content'), 'required');

		return parent::validate();

	}

	/* Returns an array of files contained in the template directory. */
	public function get($type) {

		$this->load->helper('directory');

		/* Get the initial map of files in the template directory. */
		$map = directory_map($this->template_dir[$type], TRUE);

		foreach ($map as $key=>$value) {

			if (substr($value, -4) <> '.php') {

				/* Remove this file from the array if it doesn't have a .php extension. */
				unset ($map[$key]);

			}

			else {

				/* Yep - it's got a .php extension, so let's keep it. */
				$map[$key] = substr($map[$key], 0, -4);

			}

		}

        sort($map);

		/* Return the list of files to the controller. */
		return $map;

	}

	/* Returns the contents of the specified file. */
	public function get_content($template, $type) {

		$this->load->helper('file');

		parent::set_form_value('template_name', $template);

		parent::set_form_value('template_content', read_file($this->template_dir[$type] . $template . '.php'));

	}

	/* Checks to see if the template directory is writable or not. */
	public function dir_is_writable($type) {

		if (is_writable($this->template_dir[$type])) {

			return TRUE;

		}

		return FALSE;

	}

	/* Writes the contents of the file. */
	public function save($type) {

		$template_filename = url_title($this->input->post('template_name'));

		$template_content = $this->input->post('template_content');

		$this->load->helper('file');

		if (write_file($this->template_dir[$type] . $template_filename . '.php', $template_content)) {

			$this->session->set_flashdata('success_save', TRUE);

		}

	}

	/* Deletes the template file. */
	public function delete($type) {

		if (count($this->get($type)) > 1) {

			if (unlink($this->template_dir[$type] . uri_assoc('template_name') . '.php')) {

				$this->session->set_flashdata('success_delete', TRUE);

			}

		}

		else {

			$this->session->set_flashdata('custom_error', $this->lang->line('template_cannot_be_deleted'));

		}

	}

}

?>