<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\Category;
use Tests\TestCase;
use App\Models\User;

class ArticlePageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testPageArticleAccess()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/article')->assertStatus(200);
    }

    public function testCreateArticle()
    {
        $user = User::factory()->create();
        Category::factory()->create();
        $article = [
            'title' => 'ini judul',
            'content' => 'ini content',
            'id_user' => 1,
            'id_category' => 1
        ];
        $this->actingAs($user)->post('article', $article)->assertStatus(201);        
    }

    public function testUpdateArticle()
    {
        $user = User::factory()->create();
        Category::factory()->create();
        $article = Article::factory()->create();
        $update = [
            'title' => 'ini judul',
            'content' => 'ini content',
            'id_user' => 1,
            'id_category' => 1
        ];
        $this->actingAs($user)->post("article/$article->id", $update)->assertStatus(200);
    }

    public function testDeleteArticle()
    {
        $user = User::factory()->create();
        Category::factory()->create();
        $article = Article::factory()->create();
        $this->actingAs($user)->delete("article/$article->id")->assertStatus(200);
    }
}
