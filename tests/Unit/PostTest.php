<?php

namespace Tests\Unit;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function if_the_published_at_is_null_the_post_is_not_published()
    {

        $post = Post::factory()->create([
            'published_at' => null,
        ]);
        $posts = Post::published()->get();

        $this->assertFalse($posts->contains($post));
    }
    /** @test */
    public function if_the_published_at_is_future_the_post_is_not_published()
    {

        $post = Post::factory()->create([
            'published_at' => Carbon::tomorrow(),
        ]);
        $posts = Post::published()->get();

        $this->assertFalse($posts->contains($post));
    }
    /** @test */
    public function if_the_published_at_is_past_the_post_is_not_published()
    {

        $post = Post::factory()->create([
            'published_at' => Carbon::yesterday(),
        ]);
        $posts = Post::published()->get();

        $this->assertTrue($posts->contains($post));
    }
    /** @test */
    public function if_the_published_at_is_now_the_post_is_not_published()
    {

        $post = Post::factory()->create([
            'published_at' => Carbon::now(),
        ]);
        $posts = Post::published()->get();

        $this->assertTrue($posts->contains($post));
    }
}
