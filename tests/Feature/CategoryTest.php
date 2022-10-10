<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetCategory()
    {
        User::factory()->create();
        Category::factory()->create();

        $this->get('api/category')->assertStatus(200);
    }

    public function testStoreCategory()
    {
        User::factory()->create();
        $data = Category::factory()->create();

        $this->post('api/category', $data->getRawOriginal())->assertStatus(201);
    }

    public function testUpdateCategory()
    {
        User::factory()->create();
        $data = Category::factory()->create();

        $update = [
            'name' => $this->faker->name(),
            'id_user' => 1
        ];

        $this->put("api/category/$data->id", $update)->assertStatus(200);
    }

    public function testShowDetailCategory()
    {
        User::factory()->create();
        $data = Category::factory()->create();

        $this->get("api/category/$data->id")->assertStatus(200);
    }

    public function testDeleteCategory()
    {
        User::factory()->create();
        $data = Category::factory()->create();

        $this->delete("api/category/$data->id")->assertStatus(200);
    }

}
