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
            //$accesos = $db->query("SELECT * FROM MENU");

            $datos_dinamicos = [
                'title' => 'AIG - Accesos',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'accesos',
                'tipousuarios' => $tipousuarios,
                'usuarios' => $usuarios,
                'tipousuarioid' => NULL,
                'usuarioid' => NULL,
                'axtu' => NULL,
                'axu' => NULL,
                'accesos' => NULL,
                'urlpost' => 'Accesos/setAcceso'
                //'data' => $table->generate()
            ];
            
            return view('dashboard',$datos_dinamicos);
            
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    public function setAcceso(){

        $tipousuarioid = $_POST['tipousuarioid'];
        $usuarioid = $_POST['usuarioid'];

        if(isset($_POST['ck1'])){
            
            $db = \Config\Database::connect();
            $conteo = $db->query("SELECT * FROM MENU");
            for ($i=1; $i <= $conteo->getNumRows(); $i++) { 
                //echo $_POST['ck'.$i.''];
                if(isset($_POST['ck'.$i])){

                    echo 'variable: '.$_POST['ck'.$i];
                }
            }

        }else{

        if($tipousuarioid>0){

            return $this->getAcceso($tipousuarioid,$usuarioid);

        }else{
            return $this->index();
        }
        }

    }

    public function getAcceso($tipousuarioid,$usuarioid){

        $db = \Config\Database::connect();

            $tipousuarios = $db->query("SELECT * FROM TIPOUSUARIO");
            $usuarios = $db->query("SELECT * FROM USUARIO WHERE TIPOUSUARIOID=".$tipousuarioid);
            $accesos = $db->query("SELECT * FROM MENU");
            $axtu=NULL;
            $axu=NULL;

            if($tipousuarioid>0){
                
                $axtu = $db->query("SELECT * FROM ACCESOXTIPOUSUARIO WHERE TIPOUSUARIOID=".$tipousuarioid);
                
                if($usuarioid>0){
                    $axtu = $db->query("SELECT AXU AS AXTU,MENUID,USUARIOID AS TIPOUSUARIOID FROM ACCESOXUSUARIO WHERE USUARIOID=".$usuarioid);
                }
            }

            if($usuarioid>0){
                $axu = $db->query("SELECT * FROM ACCESOXUSUARIO WHERE USUARIOID=".$usuarioid);
            }else{
                $axu = $db->query("SELECT AXTU AS AXU,MENUID,TIPOUSUARIOID AS USUARIOID FROM ACCESOXTIPOUSUARIO WHERE TIPOUSUARIOID=".$tipousuarioid);
            }

            $datos_dinamicos = [
                'title' => 'AIG - Accesos',
                //'nombresession' => $this->$session->nombre,
                //'tipousuarioid' => $this->$session->tipousuarioid,
                'content' => 'accesos',
                'tipousuarios' => $tipousuarios,
                'usuarios' => $usuarios,
                'tipousuarioid' => $tipousuarioid,
                'usuarioid' => $usuarioid,
                'axtu' => $axtu,
                'axu' => $axu,
                'accesos' => $accesos,
                'urlpost' => 'setAcceso'
                //'data' => $table->generate()
            ];
            
        return view('dashboard',$datos_dinamicos);

    }
}