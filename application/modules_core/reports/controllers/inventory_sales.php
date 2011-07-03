<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Inventory_Sales extends Admin_Controller {

    public function __construct() {

        parent::__construct();

    }

    public function index() {

        $data = array(
            'output_types'  =>  array('pdf','view')
        );

        $this->load->view('inventory_sales', $data);

    }

    public function jquery_display_results($output_type = 'view') {

        $this->load->model(array('invoices/mdl_items', 'mdl_inventory_sales'));

        $data = array(
            'items'  =>  $this->mdl_inventory_sales->get()
        );

        if ($output_type == 'view') {

            $this->load->view('inventory_sales_view', $data);

        }

        elseif ($output_type == 'pdf') {

            $this->load->helper($this->mdl_mcb_data->setting('pdf_plugin'));

            $html = $this->load->view('inventory_sales_pdf', $data, TRUE);

            pdf_create($html, url_title($this->lang->line('inventory_sales'), '_'), TRUE);

        }

    }

}

?>