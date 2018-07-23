<?php

namespace Unite\Tags\Http\Resources;

use Unite\UnisysApi\Http\Resources\Resource;

class TagResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        /** @var \Unite\Tags\Tag $this->resource */
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'type'              => $this->type,
            'custom_properties' => $this->custom_properties,
            'created_at'        => (string) $this->created_at,
        ];
    }
}
