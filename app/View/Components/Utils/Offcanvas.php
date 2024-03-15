<?php

namespace App\View\Components\Utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Offcanvas extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $btnStyle,
        public string $id,
        public string $title
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.offcanvas');
    }
}
