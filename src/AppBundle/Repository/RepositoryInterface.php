<?php

namespace AppBundle\Repository;

interface RepositoryInterface{
	// Returns an entity of the appropriate type
	public function selectById($id);
}