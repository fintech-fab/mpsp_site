<?php

use FintechFab\MPSP\Helpers\FormHorizontalFields;

echo Form::model(FormHorizontalFields::model(), array(
	'route' => array('status.check'),
	'class' => 'form-horizontal',
));

?>
<fieldset>
	<legend>Or сheck sent transfer there:</legend>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('status_code', 'Transfer code');
		FormHorizontalFields::text('status_code', 'transfer code');
		?>
	</div>

	<div class="form-group">
		<?php
		FormHorizontalFields::label('status_phone', 'Your phone number');
		FormHorizontalFields::text('status_phone', '07 000 000-00-00');
		?>
	</div>

	<div class="form-group pull-right">
		<button class="btn btn-large btn-primary" id="do-status">Check it!</button>
	</div>


	<div class="clear clearfix"></div>

</fieldset>

<?php


echo Form::close();
