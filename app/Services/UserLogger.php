<?php

namespace App\Services;

use App\Models\Logs;
use App\Models\User;
class UserLogger
{
     /**
     * Create a new class instance.
     */
    public function __construct()
    {
        // Empty
    }

    /**
     * Index method to log viewing all users.
     */
    public function index(int $userId): array
    {
        return $this->log(
            Logs::ACTION_VIEW_USERS,
            [
                'Viewed all departments',
            ],
            $userId,
        );
    }

    /**
     * Log showing a specific user.
     */
    public function show(User $user, int $userId): array
    {
        return $this->log(
            Logs::ACTION_SHOW_USER,
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'department_id' => $user->department_id,
                'job_id' => $user->job_id,
            ],
            $userId,
        );
    }

    /**
     * Log creating a new user.
     */
    public function create(User $user, int $userId): array
    {
        return $this->log(
            Logs::ACTION_CREATE_USER,
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'department_id' => $user->department_id,
                'created_by' => $user->created_by,
                'created_at' => $user->created_at,
            ],
            $userId,
        );
    }

    /**
     * Log updating an existing user.
     */
    public function update(User $user, int $userId): array
    {
        return $this->log(
            Logs::ACTION_UPDATE_USER,
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'department_id' => $user->department_id,
                'job_id' => $user->job_id,
                'updated_by' => $user->updated_by,
                'updated_at' => $user->updated_at,
            ],
            $userId,
        );
    }

    /**
     * Log deleting a user.
     */
    public function delete(User $user, int $userId): array
    {
        return $this->log(
            Logs::ACTION_DELETE_USER,
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'department_id' => $user->department_id,
                'job_id' => $user->job_id,
                'deleted_by' => $user->deleted_by,
                'deleted_at' => $user->deleted_at,
            ],
            $userId,
        );
    }

    /**
     * Log restoring a user.
     */
    public function restore(User $user, int $userId): array
    {
        return $this->log(
            Logs::ACTION_REINSTATE_USER,
            [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'department_id' => $user->department_id,
                'job_id' => $user->job_id,
                'restored_at' => $user->restored_at,
                'restored_by' => $user->restored_by,
            ],
            $userId,
        );
    }

    /**
     * Log viewing archived users.
     */
    public function archived(int $userId): array
    {
        return $this->log(
            Logs::ACTION_VIEW_ARCHIVED_USERS,
            [
                'Viewed archived users',
            ],
            $userId,
        );
    }

    /**
     * Helper method to log actions.
     */
    private function log(string $action, array $data, int $userId): array
    {
        $log = Logs::log($action, $data, $userId);
        return is_array($log) ? $log : [];
    }
}
