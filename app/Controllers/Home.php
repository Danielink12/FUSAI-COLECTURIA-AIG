<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();

       /* $newdata = [
            'usuario'  => 'administrador',
            'logged_in' => true,
        ];

        $session->set($newdata);*/

        //unset($session);
        
        $datos_dinamicos = [
            'title' => 'AIG - Dashboard',
            'content' => 'welcome.php'
        ];

        if(isset($session->usuario)){

            return view('dashboard',$datos_dinamicos);
        }else{
            return redirect()->to(site_url('Login'));
        }
    }

    function cerrarSesion(){
        $session = session();
        $array_items = ['usuario', 'token','logged_in','nombre','tipousuarioid','usuarioid'];
        $session->remove($array_items);
        //unset($this->$session);
        return redirect()->to(site_url('Home'));
    }

    //funcion de prueba
    public function cambiovista(){

        $datos_dinamicos=[
            'title' => 'otro titulo',
            'content' => 'sidebar.php'
        ];

        return view('dashboard',$datos_dinamicos);
    }
}
