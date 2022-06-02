<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookAuthor extends Migration
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
                'first_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
                'middle_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
                'last_name' => [
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

        $this->forge->createTable('book_authors');
    }

    public function down()
    {
        $this->forge->dropTable('book_authors');
    }
}
