<?php


namespace Damejidlo\Reporting;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\Attributes\Identifier;
use Nette\Object;



/**
 * @ORM\Entity()
 * @ORM\Table(name="report_definitions")
 */
class ReportDefinition extends Object
{

	use Identifier;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(type="text", nullable=TRUE)
	 * @var string
	 */
	private $description;

	/**
	 * @ORM\Column(type="text")
	 * @var string
	 */
	private $query;

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}



	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}



	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}



	/**
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}



	/**
	 * @return string
	 */
	public function getQuery()
	{
		return $this->query;
	}



	/**
	 * @param string $query
	 */
	public function setQuery($query)
	{
		$this->query = $query;
	}



	/**
	 * @return array
	 */
	public function toArray()
	{
		return [
			'id' => $this->getId(),
			'name' => $this->name,
			'description' => $this->description,
			'query' => $this->query,
		];
	}

}
