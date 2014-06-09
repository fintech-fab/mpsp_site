<?php

?>

<table class="table">
	<tr>
		<td>Receive Amount</td>
		<td><?= $amount ?> <?= Config::get('api.currency') ?></td>
	</tr>
	<tr>
		<td>Your commission</td>
		<td><?= $fee ?> <?= Config::get('api.currency') ?></td>
	</tr>
	<tr>
		<td>Total amount</td>
		<td><?= $amount_total ?> <?= Config::get('api.currency') ?></td>
	</tr>
</table>

<div class="form-group pull-right">
	<button class="btn btn-large btn-primary" id="do-transfer">Go to send transfer!</button>
</div>


<div class="clear clearfix"></div>