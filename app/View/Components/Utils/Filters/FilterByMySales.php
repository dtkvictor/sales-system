<?php

namespace App\View\Components\Utils\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterByMySales extends Component
{
    public bool $value;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->value = request()->query('my-sales', false);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.filters.filter-by-my-sales');
    }
}
