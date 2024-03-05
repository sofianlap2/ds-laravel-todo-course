<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AddBtn extends Component
{
    public $msgBtn;
    /**
     * Create a new component instance.
     */
    public function __construct($addMsg)
    {
        $this->msgBtn = $addMsg;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.add-btn');
    }
}
