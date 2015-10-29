<?php
// src/[Entity].php
/**
 * @Entity @Table(name="events")
 **/

use Doctrine\ORM\Mapping as ORM;
class eventEntity
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
	
	/** @Column(type="string") **/
    private $title;

    /** @Column(type="text") **/
    private $description;

    /** @Column(type="datetime") **/
    private $start;

    /** @Column(type="datetime") **/
    private $end;

    /** @Column(type="array") **/
    private $type;
 }
?>