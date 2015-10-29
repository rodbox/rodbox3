<?php
// src/[Entity].php
/**
 * @Entity @Table(name="userContact")
 **/
class contactEntity
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
	
	/** @Column(type="integer") **/
    private $user1;

    /** @Column(type="integer") **/
    private $user2;
 }
?>