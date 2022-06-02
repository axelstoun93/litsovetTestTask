<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksAuthors extends Migration
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
                'book_id' => [
                    'type' => 'BIGINT',
                    'unsigned' => TRUE
                ],
                'author_id' => [
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
        $this->forge->addForeignKey('author_id', 'book_authors', 'id');
        $this->forge->createTable('books_authors');
    }

    public function down()
    {
        $this->forge->dropTable('books_authors');
    }
}
