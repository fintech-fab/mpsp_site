<?php

return [

	'connections' => [

		'ff-bank-em' => [
			'driver'  => 'iron',
			'project' => '#ironkey#',
			'token'   => '#irontoken#',
			'queue'   => 'emulator-#confid#',
		],

	],

];