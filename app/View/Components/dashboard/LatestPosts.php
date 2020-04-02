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
     * Return latest posts
     *
     * @return self::getLatestPosts
     */
    public function posts()
    {
        return $this->getLatestPosts();
    }

    /**
     * Get latest posts
     *
     * @return \App\Models\Post
     */
    protected function getLatestPosts() : object
    {
        return Post::published()->orderBy("created_at", "desc")->limit(5)->get();
    }
}
