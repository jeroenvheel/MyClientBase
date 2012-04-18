<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Inventory_History extends Admin_Controller {

    public function __construct() {

        parent::__construct();

    }

    public function index() {

        $data = array(
            'output_types'  =>  array('pdf','csv','view')
        );

        $this->load->view('inventory_history', $data);

    }

    public function jquery_display_results($output_type = 'view') {
        
        $this->load->model('inventory/mdl_inventory_stock');
		
		$params = array();

        $query = $this->mdl_inventory_stock->query($params);

        if ($output_type == 'view') {

            $data = array(
                'inventory_history' =>  $query->result()
            );
          
            $this->load->view('inventory_history_view', $data);

        }

        elseif ($output_type == 'pdf') {

            $data = array(
                'inventory_history' =>  $query->result()
            );

            $this->load->helper($this->mdl_mcb_data->setting('pdf_plugin'));

            $html = $this->load->view('inventory_history_pdf', $data, TRUE);

            pdf_create($html, url_title($this->lang->line('inventory_history'), '_'), TRUE);

        }

        elseif ($output_type == 'csv') {

            $this->load->dbutil();

            $this->load->helper('download');

            $data = $this->dbutil->csv_from_result($query);

            force_download(url_title($this->lang->line('inventory_history'), '_') . '.csv', $data);

        }

    }

}

?>