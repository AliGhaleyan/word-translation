<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PartSpeechOptions extends Component
{
    public $selected;

    /**
     * Create a new component instance.
     *
     * @param null $selected
     */
    public function __construct($selected = null)
    {
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.part-speech-options');
    }
}
