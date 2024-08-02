<?php
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductosModel;

class Productos extends ResourceController
{
    use ResponseTrait;
    // Obtener todos los Productos
    public function index()
    {
        $model = new ProductosModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }
 
    // Obtener un producto en específico
    public function show($id = null)
    {
        $model = new ProductosModel();
        $data = $model->getWhere(['producto_id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No se encontraron datos con el id: '.$id);
        }
    }
 
    // Crear un producto
    public function create()
    {
        $model = new ProductosModel();
        
        $data = [
            'nombre_producto' => $this->request->getPost('nombre_producto'),
            'sabor_producto' => $this->request->getPost('sabor_producto'),
            'precio_producto' => $this->request->getPost('precio_producto')
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
 
    // Actualizar un producto
    public function update($id = null)
    {
        $model = new ProductosModel();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'nombre_producto' => $json->nombre_producto,
                'sabor_producto' => $json->sabor_producto,
                'precio_producto' => $json->precio_producto
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'nombre_producto' => $input['nombre_producto'],
                'sabor_producto' => $input['sabor_producto'],
                'precio_producto' => $input['precio_producto']
            ];
        }
        // Insertar a la base de datos
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Datos actualizados'
            ]
        ];
        return $this->respond($response);
    }

    // Eliminar producto
    public function delete($id = null)
    {
        $model = new ProductosModel();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Datos eliminados'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No se encontraron datos con el id: '.$id);
        }    
    }
}