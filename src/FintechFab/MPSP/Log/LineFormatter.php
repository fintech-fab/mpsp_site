<?php

namespace FintechFab\MPSP\Log;

use Monolog\Formatter\LineFormatter as MonologLineFormatter;

class LineFormatter extends MonologLineFormatter
{

	public function format(array $record)
	{

		if(!empty($record['context'])){

			$this->format = str_replace(
				'%context%',
				print_r($record['context'], true),
				$this->format
			);

		}

		$output = parent::format($record);

		$output = "\n\n" . $output . "\n\n" . $this->elephant();

		return $output;

	}

	private function elephant()
	{

		return "\n\n##,............,#**#,.,#**#,,
.##.... .....,,#####..........#
..##....,#.... ......#....//....#
...###*.....#...... ....((.......#
....'''#................ ........#
.......''#......#............ ..#
..........''##;........#.....#,
.............#........\"##\"..#,
............#................ . .#,
............#.....#......... .. ...#
............#.....#..... ...... ...#,
............#.....#... ........ ....#
............#######......###### #####\n\n\n";

	}

}