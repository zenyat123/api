<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request)
    {

        return [

            "id" => $this->id,
            "category" => $this->category,
            "url" => $this->url,
            "posts" => PostResource::collection($this->whenLoaded("posts"))

        ];

    }

}