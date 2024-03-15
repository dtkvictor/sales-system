<?php

namespace App\View\Components\Utils\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterByHour extends Component
{
    public string $value;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->value = request()->query('hour', '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.filters.filter-by-hour');
    }
}
