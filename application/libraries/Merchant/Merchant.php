<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Merchant Driver Library
 *
 * Description:
 * This library provides the basic interface for multiple types of payment
 * gateways.
 *
 * @version 2011.11.20
 * @copyright Copyright (c) 2011 Jesse Terry
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */

class Merchant extends CI_Driver_Library {

	/** The appropriate driver to load */
	public $driver;

	/** Test mode can be used for troubleshooting as long as the driver supports it */
	public $test_mode = FALSE;

	public $CI;

	public function __construct() {

		/** Load the list of valid drivers */
		$this->valid_drivers = array('merchant_paypal');

		/** Load a copy of the CI object */
		$this->CI =& get_instance();

		/** Load the language helper */
		$this->CI->load->helper('language');

	}

	public function curl_get($url, $post_data = NULL) {

		/** Standard cURL function to send & receive responsee */

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		if ($post_data) {

			if (is_array($post_data)) {

				$post_data = http_build_query($post_data);

			}

			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

		}

		$response = curl_exec($ch);

		curl_close($ch);

		return $response;

	}

	/** Generates and returns a form for payment, which posts to Merchant */
	public function payment_form($params, $form_name = 'merchant_form') {

		$post_url = $this->{$this->driver}->post_url();

		$form_data = $this->{$this->driver}->form_data($params);

		$form = '<form action="' . $post_url . '" method="post" style="display: inline;" name="' . $form_name . '">';

		foreach ($form_data as $key => $value) {

			$form .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />';

		}

		$form .= '<input type="submit" value="' . lang('merchant_pay_online') . '" />';

		$form .= '</form>';

		return $form;

	}

	/** Generates and returns a link for payment, which directs to Merchant */
	public function payment_link($params) {

		$url = $this->{$this->driver}->post_url();

		$data = $this->{$this->driver}->link_data($params);

		$return = '<a href="' . $url . '?';

		foreach ($data as $key=>$value) {

			$href_array[] = $key . '=' . $value;

		}

		$return .= implode('&', $href_array);

		$return .= '">' . lang('merchant_pay_online') . '</a>';

		return $return;

	}

	/** The driver handles the merchant response via this method */
	public function notify() {

		return $this->{$this->driver}->driver_notify();

	}

	/** @TODO This should be moved somewhere outside of the merchant library */
	public function save_response($response) {

		$this->CI->db->insert('mcb_merchant_responses', $response);

	}

}

?>