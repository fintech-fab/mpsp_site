<?php
return [

	'debug'     => true,

	'key'       => 'random-key',

	'providers' => [
		100500 => 'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider', // ide-helper

		100501 => \FintechFab\BankEmulator\BankEmulatorServiceProvider::class,
		100502 => \FintechFab\MoneyTransferEmulator\MoneyTransferEmulatorServiceProvider::class,

	],

];