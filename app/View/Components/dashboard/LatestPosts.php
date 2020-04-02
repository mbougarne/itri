<?php

namespace App\View\Components\dashboard;

use Illuminate\View\Component;
use App\Models\Post;

class LatestPosts extends Component
{

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.latest-posts');
    }

    /**
     * Get latest posts
     *
     * @param \App\Models\Post $posts
     * @return \App\Models\Post $posts
     */
    public function posts(Post $posts) : object
    {
        return $posts;
    }
}
