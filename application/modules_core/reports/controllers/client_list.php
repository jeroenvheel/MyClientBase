<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Client_List extends Admin_Controller {

    public function __construct() {

        parent::__construct();

    }

    public function index() {

        $data = array(
            'output_types'  =>  array('pdf','csv','view')
        );

        $this->load->view('client_list', $data);

    }

    public function jquery_display_results($output_type = 'view') {
        
        $this->load->model('clients/mdl_clients');

        $client_params = array(
            'select'    =>  'mcb_clients.*'
        );
        
        $data = array(
            'clients' => $this->mdl_clients->get($client_params)
        );

        if ($output_type == 'view') {
          
            $this->load->view('client_list_view', $data);

        }

        elseif ($output_type == 'pdf') {

            $this->load->helper($this->mdl_mcb_data->setting('pdf_plugin'));

            $html = $this->load->view('client_list_pdf', $data, TRUE);

            pdf_create($html, url_title($this->lang->line('client_list'), '_'), TRUE);

        }

        elseif ($output_type == 'csv') {

            $this->load->dbutil();

            $this->load->helper('download');

            $query = $this->db->get('mcb_clients');

            $data = $this->dbutil->csv_from_result($query);

            force_download(url_title($this->lang->line('client_list'), '_') . '.csv', $data);

        }

    }

}

?>