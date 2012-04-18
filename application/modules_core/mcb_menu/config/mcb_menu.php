<?php

$config = array(
	'mcb_menu'  =>  array(
		'dashboard' =>  array(
			'title' =>  'dashboard',
			'href'  =>  'dashboard'
		),
		'clients'   =>  array(
			'title'     =>  'clients',
			'href'      =>  'clients/index',
			'submenu'   =>  array(
				'clients/form'   =>  array(
					'title' =>  'add_client',
					'href'  =>  'clients/form'
				),
				'clients'  =>  array(
					'title' =>  'view_clients',
					'href'  =>  'clients/index'
				)
			)
		),
		'quotes'  =>  array(
			'title'     =>  'quotes',
			'href'      =>  'invoices/index/is_quote/1',
			'submenu'   =>  array(
				'invoices/create/quote'    =>  array(
					'title' =>  'create_quote',
					'href'  =>  'invoices/create/quote'
				),
				'invoices/index/is_quote/1' =>  array(
					'title' =>  'view_quotes',
					'href'  =>  'invoices/index/is_quote/1'
				)
			)
		),
		'invoices'  =>  array(
			'title'     =>  'invoices',
			'href'      =>  'invoices/index',
			'submenu'   =>  array(
				'invoices/create'   =>  array(
					'title' =>  'create_invoice',
					'href'  =>  'invoices/create'
				),
				'invoices/index'    =>  array(
					'title' =>  'view_invoices',
					'href'  =>  'invoices/index'
				),
				'invoice_search'    =>  array(
					'title' =>  'invoice_search',
					'href'  =>  'invoice_search'
				),
				'setup'		=>	array(
					'title'	=>	'setup',
					'submenu'	=>	array(
						'invoices/invoice_groups'	=>	array(
							'title'         =>  'invoice_groups',
							'href'          =>  'invoices/invoice_groups'
						),
						'invoice_statuses'  =>  array(
							'title'         =>  'invoice_statuses',
							'href'          =>  'invoice_statuses/index',
							'global_admin'  =>  TRUE
						),
						'tax_rates' =>  array(
							'title'         =>  'tax_rates',
							'href'          =>  'tax_rates/index'
						)
					)
				)
			)
		),
		'payments'  =>  array(
			'title'     =>  'payments',
			'href'      =>  'payments/index',
			'submenu'   =>  array(
				'payments/form' =>  array(
					'title' =>  'enter_payment',
					'href'  =>  'payments/form'
				),
				'payments/index'    =>  array(
					'title' =>  'view_payments',
					'href'  =>  'payments/index'
				),
				'payments/client_credits/index'	=>	array(
					'title'	=>	'account_deposits',
					'href'	=>	'payments/client_credits/index'
				),
				'payments/payment_methods'  =>  array(
					'title'         =>  'payment_methods',
					'href'          =>  'payments/payment_methods',
					'global_admin'  =>  TRUE
				),
				'templates/index/type/payment_receipts' =>  array(
					'title'         =>  'receipt_templates',
					'href'          =>  'templates/index/type/payment_receipts'
				)
			)
		),
		'inventory' =>  array(
			'title'         =>  'inventory',
			'href'          =>  'inventory/index',
			'submenu'       =>  array(
				'inventory/index'   =>  array(
					'title'         =>  'inventory_items',
					'href'          =>  'inventory/index'
				),
				'inventory/inventory_types' =>  array(
					'title'         =>  'inventory_types',
					'href'          =>  'inventory/inventory_types'
				)
			)
		),
		'reports'   =>  array(
			'title'         =>  'reports',
			'submenu'       =>  array(
				'client_list'   =>  array(
					'title' =>  'client_list',
					'href'  =>  'reports/client_list'
				),
				'client_statement'  =>  array(
					'title' =>  'client_statement',
					'href'  =>  'reports/client_statement'
				),
				'inventory_history' =>  array(
					'title' =>  'inventory_history',
					'href'  =>  'reports/inventory_history'
				),
				'sales'		=>	array(
					'title'	=>	'sales',
					'href'	=>	'reports/sales'
				),
				'sales_by_customer'	=>	array(
					'title'	=>	'sales_by_customer',
					'href'	=>	'reports/sales_by_customer'
				)
			)
		)
	),
	'control_center'	=>	array(
		'my_profile'	=>	array(
			'title'			=>	'my_profile',
			'href'			=>	'users/profile'
		),
		'client_center' =>  array(
			'title'         =>  'client_center',
			'href'          =>  'client_center/admin',
			'global_admin'  =>  TRUE
		),
		'fields'    =>  array(
			'title'         =>  'custom_fields',
			'href'          =>  'fields/index',
			'global_admin'  =>  TRUE
		),
		'mcb_modules'   =>  array(
			'title'         =>  'custom_modules',
			'href'          =>  'mcb_modules/index',
			'global_admin'  =>  TRUE
		),
		'email_templates'	=>	array(
			'title'			=>	'email_templates',
			'href'			=>	'email_templates',
			'global_admin'	=>	TRUE
		),
		'invoice_templates'	=>	array(
			'title'			=>	'invoice_templates',
			'href'			=>	'templates/index/type/invoices',
			'global_admin'  =>  TRUE
		),
		'settings'  =>  array(
			'title'         =>  'system_settings',
			'href'          =>  'settings/index',
			'global_admin'  =>  TRUE
		),
		'users' =>  array(
			'title'         =>  'user_accounts',
			'href'          =>  'users/index',
			'global_admin'  =>  TRUE
		)
	)
);

?>