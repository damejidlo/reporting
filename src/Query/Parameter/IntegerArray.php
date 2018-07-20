<?php

namespace Damejidlo\Reporting\Query\Parameter;

use Doctrine\DBAL\Connection;



class IntegerArray extends AbstractBase
{

	public const PDO_TYPE = Connection::PARAM_INT_ARRAY;

	public const REGEX_VALIDATION_PATTERN = ' *(\d+ *)(, *\d+ *)*';

	public const FORM_INPUT_TYPE_DESCRIPTION = 'pole čísel oddělených čárkou';

	public const FORM_INPUT_INVALID_MESSAGE = 'Hodnota parametru musí být pole čísel oddělených čárkou.';

	public const FORM_INPUT_PLACEHOLDER = 'Např.: 1, 2, 3';

	/**
	 * @var int[]
	 */
	private $value;



	/**
	 * @param string $value
	 * @throws InvalidValueException
	 */
	public function parseValue($value)
	{
		if (!is_string($value) || !$this->regexValidateValue($value)) {
			throw new InvalidValueException('Invalid parameter value.');
		}

		$this->value = $this->parseIntegerArray($value);
	}



	/**
	 * @param $string
	 * @return int[]
	 */
	private function parseIntegerArray($string)
	{
		$array = explode(',', $string);

		return array_map(function ($value) {
			return (int) trim($value);
		}, $array);
	}



	/**
	 * @return int[]
	 */
	public function getValue()
	{
		return $this->value;
	}

}
