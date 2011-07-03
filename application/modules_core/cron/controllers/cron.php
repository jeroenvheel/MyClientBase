<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Cron extends Cron_Controller {

    function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->model('mcb_data/mdl_mcb_data');

    }

    function email_overdue($cron_key) {

        $this->load->library('session');

        $this->_check_auth($cron_key);

        $this->load->model('invoices/mdl_invoices');

        $this->load->model('mailer/mdl_mailer');

        $params = array(
            'having' =>  array(
                'invoice_is_overdue'   =>  1
            ),
            'get_invoice_items'     =>  TRUE,
            'get_invoice_tax_rates' =>  TRUE,
            'get_invoice_payments'  =>  TRUE,
            'get_invoice_tags'      =>  TRUE
        );

        $invoices = $this->mdl_invoices->get($params);

        foreach ($invoices as $invoice) {

            $invoice_template = $this->mdl_mcb_data->setting('default_invoice_template');
            $from_email = $invoice->from_email_address;
            $from_name = $invoice->from_first_name . ' ' . $invoice->from_last_name;
            $subject = $this->lang->line('overdue_invoice_reminder');
            $email_body = '';
            $email_cc = $this->mdl_mcb_data->setting('default_cc');
            $email_bcc = $this->mdl_mcb_data->setting('default_bcc');
            $invoice_as_body = 1;
            $to = $invoice->client_email_address;
        
            $this->mdl_mailer->email_invoice($invoice, $invoice_template, $from_email, $from_name, $to, $subject, $email_body, $invoice_as_body, $email_cc, $email_bcc);

        }

    }

    function _check_auth($cron_key) {

        if ($cron_key <> $this->mdl_mcb_data->get('cron_key')) {

            exit;

        }

    }

    function generate_cron_key() {

        $length = 16;

        $random= "";

        srand((double)microtime()*1000000);

        $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $char_list .= "abcdefghijklmnopqrstuvwxyz";

        $char_list .= "1234567890";

        for($i = 0; $i < $length; $i++) {

            $random .= substr($char_list,(rand()%(strlen($char_list))), 1);

        }

        echo $random;

    }

}

?>