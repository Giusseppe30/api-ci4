<?php
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PersonasModel;

class Personas extends ResourceController
{
    use ResponseTrait;
    // Obtener todas las personas
    public function index()
    {
        $model = new PersonasModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
 
    // Obtener una persona en específico
    public function show($id = null)
    {
        $model = new PersonasModel();
        $data = $model->getWhere(['persona_id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    // Crear una persona
    public function create()
    {
        $model = new PersonasModel();
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'edad' => $this->request->getPost('edad')
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($data, 201);
    }
 
    // Actualizar una persona
    public function update($id = null)
    {
        $model = new PersonasModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'nombre' => $json->nombre,
                'apellido' => $json->apellido,
                'edad' => $json->edad
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'nombre' => $input['nombre'],
                'apellido' => $input['apellido'],
                'edad' => $input['edad']
            ];
        }
        // Insertar a la base de datos
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    // delete product
    public function delete($id = null)
    {
        $model = new PersonasModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }    
    }
}