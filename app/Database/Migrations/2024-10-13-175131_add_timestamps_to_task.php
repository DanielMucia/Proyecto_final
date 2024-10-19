<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddTimestampsToTask extends Migration 
{
    public function up()
    {
        $this->forge->addColumn('task', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null 
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null 
            ]
        ]);
    }
    public function down()
    {
        $tihs->forge->dropColumn('task', 'update_at');
        $tihs->forge->dropColumn('task', 'created_at');
    }
}