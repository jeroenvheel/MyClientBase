<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Merchant Driver Library - PayPal Driver
 *
 * Description:
 * This driver processes PayPal responses through the Merchant Driver Library.
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

class Merchant_Paypal extends CI_Driver {

	const PROCESS_URL = 'https://www.paypal.com/cgi-bin/webscr';
	const PROCESS_URL_TEST = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

	public function post_url() {

		return ($this->test_mode == TRUE) ? self::PROCESS_URL_TEST : self::PROCESS_URL;

	}

	public function form_data($params) {

		$data = array(
			'rm'			=>	'2',
			'cmd'			=>	'_xclick',
			'business'		=>	$params['merchant_account_id'],
			'return'		=>	$params['return_url'],
			'cancel_return' =>	$params['cancel_url'],
			'notify_url'	=>	$params['notify_url'],
			'item_name'		=>	$params['reference'],
			'amount'		=>	$params['amount'],
			'currency_code' =>	$params['currency_code'],
			'no_shipping'	=>	1,
			'custom'		=>	$params['custom']
		);

		return $data;

	}

	public function link_data($params) {

		$data = array(
			'rm'			=>	'2',
			'cmd'			=>	'_xclick',
			'business'		=>	urlencode($params['merchant_account_id']),
			'return'		=>	urlencode($params['return_url']),
			'cancel_return' =>	urlencode($params['cancel_url']),
			'notify_url'	=>	urlencode($params['notify_url']),
			'item_name'		=>	urlencode($params['reference']),
			'amount'		=>	urlencode($params['amount']),
			'currency_code' =>	urlencode($params['currency_code']),
			'no_shipping'	=>	1,
			'custom'		=>	urlencode($params['custom'])
		);

		return $data;

	}

	public function driver_notify() {

		$ipn_response = $_POST;

		$post_validation = $ipn_response;
		$post_validation['cmd'] = '_notify-validate';

		$response = $this->curl_get($this->post_url(), $post_validation);

		$db_array = array(
			'merchant_response_payment_id'		=>	0,
			'merchant_response_client_id'		=>	0,
			'merchant_response_invoice_id'		=>	$ipn_response['custom'],
			'merchant_response_amount'			=>	$ipn_response['mc_gross'],
			'merchant_response_method'			=>	'PayPal',
			'merchant_response_status'			=>	$response,
			'merchant_response_payment_status'	=>	$ipn_response['payment_status'],
			'merchant_response_post'			=>	serialize($ipn_response)
		);

		$this->save_response($db_array);

		log_message('DEBUG', $response);

		if ($response == 'VERIFIED' and $ipn_response['payment_status'] == 'Completed') {

			return TRUE;

		}

		return FALSE;

	}

}

?>