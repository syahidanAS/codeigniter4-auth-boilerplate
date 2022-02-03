<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Articles extends Migration
{
    public function up()
    {
		$this->forge->addField(
			array(
			  'id' => 
				array(
				  'type' => 'INT',
				  'constraint' => '10',
				  'auto_increment' => TRUE
				),
			  'uid' => 
				array(
				  'type' => 'INT',
				  'constraint' => '10',
				),
			  'name' => 
				array(
				  'type' => 'VARCHAR',
				  'constraint' => '50',
				),
				'category' => 
				array(
					'type' => 'VARCHAR',
					'constraint' => '50',
				),
				'country_origin' => 
				array(
					'type' => 'VARCHAR',
					'constraint' => '50',
				),
				'city_origin' => 
				array(
					'type' => 'VARCHAR',
					'constraint' => '50',
				),
				'image' => 
				array(
					'type' => 'VARCHAR',
					'constraint' => '500',
				),
				'slug' => 
				array(
					'type' => 'VARCHAR',
					'constraint' => '50',
				),
				'desc' => 
				array(
					'type' => 'TEXT'
				),
			  'created_at datetime default current_timestamp',
			  'updated_at datetime default current_timestamp on update current_timestamp',
			)
		  );
			$this->forge->addKey('id', true);
			$this->forge->addForeignKey('uid', 'users', 'id');
			$this->forge->createTable('articles');
    }

    public function down()
    {
        //
    }
}
