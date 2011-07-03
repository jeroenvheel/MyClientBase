<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Testing extends Admin_Controller {

    function __construct() {

        parent::__construct();

    }

    function index() {

        $this->create_clients();

//        $queries = array(
//            'DELETE FROM mcb_clients',
//            'DELETE FROM mcb_invoices',
//            'DELETE FROM mcb_invoice_amounts',
//            'DELETE FROM mcb_invoice_history',
//            'DELETE FROM mcb_invoice_items',
//            'DELETE FROM mcb_invoice_item_amounts',
//            'DELETE FROM mcb_payments'
//        );
//
//        foreach ($queries as $query) {
//
//            $this->db->query($query);
//
//        }
//
//        $this->create_clients();
//
//        $this->create_invoices();
//
//        echo "OK";

    }

    function create_clients() {

        for ($x = 0; $x <= 10000; $x++) {

            $db_array = array(
                'client_name'           =>  'Client ' . $x,
                'client_address'        =>  'Client ' . $x . ' Address',
                'client_address_2'      =>  'Client ' . $x . ' Address 2',
                'client_city'           =>  'Client ' . $x . ' City',
                'client_state'          =>  'Client ' . $x . ' State',
                'client_zip'            =>  '12345',
                'client_phone_number'   =>  '123-123-1231'
            );

            $this->db->insert('mcb_clients', $db_array);

        }

    }

    function create_invoices() {

        $this->load->helper('string');

        $this->load->module('invoices/invoice_api');

        $this->db->select('client_id');

        $clients = $this->db->get('mcb_clients')->result();

        foreach ($clients as $client) {

            for ($x = 0; $x <= 10; $x++) {

                $package = array(
                    'client_id'             =>  $client->client_id,
                    'invoice_date_entered'  =>  '06/02/2011',
                    'invoice_is_quote'      =>  0,
                    'invoice_group_id'      =>  1,
                    'invoice_items'         =>  array(
                        array(
                            'item_name' =>  'Item ' . $x,
                            'item_description'  =>  '',
                            'item_qty'  =>  '1',
                            'item_price'    =>  random_string('numeric',3)
                        )
                    )
                );

                if (!$this->invoice_api->create_invoice($package)) {

                    echo "FAIL!";
                    exit;

                }

            }

        }


        /**
         * $package requirements
         * - client_id
         * - invoice_date_entered
         * - invoice_is_quote
         * - invoice_group_id
         *
         *
         * $package optional
         * - invoice_discount
         * - invoice_shipping
         * - invoice_items (array)
         *
         * $package['invoice_items'] requirements
         * - item_name
         * - item_description
         * - item_qty
         * - item_price
         *
         */

    }

}

?>