<?php

namespace App\Http\Resources;

use App\Models\Planet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PlanetResource
 * @package App\Http\Resources
 * @mixin Planet
 */
class PlanetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' =>  $this->uuid,
            'remote_uid' => $this->remote_uid,
            'name' => $this->name,
            'diameter' => $this->diameter,
            'rotation_period' => $this->rotation_period,
            'orbital_period' => $this->orbital_period,
            'gravity' => $this->gravity,
            'population' => $this->population,
            'climate' => $this->climate,
            'terrain' => $this->terrain,
            'has_surface_water' => $this->surface_water,
            'description' => $this->description,
            'url' => $this->url,
            'created_at' => $this->created_at->unix(),
            'updated_at' => $this->updated_at->unix(),
        ];
    }
}
