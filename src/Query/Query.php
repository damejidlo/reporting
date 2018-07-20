<?php

namespace Damejidlo\Reporting\Query;

use Nette\SmartObject;



class Query
{

	use SmartObject;

	/**
	 * @var string $sql
	 */
	private $sql;

	/**
	 * @var ParameterInterface[] $parameters
	 */
	private $parameters;



	/**
	 * @param string $sql
	 * @param ParameterInterface[] $parameters
	 */
	public function __construct($sql, array $parameters)
	{
		$this->sql = $sql;
		$this->parameters = $parameters;
	}



	/**
	 * @return string
	 */
	public function getSql()
	{
		return $this->sql;
	}



	/**
	 * @return ParameterInterface[]
	 */
	public function getParameters()
	{
		return $this->parameters;
	}



	/**
	 * @return array
	 */
	public function getParameterValues()
	{
		$values = [];

		foreach ($this->parameters as $name => $parameter) {
			$values[$name] = $parameter->getValue();
		}

		return $values;
	}



	/**
	 * @return array
	 */
	public function getParameterTypes()
	{
		$types = [];

		foreach ($this->parameters as $name => $parameter) {
			$types[$name] = $parameter->getPdoType();
		}

		return $types;
	}

}
