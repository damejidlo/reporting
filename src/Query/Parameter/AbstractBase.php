<?php

namespace Damejidlo\Reporting\Query\Parameter;

use Damejidlo\Reporting\Query\ParameterInterface;
use Nette\SmartObject;



/**
 * @package Damejidlo\Reporting
 */
abstract class AbstractBase implements ParameterInterface
{

	use SmartObject;

	public const FORM_ELEMENT_NAME_PREFIX = 'parameter_';

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string|NULL
	 */
	private $description = NULL;



	/**
	 * @param string $name
	 * @param string|NULL $description
	 */
	public function __construct($name, $description = NULL)
	{
		$this->name = $name;
		$this->description = $description;
	}



	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}



	/**
	 * @return string
	 */
	public function getFormElementName()
	{
		return self::FORM_ELEMENT_NAME_PREFIX . $this->name;
	}



	/**
	 * @return int
	 */
	public function getPdoType()
	{
		return static::PDO_TYPE;
	}



	/**
	 * @return string
	 */
	public function getFormInputRenderType()
	{
		return 'standard';
	}



	/**
	 * @return string
	 */
	public function getRegexValidationPattern()
	{
		return static::REGEX_VALIDATION_PATTERN;
	}



	/**
	 * @return string|NULL
	 */
	public function getDescription()
	{
		return $this->description;
	}



	/**
	 * @return string
	 */
	public function getFormInputTypeDescription()
	{
		return static::FORM_INPUT_TYPE_DESCRIPTION;
	}



	/**
	 * @return string
	 */
	public function getFormInputInvalidMessage()
	{
		return static::FORM_INPUT_INVALID_MESSAGE;
	}



	/**
	 * @return string
	 */
	public function getFormInputPlaceholder()
	{
		return static::FORM_INPUT_PLACEHOLDER;
	}



	/**
	 * @param string $value
	 * @return bool
	 */
	protected function regexValidateValue($value)
	{
		return preg_match('#^' . static::REGEX_VALIDATION_PATTERN . '$#', $value);
	}

}
