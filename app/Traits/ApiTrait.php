<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ApiTrait
{

    public function scopeIncluded(Builder $query)
    {

        if(empty($this->allowIncluded) || empty(request("included")))
        {

            return;

        }

        $relations = explode(",", request("included"));

        $collection = collect($this->allowIncluded);

        foreach($relations as $key => $relation)
        {

            if(!$collection->contains($relation))
            {

                unset($relations[$key]);

            }

        }

        $query->with($relations);

    }

    public function scopeFilter(Builder $query)
    {

        if(empty($this->allowFilter) || empty(request("filter")))
        {

            return;

        }

        $filters = request("filter");

        $collection = collect($this->allowFilter);

        foreach($filters as $key => $value)
        {

            if($collection->contains($key))
            {

                $query->where($key, "LIKE", "%" . $value . "%");

            }

        }

    }

    public function scopeSort(Builder $query)
    {

        if(empty($this->allowSort) || empty(request("sort")))
        {

            return;

        }

        $sorts = explode(",", request("sort"));

        $collection = collect($this->allowSort);

        foreach($sorts as $sort)
        {

            $mode = "asc";

            if(substr($sort, 0, 1) == "-")
            {

                $mode = "desc";

                $sort = substr($sort, 1);

            }

            if($collection->contains($sort))
            {

                $query->orderBy($sort, $mode);

            }

        }

    }

    public function scopeGetOrPaginate(Builder $query)
    {

        if(request("perPage"))
        {

            $perPage = intval(request("perPage"));

            if($perPage)
            {

                return $query->paginate($perPage);

            }

        }

        return $query->get();

    }

}