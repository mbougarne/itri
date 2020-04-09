<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCreationTest extends TestCase
{
    /** @test */
    public function can_unset_tags_from_post_creation()
    {
        $data = [
            'title' => 'Can we unset tags from post creation request',
            'description' => 'unset tags from post creation',
            'tags' => 'php, laravel, itri'
        ];

        unset($data['tags']);

        $this->assertArrayNotHasKey('tags', $data);
    }

    /** @test */
    public function can_conert_tags_to_array()
    {
        $data = [
            'title' => 'Can we unset tags from post creation request',
            'description' => 'unset tags from post creation',
            'tags' => 'php, laravel, itri'
        ];

        $tags = explode(',', $data['tags']);

        $this->assertIsArray($tags);
    }
}
