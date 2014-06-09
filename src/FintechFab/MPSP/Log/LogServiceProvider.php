<?php
namespace FintechFab\MPSP\Log;


use Monolog\Logger;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$logger = new Writer(
			new Logger($this->app['env']), $this->app['events']
		);

		$this->app->instance('log', $logger);

	}

}
