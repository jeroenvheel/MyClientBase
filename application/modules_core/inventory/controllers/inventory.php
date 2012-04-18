<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Inventory extends Admin_Controller {

    public function __construct() {

        parent::__construct();

        $this->_post_handler();

        $this->load->model('mdl_inventory');

    }

    public function index() {

        $this->redir->set_last_index();
        $this->load->model('mdl_inventory_table');

        $params = array(
            'paginate'	=>	TRUE,
            'page'		=>	uri_assoc('page'),
        );

        $order_by = uri_assoc('order_by');

        $order = uri_assoc('order');

	switch ($order_by) {

		case 'inventory_id':
		    $params['order_by'] = 'inventory_id ' . $order;
		    break;
		case 'inventory_type':
		    $params['order_by'] = 'inventory_type ' . $order;
		    break;
		case 'inventory_item':
		    $params['order_by'] = 'inventory_name ' . $order;
		    break;
		case 'inventory_stock':
		    $params['order_by'] = 'inventory_stock ' . $order;
		    break;
		case 'inventory_price':
		    $params['order_by'] = 'inventory_unit_price ' . $order;
		    break;
		default:
		    $params['order_by'] = 'inventory_name ' . $order;

	}

        $items = $this->mdl_inventory->get($params);

        $data = array(
            'items'			=>	$items,
            'table_headers'	=>	$this->mdl_inventory_table->get_table_headers()
        );

        $this->load->view('index', $data);

    }

    public function form() {

        if($this->session->flashdata('page'))
        {
            $this->session->set_flashdata('page', $this->session->flashdata('page'));            
        }
        
	    $inventory_id = uri_assoc('inventory_id');

        if (!$this->mdl_inventory->validate()) {

            $this->load->model(array('mdl_inventory_types', 'tax_rates/mdl_tax_rates'));

            if (!$_POST AND $inventory_id) {

                $this->mdl_inventory->prep_validation($inventory_id);

            }

            $data = array(
                'inventory_types' =>    $this->mdl_inventory_types->get(),
                'tax_rates'       =>    $this->mdl_tax_rates->get()
            );

            $this->load->view('form', $data);

        }

        else {

			if (!$inventory_id) {

				$this->load->model('mdl_inventory_stock');

			}

            $this->mdl_inventory->save($this->mdl_inventory->db_array(), $inventory_id, $this->input->post('initial_stock_quantity'));

            $this->redir->redirect('inventory');

        }

    }

    public function delete() {

        if (uri_assoc('inventory_id')) {

            $this->mdl_inventory->delete(array('inventory_id'=>uri_assoc('inventory_id')));

        }

        $this->redir->redirect('inventory');

    }

    public function jquery_item_data() {

        /* This function is only used to send JSON data back to a jquery function */

        $params = array(
            'where'	=>	array(
                'mcb_inventory.inventory_id'	=>	$this->input->post('inventory_id')
            )
        );

        $item = $this->mdl_inventory->get($params);

        $array = array(
            'item_name'			=>	$item->inventory_name,
            'item_cost'			=>	format_number($item->inventory_unit_price, FALSE),
            'item_description'	=>	$item->inventory_description,
            'tax_rate_id'       =>  $item->inventory_tax_rate_id
        );

        echo json_encode($array);

    }

    public function jquery_adjust_stock() {

        $this->load->model('inventory/mdl_inventory_stock');

        $inventory_id = $this->input->post('inventory_id');

        $inventory_stock_quantity = standardize_number($this->input->post('inventory_stock_quantity'));

        $inventory_stock_notes = $this->input->post('inventory_stock_notes');

        $this->mdl_inventory_stock->adjust($inventory_id, $inventory_stock_quantity, 0, $inventory_stock_notes);

    }

    public function jquery_refresh_stock() {

        $inventory_id = $this->input->post('inventory_id');

        $params = array(
            'where' =>  array(
                'mcb_inventory.inventory_id'    =>  $inventory_id
            )
        );

        $inventory = $this->mdl_inventory->get($params);

        echo format_number($inventory->inventory_stock, FALSE);

    }

    public function _post_handler() {

        if ($this->input->post('btn_add')) {
            
            if(uri_assoc('page'))
            {
                $this->session->set_flashdata('page', uri_assoc('page'));    
            }            
            redirect('inventory/form');
        }

        if ($this->input->post('btn_cancel')) {            
            if($this->session->flashdata('page'))
            {
                redirect('inventory/index/page/'.$this->session->flashdata('page'));
            }
            else
                redirect('inventory/index');
        }
    }
}
?>