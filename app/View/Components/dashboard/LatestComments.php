<?php

namespace App\View\Components\dashboard;

use Illuminate\View\Component;

class LatestComments extends Component
{
    /**
     * Latest comments
     *
     * @var $comment
     */
    public $comments;

    public function __construct($comments)
    {
        $this->comments = $comments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.latest-comments');
    }
}
