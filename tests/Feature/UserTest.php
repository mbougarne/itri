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

    /** @test */
    public function user_has_create_route()
    {
        $response = $this->get('/users/register');
        $response->assertStatus(200);
    }

    /** @test */
    public function can_create_with_post_method()
    {
        $response = $this->post('/users/register', [
            'username' => 'mourad',
            'email' => 'contact@mbougarne.me',
            'password' => 'password01',
            'password_confirmation' => 'password01',
        ]);

        $response->assertCreated();
    }

    /** @test */
    public function can_update_with_post_method()
    {
        $user = User::first();
        $response = $user->update([
            'username' => 'johnDoe',
            'email' => 'updated@mbougarne.me'
        ]);

        $this->assertTrue($response);
    }

}
