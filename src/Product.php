<?php
// src/User.php
/**
 * @Entity @Table(name="user")
 **/
class User
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $username;

    /** @Column(type="string") **/
    protected $firstname;

    /** @Column(type="string") **/
    protected $lastname;

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