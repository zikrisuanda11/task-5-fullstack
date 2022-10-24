<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryPageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAccessCategoryPage()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/category')->assertStatus(200);
    }

    public function testCreateCategory()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $this->actingAs($user)->post('category', $category->getRawOriginal())->assertStatus(201);
    }

    public function testUpdateCategory()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $update = Category::factory()->create();
        $this->actingAs($user)->put("category/$category->id", $update->getRawOriginal())->assertStatus(200);
    }

    public function testDeleteCategory()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $this->actingAs($user)->delete("category/$category->id")->assertStatus(200);
    }
}
