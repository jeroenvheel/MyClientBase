<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Items extends MY_Model {

	public function __construct() {

		parent::__construct();

		$this->table_name = 'mcb_invoice_items';

		$this->primary_key = 'mcb_invoice_items.invoice_item_id';

		$this->select_fields = "
		SQL_CALC_FOUND_ROWS *,
        mcb_invoice_items.tax_rate_id AS item_tax_rate_id,
        mcb_inventory.tax_rate_id AS inventory_tax_rate_id";

        $this->joins = array(
            'mcb_inventory' =>  array(
                'mcb_inventory.inventory_id = mcb_invoice_items.inventory_id', 'left'
            )
        );

		$this->custom_fields = $this->mdl_fields->get_object_fields(2);

	}

	public function validate() {

		$this->form_validation->set_rules('item_date', $this->lang->line('item_date'), 'required');
		$this->form_validation->set_rules('item_name', $this->lang->line('item_name'), 'required');
		$this->form_validation->set_rules('item_description', $this->lang->line('item_description'));
		$this->form_validation->set_rules('item_qty', $this->lang->line('quantity'), 'required');
		$this->form_validation->set_rules('item_price', $this->lang->line('unit_price'), 'required');
		$this->form_validation->set_rules('is_taxable', $this->lang->line('taxable'));
		$this->form_validation->set_rules('tax_rate_id', $this->lang->line('tax_rate'), 'required');
        $this->form_validation->set_rules('item_tax_option', $this->lang->line('item_tax_option'));
        $this->form_validation->set_rules('inventory_id');

		foreach ($this->custom_fields as $custom_field) {

			$this->form_validation->set_rules($custom_field->column_name, $custom_field->field_name);

		}

		return parent::validate($this);

	}

	public function db_array() {

		$db_array = parent::db_array();

		$db_array['invoice_id'] = uri_assoc('invoice_id', 4);

		if (!$this->input->post('is_taxable')) {

			$db_array['is_taxable'] = 0;

		}

		$db_array['item_date'] = strtotime(standardize_date($db_array['item_date']));

		return $db_array;

	}

	public function save($db_array, $invoice_item_id = NULL) {

		/* Transform these two vars to standard number format */
		$db_array['item_qty'] = standardize_number($db_array['item_qty']);
		$db_array['item_price'] = standardize_number($db_array['item_price']);

		parent::save($db_array, $invoice_item_id);

        if ($this->input->post('save_as_inventory')) {

            $db_array = array(
                'inventory_name'        =>  $db_array['item_name'],
                'inventory_unit_price'  =>  $db_array['item_price'],
                'inventory_description' =>  $db_array['item_description']
            );

            $this->db->insert('mcb_inventory', $db_array);

        }

	}

    public function save_order($invoice_item_id, $item_order) {

        $this->db->where('invoice_item_id', $invoice_item_id);

        $this->db->set('item_order', $item_order);

        $this->db->update('mcb_invoice_items');

    }

	public function delete($invoice_item_id) {

		$this->db->where('invoice_item_id', $invoice_item_id);

		$this->db->delete(array('mcb_invoice_items', 'mcb_invoice_item_amounts'));

		$this->session->set_flashdata('success_delete', TRUE);

	}

}

?>