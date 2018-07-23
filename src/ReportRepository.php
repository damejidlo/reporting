<?php

namespace Damejidlo\Reporting;

use Damejidlo\Reporting\Query\Parser;
use Damejidlo\Reporting\Query\SyntaxErrorException;
use Nette\SmartObject;



class ReportRepository
{

	use SmartObject;

	/**
	 * @var IReportDefinitionFinder
	 */
	private $reportDefinitionFinder;

	/**
	 * @var Parser
	 */
	private $queryParser;



	/**
	 * @param IReportDefinitionFinder $reportDefinitionFinder
	 * @param Parser $queryParser
	 */
	public function __construct(IReportDefinitionFinder $reportDefinitionFinder, Parser $queryParser)
	{
		$this->reportDefinitionFinder = $reportDefinitionFinder;
		$this->queryParser = $queryParser;
	}



	/**
	 * @return mixed[]
	 */
	public function getList()
	{
		$sortBy = ['name' => 'ASC'];
		$definitions = $this->reportDefinitionFinder->findBy([], $sortBy);

		$list = [];

		foreach ($definitions as $definition) {
			$list[$definition->getId()] = $definition->getName();
		}

		return $list;
	}



	/**
	 * @param int $id
	 * @return Report
	 * @throws InvalidReportException
	 * @throws ReportNotFoundException
	 */
	public function get($id)
	{
		$definition = $this->reportDefinitionFinder->find($id);

		if ($definition === NULL) {
			throw new ReportNotFoundException("Report id $id not found.");
		}

		return $this->createReport($definition);
	}



	/**
	 * @param IReportDefinition $definition
	 * @return Report
	 * @throws InvalidReportException
	 */
	private function createReport(IReportDefinition $definition)
	{
		try {
			$query = $this->queryParser->parse($definition->getQuery());
		} catch (SyntaxErrorException $exception) {
			throw new InvalidReportException('Invalid report "' . $definition->getName() . '": ' . $exception->getMessage());
		}

		return new Report($definition, $query);
	}

}
