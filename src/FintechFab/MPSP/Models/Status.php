<?php
namespace FintechFab\MPSP\Models;


use Eloquent;
use Validator;

/**
 * Class Status
 *
 * @package FintechFab\MPSP\Models
 *
 * @property string  status_code
 * @property string  status_phone
 */
class Status extends Eloquent
{

	protected $fillable = array('status_phone', 'status_code');

	public $rules = array(
		'status_code'  => 'required',
		'status_phone' => 'required',
	);

	public $messages = array(
		'status_code.required'  => 'Type transfer Code',
		'status_phone.required' => 'Type your phone number',
	);

	private $error;

	public function validate()
	{
		$validator = Validator::make(
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