<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {

        return [

            "id" => $this->id,
            "title" => $this->title,
            "url" => $this->url,
            "resume" => $this->resume,
            "content" => $this->content,
            "user" => UserResource::make($this->whenLoaded("user")),
            "category" => CategoryResource::make($this->whenLoaded("category"))

        ];

    }

}