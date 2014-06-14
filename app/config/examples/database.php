<?php

return [

	'connections' => [

		'ff-bank-em' => [
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'emulators',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => 'bank_',
		],

		'ff-mt-em'   => [
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'emulators',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => 'transfer_',
		],

	],

];