<?php

namespace App\View\Components\Utils\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Container extends Component
{
    public string $clearFilterRoute;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->clearFilterRoute = request()->url();

        if(request()->has('page')) {
            $page = request()->query('page');
            $this->clearFilterRoute .= "?page=$page";
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.filters.container');
    }
}
