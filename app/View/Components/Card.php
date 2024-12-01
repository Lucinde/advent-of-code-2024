<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $part1Result;
    public $part2Result;

     /**
     * Create a new component instance.
     */
    public function __construct($title, $part1Result, $part2Result)
    {
        $this->title = $title;
        $this->part1Result = $part1Result;
        $this->part2Result = $part2Result;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
