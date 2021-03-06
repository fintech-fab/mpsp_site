<?php

namespace FintechFab\MPSP\Components;


use App;
use Config;
use Log;

class Api
{

	const C_STATUS_NEW = 1; // новый перевод
	const C_STATUS_CHECK_WAIT = 2; // ожидание проверки возможности перевода
	const C_STATUS_CHECK_ERROR = 3; // перевод нельзя осуществить
	const C_STATUS_CHECK_SUCCESS = 4; // перевод возможно осуществить
	const C_STATUS_ACQUIRING_WAIT = 5; // ожидание списания средств с карты
	const C_STATUS_ACQUIRING_3DS = 6; // требуется пройти 3DS авторизацию
	const C_STATUS_ACQUIRING_ERROR = 7; // ошибка списания средств
	const C_STATUS_ACQUIRING_SUCCESS = 8; // средства были списаны с карты
	const C_STATUS_TRANSFER_TO_SEND = 9; // ожидание выполнения перевода
	const C_STATUS_TRANSFER_ERROR = 10; // не удалось выполнить перевод
	const C_STATUS_TRANSFER_SUCCESS = 11; // перевод был успешно отправлен
	const C_STATUS_REFUND_WAIT = 12; // ожидание возврата средств
	const C_STATUS_REFUND_ERROR = 13; // не удалось вернуть средства
	const C_STATUS_REFUND_SUCCESS = 14; // средства были возвращены

	/**
	 * @param $params
	 *
	 * @return \stdClass
	 */
	public static function doTransferCreate($params)
	{

		$result = self::request('transfer/create', $params);

		return $result;

	}

	/**
	 * @param $name
	 * @param $params
	 *
	 * @return \stdClass
	 */
	private static function request($name, $params)
	{

		Log::info('Environment: ' . App::environment());

		$url = rtrim(Config::get('api.url'), '/') . '/' . $name;
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);

		Log::info('Api request', array(
			'url'  => $url,
			'name' => $name,
			'params' => $params,
			'error'  => $error,
			'result' => $result,
		));

		if ($error) {
			Log::warning('Curl request error: ' . $error, array());

			return null;
		}

		$json = @json_decode($result);

		if (!$json) {
			Log::warning('Response format error: ' . $result, array());

			return null;
		}

		if ($json->code < 0) {
			Log::warning('Operation processing error: ' . $json->message, array());
			Log::info('Api response', array(
				'result' => $json,
			));
			return null;
		}

		if (!$json->response) {
			Log::warning('Response is empty', array());

			return null;
		}

		return $json->response;

	}

	/**
	 * @param $params
	 *
	 * @return \stdClass
	 */
	public static function doTransferSend($params)
	{

		$result = self::request('transfer/send', $params);

		return $result;

	}

	/**
	 * @param $amount
	 * @param $cityId
	 *
	 * @return \stdClass
	 */
	public static function getFeeCost($amount, $cityId)
	{

		$params = array(
			'amount'  => (int)$amount,
			'currency' => Config::get('api.currency'),
			'city_id' => $cityId,
		);

		$oResult = self::request('transfer/cost', $params);
		return $oResult;

	}

	/**
	 * @param $params
	 *
	 * @return null|\stdClass
	 */
	public static function doTransferStatus($params)
	{

		$result = self::request('transfer/status', $params);
		if(empty($result) || empty($result->transfer->status) ){
			return null;
		}

		switch ($result->transfer->status) {

			case self::C_STATUS_NEW:
			case self::C_STATUS_CHECK_WAIT:
			case self::C_STATUS_CHECK_SUCCESS:
				$sMsg = 'Ждите, идет обработка перевода';
				break;

			case self::C_STATUS_ACQUIRING_ERROR:
				$sMsg = 'Ошибка списания средств с карты отправителя';
				break;

			case self::C_STATUS_ACQUIRING_WAIT:
			case self::C_STATUS_ACQUIRING_SUCCESS:
				$sMsg = 'Идет списание средств с вашей карты...';
				break;

			case self::C_STATUS_TRANSFER_TO_SEND:
				$sMsg = 'Средства успешно списаны с вашей карты, осуществляется перевод...';
				break;

			case self::C_STATUS_TRANSFER_SUCCESS:
				$sMsg = 'Перевод успешно отправлен!';
				break;

			case self::C_STATUS_REFUND_SUCCESS:
				$sMsg = 'Возникла ошибка перевода, средства возвращены на карту отправителя';
				break;

			case self::C_STATUS_REFUND_WAIT:
				$sMsg = 'Возникла ошибка перевода, осуществляется возврат средств на карту отправителя';
				break;

			case self::C_STATUS_REFUND_ERROR:
				$sMsg = 'Возникла ошибка перевода и возврата средств на карту отправителя';
				break;

			default:
				$sMsg = 'Статус неизвестен. Программист был голоден и не описал этот статус';
				break;
		}

		$result->message = $sMsg . ' [#' . $result->transfer->status . ']';

		return $result;


	}


}
