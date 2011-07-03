<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Inventory extends Admin_Controller {

    public function __construct() {

        parent::__construct();

        $this->_post_handler();

        $this->load->model('mdl_inventory');

    }

    public function index() {

        $this->redir->set_last_index();

        $params = array(
            'paginate'	=>	TRUE,
            'page'		=>	uri_assoc('page'),
            'order_by'	=>	'inventory_name'
        );

        $items = $this->mdl_inventory->get($params);

        $data = array(
            'items'	=>	$items
        );

        $this->load->view('index', $data);

    }

    public function form() {

        if (!$this->mdl_inventory->validate()) {

            $this->load->model(array('mdl_inventory_types', 'tax_rates/mdl_tax_rates'));

            $this->load->helper('form');

            if (!$_POST AND uri_assoc('inventory_id')) {

                $this->mdl_inventory->prep_validation(uri_assoc('inventory_id'));

            }

            $data = array(
                'inventory_types' =>    $this->mdl_inventory_types->get(),
                'tax_rates'       =>    $this->mdl_tax_rates->get()
            );

            $this->load->view('form', $data);

        }

        else {

            $this->mdl_inventory->save($this->mdl_inventory->db_array(), uri_assoc('inventory_id'));

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
            'tax_rate_id'       =>  $item->tax_rate_id
        );

        echo json_encode($array);

    }

    public function jquery_adjust_stock() {

        $this->load->model('inventory/mdl_inventory_stock');

        $inventory_id = $this->input->post('inventory_id');

        $inventory_stock_quantity = $this->input->post('inventory_stock_quantity');

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

        echo $inventory->inventory_stock;

    }

    public function _post_handler() {

        if ($this->input->post('btn_add')) {

            redirect('inventory/form');

        }

        if ($this->input->post('btn_cancel')) {

            redirect('inventory/index');

        }

    }

}

?>