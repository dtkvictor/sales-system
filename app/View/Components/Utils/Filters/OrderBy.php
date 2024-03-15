<?php

namespace App\View\Components\Utils\Filters;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderBy extends Component
{
    public string|null $orderByValue;
    public array $options;
    /**
     * Create a new component instance.
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
        $this->orderByValue = request()->query('order-by');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.filters.order-by');
    }
}
