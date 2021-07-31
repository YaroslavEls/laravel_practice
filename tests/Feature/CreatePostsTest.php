<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreatePostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test  */
    public function not_signed_in_user_can_not_create_posts()
    {
        $post = Post::factory()->make();

        $this->post('admin/posts', $post->toArray());

        $this->get('posts/'.$post->slug)->assertDontSee($post->title);
    }

    /** @test  */
    public function signed_in_user_can_create_posts()
    {
        $this->signIn();

        $post = Post::factory()->make();

        $this->post('admin/posts', $post->toArray());

        $this->get('posts/'.$post->slug)->assertSee($post->title);
    }

    /** @test */
    public function a_post_must_have_a_title() {
        $this->signIn();

        $post = Post::factory()->make(['title' => '']);

        $this->post('admin/posts', $post->toArray())->assertSessionHasErrors('title');
    }

    /**
     * @test
     * @dataProvider requiredFormValidationProvider
     */
    public function post_validates_form($formInput, $formInputValue)
    {
        $this->signIn();

        $post = Post::factory()->make([$formInput => $formInputValue]);

        $this->post('admin/posts', $post->toArray())->assertSessionHasErrors($formInput);
    }

    public function requiredFormValidationProvider()
    {
        return [
            ['title', ''],
            ['thumbnail', ''],
            ['slug', ''],
            ['excerpt', ''],
            ['body', ''],
            ['category_id', ''],
        ];
    }
}
