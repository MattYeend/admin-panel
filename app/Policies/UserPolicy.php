<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any user models.
     *
     * @param User $user The currently authenticated user.
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        unset($user);
        return true;
    }

    /**
     * Determine whether the user can view a specific user model.
     *
     * @param User $user The currently authenticated user.
     * @param User $target The user being viewed.
     *
     * @return bool
     */
    public function view(User $user, User $target): bool
    {
        unset($user, $target);
        return true;
    }

    /**
     * Determine whether the user can create new users.
     *
     * @param User $user The currently authenticated user.
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return $this->hasPrivilegedRole($user);
    }

    /**
     * Determine whether the user can update a specific user.
     *
     * @param User $user The currently authenticated user.
     * @param User $target The user being updated.
     *
     * @return bool
     */
    public function update(User $user, User $target): bool
    {
        // Allow if updating self or has a privileged role
        return $this->isSelf($user, $target) ||
               $this->hasPrivilegedRole($user);
    }

    /**
     * Determine whether the user can delete a specific user.
     *
     * @param User $user The currently authenticated user.
     * @param User $target The user being deleted.
     *
     * @return bool
     */
    public function delete(User $user, User $target): bool
    {
        unset($target); // Only user role is checked
        return $this->hasPrivilegedRole($user);
    }

    /**
     * Determine whether the user can restore a deleted user.
     *
     * @param User $user The currently authenticated user.
     * @param User $target The user being restored.
     *
     * @return bool
     */
    public function restore(User $user, User $target): bool
    {
        unset($target);
        return $this->hasPrivilegedRole($user);
    }

    /**
     * Determine whether the user can permanently delete a user.
     *
     * @param User $user The currently authenticated user.
     * @param User $target The user being permanently deleted.
     *
     * @return bool
     */
    public function forceDelete(User $user, User $target): bool
    {
        unset($target);
        return $this->hasPrivilegedRole($user);
    }

    /**
     * Determine whether the user can view archived users.
     *
     * @param User $user The currently authenticated user.
     *
     * @return bool
     */
    public function viewArchived(User $user): bool
    {
        return $this->hasPrivilegedRole($user);
    }

    /**
     * Helper method to check if the user has a privileged role
     * (admin or high-level staff).
     *
     * @param User $user The user being checked.
     *
     * @return bool
     */
    private function hasPrivilegedRole(User $user): bool
    {
        return $user->isAtleastAdmin();
    }

    /**
     * Helper method to check if the user is the same as the target user.
     *
     * @param User $user The currently authenticated user.
     * @param User $target The target user to compare against.
     *
     * @return bool
     */
    private function isSelf(User $user, User $target): bool
    {
        return $user->id === $target->id;
    }
}
