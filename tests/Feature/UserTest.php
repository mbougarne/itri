<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Repository\UserRepository;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;
    protected $repository;

    public function setUp() : void
    {
        parent::setUp();
        $this->user = factory(User::class, 1)->create();
        $this->repository = new UserRepository();
    }

    /** @test */
    public function can_get_users()
    {
        $this->assertCount(1, $this->repository->getAll());
    }

    /** @test */
    public function can_get_user_by_key()
    {
        $user = $this->repository->getItemByKey('id', 1);
        $this->assertNotNull($user);
    }

    /** @test */
    public function can_save_user()
    {
        $user = [
            'username' => 'mbougarne',
            'email' => 'mourad@mbougarne.me',
            'password' => 'password',
        ];

        $save = $this->repository->save($user);
        $this->assertNotNull($save);
    }

    /** @test */
    public function can_update_user()
    {
        $user = User::first();
        $update = $this->repository->update($user, ['username' => 'itri']);
        $this->assertTrue($update);
    }

    /** @test */
    public function can_delete_user()
    {
        $user = User::first();
        $update = $this->repository->delete($user);
        $this->assertTrue($update);
    }
}
