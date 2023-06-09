<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{

    public function __construct(){
        $session = \Config\Services::session();
        helper("utilidades");
    }

    public function index()
    {
        $datos_dinamicos = [
            'title' => 'AIG - Login'
        ];

        return view('login',$datos_dinamicos);
    }

    public function loginweb(){

        $usuario = $_POST['usuario'];
        $pass = $_POST['password'];

        $passencrypt = Encrypt($pass);

        //echo (Decrypt(utf8_decode( 'ÀÆØÐÚFb^`pÊèäÀÐ')));

        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM USUARIO WHERE USUARIO='".$usuario."' AND CLAVE='".$passencrypt."'");

        $resultado = $query->getNumRows();

        $datos = $query->getResult();
        
        if($resultado>0){

            $session = \Config\Services::session();

            $this->response->setStatusCode(200,'Autorizado'); 
            //redirect(base_url() . 'Home/');
            //return view('dashboard');

            $newdata = [
                'usuarioid' => $datos[0]->USUARIOID,
                'usuario'  => $datos[0]->USUARIO,
                'token'=>otorgarToken(),
                'logged_in' => true
            ];
            
            $session->set($newdata);
            
            return redirect()->to(site_url('Home'));
        }else{
            //$this->response->setStatusCode(401,'No autorizado');
            //return view('404');

            $datos_dinamicos = [
                'title' => 'AIG - Login'
            ];

            echo view('login',$datos_dinamicos);
            echo "<script> badlogin(); </script>";
        }

    }

    public function Encriptar($cadena){
        helper('utilidades');

        return Encrypt($cadena);
    }

    public function Desencriptar($cadena){
        helper('utilidades');

        $sSoftware = strtolower( $_SERVER["SERVER_SOFTWARE"] );
        if ( strpos($sSoftware, "microsoft-iis") !== false )
            //si el servidor es IIS
            return Decrypt($cadena);
        else
            //si el servidor es Apache
            return Decrypt(utf8_decode($cadena));

        /*$resultado = array(
            'Apache'=>Decrypt(utf8_decode($cadena)),
            'IIS'=>Decrypt($cadena)
        );*/
        
        //return $this->response->setJSON($resultado);
    }
}