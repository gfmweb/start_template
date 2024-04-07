<?php

namespace App\DTO;

use App\DTO\DTO;
use \Illuminate\Database\Eloquent\Collection;

class PermissionsDTO extends DTO
{
    public int $action_id;
    public string $name;
    public bool $permission;

    private function __construct(array $data, bool $readonly = false)
    {
        parent::__construct($readonly);
        $this->action_id = $data['action_id'];
        $this->name = $data['name'];
        $this->permission = $data['permission'];
    }

    public static function makeFromCollections(array $actions, Collection $permissions, int $role_id): array
    {
        $response = [];
        if ($role_id == 2) {
            foreach ($actions as $action) {
                $response[] = new self([
                    'action_id' => $action->id,
                    'name' => $action->action,
                    'permission' => true,
                ]);
            }
        } else {
            foreach ($actions as $action) {
                $grand = false;
                foreach ($permissions as $permission) {
                    if ($permission->action_id == $action->id) {
                        $grand = ($permission->granted == 1);
                    }
                }
                $response[] = new self([
                    'action_id' => $action->id,
                    'name' => $action->action,
                    'permission' => $grand,
                ]);
            }
        }
        return $response;
    }


}
