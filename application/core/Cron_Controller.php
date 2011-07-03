<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Cron_Controller extends MX_Controller {

    function __construct() {

        parent::__construct();

        $this->load->database();

        $this->load->helper('url');

        $this->load->model('mcb_modules/mdl_mcb_modules');

        $this->mdl_mcb_modules->set_module_data();

        $this->load->model('mcb_data/mdl_mcb_data');

        $this->mdl_mcb_data->set_session_data();

        $this->load->helper(array('uri', 'mcb_currency', 'mcb_invoice', 'mcb_date', 'mcb_icon', 'mcb_custom', 'mcb_app'));

        $this->load->language('mcb', $this->mdl_mcb_data->setting('default_language'));

        $this->load->model('fields/mdl_fields');

    }

}

?>