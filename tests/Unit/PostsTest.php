<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class PostsTest extends TestCase
{
    use DatabaseMigrations;

    protected $post;

    public function setUp() :void
    {
        parent::setUp();

        $this->post = Post::factory()->create();
    }

    /** @test */
    function a_post_has_comments()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->post->comments);
    }

    /** @test */
    function a_post_has_an_author()
    {
        $this->assertInstanceOf(User::class, $this->post->author);
    }

    /** @test */
    function a_post_belongs_to_the_category()
    {
        $this->assertInstanceOf(Category::class, $this->post->category);
    }
}
