<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Http\Controllers\PostsController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class PostsTest extends TestCase
{
    /** @test */
    public function the_posts_show_route_can_be_accessed()
    {
       // $this->withoutExceptionHandling();
        // Arrange
        // Dodajmy do bazy danych wpis
        $post = Post::factory()->create([

            'title' => 'Wrabiał krowę w morderstwo cioci',
        ]);

        // Act
        // Wykonajmy zapytanie pod adres wpisu
        $response = $this->get('/posts/' . $post->id);

        // Assert
        // Sprawdźmy że w odpowiedzi znajduje się tytuł wpisu
        $response->assertStatus(200)
            ->assertSeeText('Wrabiał krowę w morderstwo cioci');
    }
    /** @test */
    public function the_body_attribute_is_shown_on_the_posts_show_view()
    {
        $post = Post::factory()->create([
            'body' => 'Mroczna tajemnica mordu w oborze długo spędzała sen z oczu policjantom z Lublina. Kto zabił 88-letnią kobietę i jej krowę?',
        ]);

        $response = $this->get('/posts/' . $post->id);

        $response->assertSeeText('Mroczna tajemnica mordu w oborze długo spędzała sen z oczu policjantom z Lublina. Kto zabił 88-letnią kobietę i jej krowę?');
    }

    /** @test */
    public function only_published_posts_are_shown_on_the_posts_index_view()
    {
        $publishedPost = Post::factory()->create([
            'title' => 'publish Post',
            'published_at' => Carbon::yesterday(),
        ]);

        $unpublishedPost = Post::factory()->create([
            'title' => 'unpublish Post',
            'published_at' => Carbon::tomorrow(),
        ]);

        $response = $this->get('/posts');

        $response->assertStatus(200)
            ->assertSeeText($publishedPost->title)
            ->assertDontSeeText($unpublishedPost->title);
    }
}
