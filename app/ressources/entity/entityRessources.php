<?php
// src/User.php
/**
 * @Entity @Table(name="ressources")
 **/
class Ressources
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $many;

    /** @Column(type="datetime") **/
    protected $date;


    /** @Column(type="text") **/
    protected $description;


    /** @Column(type="integer") **/
    protected $projectID;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}