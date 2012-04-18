<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Invoice_Mailer extends Admin_Controller {

    function __construct() {

        parent::__construct();

        $this->load->model(
            array(
            'users/mdl_users',
            'invoices/mdl_invoices',
            'templates/mdl_templates',
            'mdl_mailer'
            )
        );

    }

    function form() {

		/**
		 * Grab the invoice id from url, if exists.
		 */
        $invoice_id = uri_assoc('invoice_id', 4);

		/**
		 * No invoice id in url? Screw it, let's get outta here.
		 */
        if (!$invoice_id) {

            redirect($this->session->userdata('last_index'));

        }

		/**
		 * Was the Cancel button pressed?
		 */
        if ($this->input->post('btn_cancel')) {

            redirect('invoices');

        }

		/**
		 * Load the email template model.
		 */
		$this->load->model('email_templates/mdl_email_templates');

		/**
		 * Set some default values
		 */
		$default_template = $this->mdl_email_templates->get_by_id($this->mdl_mcb_data->setting('default_invoice_email_template'));
		$email_body = ($default_template) ? $default_template->email_template_body : ' ';
		$email_footer = ($default_template) ? $default_template->email_template_footer : ' ';

		/**
		 * Set the parameters for the invoice model.
		 */
        $params = array(
            'where'	=>	array(
                'mcb_invoices.invoice_id'	=>	$invoice_id
            ),
            'get_invoice_items'     =>  TRUE,
            'get_invoice_tax_rates' =>  TRUE,
            'get_invoice_payments'  =>  TRUE,
            'get_invoice_tags'      =>  TRUE
        );

		/**
		 * Get the invoice object.
		 */
        $invoice = $this->mdl_invoices->get($params);

		/**
		 * Does this thing validate yet or what?
		 */
        if (!$this->mdl_mailer->validate_invoice_email()) {

			/**
			 * If nothing has yet been posted, let's set some form values.
			 */
            if (!$_POST) {

                $email_subject = (!$invoice->invoice_is_quote) ? $this->lang->line('invoice') : $this->lang->line('quote');
                $email_subject .= ' #' . $invoice->invoice_number;

                $this->mdl_mailer->set_form_value('email_to', $invoice->client_email_address);
                $this->mdl_mailer->set_form_value('email_from_name', $invoice->from_first_name . ' ' . $invoice->from_last_name);
                $this->mdl_mailer->set_form_value('email_from_email', $invoice->from_email_address);
                $this->mdl_mailer->set_form_value('email_subject', $email_subject);
                $this->mdl_mailer->set_form_value('email_body', $email_body);
                $this->mdl_mailer->set_form_value('invoice_template', uri_assoc('invoice_template', 4));
                $this->mdl_mailer->set_form_value('email_cc', $this->mdl_mcb_data->setting('default_cc'));
                $this->mdl_mailer->set_form_value('email_bcc', $this->mdl_mcb_data->setting('default_bcc'));
                $this->mdl_mailer->set_form_value('email_footer', $email_footer);

            }

			/**
			 * Prepare the data for the view.
			 */
            $data = array(
                'templates'	=>	$this->mdl_templates->get('invoices')
            );

			/**
			 * Duh, load the view.
			 */
            $this->load->view('invoice_mailer', $data);

        }

        else {

			/**
			 * Finally, the freakin' form has validated.
			 * Now let's quit jerking around and load a few things.
			 */
			$this->load->library('invoices/lib_output');

			/**
			 * Here's a bunch of stuff we'll cram into the email.
			 */
            $invoice_template = $this->input->post('invoice_template');
            $from_email = $this->input->post('email_from_email');
            $from_name = $this->input->post('email_from_name');
            $to = $this->input->post('email_to');
            $subject = $this->input->post('email_subject');
            $email_body = $this->input->post('email_body');
            $email_cc = $this->input->post('email_cc');
            $email_bcc = $this->input->post('email_bcc');
            $invoice_as_body = $this->input->post('invoice_as_body');
            $email_footer = $this->input->post('email_footer');

			/**
			 * Shoot the email out into space in hopes a civilization far, far
			 * way shall receive it, decipher it, locate our planet and destroy
			 * us all.
			 */
            $this->mdl_mailer->email_invoice(
                $invoice,
                $invoice_template,
                $from_email,
                $from_name,
                $to,
                $subject,
                $email_body,
                $email_footer,
                $invoice_as_body,
                $email_cc,
                $email_bcc
            );

			$this->load->model('invoices/mdl_invoice_history');
			$this->mdl_invoice_history->save($invoice->invoice_id, $this->session->userdata('user_id'), $this->lang->line('emailed_invoice') . ' to ' . $to);

			/**
			 * Ok, we're done here. Let's move on.
			 */
            redirect($this->session->userdata('last_index'));

        }

    }

    function overdue() {

        if (!$this->mdl_mailer->validate_invoice_overdue()) {

            if (!$_POST) {

				$this->load->model('email_templates/mdl_email_templates');

				$default_template = $this->mdl_email_templates->get_by_id($this->mdl_mcb_data->setting('default_overdue_invoice_email_template'));
				$email_body = ($default_template) ? $default_template->email_template_body : ' ';
				$email_footer = ($default_template) ? $default_template->email_template_footer : ' ';

                $user = $this->mdl_users->get_by_id($this->session->userdata('user_id'));

                $this->mdl_mailer->set_form_value('email_from_name', $user->first_name . ' ' . $user->last_name);
                $this->mdl_mailer->set_form_value('email_from_email', $user->email_address);
                $this->mdl_mailer->set_form_value('email_subject', $this->lang->line('overdue_invoice_reminder'));
                $this->mdl_mailer->set_form_value('email_body', $email_body);
                $this->mdl_mailer->set_form_value('email_footer', $email_footer);

                $this->mdl_mailer->set_form_value('invoice_template', $this->mdl_mcb_data->setting('default_invoice_template'));

            }

            $data = array(
                'invoices'  =>  $this->mdl_invoices->get_overdue(),
                'templates' =>  $this->mdl_templates->get('invoices')
            );

            $this->load->view('invoice_overdue', $data);

        }

        else {

            if ($this->input->post('invoice_ids')) {

                $invoice_template = $this->input->post('invoice_template');
                $from_email = $this->input->post('email_from_email');
                $from_name = $this->input->post('email_from_name');
                $subject = $this->input->post('email_subject');
                $email_body = $this->input->post('email_body');
                $email_cc = $this->input->post('email_cc');
                $email_bcc = $this->input->post('email_bcc');
                $invoice_as_body = $this->input->post('invoice_as_body');
                $email_addresses = $this->input->post('email_address');
                $email_footer = $this->input->post('email_footer');

                foreach ($this->input->post('invoice_ids') as $invoice_id) {

                    $params = array(
                        'where' =>  array(
                            'mcb_invoices.invoice_id'   =>  $invoice_id
                        ),
                        'get_invoice_items'     =>  TRUE,
                        'get_invoice_tax_rates' =>  TRUE,
                        'get_invoice_payments'  =>  TRUE,
                        'get_invoice_tags'      =>  TRUE
                    );

                    $invoice = $this->mdl_invoices->get($params);

                    $to = $email_addresses[$invoice_id];

                    $this->mdl_mailer->email_invoice(
                        $invoice,
                        $invoice_template,
                        $from_email,
                        $from_name,
                        $to,
                        $subject,
                        $email_body,
                        $email_footer,
                        $invoice_as_body,
                        $email_cc,
                        $email_bcc
                    );

                }

            }

            redirect($this->session->userdata('last_index'));

        }

    }

}

?>