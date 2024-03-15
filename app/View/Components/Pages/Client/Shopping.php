<?php

namespace App\View\Components\Pages\Client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Shopping extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public object $shoppings
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.client.partials.shopping');
    }
}
