<?php

namespace Damejidlo\Reporting\Query\Parameter;

use PDO;



class Integer extends AbstractBase
{

	public const PDO_TYPE = PDO::PARAM_INT;

	public const REGEX_VALIDATION_PATTERN = '\d+';

	public const FORM_INPUT_TYPE_DESCRIPTION = 'číslo';

	public const FORM_INPUT_INVALID_MESSAGE = 'Hodnota parametru musí být číslo.';

	public const FORM_INPUT_PLACEHOLDER = 'Např.: 1000';

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

		$this->value = (int) $value;
	}



	/**
	 * @return int
	 */
	public function getValue()
	{
		return $this->value;
	}

}
