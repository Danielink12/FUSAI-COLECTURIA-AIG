<?php

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\I18n\Time;




function Encrypt($cadena){

    $des="";

    for ($x=0; $x < strlen($cadena) ; $x++) { 
        # code...
        $Letr=substr($cadena,$x,1);
        $des=$des . chr((ord($Letr)-1)*2);
    }
    return utf8_encode ($des);
}

function Decrypt($cadena){

    $des="";

    for ($x=0; $x < strlen($cadena) ; $x++) { 
        # code...
        $Letr=substr($cadena,$x,1);
        $des=$des . chr((ord($Letr)/2)+1);
    }
    return $des;
}

function otorgarToken(){
    $now = Time::now();
    $exp = new Time('+60 minutes');
    $key = \Config\Services::getSecretKey();

	$payload = [
		'aud' => 'http://FPH.com',
        'iss' => 'Daniel Alas',
		'iat' => $now->getTimestamp(),
		'nbf' => $now->getTimestamp(),
        //'exp' => $exp->getTimestamp()
	];
            
    //$jwt = JWT::encode($payload, $key.$now->getDay(),'HS256');
    $jwt = JWT::encode($payload, $key,'HS256');

    //$token = JWT::decode($jwt, new Key($key,'HS256'));

    return $jwt;
}

function validarToken($req){
    $key = \Config\Services::getSecretKey();
    $now = Time::now();
    $header = $req;
    $token = preg_split('/[\s]+/',$header);
    //$datajwt = JWT::decode($token[1], new Key($key.$now->getDay(),'HS256'));
    $datajwt = JWT::decode($token[1], new Key($key,'HS256'));
    return json_encode($datajwt);
}

function decodeToken($token){
    $key = \Config\Services::getSecretKey();
    $now = Time::now();
    //$decode = JWT::decode($token, new Key($key.$now->getDay(),'HS256'));
    $decode = JWT::decode($token, new Key($key,'HS256'));
    return $decode;
}

function cerrarSesion(){
    $session = session();
    $array_items = ['usuario', 'token','logged_in','nombre','tipousuarioid','usuarioid'];
    $session->remove($array_items);
    //unset($this->$session);
    return redirect()->to(site_url('Home'));
}

?>