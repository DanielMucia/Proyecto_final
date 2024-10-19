<?php

namespace App\Models;

class taskModel extends \CodeIgniter\Model
{
    protected $table = 'task';

    protected $allowedFields = ['description']; 

    protected $returnType = 'App\Entities\Task';

    protected $useTimestamps = true;

    protected $validationRules = [
        'description' => 'required'
    ];

    protected $validationMessages = [
        'description' => [
            'required' => 'place enter a description'

        ]

        ];
}