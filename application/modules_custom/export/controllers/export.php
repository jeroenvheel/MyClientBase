<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Export extends Admin_Controller {

    function __construct() {

        parent::__construct();

        if (!$this->mdl_mcb_modules->check_enable('export')) {

            redirect('mcb_modules');

        }

        $this->load->model('mdl_export');

        $this->_post_handler();

    }

    function index() {

        $objects = array(
            array(
                'object_name'	=>	'invoices',
                'label'			=>	$this->lang->line('invoices')
            ),
            array(
                'object_name'   =>  'clients',
                'label'         =>  $this->lang->line('clients')
            ),
            array(
                'object_name'   =>  'payments',
                'label'         =>  $this->lang->line('payments')
            )
        );

        $formats = array(
            'csv'	=>	'CSV',
            'xml'	=>	'XML'
        );

        $data = array(
            'objects'	=>	$objects,
            'formats'	=>	$formats
        );

        $this->load->view('index', $data);

    }

    function _post_handler() {

        if ($this->input->post('btn_submit')) {

            $this->load->dbutil();

            $this->load->helper('download');

            $object = $this->input->post('object');

            $function = 'get_' . $object . '_query';

            $query = $this->mdl_export->$function();

            if ($this->input->post('format') == 'csv') {

                $data = $this->dbutil->csv_from_result($query);

            }

            elseif ($this->input->post('format') == 'xml') {

                $config = array (
                    'root'    => 'root',
                    'element' => 'element',
                    'newline' => "\n",
                    'tab'    => "\t"
                );

                $data = $this->dbutil->xml_from_result($query, $config);

            }

            $name = $this->input->post('object') . '.' . $this->input->post('format');

            force_download($name, $data);

        }

    }

}

?>