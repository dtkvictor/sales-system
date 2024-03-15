<?php

namespace App\View\Components\Utils\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputImage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $default,
        public string $position = 'center',
        public string|null $width = null,
        public string|null $height = null,
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.form.input-image');
    }
}
