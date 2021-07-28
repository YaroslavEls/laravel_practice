<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Comment;

class AddCommentsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_unauthenticated_users_may_not_leave_comments()
    {
        $post = Post::factory()->create();
        $comment = Comment::factory()->create();

        $this->post('posts/'.$post->slug.'/comments', $comment->toArray());

        $this->get('posts/'.$post->slug)->assertDontSee($comment->body);
    }

    /** @test */
    function an_authenticated_user_may_leave_comments()
    {
        $this->signIn();

        $post = Post::factory()->create();
        $comment = Comment::factory()->create();

        $this->post('posts/'.$post->slug.'/comments', $comment->toArray());

        $this->get('posts/'.$post->slug)->assertSee($comment->body);
    }
}
