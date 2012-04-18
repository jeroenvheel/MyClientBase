<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Sales extends Admin_Controller {

    public function __construct() {

        parent::__construct();

    }

    public function index() {

        $this->load->model('clients/mdl_clients');

        $data = array(
            'output_types' => array('pdf', 'view')
        );

        $this->load->view('sales', $data);

    }

    public function jquery_display_results() {

		$this->load->model('mdl_sales');

		$items = $this->mdl_sales->get($this->input->post('from_date'), $this->input->post('to_date'), $this->input->post('client_id'));

		$data = array(
			'items'	=>	$items
		);

		if ($this->input->post('output_type') == 'view') {

			$this->load->view('sales_view', $data);

		}

		elseif ($this->input->post('output_type') == 'pdf') {

            $this->load->helper($this->mdl_mcb_data->setting('pdf_plugin'));

            $html = $this->load->view('sales_pdf', $data, TRUE);

			$filename = url_title($this->lang->line('sales_report'), '_');

            pdf_create($html, $filename, FALSE);

			echo base_url() . 'uploads/temp/' . $filename . '.pdf';
			
		}

    }

}

?>