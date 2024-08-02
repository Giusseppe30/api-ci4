<?php

namespace App\Controllers;

class Home extends BaseController
{
    // public function index(): string
    public function index()
    {
        // $valor =[
        //     'test'=> 'ejemplo',
        //     'id'=> 1
        // ];

        $this->db=\Config\Database::connect();

        $query=$this->db->query('select * from personas');

        $valor=$query->getResult();

        return $this->response->setJSON($valor);


        // echo ('Hola');
        
        // return view('welcome_message');
    }
}
