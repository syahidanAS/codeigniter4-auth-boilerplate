<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArticleModel;
use App\Models\KeyModel;

class ArticleController extends ResourceController
{
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	use ResponseTrait;
	// function __construct()
	// {
	// 	$this->model = new ArticleModel();
	// }
	public function index()
	{
		$this->model = new ArticleModel();
		$data = $this->model->select('*')->findAll();
		$api_key = $this->request->getVar('key');

		$keyModel = new KeyModel();
		$key_checker = $keyModel->select('*')->where('key', $api_key)->findAll();

		$response = [
			'status' => 'ok',
			'message' => 'success',
			'data' => $data
		];
		return $this->respond($response, 200);

		// if(!$key_checker || $key_checker = null){
		// 	$response = [
		// 		'status' => 'unauthorized',
		// 		'message' => 'Make sure your API key is valid'
		// 	];
		// 	return $this->respond($response, 401);
		// }else{
	
		// }

	}

	public function show($id = null)
	{
		$this->model = new ArticleModel();
		$data = $this->model->where('id', $id)->findAll();
		if ($data) {
			return $this->respond($data, 200);
		} else {
			return $this->failNotFound("Data tidak ditemukan untuk id $id");
		}
	}
}
