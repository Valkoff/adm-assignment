<?php


namespace App\Repositories;


use App\Models\AbstractModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

abstract class AbstractRepository
{

    protected AbstractModel $model;

    protected array $allowedFilters = [];

    protected array $allowedSorts = [];

    protected array $allowedIncludes = [];

    protected string $defaultSort = '-created_at';

    public function __construct(AbstractModel $model)
    {
        $this->model = $model;
    }

    public function createMany(array $data): void
    {
        $this->model->insert($data);
    }

    public function all(): LengthAwarePaginator
    {
        return $this->baseQuery()->paginate(20);
    }

    protected function baseQuery(): QueryBuilder
    {
        return QueryBuilder::for(get_class($this->model))
            ->allowedSorts($this->allowedSorts)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedFilters($this->allowedFilters)
            ->defaultSort($this->defaultSort);
    }

    public function show(AbstractModel $model): ?AbstractModel
    {
        return $this->baseQuery()
            ->where('uuid', $model->uuid)
            ->first();
    }

}
