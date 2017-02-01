<?php

namespace AppBundle\Entity;


class Hospital
{
	private $id;

	private $name;

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 * @return Hospital
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 * @return Hospital
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

}