<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Dashboard_Settings extends Admin_Controller {

	function display() {

        if (!$_POST and $this->mdl_mcb_data->setting('dashboard_total_paid_cutoff_date')) {

            $this->mdl_mcb_data->set_setting('dashboard_total_paid_cutoff_date', format_date($this->mdl_mcb_data->setting('dashboard_total_paid_cutoff_date')));

        }

		$this->load->view('settings');

	}

	function save() {

		/*
		 * As per the config file, this function will
		 * execute when the core system settings are saved.
		*/

		if ($this->input->post('dashboard_show_open_invoices')) {

			$this->mdl_mcb_data->save('dashboard_show_open_invoices', 'TRUE');

		}

		else {

			$this->mdl_mcb_data->save('dashboard_show_open_invoices', 'FALSE');

		}

		if ($this->input->post('dashboard_show_closed_invoices')) {

			$this->mdl_mcb_data->save('dashboard_show_closed_invoices', 'TRUE');

		}

		else {

			$this->mdl_mcb_data->save('dashboard_show_closed_invoices', 'FALSE');

		}
		
		if ($this->input->post('dashboard_show_pending_invoices')) {

			$this->mdl_mcb_data->save('dashboard_show_pending_invoices', 'TRUE');

		}

		else {

			$this->mdl_mcb_data->save('dashboard_show_pending_invoices', 'FALSE');

		}
		
		if ($this->input->post('dashboard_show_overdue_invoices')) {

			$this->mdl_mcb_data->save('dashboard_show_overdue_invoices', 'TRUE');

		}

		else {

			$this->mdl_mcb_data->save('dashboard_show_overdue_invoices', 'FALSE');

		}

		$this->mdl_mcb_data->save('dashboard_override', $this->input->post('dashboard_override'));

        $this->mdl_mcb_data->save('dashboard_total_paid_cutoff_date', strtotime(standardize_date($this->input->post('dashboard_total_paid_cutoff_date'))));

	}

}

?>