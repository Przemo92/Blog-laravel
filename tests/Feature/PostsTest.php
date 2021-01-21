<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Http\Controllers\PostsController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /** @test */
    public function the_posts_show_route_can_be_accessed()
    {
        $this->withoutExceptionHandling();
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
}
