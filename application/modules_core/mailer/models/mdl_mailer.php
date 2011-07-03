<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Mdl_Mailer extends MY_Model {

    public function validate_invoice_email() {

        $this->form_validation->set_rules('invoice_template', $this->lang->line('invoice_template'), 'required');
        $this->form_validation->set_rules('email_from_name', $this->lang->line('from_name'), 'required');
        $this->form_validation->set_rules('email_from_email', $this->lang->line('from_email'), 'required|valid_email');
        $this->form_validation->set_rules('email_to', $this->lang->line('to'), 'required|callback_check_email');
        $this->form_validation->set_rules('email_subject', $this->lang->line('subject'), 'required|max_length[100]');
        $this->form_validation->set_rules('email_body', $this->lang->line('body'));
        $this->form_validation->set_rules('email_footer', $this->lang->line('footer'));

        return parent::validate($this);

    }

    public function validate_invoice_overdue() {

        $this->form_validation->set_rules('invoice_template', $this->lang->line('invoice_template'), 'required');
        $this->form_validation->set_rules('email_from_name', $this->lang->line('from_name'), 'required');
        $this->form_validation->set_rules('email_from_email', $this->lang->line('from_email'), 'required|check_email');
        $this->form_validation->set_rules('email_subject', $this->lang->line('subject'), 'required|max_length[100]');
        $this->form_validation->set_rules('email_body', $this->lang->line('body'));
        $this->form_validation->set_rules('email_footer', $this->lang->line('footer'));

        return parent::validate($this);

    }

    public function validate_payment_email() {

        $this->form_validation->set_rules('template', $this->lang->line('template'), 'required');
        $this->form_validation->set_rules('email_from_name', $this->lang->line('from_name'), 'required');
        $this->form_validation->set_rules('email_from_email', $this->lang->line('from_email'), 'required|valid_email');
        $this->form_validation->set_rules('email_to', $this->lang->line('to'), 'required|callback_check_email');
        $this->form_validation->set_rules('email_subject', $this->lang->line('subject'), 'required|max_length[100]');
        $this->form_validation->set_rules('email_body', $this->lang->line('body'));
        $this->form_validation->set_rules('email_footer', $this->lang->line('footer'));

        return parent::validate($this);

    }

    public function check_email($email) {

        $this->load->helper('email');

        $email = (strpos($email, ',')) ? explode(',', $email) : explode(';', $email);

        foreach ($email as $address) {

            if (!valid_email($address)) {

                $this->form_validation->set_message('check_email', 'The %s field can not be the word "test"');

                return FALSE;

            }

        }

        return TRUE;

    }

    public function email_invoice($invoice, $invoice_template, $from_email, $from_name, $to, $subject, $email_body = ' ', $email_footer, $invoice_as_body, $email_cc = NULL, $email_bcc = NULL) {

        $this->load->helper($this->mdl_mcb_data->setting('pdf_plugin'));

        $this->load->helper('mailer/phpmailer');

        $filename = $this->lang->line('invoice') . '_' . $invoice->invoice_number;

        $full_filename = 'uploads/temp/' . $filename . '.pdf';

        $data = array(
            'invoice'       =>  $invoice,
            'output_type'   =>  'pdf'
        );

        $pdf_invoice = $this->load->view('invoices/invoice_templates/' . $invoice_template, $data, TRUE);

        pdf_create($pdf_invoice, $filename, FALSE);

        if ($invoice_as_body) {

            $data['output_type'] = 'html';

            $html_invoice = $this->load->view('invoices/invoice_templates/' . $invoice_template, $data, TRUE);

            $email_body = ($invoice_as_body) ? nl2br($email_body) . $html_invoice : nl2br($email_body);

        }

        $email_body .= nl2br($email_footer);

        phpmail_send(
            array($from_email, $from_name),
            $to,
            $subject,
            $email_body,
            $full_filename,
            $email_cc,
            $email_bcc);

        $this->mdl_invoices->delete_invoice_file($filename . '.pdf');

        $this->mdl_invoices->save_invoice_history($invoice->invoice_id, $this->session->userdata('user_id'), $this->lang->line('emailed_invoice') . ' to ' . $to);

    }

    public function email_payment_receipt($invoice, $template, $from_email, $from_name, $to, $subject, $email_body, $email_footer, $receipt_as_body, $email_cc = NULL, $email_bcc = NULL) {

        $filename = 'receipt_' . $invoice->invoice_number;

        $full_filename = 'uploads/temp/' . $filename . '.pdf';

        $this->load->helper($this->mdl_mcb_data->setting('pdf_plugin'));

        $invoice_payments = $this->mdl_invoices->get_invoice_payments($invoice->invoice_id);

        $data = array(
            'invoice'           =>  $invoice,
            'invoice_payments'  =>  $invoice_payments
        );

        $html = $this->load->view('payments/receipt_templates/' . $template, $data, TRUE);

        pdf_create($html, $filename, FALSE);

        $this->load->helper('mailer/phpmailer');

        $email_body = ($receipt_as_body) ? nl2br($email_body) . $html : $email_body;

        if (!$email_body) {

            $email_body = ' ';

        }

        $email_body .= nl2br($email_footer);

        phpmail_send(
            array($from_email, $from_name),
            $to,
            $subject,
            $email_body,
            $full_filename,
            $email_cc,
            $email_bcc);

        $this->mdl_invoices->delete_invoice_file($filename . '.pdf');

    }

}

?>