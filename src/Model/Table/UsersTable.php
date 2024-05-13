<?php

namespace App\Model\Table;

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
}
