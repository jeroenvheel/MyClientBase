<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Setup extends Admin_Controller {

    function index() {

    }

    function install() {

    }

    function uninstall() {

    }

    function upgrade() {

        switch($this->mdl_mcb_modules->custom_modules['export']->module_version) {
            case '0.1':
                $this->u093();
                break;
            case '0.2':
                $this->u093();
                break;
            case '0.3':
                $this->u093();
                break;
            case '0.3.1':
                $this->u093();
                break;
            case '0.8.7':
                $this->u093();
                break;
            case '0.8.8':
                $this->u093();
                break;
            case '0.9.2':
                $this->u093();
                break;
        }

    }
    
    function u093() {
        
        $this->set_module_version('0.9.3');
        
    }

	function set_module_version($module_version) {

		$this->db->set('module_version', $module_version);

		$this->db->where('module_path', 'export');

		$this->db->update('mcb_modules');

	}

}

?>