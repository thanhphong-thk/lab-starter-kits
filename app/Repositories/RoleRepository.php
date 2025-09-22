<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Role;

class RoleRepository implements BaseRepositoryInterface
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {
        return $this->role->get();
    }

    public function create(array $data)
    {
        return $this->role->create($data);
    }

    public function update($data)
    {
        return $this->role->save($data);
    }
}
