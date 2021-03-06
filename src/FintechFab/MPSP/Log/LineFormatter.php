<?php

namespace FintechFab\MPSP\Log;

use Monolog\Formatter\LineFormatter as MonologLineFormatter;

class LineFormatter extends MonologLineFormatter
{

	public function format(array $record)
	{

		$format = $this->format;

		if(!empty($record['context'])){


			$this->format = str_replace(
				'%context%',
				print_r($record['context'], true),
				$this->format
			);

		}

		$output = parent::format($record);
		$this->format = $format;

		return $output;

	}

}