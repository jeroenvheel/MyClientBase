<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Inventory_Stock extends MY_Model {

    public function __construct() {

        parent::__construct();

        $this->table_name = 'mcb_inventory_stock';

        $this->primary_key = 'mcb_inventory_stock.inventory_stock_id';

        $this->select_fields = 'SQL_CALC_FOUND_ROWS *';

        $this->joins = array(
            'mcb_inventory' =>  'mcb_inventory.inventory_id = mcb_inventory_stock.inventory_id',
            'mcb_inventory_types'   =>  array(
                'mcb_inventory_types.inventory_type_id = mcb_inventory.inventory_type_id', 'left'
            )
        );

        $this->order_by = 'inventory_stock_date DESC';

        $this->limit = $this->mdl_mcb_data->setting('results_per_page');

    }

    public function adjust($inventory_id, $quantity, $invoice_item_id = 0, $inventory_stock_notes = NULL) {

        if ($this->track_stock($inventory_id)) {

            if ($invoice_item_id > 0) {

                $this->db->where('invoice_item_id', $invoice_item_id);

                $this->db->delete('mcb_inventory_stock');

            }

            $db_array = array(
                'inventory_id'              =>  $inventory_id,
                'invoice_item_id'           =>  $invoice_item_id,
                'inventory_stock_quantity'  =>  $quantity,
                'inventory_stock_date'      =>  time()
            );

            if ($inventory_stock_notes) {

                $db_array['inventory_stock_notes'] = $inventory_stock_notes;

            }

            $this->db->insert('mcb_inventory_stock', $db_array);

        }

    }

    public function delete_by_invoice_item_id($invoice_item_id) {

        $this->db->where('invoice_item_id', $invoice_item_id);

        $this->db->delete('mcb_inventory_stock');

    }

    public function track_stock($inventory_id) {

        $this->db->where('inventory_id', $inventory_id);

        $this->db->where('inventory_track_stock', 1);

        return $this->db->get('mcb_inventory')->num_rows();

    }

}

?>