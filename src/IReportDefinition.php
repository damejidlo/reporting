<?php
declare(strict_types = 1);

namespace Damejidlo\Reporting;

interface IReportDefinition
{

	/**
	 * @return int
	 */
	public function getId() : int;



	/**
	 * @return string
	 */
	public function getName() : string;



	/**
	 * @return string
	 */
	public function getDescription() : string;



	/**
	 * @return string
	 */
	public function getQuery() : string;

}
