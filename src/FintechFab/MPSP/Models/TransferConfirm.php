<?php
namespace FintechFab\MPSP\Models;


use Eloquent;
use Validator;

/**
 * @property string confirm_phone
 * @property string confirm_code
 */
class TransferConfirm extends Eloquent
{

	protected $fillable = array('confirm_phone', 'confirm_code');

	public $rules = array(
		'confirm_phone' => 'required',
		'confirm_code'  => 'required',
	);

	public $messages = array(
		'status_phone.required' => 'Type your phone number',
		'confirm_code.required' => 'Type transfer code from sms',
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