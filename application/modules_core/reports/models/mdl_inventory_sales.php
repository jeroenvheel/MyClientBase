<?php

class Mdl_Inventory_Sales extends MY_Model {

    function __construct() {

        parent::__construct();

    }

    function get() {

        $params = array(
            'select'    =>  'mcb_inventory.inventory_name, (sum(item_subtotal)) AS inventory_sum_amount, sum(item_qty) AS inventory_sum_quantity',
            'where' =>  array(
                'mcb_invoice_items.inventory_id >'  =>  0
            ),
            'joins' =>  array(
                'mcb_inventory' =>  array(
                    'mcb_inventory.inventory_id = mcb_invoice_items.inventory_id', 'left'
                ),
                'mcb_invoice_item_amounts'  =>  'mcb_invoice_item_amounts.invoice_item_id = mcb_invoice_items.invoice_item_id'
            ),
            'group_by'  =>  'mcb_inventory.inventory_id'
        );

        return $this->mdl_items->get($params);

    }

}

?>
