<?php namespace FintechFab\MPSP\Routes;

use FintechFab\MPSP\Controllers\HomeController;
use Illuminate\Support\ServiceProvider;
use Route;

class RoutesServiceProvider extends ServiceProvider
{

	public function register()
	{
		$this->routes();
	}

	private function routes()
	{
		Route::get('/', HomeController::class . '@index');

		Route::post('sender/create', array('as' => 'sender.create', 'uses' => HomeController::class . '@create'));

		Route::get(
			'form/status',
			array(
				'as'   => 'form.status',
				'uses' => HomeController::class . '@statusForm'
			)
		);

		Route::post(
			'form/status',
			array(
				'as'   => 'status.check',
				'uses' => HomeController::class . '@statusCheck'
			)
		);

		Route::get(
			'form/fee',
			array(
				'as'   => 'form.fee',
				'uses' => HomeController::class . '@feeForm'
			)
		);

		Route::post(
			'form/fee/calc',
			array(
				'before' => 'csrf',
				'as'     => 'form.fee.post',
				'uses'   => HomeController::class . '@feeFormPost'
			)
		);

		Route::get(
			'form/transfer',
			array(
				'as'   => 'form.transfer',
				'uses' => HomeController::class . '@transferForm'
			)
		);

		Route::post(
			'form/transfer',
			array(
				'before' => 'csrf',
				'as'     => 'form.transfer.post',
				'uses'   => HomeController::class . '@transferFormPost'
			)
		);

		Route::post(
			'form/transfer/confirm',
			array(
				'before' => 'csrf',
				'as'     => 'transfer.confirm',
				'uses'   => HomeController::class . '@transferConfirmPost'
			)
		);
	}

}