<?php

namespace DamejidloTests\Reporting;

require_once __DIR__ . '/../bootstrap.php';

use Damejidlo\Reporting\Query\ParameterFactoryInterface;
use Damejidlo\Reporting\Query\Parser;
use Mockery;
use Mockery\MockInterface;
use Tester\Assert;
use Tester\TestCase;



class ParserTest extends TestCase
{

	/**
	 * @dataProvider getDataForParseTest
	 * @param string $expectedSql
	 * @param array[] $expectedBuildsParameters
	 * @param string $input
	 */
	public function testParseSql($expectedSql, array $expectedBuildsParameters, $input)
	{
		/** @var ParameterFactoryInterface|MockInterface $builderExpectations */
		$builderExpectations = Mockery::mock(ParameterFactoryInterface::class);

		foreach ($expectedBuildsParameters as $expectedBuildParameters) {
			$builderExpectations->shouldReceive('create')->withArgs($expectedBuildParameters)->once();
		}


		$queryParser = new Parser($builderExpectations);
		$parsedQuery = $queryParser->parse($input);
		Assert::equal($parsedQuery->getSql(), $expectedSql);
	}



	public function getDataForParseTest()
	{
		return [
			[
				'id = :fieldName',
				[['fieldName', 'int', 'Field description 1']],
				'id = :fieldName[int]"Field description 1"'
			],
			[
				'id = :fieldName',
				[['fieldName', 'int', '']],
				'id = :fieldName[int]'
			],
			[
				'id1 = :fieldName1 AND id2 = :fieldName2',
				[
					['fieldName1', 'int', 'Field description 1'],
					['fieldName2', 'string', 'Field description 2']
				],
				'id1 = :fieldName1[int]"Field description 1" AND id2 = :fieldName2[string]"Field description 2"'
			],
		];
	}

}



(new ParserTest())->run();
