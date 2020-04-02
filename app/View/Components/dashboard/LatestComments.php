<?php

namespace App\View\Components\dashboard;

use Illuminate\View\Component;
use App\Models\Comment;

class LatestComments extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.dashboard.latest-comments');
    }

    /**
     * Return latest comments
     *
     * @return self::getLatestComments
     */
    public function comments()
    {
        return $this->getLatestComments();
    }

    /**
     * Get latest comments
     *
     * @return \App\Models\Comment
     */
    protected function getLatestComments() : object
    {
        return Comment::pending()->orderBy("created_at", "desc")->limit(5)->get();
    }
}
