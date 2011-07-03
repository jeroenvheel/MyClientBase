<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Clients extends MY_Model {

    public function __construct() {

        parent::__construct();

        $this->table_name = 'mcb_clients';

        $this->select_fields = "
		SQL_CALC_FOUND_ROWS
		mcb_clients.*,
		mcb_clients.client_id as join_client_id,
		(SELECT SUM(invoice_total) FROM mcb_invoice_amounts WHERE invoice_id IN (SELECT invoice_id FROM mcb_invoices WHERE client_id = join_client_id AND invoice_is_quote = 0)) AS client_total_invoice,
		IFNULL((SELECT SUM(payment_amount) FROM mcb_payments JOIN mcb_invoices ON mcb_invoices.invoice_id = mcb_payments.invoice_id WHERE mcb_invoices.client_id = mcb_clients.client_id AND invoice_is_quote = 0), 0.00) AS client_total_payment,
		(SELECT ROUND(client_total_invoice - client_total_payment, 2)) AS client_total_balance";

        $this->primary_key = 'mcb_clients.client_id';

        $this->order_by = 'client_name';

        $this->custom_fields = $this->mdl_fields->get_object_fields(3);

    }

    public function get($params = NULL) {

        $clients = parent::get($params);

        if (is_array($clients)) {

            if ($this->mdl_mcb_data->setting('version') > '0.8.2') {

                if (isset($params['set_client_data'])) {

                    foreach ($clients as $client) {

                        $this->db->where('client_id', $client->client_id);

                        $mcb_client_data = $this->db->get('mcb_client_data')->result();

                        foreach ($mcb_client_data as $client_data) {

                            $client->{$client_data->mcb_client_key} = $client_data->mcb_client_value;

                        }

                    }

                }

            }

        }

        else {

            if ($this->mdl_mcb_data->setting('version') > '0.8.2') {

                if (isset($params['set_client_data'])) {

                    $this->db->where('client_id', $clients->client_id);

                    $mcb_client_data = $this->db->get('mcb_client_data')->result();

                    foreach ($mcb_client_data as $client_data) {

                        $clients->{$client_data->mcb_client_key} = $client_data->mcb_client_value;

                    }

                }

            }

        }

        return $clients;

    }

    public function get_active($params = NULL) {

        if (!$params) {

            $params = array(
                'where'	=>	array(
                    'client_active'	=>	1
                )
            );

        }

        else {

            $params['where']['client_active'] = 1;

        }

        return $this->get($params);

    }

    public function validate() {

        $this->form_validation->set_rules('client_active', $this->lang->line('client_active'));
        $this->form_validation->set_rules('client_name', $this->lang->line('client_name'), 'required');
        $this->form_validation->set_rules('client_tax_id', $this->lang->line('tax_id_number'));
        $this->form_validation->set_rules('client_address', $this->lang->line('street_address'));
        $this->form_validation->set_rules('client_address_2', $this->lang->line('street_address_2'));
        $this->form_validation->set_rules('client_city', $this->lang->line('city'));
        $this->form_validation->set_rules('client_state', $this->lang->line('state'));
        $this->form_validation->set_rules('client_zip', $this->lang->line('zip'));
        $this->form_validation->set_rules('client_country', $this->lang->line('country'));
        $this->form_validation->set_rules('client_phone_number', $this->lang->line('phone_number'));
        $this->form_validation->set_rules('client_fax_number',	$this->lang->line('fax_number'));
        $this->form_validation->set_rules('client_mobile_number', $this->lang->line('mobile_number'));
        $this->form_validation->set_rules('client_email_address', $this->lang->line('email_address'), 'valid_email');
        $this->form_validation->set_rules('client_web_address', $this->lang->line('web_address'));
        $this->form_validation->set_rules('client_notes', $this->lang->line('notes'));

        foreach ($this->custom_fields as $custom_field) {

            $this->form_validation->set_rules($custom_field->column_name, $custom_field->field_name);

        }

        return parent::validate($this);

    }

    public function delete($client_id) {

        $this->load->model('invoices/mdl_invoices');

        /* Delete the client record */

        parent::delete(array('client_id'=>$client_id));

        /* Delete any related contacts */

        $this->db->where('client_id', $client_id);

        $this->db->delete('mcb_contacts');

        /*
		 * Delete any related invoices, but use the invoice model so records
		 * related to the invoice are also deleted
        */

        $this->db->select('invoice_id');

        $this->db->where('client_id', $client_id);

        $invoices = $this->db->get('mcb_invoices')->result();

        foreach ($invoices as $invoice) {

            $this->mdl_invoices->delete($invoice->invoice_id);

        }

    }

    public function save() {

        $db_array = parent::db_array();

        if (!$this->input->post('client_active')) {

            $db_array['client_active'] = 0;

        }

        parent::save($db_array, uri_assoc('client_id'));

    }

}

?>