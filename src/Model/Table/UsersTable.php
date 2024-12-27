<?php

namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Http\Exception\BadRequestException;
use Cake\Http\Exception\UnauthorizedException;
use RestApi\Model\Table\RestApiTable;

class UsersTable extends RestApiTable
{
    public function getUserGroup($uid): ?int
    {
        $u = $this->_getFirst($uid);
        return $u->group_id ?? null;
    }

    private function _getFirst($uid)
    {
        return $this->findById($uid)
            ->firstOrFail();
    }

    public function getDependentUserIDs($uID): array
    {
        return [];
    }

    public function getUserByEmailOrNew(array $data)
    {
        $usr = $this->find()->where(['email' => $data['email']])->first();
        if (!$usr) {
            $usr = $this->newEmptyEntity();
            $usr = $this->patchEntity($usr, $data);
        }
        return $usr;
    }

    public function getForLti($uid): array
    {
        return [
            'user_id' => $uid,
            'name' => 'Arnold Schwartz',
            'family_name' => 'Schwartz',
            'given_name' => 'Arnold',
            'https://purl.imsglobal.org/spec/lti/claim/roles' => [],
            'https://purl.imsglobal.org/spec/lti/claim/custom' => [],
            'https://purl.imsglobal.org/spec/lti/claim/context' => [],
        ];
    }

    public function checkLogin(array $data)
    {
        $email = $data['username'] ?? '';
        if (!$email) {
            throw new BadRequestException('Username is required');
        }
        $pass = $data['password'] ?? '';
        if (!$pass) {
            throw new BadRequestException('Password is required');
        }
        $usr = $this->find()
            ->where(['email' => $email])
            ->first();
        if (!$usr) {
            throw new UnauthorizedException('User not found ' . $email);
        }
        if (!(new DefaultPasswordHasher)->check($pass, $usr->password)) {
            throw new UnauthorizedException('Invalid password');
        }
        return $usr;
    }
}
