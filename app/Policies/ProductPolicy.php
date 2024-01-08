<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;


    public function updateArticle(User $user)
    {
        return $user->role === config('products.role.admin');
    }

    public function updateAttributes(User $user)
    {
        return $user->role !== config('products.role.admin');
    }
}
