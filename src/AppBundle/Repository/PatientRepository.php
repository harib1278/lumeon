<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Patient;

class PatientRepository implements RepositoryInterface
{
	/** @return Patient */
	public function selectById($id)
	{
		// TODO: Implement selectById() method.
	}

	/**
	 * @param \AppBundle\Entity\Hospital $hospital
	 * @return Patient[]
	 */
	public function selectByHospital($hospital){}
}