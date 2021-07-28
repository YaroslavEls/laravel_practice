<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreatePostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test  */
    public function non_admin_can_not_create_posts()
    {
        $user = User::factory()->create();
        $this->be($user);

        $this->get('admin/posts/create')->assertStatus(403);
    }

    /** @test  */
    public function an_admin_can_create_posts()
    {
        $user = User::factory()->create(['username' => 'asd']);
        $this->be($user);

        $this->get('admin/posts/create')->assertStatus(200);
    }
}
