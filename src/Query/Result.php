<?php

namespace Damejidlo\Reporting\Query;

use Nette\SmartObject;



class Result
{

	use SmartObject;

	/**
	 * @var int
	 */
	private $rowCount;

	/**
	 * @var array
	 */
	private $data = [];



	/**
	 * @param int $rowCount
	 * @param array $data
	 */
	public function __construct($rowCount, array $data = [])
	{
		$this->rowCount = $rowCount;
		$this->data = $data;
	}



	/**
	 * @return int
	 */
	public function getRowCount()
	{
		return $this->rowCount;
	}



	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

}
