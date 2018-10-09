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
use App\User;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;
use App\Challenge;
use App\Exceptions\VerifiedChallengeException;
use App\Exceptions\SolvedChallengeException;
use Exception;

class ChallengeTest extends TestCase
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

    protected static function createChallenge(User $setter): Challenge
    {
        return Challenge::create([
            'title' => str_random(),
            'model_answer' => '#<svg onload=alert(/XSS/.source)>',
            'setter_id' => $setter->id,
            'file_id' => Uuid::generate(4)->string,
            'from_ip' => '0.0.0.0',
        ]);
    }

    public function testChallengeGeneration()
    {
        $setter = self::createUser(User::ROLE_SETTER);
        $challenge = self::createChallenge($setter);
        $this->assertNotNull($challenge);
    }

    public function testVerifyChallengeSuccess()
    {
        $setter = self::createUser(User::ROLE_SETTER);
        $challenge = self::createChallenge($setter);
        $challenge->verify();
        $this->assertTrue($challenge->verified);
    }

    public function testVerifyChallengeFail()
    {
        $setter = self::createUser(User::ROLE_SETTER);
        $challenge = self::createChallenge($setter);

        try {
            $challenge->verify();
            $challenge->verify();
        } catch (Exception $e) {
            $this->assertInstanceOf(VerifiedChallengeException::class, $e);
        }
    }

    public function testSolveChallengeSuccess()
    {
        $setter = self::createUser(User::ROLE_SETTER);
        $challenge = self::createChallenge($setter);
        $challenge->solve();
        $this->assertTrue($challenge->solved);
    }

    public function testSolveChallengeFail()
    {
        $setter = self::createUser(User::ROLE_SETTER);
        $challenge = self::createChallenge($setter);

        try {
            $challenge->solve();
            $challenge->solve();
        } catch (Exception $e) {
            $this->assertInstanceOf(SolvedChallengeException::class, $e);
        }
    }

}
