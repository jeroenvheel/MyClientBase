<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MCB_Menu extends Admin_Controller {

	function __construct() {

		parent::__construct();

	}

	function generate() {

		$menu_items = $this->config->item('mcb_menu');

		foreach ($menu_items as $key=>$menu_item) {

			if (!$this->session->userdata('global_admin')) {

				if (isset($menu_item['global_admin'])) {

					unset($menu_items[$key]);

				}

				elseif (isset($menu_item['submenu'])) {

					foreach ($menu_item['submenu'] as $sub_key=>$sub_item) {

						if (isset($sub_item['global_admin'])) {

							unset($menu_items[$key]['submenu'][$sub_key]);

						}

					}

				}

			}

		}

		return $menu_items;

	}

	function generate_control_center() {

		$control_center = $this->config->item('control_center');

		foreach ($control_center as $key=>$item) {

			if (!$this->session->userdata('global_admin')) {

				if (isset($item['global_admin'])) {

					unset($control_center[$key]);

				}

			}

		}

		return $control_center;

	}

	function display($params) {

		$data = array(
			'menu_items'    =>  $this->generate()
		);

		$this->load->view($params['view'], $data);

	}

	function display_control_center($params) {

		if ($this->uri->segment(1) == 'dashboard') {

			$data = array(
				'menu_items'    =>  $this->generate_control_center()
			);

			$this->load->view($params['view'], $data);

		}

	}

	function check_permission($uri_string, $global_admin) {

		foreach ($this->config->item('mcb_menu') as $menu_item) {

			if (isset($menu_item['href']) and strpos($menu_item['href'], $uri_string) === 0) {

				if (isset($menu_item['global_admin']) and !$global_admin) {

					redirect('dashboard');

				}

			}

			if (isset($menu_item['submenu'])) {

				foreach ($menu_item['submenu'] as $sub_item) {

					if (isset($sub_item['href']) and strpos($sub_item['href'], $uri_string) === 0) {

						if (isset($sub_item['global_admin']) and !$global_admin) {

							redirect('dashboard');

						}

					}


				}

			}

		}

		foreach ($this->config->item('control_center') as $menu_item) {

			if (strpos($menu_item['href'], $uri_string) === 0) {

				if (isset($menu_item['global_admin']) and !$global_admin) {

					redirect('dashboard');

				}

			}

		}

	}

}

?>