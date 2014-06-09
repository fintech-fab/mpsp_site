<?php
namespace FintechFab\MPSP\Models;


use Eloquent;
use Validator;

/**
 * @property string card_expire_month
 * @property string card_expire_year
 * @property string card_number
 * @property string card_cvc
 *
 * @property string calc_receiver_city
 * @property string calc_amount
 * @property string receiver_phone
 * @property string receiver_name
 * @property string sender_phone
 */
class Transfer extends Eloquent
{

	public $rules = array(

		'calc_receiver_city' => 'required|integer|min:1',
		'calc_amount'        => 'required|integer|min:10',

		'receiver_phone'    => 'required',
		'receiver_name'     => 'required',
		'sender_phone'      => 'required',
		'card_number'       => 'required|digits_between:13,19|',
		'card_expire_year'  => 'required|digits:2',
		'card_expire_month' => 'required|digits:2',
		'card_cvc'          => 'required|digits_between:3,4',

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

		$validator = Validator::make(
			$this->getAttributes(),
			$this->rules,
			$this->messages
		);

		if (!$validator->passes()) {
			$this->error = $validator->messages()->first();
			return;
		}

		if(!self::isLunaCardNumber($this->card_number)){
			$this->error = 'Card number is incorrect';
		}

		$this->checkExpire();

	}

	public function error()
	{
		return $this->error;
	}

	private static function isLunaCardNumber($sPan)
	{
		// проверка карты по алгоритму Луна (Luhn Algorithm)
		// последняя цифра - контрольная
		// контрольная цифра прибавляется к контрольной сумме после ее рассчета
		$iCheckDigit = (int)substr($sPan, -1, 1);
		// массив цифр карты без контрольной цифры
		$aCardDigits = str_split(substr($sPan, 0, strlen($sPan) - 1));
		// контрольная сумма
		$iControlSum = 0;

		// каждая нечетная цифра должна быть умножена на 2
		// если число при этом превышает 9, то рассчитывается как сумма этих цифр
		// (8*2 = 16 = 1+6 = 7)
		// четные цифры остаются без изменений
		for ($i = 0; $i < count($aCardDigits); $i++) {
			// четный элемент массива - нечетное число, меняем порядок
			if ($i % 2) {
				$iControlDigit = $aCardDigits[$i];
			} else {
				$iControlDigit = array_sum(str_split((string)$aCardDigits[$i] * 2));
			}
			$iControlSum += $iControlDigit;
		}

		return ($iControlSum + $iCheckDigit) % 10 == 0;
	}


	private function checkExpire()
	{


		if (strlen($this->card_expire_month) != 2) {
			$this->error = 'Card expire date is incorrect';
			return;
		}

		$sTmpValue = (int)$this->card_expire_month;
		if ($sTmpValue <= 0 || $sTmpValue > 12) {
			$this->error = 'Card expire date is incorrect';
			return;
		}


		if (strlen($this->card_expire_year) != 2) {
			$this->error = 'Card expire date is incorrect';
			return;
		}

		$iCurYear = date('y');
		$iCurMonth = date('n');
		$iMonth = (int)$this->card_expire_month;
		$iYear = (int)$this->card_expire_year;

		if (
			$iYear < $iCurYear || // year expired
			($iYear == $iCurYear && $iMonth <= $iCurMonth) || // month expired
			$iYear > ($iCurYear + 4) // over 4 years
		) {
			$this->error = 'Card expire date is incorrect';
			return;
		}

	}


}
