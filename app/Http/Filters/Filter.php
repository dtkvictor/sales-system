<?php 
namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Filter
{
    protected Model|Builder $model;

    public function __construct(Model|Builder $model) 
    {
        $this->model = $model;
    }

    /**
     *  Return a array containing the alias of the methods that must be run.
     *  @return array An Associative array containing the method alias and the real method name.
     */
    protected function filterAlias(): array
    {
        return [
            'slug' => 'filterBySlug',
            'name' => 'filterByName',
            'created_at' => 'filterByCreatedAt',
            'updated_at' => 'filterByUpdatedAt',
        ];
    }

    /**
     *  Executes the query using the data provided in the array.
     *  @param array $queries An associative array containing parameters for the database query.
     *  @return Builder|Model The resulting model instance or query builder object.
     */
    public function apply(array $queries): Builder|Model
    {
        $alias = $this->filterAlias();

        foreach($queries as $query => $value) {
            if(array_key_exists($query, $alias)) {
                
                $filterMethod = $alias[$query];
                $this->model = call_user_func([$this, $filterMethod], $value);
            }
        }

        return $this->model;
    }

    protected function filterByCreatedAt($date): Builder|Model
    {
        if(strtotime($date)) {
            return $this->model->whereDate('created_at', $date);
        }   
        return $this->model;
    }

    protected function filterByUpdatedAt($date): Builder|Model
    {
        if(strtotime($date)) {
            return $this->model->whereDate('updated_at', $date);
        }   
        return $this->model;
    }

    protected function filterBySlug($slug): Builder
    {
        return $this->model->where('slug', $slug);
    }

    protected function filterByName($name): Builder|Model
    {
        $model = $this->model;
        $name = explode('-', $name);
        
        foreach($name as $key => $value) {
            if($key === 0) {
                $model = $model->where("name", "LIKE", "%$value%");
            }else {
                $model = $model->orWhere("name", "LIKE", "%$value%");
            }
        }

        return $model;
    }

    protected function orderBy($value): Builder
    {
        if(strtolower($value) == 'asc') {
            return $this->model->orderBy('updated_at', $value);
        }
        return $this->model->orderBy('updated_at', 'DESC');
    }

}