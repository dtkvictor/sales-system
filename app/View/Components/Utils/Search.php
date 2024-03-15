<?php

namespace App\View\Components\Utils;

use Closure;
use App\Helpers\StringUtils;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component
{
    public string $oldValue;
    
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string|null $id = null,
        public string|null $placeholder = null,
        public string|null $class = '',
    )
    {
        $this->oldValue = StringUtils::slugToText(
            request()->query('search', '')
        );
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.search');
    }
}
