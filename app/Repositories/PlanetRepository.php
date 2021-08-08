<?php


namespace App\Repositories;


use App\Models\Planet;


class PlanetRepository extends AbstractRepository
{

    use HasRemoteData;

    protected string $remoteEndpoint = 'https://www.swapi.tech/api/planets';

    public function __construct(Planet $model)
    {
        parent::__construct($model);
    }

}
