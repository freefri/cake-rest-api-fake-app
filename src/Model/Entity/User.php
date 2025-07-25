<?php

declare(strict_types = 1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected array $_hidden = [
        'deleted',
        'password',
        'access_level',
    ];
}
