<?php

namespace Damejidlo\Reporting;

use Damejidlo\Reporting\Query\ParameterInterface;
use Damejidlo\Reporting\Query\Query;
use Nette\Object;



class Report extends Object
{

	/**
	 * @var ReportDefinition
	 */
	private $definition;

	/**
	 * @var Query
	 */
	private $query;



	/**
	 * @param ReportDefinition $definition
	 * @param Query $query
	 */
	public function __construct(ReportDefinition $definition, Query $query)
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
	 * @return ReportDefinition
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
