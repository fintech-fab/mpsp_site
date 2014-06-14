<?php namespace FintechFab\MPSP\Controllers;

use Config;
use FintechFab\MPSP\Components\Api;
use FintechFab\MPSP\Helpers\FormHorizontalFields;
use FintechFab\MPSP\Models\CalculateFee;
use FintechFab\MPSP\Models\Status;
use FintechFab\MPSP\Models\Transfer;
use FintechFab\MPSP\Models\TransferConfirm;
use Illuminate\Routing\Controller;
use Input;
use View;

class HomeController extends Controller
{

	public function __construct()
	{

	}

	public function index()
	{
		return View::make('mpsp::home');
	}


	public function feeForm()
	{

		$form = new CalculateFee();
		FormHorizontalFields::model($form);

		return View::make('mpsp::forms.fee');

	}

	public function statusForm()
	{

		$form = new Status();
		FormHorizontalFields::model($form);

		return View::make('mpsp::forms.status');

	}

	public function statusCheck()
	{

		$form = new Status();
		$form->setRawAttributes(Input::all());
		$form->validate();
		if ($form->error()) {
			return View::make('mpsp::errors.status', array(
				'error' => $form->error(),
			));
		}

		$result = Api::doTransferStatus(array(
			'code' => $form->status_code,
			'phone' => $form->status_phone,
		));

		if(!$result){
			return View::make('mpsp::errors.status', array(
				'error' => 'Error status request.',
			));
		}

		return View::make('mpsp::forms.status_result', array(
			'message' => $result->message,
		));

	}


	public function feeFormPost()
	{

		$form = new CalculateFee();
		$form->setRawAttributes(Input::all());
		$form->validate();
		if ($form->error()) {
			return View::make('mpsp::errors.fee', array(
				'error' => $form->error(),
			));
		}

		$result = Api::getFeeCost($form->calc_amount, $form->calc_receiver_city);
		if (!$result) {
			return 'wait';
		}

		FormHorizontalFields::model($form);

		return View::make('mpsp::forms.fee_result', array(
			'amount'       => $result->amount,
			'fee'          => $result->cost,
			'amount_total' => $result->total,
		));

	}


	public function transferForm()
	{

		$form = new CalculateFee();
		$form->setRawAttributes(Input::all());
		$form->validate();
		if ($form->error()) {
			return View::make('mpsp::errors.transfer', array(
				'error' => $form->error(),
			));
		}

		$formTransfer = new Transfer();
		$formTransfer->setRawAttributes($form->getAttributes());
		FormHorizontalFields::model($formTransfer);

		return View::make('mpsp::forms.transfer');

	}


	public function transferFormPost()
	{

		$form = new Transfer();
		$form->setRawAttributes(Input::all());
		$form->validate();
		if ($form->error()) {
			return View::make('mpsp::errors.transfer', array(
				'error' => $form->error(),
			));
		}

		$result = Api::getFeeCost($form->calc_amount, $form->calc_receiver_city);

		$params = array(
			'amount'             => $form->calc_amount,
			'currency'           => Config::get('api.currency'),
			'receiver_name'      => $form->receiver_name,
			'receiver_thirdname' => '-',
			'receiver_surname'   => '-',
			'receiver_phone'     => $form->receiver_phone,
			'sender_phone'       => $form->sender_phone,
			'receiver_city_id'   => $form->calc_receiver_city,
			'card_number'        => $form->card_number,
			'card_expire_month'  => $form->card_expire_month,
			'card_expire_year'   => $form->card_expire_year,
			'card_cvv'           => $form->card_cvc,
			'fee'                => $result->cost,
			'phone'              => $form->receiver_phone,
		);

		$result = Api::doTransferCreate($params);

		if (!$result || empty($result->transfer->phone)) {
			return View::make('mpsp::errors.transfer', array(
				'error' => 'Error create Transfer',
			));
		}

		$formConfirm = new TransferConfirm();
		$formConfirm->confirm_phone = $result->transfer->phone;
		$formConfirm->confirm_code = '';
		FormHorizontalFields::model($formConfirm);

		return View::make('mpsp::forms.transfer_result');

	}


	public function transferConfirmPost()
	{

		$form = new TransferConfirm();
		$form->setRawAttributes(Input::all());
		if ($form->error()) {
			return View::make('mpsp::errors.confirm', array(
				'error' => $form->error(),
			));
		}

		$result = Api::doTransferSend(array(
			'phone' => $form->confirm_phone,
			'code'  => $form->confirm_code,
		));

		if(!$result){
			return View::make('mpsp::errors.confirm', array(
				'error' => 'Error transfer confirmation',
			));
		}

		return View::make('mpsp::forms.transfer_confirm_result');

	}

} 