<?php
 
namespace DamejidloTests\Reporting;

require_once __DIR__ . '/../bootstrap.php';

use Damejidlo\Reporting\Query\InvalidParameterTypeException;
use Damejidlo\Reporting\Query\ParameterFactory;
use Tester\Assert;
use Tester\TestCase;



class ParameterFactoryTest extends TestCase
{

	protected $factory;



	protected function setUp()
	{
		$this->factory = new ParameterFactory();
	}



	public function testThrowsExceptionOnInvalidType()
	{
		$factory = new ParameterFactory();

		Assert::exception(function() use ($factory) {
			$factory->create('name', 'invalid_type');
		}, InvalidParameterTypeException::class);
	}

}

(new ParameterFactoryTest())->run();
