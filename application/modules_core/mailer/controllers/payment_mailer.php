<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Payment_Mailer extends Admin_Controller {

    function __construct() {

        parent::__construct();

        $this->load->model(
            array(
            'payments/mdl_payments',
            'invoices/mdl_invoices',
            'users/mdl_users',
            'templates/mdl_templates',
            'mdl_mailer'
            )
        );

    }

    function form() {

        if ($this->input->post('btn_cancel')) {

            redirect('payments');

        }

        if (!uri_assoc('invoice_id', 4)) {

            redirect($this->session->userdata('last_index'));

        }

        $invoice_id = uri_assoc('invoice_id', 4);

        $params = array(
            'where'	=>	array(
                'mcb_invoices.invoice_id'	=>	$invoice_id
            )
        );

        $invoice = $this->mdl_invoices->get($params);

        if (!$this->mdl_mailer->validate_payment_email()) {

            if (!$_POST) {

                $this->mdl_mailer->set_form_value('email_to', $invoice->client_email_address);
                $this->mdl_mailer->set_form_value('email_from_name', $invoice->from_first_name . ' ' . $invoice->from_last_name);
                $this->mdl_mailer->set_form_value('email_from_email', $invoice->from_email_address);
                $this->mdl_mailer->set_form_value('email_subject', $this->lang->line('invoice_number') . $invoice->invoice_number . ' ' . $this->lang->line('payment_receipt'));
                $this->mdl_mailer->set_form_value('email_body', '');
                $this->mdl_mailer->set_form_value('template', uri_assoc('receipt_template', 4));
                $this->mdl_mailer->set_form_value('email_cc', $this->mdl_mcb_data->setting('default_cc'));
                $this->mdl_mailer->set_form_value('email_bcc', $this->mdl_mcb_data->setting('default_bcc'));
                $this->mdl_mailer->set_form_value('email_footer', $this->mdl_mcb_data->setting('email_footer'));

            }

            $data = array(
                'templates'	=>	$this->mdl_templates->get('payment_receipts')
            );

            $this->load->view('payment_mailer', $data);

        }

        else {

            $invoice_id = uri_assoc('invoice_id', 4);
            
            $params = array(
                'where'	=>	array(
                    'mcb_invoices.invoice_id'	=>	$invoice_id
                )
            );
            
            $invoice = $this->mdl_invoices->get($params);
            
            $template = $this->input->post('template');
            $from_email = $this->input->post('email_from_email');
            $from_name = $this->input->post('email_from_name');
            $to = $this->input->post('email_to');
            $subject = $this->input->post('email_subject');
            $email_body = $this->input->post('email_body');
            $email_cc = $this->input->post('email_cc');
            $email_bcc = $this->input->post('email_bcc');
            $receipt_as_body = $this->input->post('receipt_as_body');
            $email_footer = $this->input->post('email_footer');

            $this->mdl_mailer->email_payment_receipt($invoice, $template, $from_email, $from_name, $to, $subject, $email_body, $email_footer, $receipt_as_body, $email_cc, $email_bcc);

            /* @todo - Add mdl_invoices->save_invoice_history */

            redirect($this->session->userdata('last_index'));

        }

    }

}

?>