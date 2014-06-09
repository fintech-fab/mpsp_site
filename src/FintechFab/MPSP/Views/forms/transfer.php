<?php

use FintechFab\MPSP\Helpers\FormHorizontalFields;

echo Form::model(FormHorizontalFields::model(), array(
	'route' => array('sender.create'),
	'class' => 'form-horizontal',
));

FormHorizontalFields::model()->receiver_phone = '79104775209';
FormHorizontalFields::model()->receiver_name = 'Jacky Chen';
FormHorizontalFields::model()->sender_phone = '79104775209';
FormHorizontalFields::model()->card_number = '4532274626451231';
FormHorizontalFields::model()->card_expire_year = '15';
FormHorizontalFields::model()->card_expire_month = '12';
FormHorizontalFields::model()->card_cvc = '333';

?>

<fieldset>
	<legend>Destination details</legend>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('Receiver phone number');
		FormHorizontalFields::text('receiver_phone', '07 000 000-00-00');
		?>
	</div>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('Receiver name');
		FormHorizontalFields::text('receiver_name', 'John Doe');
		?>
	</div>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('Your phone number');
		FormHorizontalFields::text('sender_phone', '07 000 000-00-00');
		?>
	</div>
</fieldset>

<fieldset>
	<legend>Card data</legend>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('card_number');
		FormHorizontalFields::text('card_number', '0000000000000000');
		?>
	</div>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('card_expire_month', 'Card expire date');
		FormHorizontalFields::text('card_expire_month', 'MM', 2);
		FormHorizontalFields::text('card_expire_year', 'YY', 2);
		?>
	</div>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('CVV/CVC2');
		FormHorizontalFields::text('card_cvc', '000', 2);
		?>
	</div>

	<?php
	FormHorizontalFields::hidden('calc_receiver_city');
	FormHorizontalFields::hidden('calc_amount');
	?>

</fieldset>

<?= Form::close() ?>


<div class="pull-left">
	<button class="btn btn-sm btn-info do-back-services">back</button>
</div>
<div class="pull-right">
	<button class="btn btn-sm btn-primary" id="do-create-transfer">Create transfer!</button>
</div>

<div class="clearfix clear"></div>
