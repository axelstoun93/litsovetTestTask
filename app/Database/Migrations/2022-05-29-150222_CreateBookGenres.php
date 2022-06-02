<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookGenres extends Migration
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
                'updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                ],
                'created_at datetime default current_timestamp',
            ]
        );

        $this->forge->addKey('id', true);

        $this->forge->createTable('book_genres');
    }

    public function down()
    {
        $this->forge->dropTable('book_genres');
    }
}
