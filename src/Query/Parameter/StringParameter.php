<?php

namespace Damejidlo\Reporting\Query\Parameter;

use PDO;



class StringParameter extends AbstractBase
{

	public const PDO_TYPE = PDO::PARAM_INT;

	public const REGEX_VALIDATION_PATTERN = '.+';

	public const FORM_INPUT_TYPE_DESCRIPTION = 'řetězec';

	public const FORM_INPUT_INVALID_MESSAGE = 'Hodnota parametru musí být řetězec.';

	public const FORM_INPUT_PLACEHOLDER = 'Např.: DámeJídlo';

	/**
	 * @var string
	 */
	private $value;



	/**
	 * @param string $value
	 * @throws InvalidValueException
	 */
	public function parseValue($value)
	{
		if (!is_string($value)) {
			throw new InvalidValueException('Invalid parameter value.');
		}

		$this->value = (string) $value;
	}



	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

}
