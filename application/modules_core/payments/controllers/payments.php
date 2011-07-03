<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Payments extends Admin_Controller {

    function __construct() {

        parent::__construct();

        $this->_post_handler();

        $this->load->model('mdl_payments');

    }

    function index() {

        $this->load->helper('text');

        $this->redir->set_last_index();

        $order_by = uri_assoc('order_by');

        $params = array(
            'paginate'	=>	TRUE,
            'page'		=>	uri_assoc('page')
        );

        switch ($order_by) {
            case 'payment_id':
                $params['order_by'] = 'mcb_payments.payment_id DESC';
                break;
            case 'client':
                $params['order_by'] = 'client_name';
                break;
            case 'amount':
                $params['order_by'] = 'payment_amount DESC';
                break;
            case 'invoice_id':
                $params['order_by'] = 'invoice_number DESC';
                break;
            default:
                $params['order_by'] = 'payment_date DESC';
        }

        if (!$this->session->userdata('global_admin')) {

            $params['where'][] = 'mcb_invoices.invoice_id IN (SELECT invoice_id FROM mcb_invoices WHERE user_id = ' . $this->session->userdata('user_id') . ')';

        }

        $data = array(
            'payments'		=>  $this->mdl_payments->get($params),
            'sort_links'	=>	TRUE);

        $this->load->view('index', $data);

    }

    function form() {

        $this->load->model('invoices/mdl_invoices');

        $payment_id = uri_assoc('payment_id');

        $invoice_id = uri_assoc('invoice_id');

        if (!$this->mdl_payments->validate()) {

            $this->load->helper('text');

            $this->load->model('mdl_payment_methods');

            $data = array(
                'payment_methods'	=>	$this->mdl_payment_methods->get(),
                'custom_fields'		=>	$this->mdl_payments->custom_fields
            );

            if (!$_POST) {

                if ($payment_id) {

                    $this->mdl_payments->prep_validation($payment_id);

                }

                else {

                    $this->mdl_payments->set_date();


                }

            }

            if ($invoice_id) {

                $params = array(
                    'select'	=>	'*',
                    'where'	=>	array(
                        'mcb_invoices.invoice_id'	=>	$invoice_id
                    )
                );

                if (!$this->session->userdata('global_admin')) {

                    $params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

                }

                $data['invoice'] = $this->mdl_invoices->get($params);

                $this->load->view('form', $data);

            }

            else {

                $params = array(
                    'where'	=>	array(
                        'invoice_balance >'	=>	0,
                        'invoice_is_quote'  =>  0
                    )
                );

                if (!$this->session->userdata('global_admin')) {

                    $params['where']['mcb_invoices.user_id'] = $this->session->userdata('user_id');

                }

                $invoices = $this->mdl_invoices->get($params);

                if ($invoices) {

                    $data['invoices'] = $invoices;

                    $this->load->view('form', $data);

                }

                else {

                    $this->load->view('form_no_invoices');

                }

            }

        }

        else {

            $this->mdl_payments->save();

            $this->load->model('invoices/mdl_invoice_amounts');

            if ($invoice_id) {

                $this->mdl_invoice_amounts->adjust($invoice_id);

            }

            elseif ($this->input->post('invoice_id')) {

                $this->mdl_invoice_amounts->adjust($this->input->post('invoice_id'));

            }

            $this->session->set_flashdata('tab_index', 2);

            $this->redir->redirect(array('payments', 'invoices'));

        }

    }

    function delete() {

        if (uri_assoc('payment_id')) {

            $invoice_id = $this->mdl_payments->get_invoice_id(uri_assoc('payment_id'));

            $this->mdl_payments->delete(array('payment_id'=>uri_assoc('payment_id')));

            $this->load->model('invoices/mdl_invoice_amounts');

            $this->mdl_invoice_amounts->adjust($invoice_id);

        }

        $this->session->set_flashdata('tab_index', 2);

        $this->redir->redirect(array('payments', 'invoices'));

    }

    function receipt() {

        $this->load->library('lib_output');

        $invoice_id = uri_assoc('invoice_id');

        $payment_id = uri_assoc('payment_id');

        $output_type = uri_assoc('type');

        $receipt_template = uri_assoc('receipt_template');

        $this->lib_output->$output_type($invoice_id, $payment_id, $receipt_template);

    }

    function _post_handler() {

        if ($this->input->post('btn_add')) {

            redirect('payments/form');

        }

        elseif ($this->input->post('btn_cancel')) {

            redirect($this->session->userdata('last_index'));

        }

    }

}



?>