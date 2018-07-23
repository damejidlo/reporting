<?php
declare(strict_types = 1);

namespace Damejidlo\Reporting;

use Damejidlo\Reporting\Query\InvalidParameterValueException;
use Damejidlo\Reporting\Query\ParameterNotSetException;
use Damejidlo\Reporting\Query\Result;
use Damejidlo\Reporting\Query\Runner;
use Damejidlo\Reporting\Query\SyntaxErrorException;
use Nette\SmartObject;



class ReportingFacade
{

	use SmartObject;

	/**
	 * @var ReportRepository
	 */
	private $reportRepository;

	/**
	 * @var Runner
	 */
	private $runner;



	/**
	 * @param ReportRepository $reportRepository
	 * @param Runner $runner
	 */
	public function __construct(ReportRepository $reportRepository, Runner $runner)
	{
		$this->reportRepository = $reportRepository;
		$this->runner = $runner;
	}



	/**
	 * @return string[] (id) => (reportName)
	 */
	public function getListOfReports() : array
	{
		return $this->reportRepository->getList();
	}



	/**
	 * @param int $id
	 * @return Report
	 * @throws InvalidReportException
	 * @throws ReportNotFoundException
	 */
	public function getReport(int $id) : Report
	{
		return $this->reportRepository->get($id);
	}



	/**
	 * @param Report $report
	 * @param mixed[] $parameterValues
	 * @return Result
	 * @throws InvalidParameterValueException
	 * @throws ParameterNotSetException
	 * @throws SyntaxErrorException
	 */
	public function runReport(Report $report, array $parameterValues) : Result
	{
		$query = $report->getQuery();

		return $this->runner->run($query, $parameterValues);
	}

}
