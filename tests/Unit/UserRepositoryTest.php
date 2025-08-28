<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserRoles;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser()
    {
        $repo = new UserRepository(new User());
        $data = [
            'name' => 'Test User',
            'username' => 'testuser',
            'date' => '2000-01-01',
            'email' => 'test@example.com',
            'phone' => '+70000000000',
            'address' => json_encode(['city' => 'Test City']),
            'password' => bcrypt('password'),
            'roles' => [
                ['role_code' => 'admin', 'status' => true],
                ['role_code' => 'user', 'status' => false],
            ],
        ];
        $user = $repo->create($data);

        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
        $this->assertDatabaseHas('user_roles', [
            'user_id' => $user->id,
            'role_code' => 'admin',
        ]);
        $this->assertDatabaseHas('user_roles', [
            'user_id' => $user->id,
            'role_code' => 'user',
        ]);
    }

    public function testUpdateUser()
    {
        $repo = new UserRepository(new User());
        $user = $repo->create([
            'name' => 'Old Name',
            'username' => 'olduser',
            'date' => '2000-01-02',
            'email' => 'old@example.com',
            'phone' => '+70000000001',
            'address' => json_encode(['city' => 'Old City']),
            'password' => bcrypt('password'),
        ]);
        $updated = $repo->update([
            'name' => 'New Name',
            'roles' => [
                ['role_code' => 'editor', 'status' => true],
            ],
        ], $user->id);

        $this->assertEquals('New Name', $updated->name);
        $this->assertDatabaseHas('user_roles', [
            'user_id' => $user->id,
            'role_code' => 'editor',
        ]);
    }

    public function testFindByEmail()
    {
        $repo = new UserRepository(new User());
        $repo->create([
            'name' => 'Find Me',
            'username' => 'findme',
            'date' => '2000-01-03',
            'email' => 'find@example.com',
            'phone' => '+70000000002',
            'address' => json_encode(['city' => 'Find City']),
            'password' => bcrypt('password'),
        ]);
        $found = $repo->findByEmail('find@example.com');
        $this->assertNotNull($found);
        $this->assertEquals('find@example.com', $found->email);
    }

    public function testDeleteUser()
    {
        $repo = new UserRepository(new User());
        $user = $repo->create([
            'name' => 'To Delete',
            'username' => 'todelete',
            'date' => '2000-01-04',
            'email' => 'del@example.com',
            'phone' => '+70000000003',
            'address' => json_encode(['city' => 'Delete City']),
            'password' => bcrypt('password'),
        ]);
        $repo->delete($user->id);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
