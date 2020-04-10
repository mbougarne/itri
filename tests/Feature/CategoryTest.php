<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $category;

    /** @test */
    public function can_create_category_and_get_slug()
    {
        $response = $this->postJson('/categories/create', [
            'name' => 'uncategorized',
            'description' => 'Category for non categories',
            'is_sub' => 1
        ]);

        $data = $response->getData();

        $response->assertCreated();
        $this->assertNotNull($data->slug);
        $this->assertEquals('Sub Category', $data->is_sub);
    }

}
