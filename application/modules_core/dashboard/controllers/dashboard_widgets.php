<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_Widgets extends Admin_Controller {

	function total_balance() {

		if ($this->session->userdata('global_admin')) {

			$invoice_total_balance = $this->mdl_invoices->get_total_invoice_balance();

		}

		else {

			$invoice_total_balance = $this->mdl_invoices->get_total_invoice_balance($this->session->userdata('user_id'));

		}

		$data = array(
			'invoice_total_balance'	=>	$invoice_total_balance
		);

		$this->load->view('dashboard/sidebar_invoice_balance', $data);

	}

    function total_paid() {

        $this->load->model('payments/mdl_payments');

        $params = array();

        if ($this->mdl_mcb_data->setting('dashboard_total_paid_cutoff_date')) {

            $params['where']['mcb_payments.payment_date >='] = $this->mdl_mcb_data->setting('dashboard_total_paid_cutoff_date');

        }

        if ($this->session->userdata('global_admin')) {

            $invoice_total_paid = $this->mdl_payments->get_total_paid($params);

        }

        else {

            $params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

            $invoice_total_paid = $this->mdl_payments->get_total_paid($params);

        }

        $data = array(
            'invoice_total_paid'    =>  $invoice_total_paid
        );

        $this->load->view('dashboard/sidebar_invoice_paid', $data);

    }

}

?>