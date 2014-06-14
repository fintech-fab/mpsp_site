<?php

$preloader = '<img alt="" src="data:image/gif;base64,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" />';

?>
<!DOCTYPE html>
<html>
<head lang="en">
	<title>MPSP</title>
	<meta charset="UTF-8">
	<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/yeti/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.js"></script>
	<link rel="stylesheet" href="/assets/style.css" />
</head>
<body>

<section id="content">

	<div class="row container">

		<div class="col-md-1"></div>

		<div class="col-md-5" id="service-forms">

			<div id="form-fee">

			</div>

			<div id="form-fee-result">

			</div>

			<div id="form-status" class="mt30">

			</div>

			<div id="form-status-result">

			</div>

		</div>

		<div class="col-md-5">

			<div id="transfer-forms">

				<div id="form-transfer">

				</div>

			</div>

			<div id="confirm-forms">

				<div id="form-transfer-result">

				</div>

				<div id="form-transfer-confirm-result">

				</div>

			</div>

		</div>

		<div class="col-md-1"></div>

	</div>

</section>

<script type="application/javascript">

	var preloader = '<?= $preloader ?>';

	$(document).ready(function () {
		loadFeeForm();
		loadStatusForm();
	});


	function loadFeeForm() {
		var url = '<?= URL::route('form.fee') ?>';
		$.get(url, function (data) {
			$('#form-fee').html(data);
			listenFeeForm();
		});
	}

	function loadStatusForm() {
		var url = '<?= URL::route('form.status') ?>';
		$.get(url, function (data) {
			$('#form-status').html(data);
			listenStatusForm();
		});
	}

	var mpspBackendTimeout = null;
	function listenFeeForm() {
		var $select = $('#calc_receiver_city');
		var $amount = $('#calc_amount');

		$select.off('change');
		$select.on('change', onChangeFee);

		$amount.off('input');
		$amount.on('input', function () {
			hideErrorBlocks();
			if (mpspBackendTimeout) {
				clearTimeout(mpspBackendTimeout);
			}
			var eventOb = this;
			mpspBackendTimeout = setTimeout(function () {
				onChangeFee(eventOb);
			}, 300);
		});
	}

	function onChangeFee(inputOb) {
		var url = '<?= URL::route('form.fee.post') ?>';
		var $this = inputOb && inputOb.target ? $(inputOb.target) : $(inputOb);
		var params = $('#form-fee').find('form').serialize();
		var $div = $('#form-fee-result');
		$div.html('<div class="waiting">' + preloader + '&nbsp;' + 'Please wait, we expect your conditions...' + '</div>');
		$.post(url, params, function (data) {
			hideErrorBlocks();
			var $div = $('#form-fee-result');
			if (data == 'wait') {
				if (mpspBackendTimeout) {
					clearTimeout(mpspBackendTimeout);
				}
				mpspBackendTimeout = setTimeout(function () {
					onChangeFee($this);
				}, 10000);
				return;
			}
			$div.html(data);
			listenFeeResultForm();
		});
	}

	function listenFeeResultForm() {
		var $button = $('#do-transfer');
		$button.off('click');
		$button.on('click', function () {
			hideErrorBlocks();
			showTransferForms();
			var url = '<?= URL::route('form.transfer') ?>';
			var $div = $('#form-transfer');
			var params = $('#form-fee').find('form').serialize();
			$div.html('<div class="waiting">' + preloader + '&nbsp;' + 'Please wait, create form data...' + '</div>');
			$.get(url, params, function (data) {
				var $div = $('#form-transfer');
				$div.html(data);
				listenTransferForm();
			});
			return false;
		});

	}

	function listenStatusForm() {
		var $button = $('#do-status');
		$button.off('click');
		$button.on('click', function () {
			hideErrorBlocks();
			var url = '<?= URL::route('status.check') ?>';
			var $div = $('#form-status-result');
			var params = $('#form-status').find('form').serialize();
			$div.html('<div class="waiting">' + preloader + '&nbsp;' + 'Please wait, check transfer status in progress...' + '</div>');
			$.post(url, params, function (data) {
				var $div = $('#form-status-result');
				$div.html(data);
			});
			return false;
		});

	}


	function listenBack2Services() {
		var $button = $('.do-back-services');
		$button.off('click');
		$button.on('click', function () {
			showServiceForms();
			return false;
		});
	}

	function hideErrorBlocks(){
		$('.error').remove();
	}

	function listenTransferForm() {

		listenBack2Services();

		var $button2 = $('#do-create-transfer');
		$button2.off('click');
		$button2.on('click', function () {
			hideErrorBlocks();
			var url = '<?= URL::route('form.transfer.post') ?>';
			var $div = $('#form-transfer-result');
			$div.html('<div class="waiting">' + preloader + '&nbsp;' + 'Please wait, creating transfer in progress...' + '</div>');
			var params = $('#form-transfer').find('form').serialize();
			$.post(url, params, function (data) {
				var $div = $('#form-transfer-result');
				$div.html(data);
				listenTransferFormResult();
			});
			return false;
		});

	}


	function listenConfirmForm() {

		var $button = $('#do-confirm-transfer');
		$button.off('click');
		$button.on('click', function () {
			hideErrorBlocks();
			var url = '<?= URL::route('transfer.confirm') ?>';
			var $div = $('#form-transfer-confirm-result');
			$div.html('<div class="waiting">' + preloader + '&nbsp;' + 'Please wait, confirmed transfer in progress...' + '</div>');
			var params = $('#form-transfer-result').find('form').serialize();
			$.post(url, params, function (data) {
				var $div = $('#form-transfer-confirm-result');
				$div.html(data);
				var $errors = $div.find('.error');
				if($errors.length <= 0){
					$('#form-transfer-result').hide();
					listenBack2Services();
				}

			});
		});

	}

	function listenTransferFormResult() {

		listenBack2Services();

		var $div = $('#form-transfer-result');
		if ($div.find('.error').length <= 0) {
			showConfirmForms();
			listenConfirmForm();
		}
	}

	function showServiceForms() {
		$('#form-transfer-result').html('');
		$('#confirm-forms').hide();

		$('#service-forms').show();
		$('#transfer-forms').hide();
		$('#form-transfer-confirm-result').hide();
	}

	function showTransferForms() {
		$('#form-transfer-result').html('');
		$('#confirm-forms').show();

		$('#service-forms').hide();
		$('#transfer-forms').show();
	}

	function showConfirmForms() {
		$('#service-forms').hide();
		$('#transfer-forms').hide();

		$('#confirm-forms').show();
	}


</script>


</body>
</html>