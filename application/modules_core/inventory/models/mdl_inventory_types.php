<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Inventory_Types extends MY_Model {

    public function __construct() {

        parent::__construct();

        $this->table_name = 'mcb_inventory_types';

        $this->primary_key = 'mcb_inventory_types.inventory_type_id';

        $this->select_fields = 'SQL_CALC_FOUND_ROWS *';

        $this->order_by = 'inventory_type';

        $this->limit = $this->mdl_mcb_data->setting('results_per_page');

    }

    public function validate() {

        $this->form_validation->set_rules('inventory_type', $this->lang->line('inventory_type'), 'required|callback_is_unique');

        return parent::validate($this);

    }

    public function is_unique($inventory_type) {

        /** Checks to make sure the inventory type is not already in use **/

        $inventory_type_id = uri_assoc('inventory_type_id', 4);

        $this->db->where('inventory_type', $inventory_type);

        if ($inventory_type_id) {

            $this->db->where('inventory_type_id <>', $inventory_type_id);

        }

        $num = $this->db->get('mcb_inventory_types')->num_rows();

        if ($num > 0) {

            $this->form_validation->set_message('is_unique', $this->lang->line('inventory_type_in_use'));

            return FALSE;

        }

        return TRUE;

    }

    public function delete($inventory_type_id) {

        /** Deletes the inventory type and unlinks any existing inventory items from the type **/

        $this->db->where('inventory_type_id', $inventory_type_id);

        $this->db->set('inventory_type_id', 0);

        $this->db->update('mcb_inventory');

        parent::delete_by_id($inventory_type_id);

    }

}

?>