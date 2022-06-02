<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookNotice extends Migration
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
                'number' => [
                    'type' => 'int',
                ],
                'description' => [
                    'type' => 'text'
                ],
                'book_id' => [
                    'type' => 'BIGINT',
                    'unsigned' => TRUE
                ],
                'updated_at' => [
                    'type' => 'datetime',
                    'null' => true,
                ],
                'created_at datetime default current_timestamp',
            ]
        );

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('book_id', 'books', 'id');
        $this->forge->createTable('book_notice');
    }

    public function down()
    {
        $this->forge->dropTable('book_notice');
    }
}
