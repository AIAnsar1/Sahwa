<?php

namespace Tests\Unit;

use Tests\TestCase; // <- Laravel TestCase
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use App\Models\Partners;


class PartnersTest extends TestCase
{
    use RefreshDatabase;

    private function makeModel(array $overrides = []): Partners
    {
        return Partners::factory()->make($overrides);
    }

    private function createModel(array $overrides = []): Partners
    {
        return Partners::factory()->create($overrides);
    }

    public function test_can_create_model(): void
    {
        $model = $this->makeModel();
        $this->assertInstanceOf(Partners::class, $model);
    }

    public function test_can_store_model(): void
    {
        $model = $this->createModel();
        $this->assertDatabaseHas('partners', ['id' => $model->id]);
    }

    public function test_can_update_model(): void
    {
        $model = $this->createModel();
        $model->update(['title' => 'Updated title']);
        $this->assertEquals('Updated title', $model->fresh()->title);
    }

    public function test_can_delete_model(): void
    {
        $model = $this->createModel();
        $model->delete();
        // change crud_generators to your migration name
        $this->assertDatabaseMissing('partners', [
            'id' => $model->id,
        ]);
    }

    public function test_can_find_model(): void
    {
        $model = $this->createModel();
        $found = Partners::find($model->id);
        $this->assertNotNull($found);
        $this->assertEquals($model->id, $found->id);
    }
}
