<?php

namespace FintechFab\MPSP\Tests;


use TestCase;
use URL;

class ExampleTest extends TestCase
{


	public function testFee()
	{
		$this->call(
			'POST',
			URL::route('form.fee.post')
		);

		dd($this->client->getResponse());
	}

}