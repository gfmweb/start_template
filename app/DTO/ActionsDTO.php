<?php

namespace App\DTO;

use App\Models\Action;
use Illuminate\Database\Eloquent\Collection;

/**
 * Действия по которым можно осуществлять проверку правомерности доступа
 */
class ActionsDTO extends DTO
{
    public int $id;
    public string $action;

    private function __construct(array $data, bool $readonly = false)
    {
        parent::__construct($readonly);
        $this->id = $data["id"];
        $this->action = $data["action"];
    }

    public static function makeFromModel(Action $action): ActionsDTO
    {
        return new self([
            'id' => $action->id,
            'action' => $action->action
        ]);
    }

    public static function makeFromCollection(Collection $collection): array
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = new self(['id' => $item->id, 'action' => $item->action]);
        }
        return $result;
    }
}
