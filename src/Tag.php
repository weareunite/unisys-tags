<?php

namespace Unite\Tags;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Unite\UnisysApi\Helpers\CustomProperty\HasCustomProperty;
use Unite\UnisysApi\Helpers\CustomProperty\HasCustomPropertyTrait;

class Tag extends Model implements HasCustomProperty
{
    use HasCustomPropertyTrait;

    protected $fillable = [
        'title', 'type', 'custom_properties'
    ];

    protected $casts = [
        'custom_properties' => 'array',
    ];

    public function scopeWithType(Builder $query, string $type = null): Builder
    {
        if (is_null($type)) {
            return $query;
        }

        return $query->where('type', $type);
    }

    public static function getWithType(string $type): Collection
    {
        return static::withType($type)->orderBy('title')->get();
    }

    public static function findOrCreate($values, string $type = null)
    {
        $tags = collect($values)->map(function ($value) use ($type) {
            if ($value instanceof Tag) {
                return $value;
            }
            return static::findOrCreateFromString($value, $type);
        });

        return is_string($values) ? $tags->first() : $tags;
    }

    protected static function findOrCreateFromString(string $title, string $type = null): Tag
    {
        $tag = static::findFromString($title, $type);
        if (! $tag) {
            $tag = static::create([
                'title' => $title,
                'type' => $type,
            ]);
        }
        return $tag;
    }

    public static function findFromString(string $title, string $type = null)
    {
        return static::query()
            ->where('title', $title)
            ->where('type', $type)
            ->first();
    }
}
