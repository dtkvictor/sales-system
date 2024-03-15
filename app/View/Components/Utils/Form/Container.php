<?php

namespace App\View\Components\Utils\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Container extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $route,
        public string $method
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.form.container');
    }
}
