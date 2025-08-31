<?php

namespace Tests\Unit;

use Tests\TestCase; // <- Laravel TestCase
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use App\Models\SocialMedia;


class SocialMediaTest extends TestCase
{
    use RefreshDatabase;

    private function makeModel(array $overrides = []): SocialMedia
    {
        return SocialMedia::factory()->make($overrides);
    }

    private function createModel(array $overrides = []): SocialMedia
    {
        return SocialMedia::factory()->create($overrides);
    }

    public function test_can_create_model(): void
    {
        $model = $this->makeModel();
        $this->assertInstanceOf(SocialMedia::class, $model);
    }

    public function test_can_store_model(): void
    {
        $model = $this->createModel();
        $this->assertDatabaseHas('social_medias', ['id' => $model->id]);
    }

    public function test_can_update_model(): void
    {
        $model = $this->createModel();
        $model->update(['platform' => 'Updated platform']);
        $this->assertEquals('Updated platform', $model->fresh()->platform);
    }

    public function test_can_delete_model(): void
    {
        $model = $this->createModel();
        $model->delete();
        // change crud_generators to your migration name
        $this->assertDatabaseMissing('social_medias', [
            'id' => $model->id,
        ]);
    }

    public function test_can_find_model(): void
    {
        $model = $this->createModel();
        $found = SocialMedia::find($model->id);
        $this->assertNotNull($found);
        $this->assertEquals($model->id, $found->id);
    }
}
