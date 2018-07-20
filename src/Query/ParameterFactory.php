<?php

namespace Damejidlo\Reporting\Query;

use Damejidlo\Reporting\Query\Parameter\DateTime;
use Damejidlo\Reporting\Query\Parameter\Integer;
use Damejidlo\Reporting\Query\Parameter\IntegerArray;
use Damejidlo\Reporting\Query\Parameter\StringParameter;
use Nette\SmartObject;



class ParameterFactory implements ParameterFactoryInterface
{

	use SmartObject;

	private const MAPPING = [
		'integer' => Integer::class,
		'string' => StringParameter::class,
		'datetime' => DateTime::class,
		'integer_array' => IntegerArray::class,
	];



	/**
	 * @param string $name
	 * @param string $type
	 * @param string|NULL $description
	 * @return ParameterInterface
	 * @throws InvalidParameterTypeException
	 */
	public function create($name, $type, $description = NULL)
	{
		$className = $this->getClassName($type);

		if ($className === NULL) {
			$validTypes = array_keys(self::MAPPING);

			throw new InvalidParameterTypeException('Invalid parameter "' . $name . '", type "' . $type . '" not recognized, '
				. 'valid types are: ' . implode(', ', $validTypes));
		}

		return new $className($name, $description);
	}



	/**
	 * @param string $type
	 * @return null
	 */
	private function getClassName($type)
	{
		$mapping = self::MAPPING;

		return isset($mapping[$type]) ? $mapping[$type] : NULL;
	}

}
