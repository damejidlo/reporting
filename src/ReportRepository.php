<?php

namespace Damejidlo\Reporting;

use Damejidlo\Reporting\Query\Parser;
use Damejidlo\Reporting\Query\SyntaxErrorException;
use Doctrine\ORM\EntityRepository;
use Nette\Object;



class ReportRepository extends Object
{

	/**
	 * @var EntityRepository
	 */
	private $repository;

	/**
	 * @var Parser
	 */
	private $queryParser;



	/**
	 * @param EntityRepository $repository
	 * @param Parser $queryParser
	 */
	public function __construct(EntityRepository $repository, Parser $queryParser)
	{
		$this->repository = $repository;
		$this->queryParser = $queryParser;
	}



	/**
	 * @return array
	 */
	public function getList()
	{
		$sortBy = ['name' => 'ASC'];
		$definitions = $this->repository->findBy([], $sortBy);

		$list = [];

		foreach ($definitions as $definition) {
			$list[$definition->id] = $definition->name;
		}

		return $list;
	}



	/**
	 * @param $id
	 * @return Report
	 * @throws InvalidReportException
	 * @throws ReportNotFoundException
	 */
	public function find($id)
	{
		$definition = $this->repository->find($id);

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
