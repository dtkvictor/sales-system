<?php

namespace App\View\Components\Utils\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class FilterByCategory extends Component
{
    public int|null $value;
    public object $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->value = request()->query('category');
        $this->categories = Category::select('id', 'name')->get();    
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.filters.filter-by-category');
    }
}
