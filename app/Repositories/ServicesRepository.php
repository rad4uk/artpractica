<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServicesRepository implements ServiceRepositoryInterface
{
    public function list()
    {
        return Service::orderBy('updated_at', 'DESC')->get();
    }

    public function findById(int $serviceId)
    {
        return Service::query()->findOrFail($serviceId);
    }

    public function create(array $details)
    {
        return Service::create($details);
    }

    public function update(int $serviceId, array $details)
    {
        return Service::query()->where('id', $serviceId)->update($details);
    }

    public function delete(int $serviceId)
    {
        return Service::query()->where('id', $serviceId)->delete();
    }

    public function findByOne(array $condition): ?Model
    {
        return Service::where($condition)->first();
    }

    public function findBy(array $condition, array $orderBy = null, int $limit = null, int $offset = null): Collection
    {
        $qb = Service::where($condition);
        if (!is_null($orderBy)) {
            foreach ($orderBy as $field => $order) {
                $qb->orderBy($field, $order);
            }
        }
        if (!is_null($limit)) {
            $qb->limit($limit);
        }
        if (!is_null($offset)) {
            $qb->offset($offset);
        }

        return $qb->get();
    }

}
