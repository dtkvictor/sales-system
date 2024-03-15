<?php
namespace App\View\Components\Utils\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterByDate extends Component
{
    public string $value;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->value = request()->query('date', '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.filters.filter-by-date')->with('value', $this->value);
    }
}