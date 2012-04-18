<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Inventory extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_inventory';

		$this->primary_key = 'mcb_inventory.inventory_id';

		$this->select_fields = 'SQL_CALC_FOUND_ROWS mcb_inventory.*, mcb_inventory_types.*,
            IFNULL((SELECT SUM(inventory_stock_quantity) FROM mcb_inventory_stock WHERE mcb_inventory_stock.inventory_id = mcb_inventory.inventory_id), 0) AS inventory_stock';

        $this->joins = array(
            'mcb_inventory_types'   =>  array(
                'mcb_inventory_types.inventory_type_id = mcb_inventory.inventory_type_id', 'left'
            )
        );

		$this->order_by = 'inventory_name';

		$this->limit = $this->mdl_mcb_data->setting('results_per_page');

	}

    public function get($params = NULL) {

        $inventory = parent::get($params);

        if ($inventory and isset($params['group_by_type'])) {

            $tmp = $inventory;

            unset($inventory);

            foreach ($tmp as $item) {

                $inventory[$item->inventory_type][] = $item;

            }

        }

        return $inventory;

    }

	public function validate() {

        $this->form_validation->set_rules('inventory_type_id', $this->lang->line('inventory_type'));
		$this->form_validation->set_rules('inventory_name', $this->lang->line('item_name'), 'required');
		$this->form_validation->set_rules('inventory_description', $this->lang->line('item_description'));
		$this->form_validation->set_rules('inventory_unit_price', $this->lang->line('unit_price'), 'required');
        $this->form_validation->set_rules('inventory_tax_rate_id', $this->lang->line('tax_rate_id'));
        $this->form_validation->set_rules('inventory_track_stock', $this->lang->line('track_stock'));

		return parent::validate();

	}

	public function db_array() {

		$db_array = parent::db_array();

		$db_array['inventory_unit_price'] = standardize_number($db_array['inventory_unit_price']);

        if (!isset($db_array['inventory_track_stock'])) {

            $db_array['inventory_track_stock'] = 0;

        }

		return $db_array;

	}
	
	public function save($db_array, $id = NULL, $initial_stock_quantity = NULL) {

		parent::save($db_array, $id);
		
		if ($initial_stock_quantity) {
			
			$inventory_id = $this->db->insert_id();
			
			$this->mdl_inventory_stock->adjust($inventory_id, $initial_stock_quantity, 0, $this->lang->line('initial_stock_quantity'));
			
		}
		
	}

}

?>