<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'password',
        'email',
        'full_name'
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
        'username' => 'required|min_length[3]|max_length[50]|is_unique[admins.username,id,{id}]',
        'password' => 'required|min_length[8]',
        'email'    => 'permit_empty|valid_email|is_unique[admins.email,id,{id}]',
    ];

    protected $validationMessages = [
        'username' => [
            'is_unique' => 'This username is already taken'
        ],
        'email' => [
            'is_unique' => 'This email is already registered'
        ]
    ];

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash password before saving to database
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Verify admin credentials
     */
    public function verifyCredentials(string $username, string $password): ?array
    {
        $admin = $this->where('username', $username)->first();
        
        if ($admin && password_verify($password, $admin['password'])) {
            // Remove password from returned data
            unset($admin['password']);
            return $admin;
        }
        
        return null;
    }
}
