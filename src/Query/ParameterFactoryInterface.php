<?php

namespace Damejidlo\Reporting\Query;

interface ParameterFactoryInterface
{

	/**
	 * @param string $name
	 * @param string $type
	 * @param string|NULL $description
	 * @return ParameterInterface
	 * @throws InvalidParameterTypeException
	 */
	public function create($name, $type, $description = NULL);

}
