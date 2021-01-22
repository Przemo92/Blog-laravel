<?php

namespace Tests\Feature\Authenticated;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;



class PostsTest extends AuthenticatedTestCase
{
    use RefreshDatabase;
    use WithoutMiddleware; //uzylem tego aby nie wyskakiwal error cfrf token podczas wysylania post

    /** @test */
    public function a_post_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/posts', [
            'published_at' => '2019-11-19 12:00:00',
            'title' => 'Odebrał żelazko zamiast telefonu',
            'body' => 'Miał pomóc żonie, a skończyło się tragedią.',
        ]);

        $this->assertDatabaseHas('posts', [
            'user_id' => $this->user->id,
            'published_at' => '2019-11-19 12:00:00',
            'title' => 'Odebrał żelazko zamiast telefonu',
            'body' => 'Miał pomóc żonie, a skończyło się tragedią.',
        ]);
    }
    /** @test */
    public function the_title_field_is_required()
    {
        $response = $this->post('/posts', [
            'title' => null,
        ]);

        $response->assertSessionHasErrors('title');
    }
    /** @test */
    public function the_title_field_must_be_unique()
    {

        $existingPost = Post::factory()->create([
            'title' => 'rrrrrrrrrrrrrrrrrrrrr',
        ]);

        $response = $this->actingAs($this->user)->post('/posts', [
            'title' => 'rrrrrrrrrrrrrrrrrrrrr',
        ]);

        $response->assertSessionHasErrors('title');
    }
    /** @test */
    public function the_body_is_not_required()
    {
        $response = $this->post('/posts', [
            'body' => null,
        ]);

        $response->assertSessionDoesntHaveErrors('body');
    }
    /** @test */
    public function the_body_must_be_at_least_3_characters()
    {
        $response = $this->post('/posts', [
            'body' => 'aa',
        ]);

        $response->assertSessionHasErrors('body');
    }
    /** @test */
    public function the_published_at_must_be_a_valid_date()
    {
        $response = $this->post('/posts', [
            'published_at' => 'NOT-A-DATE-STRING',
        ]);

        $response->assertSessionHasErrors('published_at');
    }
}