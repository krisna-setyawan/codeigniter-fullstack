<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PasienModel;

class Pasien extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;

    public function index()
    {
        $model = new PasienModel();
        $data = $model->findAll();
        return $this->respond($data);
    }


    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new PasienModel();
        $data = $model->find(['id' => $id]);

        if (!$data) return $this->failNotFound('No Data Found');

        return $this->respond($data[0]);
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'no_rm' => 'required',
            'nama' => 'required'
        ];

        $data = [
            'no_rm' => $this->request->getVar('no_rm'),
            'nama' => $this->request->getVar('nama'),
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new PasienModel();
        $model->save($data);

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data inserted'
            ]
        ];
        return $this->respondCreated($response);
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'no_rm' => 'required',
            'nama' => 'required'
        ];

        $data = [
            'no_rm' => $this->request->getVar('no_rm'),
            'nama' => $this->request->getVar('nama'),
        ];

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new PasienModel();

        $findById = $model->find(['id' => $id]);
        if (!$findById) return $this->failNotFound('No Data Found');

        $model->update($id, $data);

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data updated'
            ]
        ];
        return $this->respondCreated($response);
    }


    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new PasienModel();

        $findById = $model->find(['id' => $id]);
        if (!$findById) return $this->failNotFound('No Data Found');

        $model->delete($id);

        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data deleted'
            ]
        ];
        return $this->respondCreated($response);
    }
}
