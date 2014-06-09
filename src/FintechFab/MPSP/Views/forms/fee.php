<?php

use FintechFab\MPSP\Helpers\FormHorizontalFields;

echo Form::model(FormHorizontalFields::model(), array(
	'route' => array('sender.create'),
	'class' => 'form-horizontal',
));

?>
<fieldset>
	<legend>New transfer conditions:</legend>

	<div class="form-group">
		<?
		FormHorizontalFields::label('calc_amount', 'Amount (EUR)');
		FormHorizontalFields::text('calc_amount', 'min: 10', 3);
		?>
	</div>

	<div class="form-group">
		<?
		FormHorizontalFields::label('calc_receiver_city', 'Receiver city');
		FormHorizontalFields::dropdownCity('calc_receiver_city');
		?>
	</div>

</fieldset>

<?php


echo Form::close();
