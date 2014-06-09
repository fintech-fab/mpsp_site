<?php
namespace FintechFab\MPSP\Models;


use Eloquent;
use Validator;

/**
 * Class CalculateFee
 *
 * @package FintechFab\MPSP\Models
 *
 * @property integer $calc_receiver_city
 * @property integer $calc_amount
 *
 */
class CalculateFee extends Eloquent
{

	protected $fillable = array('calc_receiver_city', 'calc_amount');

	public $rules = array(
		'calc_receiver_city' => 'required|integer|min:1',
		'calc_amount'        => 'required|integer|min:10',
	);

	public $messages = array(
		'calc_receiver_city.integer'  => 'Select City',
		'calc_receiver_city.min'      => 'Select City',
		'calc_receiver_city.required' => 'Select City',
		'calc_amount.required'        => 'Set transfer amount',
		'calc_amount.integer'         => 'Set correct transfer amount (as integer)',
		'calc_amount.min'             => 'Set transfer amount more 10',
	);

	private $error;

	public function validate()
	{

		$validator = \Validator::make(
			$this->getAttributes(),
			$this->rules,
			$this->messages
		);

		if (!$validator->passes()) {
			$this->error = $validator->messages()->first();
		}
	}

	public function error()
	{
		return $this->error;
	}


} 