<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tb_user';
    protected $allowedFields = ['name', 'email', 'password', 'photo'];


    public function getAkun($id = false)
    {
        if ($id == false) {
            # code...
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
