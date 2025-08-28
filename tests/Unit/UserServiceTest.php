<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateModel()
    {
        $repo = new UserRepository(new User());
        $service = new UserService($repo);

        $data = [
            'name' => 'Service User',
            'username' => 'serviceuser',
            'date' => '2000-01-05',
            'email' => 'service@example.com',
            'phone' => '+70000000005',
            'address' => json_encode(['city' => 'Service City']),
            'password' => 'plainpassword',
        ];

        $user = $service->createModel($data);

        $this->assertDatabaseHas('users', ['email' => 'service@example.com']);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('plainpassword', $user->password));
    }

    public function testUpdateModel()
    {
        $repo = new UserRepository(new User());
        $service = new UserService($repo);

        $user = $service->createModel([
            'name' => 'Old Service',
            'username' => 'oldservice',
            'date' => '2000-01-06',
            'email' => 'oldservice@example.com',
            'phone' => '+70000000006',
            'address' => json_encode(['city' => 'Old Service City']),
            'password' => 'oldpassword',
        ]);

        $updated = $service->updateModel([
            'name' => 'New Service',
            'username' => 'oldservice',
            'date' => '2000-01-06',
            'email' => 'oldservice@example.com',
            'phone' => '+70000000006',
            'address' => json_encode(['city' => 'Old Service City']),
            'password' => 'newpassword',
        ], $user->id);

        $this->assertEquals('New Service', $updated->name);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('newpassword', $updated->password));
    }
}
