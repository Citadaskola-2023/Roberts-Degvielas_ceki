<?php

namespace App\Core\Models\Traits;


trait Timestamps
{
    public const string FIELD_CREATED_AT = 'created_at';
    public const string FIELD_UPDATED_AT = 'updated_at';

    protected function timestamps(): void
    {
        if ($this->timestamps) {
            $currentDateTime = gmdate('Y-m-d H:i:s');
            if ($this->hash ?? $this->id ?? null) {
                $this->{static::FIELD_UPDATED_AT} = $currentDateTime;
            } else {
                $this->{static::FIELD_CREATED_AT} = $currentDateTime;
            }
        }
    }
}
