<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use LDAP\Result;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetArticle()
    {
        $response = $this->get('/api/article');
        $response->assertStatus(200);
    }

    public function testStoreArticle()
    {
        User::factory()->create();
        Category::factory()->create();
        $data = Article::factory()->create();

        $this->post('api/article', $data->getRawOriginal())->assertStatus(Response::HTTP_CREATED);
    }
    
    public function testUpdateArticle()
    {
        User::factory()->create();
        Category::factory()->create();
        $data = Article::factory()->create();

        $update = [
            'title' => 'sembarang',
            'content' => 'ini content',            
            'id_user' => 1,
            'id_category' => 1
        ];

        $this->post("api/article/$data->id", $update)->assertStatus(Response::HTTP_OK);
    }

    public function testShowDetailArticle()
    {
        User::factory()->create();
        Category::factory()->create();
        $data = Article::factory()->create();

        $this->get("api/article/$data->id")->assertStatus(Response::HTTP_OK);
    }

    public function testDeleteArticle()
    {
        User::factory()->create();
        Category::factory()->create();
        $data = Article::factory()->create();

        $this->delete("api/article/$data->id")->assertStatus(Response::HTTP_OK);
    }
}
