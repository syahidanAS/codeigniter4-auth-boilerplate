<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\ProfileModel;
 
class Register extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

	use ResponseTrait;
    public function index()
    {
		helper(['form']);
		$rules = [
			'email' => 'required',
			'password' => 'required|min_length[6]'
		];
		if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $dataUser = [
			'email' => $this->request->getVar('email'),
			'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
			'is_member' => $this->request->getVar('is_member'),
			'is_verified' => $this->request->getVar('is_verified')
		];
		$modelUser = new UserModel();
		$registered1 = $modelUser->save($dataUser);
		$uid = $modelUser->getInsertID();

		$dataProfile = [
			'full_name' => $this->request->getVar('full_name'),
			'address' => $this->request->getVar('address'),
			'uid' => $uid
		];
		$modelProfile = new ProfileModel();
		$registered2 = $modelProfile->save($dataProfile);
		


		if($registered1 && $registered2){
			return $this->respondCreated([
				'status'=>'created',
				'message'=> 'success'
			]);
		}else{
			return $this->respond([
				'status'=>'failed',
				'message'=> 'something went wrong!'
			]);
		}

    }
}
