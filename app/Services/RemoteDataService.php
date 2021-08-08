<?php


namespace App\Services;


use App\Models\Person;
use App\Models\Planet;
use App\Repositories\PeopleRepository;
use App\Repositories\PlanetRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class RemoteDataService
{

    /**
     * @var PeopleRepository
     */
    private PeopleRepository $peopleRepository;

    /**
     * @var PlanetRepository
     */
    private PlanetRepository $planetRepository;

    public function __construct(PeopleRepository $peopleRepository, PlanetRepository $planetRepository)
    {
        $this->peopleRepository = $peopleRepository;
        $this->planetRepository = $planetRepository;
    }

    public function deleteLocalData()
    {
        Planet::query()->delete();
        Person::query()->delete();
    }

    public function importAllData()
    {
        $planets = $this->planetRepository->getRemoteData()->map(fn($planet) => $this->formatPlanetDataFromRemote($planet));
        $people = $this->peopleRepository->getRemoteData()->map(fn($person) => $this->formatPeopleDataFromRemote($person, $planets));
        $this->planetRepository->createMany($planets->toArray());
        $this->peopleRepository->createMany($people->toArray());
    }

    private function formatPlanetDataFromRemote(object $planet = null): array
    {
        return $planet ? [
            'uuid' => Str::uuid(),
            'remote_uid' => $planet->uid,
            'remote_id' => $planet->_id,
            'name' => $planet->properties->name,
            'diameter' => $planet->properties->diameter,
            'rotation_period' => $planet->properties->rotation_period,
            'orbital_period' => $planet->properties->orbital_period,
            'gravity' => $planet->properties->gravity,
            'population' => $planet->properties->population,
            'climate' => $planet->properties->climate,
            'terrain' => $planet->properties->terrain,
            'surface_water' => $planet->properties->surface_water,
            'url' => $planet->properties->url,
            'description' => $planet->description,
            'created_at' => Carbon::make($planet->properties->created),
            'updated_at' => Carbon::make($planet->properties->edited),
        ] : [];
    }

    private function formatPeopleDataFromRemote(object $person = null, Collection $planets): array
    {
        return $person ? [
            'uuid' => Str::uuid(),
            'remote_uid' => $person->uid,
            'remote_id' => $person->_id,
            'name' => $person->properties->name,
            'height' => $person->properties->height,
            'mass' => $person->properties->mass,
            'hair_color' => $person->properties->hair_color,
            'skin_color' => $person->properties->skin_color,
            'eye_color' => $person->properties->eye_color,
            'birth_year' => $person->properties->birth_year,
            'gender' => $person->properties->gender,
            'planet_uuid' => $planets->firstWhere('url', $person->properties->homeworld)['uuid'],
            'url' => $person->properties->url,
            'description' => $person->description,
            'created_at' => Carbon::make($person->properties->created),
            'updated_at' => Carbon::make($person->properties->edited),
        ] : [];
    }

}
