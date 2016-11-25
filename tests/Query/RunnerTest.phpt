<?php

namespace DamejidloTests\Reporting\Query;

require_once __DIR__ . '/../bootstrap.php';

use Damejidlo\Reporting\Query\InvalidParameterValueException;
use Damejidlo\Reporting\Query\Parameter\InvalidValueException;
use Damejidlo\Reporting\Query\ParameterInterface;
use Damejidlo\Reporting\Query\ParameterNotSetException;
use Damejidlo\Reporting\Query\Query;
use Damejidlo\Reporting\Query\Runner;
use Damejidlo\Reporting\Query\SyntaxErrorException;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Connection;
use Mockery;
use Mockery\MockInterface;
use Tester\Assert;
use Tester\TestCase;



class RunnerTest extends TestCase
{

	public function testThrowsParameterNotSetException()
	{
		Assert::exception(function() {
			$runner = new Runner($this->getConnectionMock());
			$runner->run($this->getQueryMock([$this->getParameterMock()]), []);
		}, ParameterNotSetException::class);
	}



	public function testThrowsInvalidParameterValueException()
	{
		Assert::exception(function() {
			$runner = new Runner($this->getConnectionMock());
			$runner->run($this->getQueryMock([$this->getParameterMockThrowingException()]), ['parameter_name' => 42]);
		}, InvalidParameterValueException::class);
	}



	public function testThrowsSyntaxErrorException()
	{
		Assert::exception(function() {
			$runner = new Runner($this->getConnectionMockThrowingException());
			$runner->run($this->getQueryMock([$this->getParameterMock()]), ['parameter_name' => 42]);
		}, SyntaxErrorException::class);
	}



	/**
	 * @return Connection|MockInterface
	 */
	public function getConnectionMock()
	{
		return Mockery::mock(Connection::class);
	}



	/**
	 * @return Connection|MockInterface
	 */
	public function getConnectionMockThrowingException()
	{
		return $this->getConnectionMock()
			->shouldReceive('executeQuery')->andThrow(DBALException::class)->getMock();
	}



	/**
	 * @param array $parameters
	 * @return Query|MockInterface
	 */
	public function getQueryMock(array $parameters)
	{
		return Mockery::mock(Query::class)
			->shouldReceive('getParameters')->andReturn($parameters)->getMock()
			->shouldReceive('getSql')->getMock()
			->shouldReceive('getParameterTypes')->getMock()
			->shouldReceive('getParameterValues')->andReturn([])->getMock();
	}



	/**
	 * @return ParameterInterface|MockInterface
	 */
	public function getParameterMock()
	{
		return Mockery::mock(ParameterInterface::class)
			->shouldReceive('getName')->andReturn('name')->getMock()
			->shouldReceive('parseValue')->getMock()
			->shouldReceive('getFormElementName')->andReturn('parameter_name')->getMock();
	}



	/**
	 * @return ParameterInterface|MockInterface
	 */
	public function getParameterMockThrowingException()
	{
		return Mockery::mock(ParameterInterface::class)
			->shouldReceive('getName')->andReturn('name')->getMock()
			->shouldReceive('parseValue')->andThrow(InvalidValueException::class)->getMock()
			->shouldReceive('getFormElementName')->andReturn('parameter_name')->getMock();
	}

}

(new RunnerTest())->run();
