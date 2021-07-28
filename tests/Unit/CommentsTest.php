<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Comment;
use App\Models\User;

class CommentsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_has_an_owner()
    {
        $comment = Comment::factory()->create();

        $this->assertInstanceOf(User::class, $comment->author);
    }
}
