<?php

namespace App\DTO;

use App\Models\Log;
use Illuminate\Database\Eloquent\Collection;

/**
 * Логи
 */
class LogDTO extends DTO
{
    public int $id;
    public array $data;

    private function __construct(array $data, bool $readonly = false)
    {
        parent::__construct($readonly);
        $this->id = $data['id'];
        $this->data = json_decode($data['data'], true);
    }

    public static function makeFromCollection(Collection $collection): array
    {
        $data = [];
        foreach ($collection as $item) {
            $data[] = new self(['id' => $item->id, 'data' => $item->data]);
        }
        return $data;
    }

}
