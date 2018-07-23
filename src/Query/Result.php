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
	 * @var mixed[]
	 */
	private $data = [];



	/**
	 * @param int $rowCount
	 * @param mixed[] $data
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
	 * @return mixed[]
	 */
	public function getData()
	{
		return $this->data;
	}

}
