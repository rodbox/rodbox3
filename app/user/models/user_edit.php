<?php
	extract($send);

	$em = $c->getEM();
	$c->getEntity("user","userEntity");
	$user = $em->getRepository("userEntity");

	$qb = $user->createQueryBuilder('a');
	$qb
		->where('a.id = :id')
		->andWhere('a.id = :id')
		->setParameter('id', $id)
	;

	$r = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

	$d = $r[0];
?>