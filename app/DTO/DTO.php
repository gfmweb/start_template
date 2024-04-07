<?php

namespace App\DTO;

class DTO
{
    private bool $readonly;
    private array $log;
    private object $original;

    public function __construct(bool $readonly = false)
    {
        $this->readonly = $readonly;
    }


    public function setLog(mixed $data, string $message): void
    {
        if (!$this->readonly) throw new \Exception('Объект ДТО не поддерживает защиту данных от изменений и не ведет логирование');
        $record['data'] = $data;
        $record['message'] = $message;
        $this->log[] = $record;
    }

    public function getLog(): array
    {
        if (!isset($this->log)) return [];
        return $this->log;
    }

    public function setOriginal(object $obj): void
    {
        if ($this->readonly) {
            $this->original = $obj;
        }
    }

    public function getOriginal(): object
    {
        if (is_null($this->original)) return (object)[];
        return $this->original;
    }
}
