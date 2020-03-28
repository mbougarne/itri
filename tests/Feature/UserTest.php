<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = factory(User::class, 1)->create();
    }

    public function testuserCreation()
    {
        $this->assertCount(1, User::all());
    }
}
