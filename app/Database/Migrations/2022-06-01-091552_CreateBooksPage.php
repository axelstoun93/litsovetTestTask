<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksPage extends Migration
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
                'chapter_title' => [
                    'type' => 'varchar',
                    'constraint' => '255',
                    'default' => null
                ],
                'content' => [
                    'type' => 'text'
                ],
                'book_id' => [
                    'type' => 'BIGINT',
                    'unsigned' => TRUE
                ],
                'chapter_id' => [
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
        $this->forge->addForeignKey('chapter_id', 'book_chapters', 'id');
        $this->forge->createTable('book_pages');
    }

    public function down()
    {
        $this->forge->dropTable('book_pages');
    }
}
