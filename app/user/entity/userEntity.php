<?php

use Doctrine\ORM\Mapping as ORM;


/**
 * @Entity @Table(name="user")
 **/
class userEntity
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $User;
    /** @Column(type="string") **/
    protected $UserPassword;

    /** @Column(type="string") **/
    protected $UserCiv;
    /** @Column(type="string") **/
    protected $UserLastname;
    /** @Column(type="string") **/
    protected $UserFirstname;
    /** @Column(type="string") **/
    protected $UserMail;

    /** @Column(type="string") **/
    protected $UserRole;

    /** @Column(type="datetime") **/
    protected $UserDateCrea;

    /** @Column(type="datetime") **/
    protected $UserDateLastConnect;

    /** @Column(type="datetime") **/
    protected $UserDateUpd;

    /** @Column(type="string") **/
    protected $UserLang;

    /** @Column(type="string", nullable=true) **/
    protected $UserTel;

    /** @Column(type="string", nullable=true) **/
    protected $UserSkype;


    /** @Column(type="string", nullable=true) **/
    protected $UserFacebook;

    /** @Column(type="string", nullable=true) **/
    protected $UserPinterest;

    /** @Column(type="datetime", nullable=true) **/
    protected $UserDateBorn;

    /** @Column(type="text", nullable=true) **/
    protected $UserContact;




    function __construct(){

    }


/* Get */
    public function getId()
    {
        return $this->id;
    }

    public function getUser(){
        return $this->User;
    }


    public function getUserPassword(){
        return $this->UserPassword;
    }


    public function getUserCiv(){
        return $this->UserCiv;
    }

    public function getUserLastname(){
        return $this->UserLastname;
    }

    public function getUserFirstname(){
        return $this->UserFirstname;
    }

    public function getUserMail(){
        return $this->UserMail;
    }

    public function getUserDateCrea(){
        return $this->UserDateCrea;
    }

    public function getUserDateLastConnect(){
        return $this->UserDateLastConnect;
    }
    public function getUserDateUpd(){
        return $this->getUserDateUpd;
    }
    public function getUserRole(){
        return $this->UserRole;
    }

    public function getUserTel(){
        return $this->UserTel;
    }

    public function getUserSkype(){
        return $this->UserSkype;
    }
    public function getUserFacebook(){
        return $this->UserFacebook;
    }
    public function getUserTwitter(){
        return $this->UserTwitter;
    }

    public function getUserPinterest(){
        return $this->UserPinterest;
    }

    public function getUserDateBorn(){
        return $this->UserDateBorn;
    }
    
    public function getUserLang(){
        return json_decode($this->UserLang,true);
    }

    public function getUserContact(){
        return json_decode($this->UserContact);
    }

/* End Get */

/* Set */
    
    public function setUser($User){
        $this->User = $User;
    }

    public function setUserPassword($UserPassword){
        $this->UserPassword = md5($UserPassword);
    }


    public function setUserCiv($UserCiv){
        $this->UserCiv = $UserCiv;
    }
    public function setUserLastname($UserLastname){
        $this->UserLastname = $UserLastname;
    }
    public function setUserFirstname($UserFirstname){
        $this->UserFirstname = $UserFirstname;
    }

    public function setUserMail($UserMail){
        $this->UserMail = $UserMail;
    }

    public function setUserDateCrea($UserDateCrea){
        $this->UserDateCrea = $UserDateCrea;
    }
    public function setUserDateUpd($UserDateUpd){
        $this->UserDateUpd = $UserDateUpd;
    }

    public function setUserDateLastConnect($UserDateLastConnect){
        $this->UserDateLastConnect = $UserDateLastConnect;
    }
    public function setUserRole($UserRole){
        $this->UserRole = $UserRole;
    }

    public function setUserTel($UserTel){
        $this->UserTel = $UserTel;
    }

    public function setUserSkype($UserSkype){
        $this->UserSkype = $UserSkype;
    }
    
    public function setUserFacebook($UserFacebook){
        $this->UserFacebook = $UserFacebook;
    }
    public function setUserTwitter($UserTwitter){
        $this->UserTwitter = $UserTwitter;
    }

    public function setUserPinterest($UserPinterest){
        $this->UserPinterest = $UserPinterest;
    }


    public function setUserDateBorn($UserDateBorn){
        $this->UserDateBorn = $UserDateBorn;
    }
    
    public function setUserLang($UserLang){
        $this->UserLang = json_encode($UserLang);
    }

    public function setUserContact($UserContact){
        $this->UserContact = json_encode($UserContact);
    }


/* End Set */


}