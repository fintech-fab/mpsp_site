<?php namespace FintechFab\MPSP\Views\Support;

use Illuminate\Support\ServiceProvider;
use View;

class ViewsServiceProvider extends ServiceProvider
{

	public function register()
	{
		View::addNamespace('mpsp', __DIR__.'/../');
	}

}