<?php
declare(strict_types = 1);

namespace Damejidlo\Reporting;

interface IReportDefinitionFinder
{

	/**
	 * @param int $id
	 * @return IReportDefinition|NULL
	 */
	public function find(int $id);



	/**
	 * @param array $criteria
	 * @param array|NULL $orderBy
	 * @return IReportDefinition[]
	 */
	public function findBy(array $criteria, array $orderBy = NULL) : array;

}
