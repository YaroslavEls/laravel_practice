<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Comment;
use App\Models\User;

class CommentsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function comment_has_an_author()
    {
        $comment = Comment::factory()->create();

        $this->assertInstanceOf(User::class, $comment->author);
    }

    /** @test */
    function comment_is_associated_with_a_post()
    {
        $comment = Comment::factory()->create();

        $this->assertInstanceOf(Post::class, $comment->post);
    }
}
