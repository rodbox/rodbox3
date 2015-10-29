<?php 
/**
* userController
*/
class userController extends controller
{
	
	function __construct(){
		# code...
	}

	function userAdd(){
		        $em = $this
            ->getDoctrine()
            ->getManager();
       

            $user = new User;
	}



	function evalUser(){
		return isset($_SESSION["user"]);
	}


/*
*
*
*** SERVICES ***
*
* 
*/


	function userMenu(){
		if($this->evalUser())
			$this->view("user","userMenu_connected");
		else
			$this->view("user","userMenu_disconnected");
	}


	function userIdentity($send){
		$this->view("user","user_identity","user_edit",$send);
	}

	function userContact($send){
		$this->view("user","user_bt_contact","",$send);
	}

	function userFriend($d){
		if (isset($_SESSION["user"]["contact"]) && in_array($d['id'],$_SESSION["user"]["contact"])){
			$this->routeExec("user_exec_removeContact",'<i class="fa fa-check-circle "></i>',["id"=>$d["id"]],["class"=>" applivebt"]);
		}
		else
			$this->routeExec("user_exec_addContact",'<i class="icomoon-plus2 "></i>',["id"=>$d["id"]],["class"=>" applivebt"]);
	}

	function userImg($send,$class=""){
		$dirImg = DIR_USERS.'/'.$send["id"].'/log.jpg';
		$webImg = WEB_USERS.'/'.$send["id"].'/log.jpg';

		if (file_exists($dirImg)) {
			echo '<div id="user-'.$send["id"].'" style="background-image: url('.$webImg.');" class="'.$class.' user-img radius "></div>';
		}
	}

	function userExist($User){
		$em = $this->getEM();
		$this->getEntity("user","userEntity");
		$user = $em->getRepository("userEntity");
		$count = count($user
			->findBy(array('User' => $User))
		);

		return ($count>0)?true:false;
	}

	function userMailExist($UserMail){
		$em = $this->getEM();
		$this->getEntity("user","userEntity");
		$user = $em->getRepository("userEntity");
		$count = count($user
			->findBy(array('UserMail' => $UserMail))
		);
		return ($count>0)?true:false;
	}

	function userLogin($User,$UserPassword){
		$em = $this->getEM();
		$this->getEntity("user","userEntity");
		$user = $em->getRepository("userEntity");

		$qb = $user->createQueryBuilder('a');

		$qb
			->where('a.User = :User')
			->andWhere('a.UserPassword = :UserPassword')
			->setParameter('User', $User["user"])
			->setParameter('UserPassword', md5($User["pw"]))
		;

		$r = $qb->getQuery()->getResult();

		$count = count($r);
		if($count==1){
			$userLogin = [
				"id" 		=> $r[0]->getId(),
				"User" 		=> $r[0]->getUser(),
				"UserRole" 	=> $r[0]->getUserRole()
			];

			$_SESSION["user"]["username"] 	= $userLogin["User"];
			$_SESSION["user"]["id"] 		= $userLogin["id"];
			$_SESSION["user"]["role"] 		= $userLogin["UserRole"];
			$_SESSION["user"]["lang"] 		= $r[0]->getUserLang();
			$_SESSION["user"]["contact"]	= $r[0]->getUserContact();
		}

		return ($count==1)?["eval"=>true,"user"=>$r]:["eval"=>false,"count"=>$count];
	}

	function formSetRole($id,$formSetRole){
		$this->view("user","formSetRole","",["id"=>$id,"role"=>$formSetRole]);
	}
	function roleList($formSetRole){
		$roleList = ["FREE","USER","EDITOR","GRAPH","ADMIN","MASTER"];
		
		foreach ($roleList as $key => $value) {
			# code...
		}

	}
	function contactList(){
		$em = $this->getEM();
		$id = 1;
		$this->getEntity("user","userEntity");
		$user = $em->getRepository("userEntity");

		$qb = $user->createQueryBuilder('a');

		$list = $_SESSION["user"]["contact"];

		$qb
			->where('a.id IN (:id)')
			->setParameter('id', $list)
		;

		$r = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

		$this->view("user","contact-list","",$r);

	}
	function userSkype($data){
		echo'<a class="btn btn-xs bg-9 c-7"><i class="fa fa-skype "></i></a>';
	}
}
 ?>