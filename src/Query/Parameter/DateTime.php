<?php

namespace Damejidlo\Reporting\Query\Parameter;

use Nette\Utils\DateTime as NetteDateTime;



class DateTime extends AbstractBase
{

	public const PDO_TYPE = 'datetime';

	public const REGEX_VALIDATION_PATTERN = '\d{1,2}\. \d{1,2}\. \d{4} \d{1,2}:\d{2}:\d{2}';

	public const FORM_INPUT_TYPE_DESCRIPTION = 'datum a čas';

	public const FORM_INPUT_INVALID_MESSAGE = 'Hodnota parametru musí být datum a čas.';

	public const FORM_INPUT_PLACEHOLDER = 'Např.: 1. 12. 2015 16:00:00';

	/**
	 * @var NetteDateTime
	 */
	private $value;



	/**
	 * @param string $value
	 * @throws InvalidValueException
	 */
	public function parseValue($value)
	{
		$dateTime = NetteDateTime::createFromFormat('d. m. Y H:i:s', $value);

		if ($dateTime === FALSE) {
			throw new InvalidValueException('Invalid parameter value.');
		}

		$this->value = $dateTime;
	}



	/**
	 * @return NetteDateTime
	 */
	public function getValue()
	{
		return $this->value;
	}



	/**
	 * @return string
	 */
	public function getFormInputRenderType()
	{
		return 'datetime';
	}

}
