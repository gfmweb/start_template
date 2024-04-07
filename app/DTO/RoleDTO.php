<?php

namespace App\DTO;

use App\DTO\DTO;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleDTO extends DTO
{
    public int $id;
    public string $role;

    private function __construct(Role $role, bool $readonly = false)
    {
        parent::__construct($readonly);
        $this->id = $role->id;
        $this->role = $role->role;
    }

    public static function makeFromCollection(Collection $coleection): array
    {
        $response = [];
        foreach ($coleection as $role) {
            $response[] = new self($role);
        }
        return $response;
    }


}
