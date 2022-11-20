<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\UserAction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Arr;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response|bool
    {
        /** @var string[] $permissions */
        $permissions = Arr::get($user->permissions, 'settings::user', []);

        return in_array(UserAction::READ->value, $permissions);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response|bool
    {
        return $this->viewAny($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response|bool
    {
        /** @var string[] $permissions */
        $permissions = Arr::get($user->permissions, 'settings::user', []);

        return in_array(UserAction::CREATE_UPDATE->value, $permissions);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response|bool
    {
        return $this->create($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response|bool
    {
        /** @var string[] $permissions */
        $permissions = Arr::get($user->permissions, 'settings::user', []);

        return in_array(UserAction::DELETE->value, $permissions);
    }
}
