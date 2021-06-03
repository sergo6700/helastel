<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_a_book_can_be_added()
    {
        $user = new User(array('name' => 'John'));
        $this->be($user);
        $this->withoutExceptionHandling();
        $response = $this->post('/api/books/add', [
            'full_name' => 'test' . rand(),
            'user_id' => 1,
            'email' => 'jexample@gmail.com',
            'phone' => '123456789'
        ]);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_a_book_can_be_update()
    {
        $user = new User(array('name' => 'John'));
        $this->be($user);
        $this->withoutExceptionHandling();
        $book_id = Book::factory()->create()->id;
        $response = $this->post("/api/books/update/$book_id",[
            'full_name' => 'example' . rand(),
            'email' => 'email@email.com',
            'phone' => '123456789'
        ]);
        $this->assertTrue(Book::findOrFail($book_id) != null);
        $response->assertJson([
            'success' => true,
        ]);
        $response->assertStatus(200);
    }

    public function test_that_a_book_can_be_deleted()
    {
        $user = new User(array('name' => 'John'));
        $this->be($user);
        $this->withoutExceptionHandling();
        Book::factory()->times(5)->create();
        $id_to_be_deleted = random_int(1, 5);
        $this->delete("/api/books/delete/$id_to_be_deleted/");
        $this->assertDatabaseMissing('books', ['id' => $id_to_be_deleted]);
    }
}
