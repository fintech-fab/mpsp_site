<?php

return [

	'connections' => [

		'ff-bank-em' => [
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'forge',
			'username'  => 'forge',
			'password'  => '#dbpass#',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => 'bank_#confid#_',
		],

		'ff-mt-em'   => [
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'forge',
			'username'  => 'forge',
			'password'  => '#dbpass#',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => 'transfer_#confid#_',
		],

	],

];