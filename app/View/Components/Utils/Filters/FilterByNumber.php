<?php

namespace App\View\Components\Utils\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterByNumber extends Component
{
    public int|float|null $value;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $name,
    )
    {
        $this->value = request()->query($name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.filters.filter-by-number');
    }
}
