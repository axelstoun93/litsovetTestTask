<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookChapters extends Migration
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
                'content' => [
                    'type' => 'text'
                ],
                'book_id' => [
                    'type' => 'BIGINT',
                    'unsigned' => TRUE
                ],
                'views' => [
                    'type' => 'INT',
                    'default' => 0,
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
        $this->forge->createTable('book_chapters');
    }

    public function down()
    {
        $this->forge->dropTable('book_chapters');
    }
}
