<?php

namespace Damejidlo\Reporting\Query;

use Damejidlo\Reporting\Query\Parameter\InvalidValueException;
use Doctrine\DBAL\DBALException as DoctrineDBALException;
use Kdyby\Doctrine\Connection;
use Kdyby\Doctrine\DBALException as KdybyDBALException;
use Nette\Object;



class Runner extends Object
{

	/**
	 * @var Connection
	 */
	private $connection;



	/**
	 * @param Connection $connection
	 */
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}



	/**
	 * @param Query $query $query
	 * @param array $parameterValues
	 * @return Result
	 * @throws InvalidParameterValueException
	 * @throws ParameterNotSetException
	 * @throws SyntaxErrorException
	 */
	public function run(Query $query, array $parameterValues)
	{
		foreach ($query->getParameters() as $parameter) {
			$name = $parameter->getName();

			if (!isset($parameterValues[$parameter->getFormElementName()])) {
				throw new ParameterNotSetException('Parameter "' . $name . '" not set.');
			}

			try {
				$parameter->parseValue($parameterValues[$parameter->getFormElementName()]);
			} catch (InvalidValueException $exception) {
				throw new InvalidParameterValueException("Parameter $name: " . $exception->getMessage());
			}
		}

		try {
			$statement = $this->connection->executeQuery($query->getSql(), $query->getParameterValues(), $query->getParameterTypes());
		} catch (DoctrineDBALException $exception) {
			throw new SyntaxErrorException('Query could not run: ' . $exception->getMessage());
		} catch (KdybyDBALException $exception) {
			throw new SyntaxErrorException('Query could not run: ' . $exception->getMessage());
		}

		if ($statement->columnCount() == 0) {
			return new Result($statement->rowCount(), []);
		}

		return new Result($statement->rowCount(), $statement->fetchAll());
	}

}
