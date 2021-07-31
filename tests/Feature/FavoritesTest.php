<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_can_not_favorite_anything()
    {
        $this->post('comments/1/favorites')->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_comment()
    {
        $this->signIn();

        $comment = Comment::factory()->create();

        $this->post('comments/' . $comment->id . '/favorites');

        $this->assertCount(1, $comment->favorites);
    }

    /** @test */
    function an_authenticated_user_may_only_favorite_a_comment_once()
    {
        $this->signIn();

        $comment = Comment::factory()->create();

        try {
            $this->post('comments/' . $comment->id . '/favorites');
            $this->post('comments/' . $comment->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $comment->favorites);
    }
}
