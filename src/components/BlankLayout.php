<?php

namespace laililmahfud\starterkit\components;

use Illuminate\View\Component;

class BlankLayout extends Component
{
    private $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title='')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('starterkit::layout.blank-layout',['title'=>$this->title]);
    }
}
