<?php

namespace App\Models;

class UserModel extends \CodeIgniter\Model
{
    protected $table = 'user';

    protected $allowedFields = ['name', 'email', 'password'];

    protected $returnType = 'App\Entities\User';

    protected $useTimestamps = true;   

    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation'=> 'required|matches[password]'
    ];

    protected $validationMessages = [
        'email' => [
          'is_unique' => 'That email address is taken'
        ],
        'password_confirmation' => [
            'required' => 'pleace confirm the password',
            'matches' => 'pleace enter the same password again'
        ]
    ];
    
    protected $beforeInsert = ['hashPassword'];

    public function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {

            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            unset($data['data']['password']);
        }

        return $data; 
    }
}