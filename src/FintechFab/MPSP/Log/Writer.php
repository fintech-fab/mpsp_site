<?php


namespace FintechFab\MPSP\Log;


use Illuminate\Log\Writer as BaseWriter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;

class Writer extends BaseWriter{

	/**
	 * Register a file log handler.
	 *
	 * @param  string  $path
	 * @param  string  $level
	 * @return void
	 */
	public function useFiles($path, $level = 'debug')
	{
		$level = $this->parseLevel($level);

		$this->monolog->pushHandler($handler = new StreamHandler($path, $level));

		$handler->setFormatter(new LineFormatter(null, null, true));
	}

	/**
	 * Register a daily file log handler.
	 *
	 * @param  string  $path
	 * @param  int     $days
	 * @param  string  $level
	 * @return void
	 */
	public function useDailyFiles($path, $days = 0, $level = 'debug')
	{
		$level = $this->parseLevel($level);

		$this->monolog->pushHandler($handler = new RotatingFileHandler($path, $days, $level));

		$handler->setFormatter(new LineFormatter(null, null, true));
	}

}