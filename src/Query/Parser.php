<?php

namespace Damejidlo\Reporting\Query;

use Nette\Object;
use Nette\Utils\Strings;



class Parser extends Object
{

	/**
	 * parameter syntax: :name[type]"optional description"
	 */
	const PARAMETER_SYNTAX_REGEX = '#(:(?<name>\w+)\[(?<type>\w+)\]("(?<description>.+?)")?)#';

	/**
	 * @var ParameterFactoryInterface
	 */
	private $queryParameterFactory;



	/**
	 * @param ParameterFactoryInterface $queryParameterFactory
	 */
	public function __construct(ParameterFactoryInterface $queryParameterFactory)
	{
		$this->queryParameterFactory = $queryParameterFactory;
	}



	/**
	 * @param string $query
	 * @return Query
	 * @throws SyntaxErrorException
	 */
	public function parse($query)
	{
		$matches = Strings::matchAll($query, self::PARAMETER_SYNTAX_REGEX);

		$sql = $this->resolveSql($query);

		$parameters = $this->resolveParameters($matches);

		return new Query($sql, $parameters);
	}



	/**
	 * Replace custom parameter syntax with PDO named bind parameters
	 *
	 * @param string $query
	 * @return string
	 */
	private function resolveSql($query)
	{
		// replace with :name for future binding
		$sql = Strings::replace($query, self::PARAMETER_SYNTAX_REGEX, function ($matches) {
			return ':' . $matches['name'];
		});

		return $sql;
	}



	/**
	 * @param array $matches
	 * @return array
	 */
	private function resolveParameters(array $matches)
	{
		$parameters = [];

		foreach ($matches as $match) {
			if (!isset($match['description'])) {
				$match['description'] = NULL;
			}

			$parameter = $this->queryParameterFactory->create($match['name'], $match['type'], $match['description']);
			$parameters[$match['name']] = $parameter;
		}

		return $parameters;
	}

}
