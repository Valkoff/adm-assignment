<?php

namespace App\Http\Resources;

use App\Models\Person;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PersonResource
 * @package App\Http\Resources
 * @mixin Person
 */
class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'uuid' =>  $this->uuid,
            'remote_uid' => $this->remote_uid,
            'name' => $this->name,
            'height' => $this->height,
            'mass' => $this->mass,
            'hair_color' => $this->hair_color,
            'skin_color' => $this->skin_color,
            'eye_color' => $this->eye_color,
            'birth_year' => $this->birth_year,
            'gender' => $this->gender,
            'description' => $this->description,
            'url' => $this->url,
            'created_at' => $this->created_at->unix(),
            'updated_at' => $this->updated_at->unix(),
            'planet' => new PlanetResource($this->whenLoaded('planet')),
        ];

    }
}
