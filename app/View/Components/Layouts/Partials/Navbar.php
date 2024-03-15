<?php

namespace App\View\Components\Layouts\Partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public function actived($name): string
    {
        if(preg_match("/\b$name\b/i", request()->route()->getName())) {
            return 'active';
        }
        return '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.partials.navbar');
    }
}
