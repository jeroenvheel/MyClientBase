<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Templates extends Admin_Controller {

	private $type;

	private $page_titles;

	function __construct() {

		parent::__construct();

		$this->load->model('mdl_templates');

		$this->type = uri_assoc('type');

		$this->page_titles = array(
			'index'	=>	array(
				'invoices'			=>	$this->lang->line('invoice_templates'),
				'payment_receipts'	=>	$this->lang->line('payment_receipt_templates')
			),
			'form'	=>	array(
				'invoices'			=>	$this->lang->line('invoice_template_form'),
				'payment_receipts'	=>	$this->lang->line('payment_receipt_template_form')
			)
		);

		$this->_post_handler();

	}

	function index() {

		$data = array(
			'templates'			=>	$this->mdl_templates->get($this->type),
			'dir_is_writable'	=>	$this->mdl_templates->dir_is_writable($this->type),
			'template_dir'		=>	$this->mdl_templates->template_dir[$this->type],
			'page_title'		=>	$this->page_titles['index'][$this->type]
		);

		$this->load->view('index', $data);

	}

	function form() {

		if (!$this->mdl_templates->validate()) {

			if (!$_POST and uri_assoc('template_name')) {

				$this->mdl_templates->get_content(uri_assoc('template_name'), $this->type);

			}

			$data = array(
				'dir_is_writable'	=>	$this->mdl_templates->dir_is_writable($this->type),
				'template_dir'		=>	$this->mdl_templates->template_dir[$this->type],
				'page_title'		=>	$this->page_titles['form'][$this->type]
			);

			$this->load->view('form', $data);

		}

		else {

			$this->mdl_templates->save($this->type);

			redirect('templates/index/type/' . $this->type);

		}

	}

	function delete() {

		$this->mdl_templates->delete($this->type);

		redirect('templates/index/type/' . $this->type);

	}

	function save_settings() {

		$this->mdl_mcb_data->save('default_invoice_template', $this->input->post('default_invoice_template'));

	}

	function _post_handler() {

		if ($this->input->post('btn_create_template')) {

			redirect('templates/form/type/' . $this->type);

		}

		elseif ($this->input->post('btn_cancel')) {

			redirect('templates/index/type/' . $this->type);

		}

	}

}

?>
