<?php

namespace Damejidlo\Reporting\Query;

interface ParameterInterface
{

	/**
	 * @return string
	 */
	public function getName();



	/**
	 * @return string
	 */
	public function getFormElementName();



	/**
	 * @return int
	 */
	public function getPdoType();



	/**
	 * @return string
	 */
	public function getFormInputRenderType();



	/**
	 * @return string
	 */
	public function getRegexValidationPattern();



	/**
	 * @return string
	 */
	public function getDescription();



	/**
	 * @param string $value
	 */
	public function parseValue($value);



	/**
	 * @return mixed
	 */
	public function getValue();



	/**
	 * @return string
	 */
	public function getFormInputTypeDescription();



	/**
	 * @return string
	 */
	public function getFormInputInvalidMessage();



	/**
	 * @return string
	 */
	public function getFormInputPlaceholder();

}
