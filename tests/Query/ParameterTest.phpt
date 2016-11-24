<?php

namespace DamejidloTests\Reporting;

require_once __DIR__ . '/../bootstrap.php';

use Damejidlo\Reporting\Query\Parameter\DateTime;
use Damejidlo\Reporting\Query\Parameter\Integer;
use Damejidlo\Reporting\Query\Parameter\IntegerArray;
use Damejidlo\Reporting\Query\Parameter\InvalidValueException;
use Damejidlo\Reporting\Query\Parameter\StringParameter;
use Nette\Utils\DateTime as NetteDateTime;
use Tester\Assert;
use Tester\TestCase;



class ParameterTest extends TestCase
{

	/**
	 * @dataProvider getValidDataForParseValueTest
	 * @param mixed $expectedParsedValue
	 * @param string $class
	 * @param string $value
	 */
	public function testParseValidValue($expectedParsedValue, $class, $value)
	{
		$parameter = new $class('parameterName');
		$parameter->parseValue($value);

		Assert::equal($expectedParsedValue, $parameter->getValue());
	}



	public function getValidDataForParseValueTest()
	{
		return [
			[
				NetteDateTime::createFromFormat('d. m. Y H:i:s', '1. 12. 2015 16:00:00'),
				DateTime::class,
				'1. 12. 2015 16:00:00',
			],
			[
				42,
				Integer::class,
				'42',
			],
			[
				[1, 2, 42],
				IntegerArray::class,
				'1, 2, 42',
			],
			[
				'damejidlo',
				StringParameter::class,
				'damejidlo',
			],
		];
	}



	/**
	 * @dataProvider getInvalidDataForParseValueTest
	 * @param string $class
	 * @param string $value
	 */
	public function testParseInvalidValue($class, $value)
	{
		Assert::exception(function() use ($class, $value) {
			$parameter = new $class('parameterName');
			$parameter->parseValue($value);
		}, InvalidValueException::class);
	}



	public function getInvalidDataForParseValueTest()
	{
		return [
			[
				DateTime::class,
				'2015-12-01',
			],
			[
				Integer::class,
				'damejidlo',
			],
			[
				IntegerArray::class,
				'1; 2; 42',
			],
		];
	}

}

(new ParameterTest())->run();
