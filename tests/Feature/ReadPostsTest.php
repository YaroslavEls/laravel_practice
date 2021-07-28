<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadPostsTest extends TestCase
{
    use DatabaseMigrations;

    protected $post;

    public function setUp() :void
    {
        parent::setUp();

        $this->post = Post::factory()->create();
    }

    /** @test */
    public function a_user_can_view_all_posts()
    {
        $response = $this->get('/');
        $response->assertSee($this->post->title);
    }

    /** @test */
    public function a_user_can_view_a_single_post()
    {
        $response = $this->get('posts/' .$this->post->slug);
        $response->assertSee($this->post->title);
    }

    /** @test */
    function a_user_can_read_comments_that_are_associated_with_a_post()
    {
        $comment = Comment::factory()->create(['post_id' => $this->post->id]);

        $response = $this->get('posts/' . $this->post->slug);
        $response->assertSee($comment->body);
    }
}
