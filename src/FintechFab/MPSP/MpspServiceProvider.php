<?php namespace FintechFab\MPSP;

use FintechFab\MPSP\Components\Api;
use FintechFab\MPSP\Controllers\HomeController;
use Illuminate\Support\ServiceProvider;
use Response;
use Route;
use View;

class MpspServiceProvider extends ServiceProvider
{

	public function register()
	{
		$this->registerViews();
		$this->registerRoutes();
		$this->registerErrorHandlers();
		$this->registerBinds();
	}

	private function registerRoutes()
	{
		Route::get('/', HomeController::class . '@index');

		Route::post(
			'sender/create',
			array(
				'as' => 'sender.create',
				'uses' => HomeController::class . '@create'
			)
		);

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

	private function registerErrorHandlers()
	{
		$this->app->missing(function()
		{
			return Response::view('mpsp::errors.missing', array(), 404);
		});
	}

	private function registerViews()
	{
		View::addNamespace('mpsp', __DIR__.'/Views');
	}

	private function registerBinds()
	{
		$this->app->bindShared('mpsp', function()
		{
			return new Api();
		});

	}

}