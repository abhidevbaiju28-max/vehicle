<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVehiclePermitsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'student_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'course_year' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'class_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'student_address' => [
                'type' => 'TEXT',
            ],
            'student_contact' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'parent_contact' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'vehicle_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'rc_owner_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'license_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'parent_recommendation' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'teacher_recommendation' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // For the files listed in "Attach Copies of"
            'rc_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'license_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'insurance_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'pollution_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'consent_file' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('vehicle_permits');
    }

    public function down()
    {
        $this->forge->dropTable('vehicle_permits');
    }
}
