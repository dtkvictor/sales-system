<?php

namespace App\View\Components\Pages\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     */ 
    public function __construct(
        public string $route = '',
        public string $method = 'POST',
        public object|null $product = null,
        public object|array $categories = [],
    ){}

    public function selected($product, $category): string
    {
        dd($category);
        if($product == null) return "";
        if($product->category == $category->id) {
            return "selected";
        }
        return "";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.product.partials.form', [
            'selected' => fn() => $this->selected(),
        ]);
    }
}
