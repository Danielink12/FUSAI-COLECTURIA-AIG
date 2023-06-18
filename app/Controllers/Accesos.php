<?php

namespace App\Controllers;

class Accesos extends BaseController
{

    public function __construct(){
        //$this->$db = \Config\Database::connect('PCSC');
        helper("utilidades");
    }

    public function index()
    {

        $session = session();

        try {
            decodeToken($session->token);
        } catch (\Throwable $th) {
            cerrarSesion();
        }

        if(isset($session->usuario)){
        
            $db = \Config\Database::connect();

            $tipousuarios = $db->query("SELECT * FROM TIPOUSUARIO");
            $usuarios = $db->query("SELECT * FROM USUARIO");
            $accesos = $db->query("SELECT * FROM MENU");

            $datos_dinamicos = [
                'title' => 'AIG - Accesos',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'accesos',
                'tipousuarios' => $tipousuarios,
                'usuarios' => $usuarios,
                'accesos' => $accesos
                //'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }
}