<?php

namespace laililmahfud\starterkit\components;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    private $title;
    private $pagetype;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title='',$pagetype=null)
    {
        $this->title = $title;
        $this->pagetype = $pagetype;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('starterkit::layout.admin-layout',['title'=>$this->title,'pagetype'=>$this->pagetype]);
    }
}
