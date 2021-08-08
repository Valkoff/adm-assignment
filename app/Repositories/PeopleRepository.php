<?php


namespace App\Repositories;


use App\Models\Person;

class PeopleRepository extends AbstractRepository
{

    use HasRemoteData;

    protected string $remoteEndpoint = 'https://www.swapi.tech/api/people';

    protected array $allowedIncludes = ['planet'];


    public function __construct(Person $model)
    {
        parent::__construct($model);
    }


}
