<?php

namespace App\Models;

use CodeIgniter\Model;

class PermitModel extends Model
{
    protected $table            = 'vehicle_permits'; // Tables will be prefixed automatically by CI4 config
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'student_name',
        'course_year',
        'student_address',
        'student_contact',
        'parent_contact',
        'vehicle_number',
        'rc_owner_name',
        'license_number',
        'parent_recommendation',
        'teacher_recommendation',
        'rc_file',
        'license_file',
        'insurance_file',
        'pollution_file',
        'consent_file',
        'status',
        'class_number'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'student_name'    => 'required|min_length[3]',
        'course_year'     => 'required',
        'class_number'    => 'required',
        'student_address' => 'required',
        'student_contact' => 'required|numeric|min_length[10]',
        'parent_contact'  => 'required|numeric|min_length[10]',
        'vehicle_number'  => 'required',
        'rc_owner_name'   => 'required',
        'license_number'  => 'required',
        'rc_file'         => 'required',
        'license_file'    => 'required',
        'insurance_file'  => 'required',
        'pollution_file'  => 'required',
    ];

    protected $validationMessages = [];
}
