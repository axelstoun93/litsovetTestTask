<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBook extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'BIGINT',
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
                'description' => [
                    'type' => 'text'
                ],
                'updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                ],
                'created_at datetime default current_timestamp',
            ]
        );

        $this->forge->addKey('id', true);

        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}
