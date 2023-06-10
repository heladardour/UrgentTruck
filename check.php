<?php

session_start();

//require('./inc/connect.php');

if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 

       $secret = '6LfAnuwkAAAAANXz_4jjC9tDQPWp-GGqEawNezTQ';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response'].'&remoteip='.$_SERVER["REMOTE_ADDR"]);
        
        $responseData = json_decode($verifyResponse); 
		
        if($responseData->success){
		//	if(1==1){

$username = trim($_POST["login"]);
//$password = md5($_POST["password"]);
$password = $_POST["password"];

//$query = $db->query("Select * from direction_regionale where login_drs = '$username' and password_drs ='$password' ");
//$query = "Select * from dep_direction_regionale where login_drs = '$username' and password_drs ='$password'  ";

 /*$query = "Select LOGIN,DEP_UTILISATEUR.COD_DRS,TYPE_ETAB,NVL(COD_ETAB,0) COD_ETAB,NOM_GOUV
 from DEP_UTILISATEUR,DEP_GOUVERNORAT
 where LOGIN = '".$username."' and PWD ='".$password."' and ETAT_USER='A'
 and DEP_UTILISATEUR.COD_DRS=DEP_GOUVERNORAT.COD_DRS " ;
 $result = oci_parse($db, $query);  
 oci_execute($result);
        $numrows = oci_fetch_all($result, $res);*/
        if(( $username=='admin') && ($password=='pmacims2022*' )  )
        {  
			$_SESSION['isLogged_PMA'] = true;
			$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
			//$_SESSION["cod_drs"] = "11";
			//$_SESSION["username"] = "test";
			//$_SESSION["code_etab"]=1;
			$_SESSION["type"]  = "Admin";
			header("Location: index.php");
		}
		else 
		{
			$_SESSION["error"] = "Nom d'utilisateur / mot de passe incorrect";
			header("location: login.php"); 
		}
		
		}
		
		
		}

else 
	
	{
		echo 'erreur captha';
		header("location: login.php"); 
	}
