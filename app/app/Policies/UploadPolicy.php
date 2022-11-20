<?php

declare(strict_types=1);

namespace App\Policies;

use App\Enums\Categories;
use App\Enums\UserAction;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Arr;

class UploadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Categories $category): Response|bool
    {
        /** @var string[] $permissions */
        $permissions = Arr::get($user->permissions, $category->value, []);

        return in_array(UserAction::READ->value, $permissions);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Upload $upload): Response|bool
    {
        if ($user->id === $upload->user_id) {
            return true;
        }

        /** @var string[] $permissions */
        $permissions = Arr::get($user->permissions, $upload->category->value, []);

        return in_array(UserAction::READ->value, $permissions);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Categories $category): Response|bool
    {
        /** @var string[] $permissions */
        $permissions = Arr::get($user->permissions, $category->value, []);

        return in_array(UserAction::CREATE_UPDATE->value, $permissions);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Upload $upload): Response|bool
    {
        /** @var string[] $permissions */
        $permissions = Arr::get($user->permissions, $upload->category->value, []);

        return in_array(UserAction::CREATE_UPDATE->value, $permissions);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Upload $upload): Response|bool
    {
        if ($user->id === $upload->user_id) {
            return true;
        }

        /** @var string[] $permissions */
        $permissions = Arr::get($user->permissions, $upload->category->value, []);

        return in_array(UserAction::DELETE->value, $permissions);
    }
}
