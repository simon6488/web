<?php
declare(strict_types=1);

namespace App\Service\Impls;


use App\Constants\ErrorCode;
use App\Constants\UserErrorCode;
use App\Dao\UserDao;
use App\Exception\ApiException;
use App\Exception\UserException;
use App\Request\UserRequest;
use App\Service\CacheService;
use App\Service\Interfaces\UserImplInterface;
use Hyperf\Di\Annotation\Inject;

class UserImpl extends BaseImpl implements UserImplInterface
{
    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

    /**
     * @Inject()
     * @var UserRequest
     */
    protected $userRequest;

    public function create(array $data): bool
    {
        $data = $this->userRequest->createValidate($data);
        $data = $this->_getUserTemplate($data);
        $user = $this->userDao->findUserByUsername($data['username']);
        if ($user) {
            throw new UserException(UserErrorCode::USER_EXIST);
        }
        return $this->userDao->create($data);
    }

    private function _getUserTemplate(array $data): array
    {
        return [
            'nickname' => $data['nickname'] ?? '',
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'mobile' => $data['mobile'] ?? '',
            'status' => $data['status'] ?? 0,
            'open_id' => $data['open_id'] ?? ''
        ];
    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function findOne(int $id): array
    {
        // TODO: Implement findOne() method.
    }

    public function findPaginate(array $data): array
    {
        // TODO: Implement findPaginate() method.
    }

    public function delete(int $id): array
    {
        // TODO: Implement delete() method.
    }

    public function login(array $data): array
    {
        $data = $this->userRequest->loginValidate($data);
        $user = $this->userDao->findUserByUsername($data['username']);
        if (!$user || !password_verify($data['password'], $user['password'])) {
            throw new UserException(UserErrorCode::USER_OR_PASSWORD_IS_WRONG);
        }

        if ($user['status']) {
            throw new UserException(UserErrorCode::USER_FROZEN);
        }

        $token = md5(json_encode($user, JSON_UNESCAPED_UNICODE));
        $value['token'] = $token;
        CacheService::setex($token, $value, 3600);
        return $value;
    }

    public function logout(): bool
    {
        // TODO: Implement logout() method.
    }
}