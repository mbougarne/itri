<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_create_comment()
    {

        $this->postJson('/dashboard/posts/create', [
            'title' => 'Sample post to test comment',
            'body' => 'Just testing the comment',
        ]);

        $responsoe = $this->postJson('/comments/create', [
            'post_id' => 1,
            'first_name' => 'Mourad',
            'last_name' => 'Bougarne',
            'email' => 'contact@mbougarne.me',
            'body' => 'Just testing the comment',
        ]);

        $responsoe->assertCreated();
        $responsoe->dump();
    }
}
