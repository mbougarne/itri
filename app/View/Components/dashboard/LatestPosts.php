<?php

namespace App\View\Components\dashboard;

use Illuminate\View\Component;

class LatestPosts extends Component
{
    public $posts;

    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.latest-posts');
    }
}
