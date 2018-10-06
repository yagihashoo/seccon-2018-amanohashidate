<?php
/**
 * Created by PhpStorm.
 * User: yagihash
 * Date: 2018/09/27
 * Time: 20:09
 */

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\InvalidRoleIdException;
use Exception;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected static function createUser(int $role_id = User::ROLE_USER): User
    {
        return User::create([
            'name' => str_random(8),
            'password' => Hash::make(str_random(8)),
            'role_id' => $role_id,
        ]);
    }

    public function testUserGeneration()
    {
        $user = self::createUser();
        $this->assertNotNull($user);
    }

    public function testChangeUserRole()
    {
        $user = self::createUser();
        $user->changeRole(User::ROLE_SETTER);
        $this->assertSame($user->role_id, User::ROLE_SETTER);
    }

    public function testChangeUserRoleInvalid()
    {
        $user = self::createUser();
        try {
            $user->changeRole(-1);
        } catch (Exception $e) {
            $this->assertInstanceOf(InvalidRoleIdException::class, $e);
        }
    }

    public function testIsAdmin()
    {
        $user = self::createUser(User::ROLE_ADMIN);
        $this->assertTrue($user->isAdmin());
    }
}
