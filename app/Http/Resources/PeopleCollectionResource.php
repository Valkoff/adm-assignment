<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PeopleCollectionResource extends ResourceCollection
{

    /**
     * @var string
     */
    public $collects = PersonResource::class;

}

