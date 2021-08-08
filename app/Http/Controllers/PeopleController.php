<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeopleCollectionResource;
use App\Http\Resources\PersonResource;
use App\Models\Person;
use App\Repositories\PeopleRepository;

class PeopleController extends Controller
{

    /**
     * @var PeopleRepository
     */
    private PeopleRepository $repository;

    public function __construct(PeopleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return new PeopleCollectionResource($this->repository->all());
    }

    public function show(Person $person)
    {
        return new PersonResource($this->repository->show($person));
    }

}
