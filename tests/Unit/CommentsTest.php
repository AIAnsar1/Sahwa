<?php

namespace Tests\Unit;

use Tests\TestCase; // <- Laravel TestCase
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use App\Models\Comments;


class CommentsTest extends TestCase
{
    use RefreshDatabase;

    private function makeModel(array $overrides = []): Comments
    {
        return Comments::factory()->make($overrides);
    }

    private function createModel(array $overrides = []): Comments
    {
        return Comments::factory()->create($overrides);
    }

    public function test_can_create_model(): void
    {
        $model = $this->makeModel();
        $this->assertInstanceOf(Comments::class, $model);
    }

    public function test_can_store_model(): void
    {
        $model = $this->createModel();
        $this->assertDatabaseHas('comments', ['id' => $model->id]);
    }

    public function test_can_update_model(): void
    {
        $model = $this->createModel();
        $model->update(['content' => 'Updated content']);
        $this->assertEquals('Updated content', $model->fresh()->content);
    }

    public function test_can_delete_model(): void
    {
        $model = $this->createModel();
        $model->delete();
        // change crud_generators to your migration name
        $this->assertDatabaseMissing('comments', [
            'id' => $model->id,
        ]);
    }

    public function test_can_find_model(): void
    {
        $model = $this->createModel();
        $found = Comments::find($model->id);
        $this->assertNotNull($found);
        $this->assertEquals($model->id, $found->id);
    }
}
