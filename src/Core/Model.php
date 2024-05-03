<?php

namespace App\Core;

#[\AllowDynamicProperties]
abstract class Model
{
    public const string FIELD_PK = 'id';

    protected string $table;
    protected string $primaryKey = self::FIELD_PK;
    protected bool $timestamps = true;
    protected DB $db;
    protected int $id;
    private ?string $hash = null;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * @param  int[]  $ids
     * @return static[]
     */
    public static function getArray(array $ids): array
    {
        $self = new static();

        $placeholders = rtrim(str_repeat('?, ', count($ids)), ', ');

        $sql = <<<MySQL
            SELECT * FROM $self->table WHERE $self->primaryKey IN ($placeholders)
            MySQL;

        $data = \App\Core\DB::execute($sql, $ids)->fetchAll();

        $result = [];
        foreach ($data as $line) {
            $item = new static();
            foreach ($line as $key => $value) {
                $item->$key = $value;
            }
            $item->hash = self::createHash($item, $line);
            $result[$item->{$self->primaryKey}] = $item;
        }

        return $result;
    }

    public static function get(int $id): ?static
    {
        $items = self::getArray([$id]);

        if (count($items) === 1) {
            return current($items);
        }

        return null;
    }

    public static function createHash(Model $item, array $data): string
    {
        return md5(json_encode($data));
    }

    public function save(): bool
    {
        $this->timestamps();

        if (!($this->hash ?? $this->id ?? null)) {
            return $this->create();
        }

        $this->onBeforeSave();
        $data = $this->getData();

        $columns = array_keys($data);
        $values = array_values($data);
        $placeholders = array_map(fn($column) => "$column = ?", $columns);
        $placeholders = implode(', ', $placeholders);

        $sql = <<<MySQL
            UPDATE $this->table SET $placeholders WHERE id = ?
            MySQL;
        $values[] = $this->id;

        \App\Core\DB::execute($sql, $values);

        return true;
    }

    public function create(): bool
    {
        $this->onBeforeCreate();
        $data = $this->getData();

        $columns = implode(', ', array_keys($data));
        $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');

        $sql = <<<MySQL
            INSERT INTO $this->table ($columns) VALUES ($placeholders)
            MySQL;
        $values = array_values($data);

        \App\Core\DB::execute($sql, $values);

        return true;
    }

    public function delete()
    {
        // delete() method implementation remains unchanged
    }

    private function getData(): array
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties(
            \ReflectionProperty::IS_PROTECTED
        );

        $data = get_object_vars($this);
        foreach ($properties as $property) {
            unset($data[$property->name]);
        }
        unset($data['hash']);

        return $data;
    }

    protected function onBeforeCreate(): void
    {
    }

    protected function onBeforeSave(): void
    {
    }

    protected abstract function timestamps();

}
