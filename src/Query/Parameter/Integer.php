<?php

namespace Damejidlo\Reporting\Query\Parameter;

use PDO;



class Integer extends AbstractBase
{

	const PDO_TYPE = PDO::PARAM_INT;

	const REGEX_VALIDATION_PATTERN = '\d+';

	const FORM_INPUT_TYPE_DESCRIPTION = 'číslo';

	const FORM_INPUT_INVALID_MESSAGE = 'Hodnota parametru musí být číslo.';

	const FORM_INPUT_PLACEHOLDER = 'Např.: 1000';

	/**
	 * @var int
	 */
	private $value;



	/**
	 * @param string $value
	 * @throws InvalidValueException
	 */
	public function parseValue($value)
	{
		if (!is_numeric($value)) {
			throw new InvalidValueException('Invalid parameter value.');
		}

		$this->value = (integer) $value;
	}



	/**
	 * @return int
	 */
	public function getValue()
	{
		return $this->value;
	}

}
