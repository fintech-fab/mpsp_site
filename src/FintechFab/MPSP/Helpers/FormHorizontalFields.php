<?php


namespace FintechFab\MPSP\Helpers;


use Form;

class FormHorizontalFields
{

	public static function model($model = null)
	{
		static $thisModel = null;
		if ($model) {
			$thisModel = $model;

			return null;
		} else {
			return $thisModel;
		}

	}

	public static function label($label, $title = null, $size = 5)
	{

		echo Form::label($label, $title, array(
			'class' => 'col-lg-' . $size . ' control-label',
		));

	}

	public static function text($name, $placeholder, $size = 7)
	{

		echo '<div class="col-lg-' . $size . '">';
		echo Form::text($name, null, array(
			'class'       => 'form-control',
			'placeholder' => $placeholder,
		));
		echo '</div>';

	}

	public static function disabled($name, $size = 7)
	{

		echo '<div class="col-lg-' . $size . '">';
		echo Form::text($name, null, array(
			'class'    => 'form-control disabled',
			'disabled' => true,
		));
		echo '</div>';

	}

	public static function hidden($name)
	{
		echo Form::hidden($name);
	}

	public static function dropdownCity($name, $size = 7)
	{

		self::dropdown(
			$name,
			array(
				0 => '- select destination city -',
				1 => 'Moscow',
				2 => 'London',
				3 => 'Kiev',
			),
			$size
		);

	}

	public static function dropdown($name, $list, $size = 7)
	{

		echo '<div class="col-lg-' . $size . '">';
		echo Form::select($name, $list, null, array(
			'class' => 'form-control',
		));
		echo '</div>';

	}

} 