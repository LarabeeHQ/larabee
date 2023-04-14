<?php

namespace App\Enums;

enum UserRole: string
{
    case ROLE_OWNER = 'OWNER';
    case ROLE_ADMIN = 'ADMIN';
    case ROLE_USER = 'USER';
}
