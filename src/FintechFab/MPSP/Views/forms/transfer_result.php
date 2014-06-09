<?php

use FintechFab\MPSP\Helpers\FormHorizontalFields;

echo Form::model(FormHorizontalFields::model(), array(
	'route' => array('transfer.confirm'),
	'class' => 'form-horizontal',
));

?>

<fieldset>
	<legend>Please confirm your transfer:</legend>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('Receiver phone number');
		FormHorizontalFields::disabled('confirm_phone');
		FormHorizontalFields::hidden('confirm_phone');
		?>
	</div>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('Confirm sms code');
		FormHorizontalFields::text('confirm_code', 'code from sms');
		?>
	</div>

</fieldset>

<?= Form::close() ?>


<div class="pull-left">
	<button class="btn btn-sm btn-info do-back-services">back</button>
</div>
<div class="pull-right">
	<button class="btn btn-sm btn-primary" id="do-confirm-transfer">Confirm!</button>
</div>

<div class="clearfix clear"></div>
