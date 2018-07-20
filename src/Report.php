<?php

namespace Damejidlo\Reporting;

use Damejidlo\Reporting\Query\ParameterInterface;
use Damejidlo\Reporting\Query\Query;
use Nette\SmartObject;



class Report
{

	use SmartObject;

	/**
	 * @var IReportDefinition
	 */
	private $definition;

	/**
	 * @var Query
	 */
	private $query;



	/**
	 * @param IReportDefinition $definition
	 * @param Query $query
	 */
	public function __construct(IReportDefinition $definition, Query $query)
	{
		$this->definition = $definition;
		$this->query = $query;
	}



	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->definition->getId();
	}



	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->definition->getName();
	}



	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->definition->getDescription();
	}



	/**
	 * @return ParameterInterface[]
	 */
	public function getParameters()
	{
		return $this->query->getParameters();
	}



	/**
	 * @return Query
	 */
	public function getQuery()
	{
		return $this->query;
	}



	/**
	 * @return IReportDefinition
	 */
	public function getDefinition()
	{
		return $this->definition;
	}



	/**
	 * @return string
	 */
	public function getDefinitionQuery()
	{
		return $this->definition->getQuery();
	}

}
