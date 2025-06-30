<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Contstants for role IDs against role names
     * Can be used as Role::SUPER_ADMIN, or Role::ADMIN
     */
    public const SUPER_ADMIN = 1;
    public const ADMIN = 2;
    public const USER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'name',
        'slug',
        'email',
        'password',
        'role',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'restored_by',
        'restored_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the unique identifier for the user.
     * This method is used by route model binding to
     * retrieve the user by their slug.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Check to see if the user is a super admin.
     * This method checks if the user's role ID matches the super admin role ID.
     *
     * @return bool
     *
     * @see User for the list of roles and their IDs
     * @see User::SUPER_ADMIN for the super admin role ID
     */
    public function isSuperAdmin(): bool
    {
        return $this->role_id === User::SUPER_ADMIN;
    }

    /**
     * Check to see if the user is an admin.
     * This method checks if the user's role ID matches the admin role ID.
     *
     * @return bool
     *
     * @see User for the list of roles and their IDs
     * @see User::ADMIN for the admin role ID
     */
    public function isAdmin(): bool
    {
        return $this->role_id === User::ADMIN;
    }

    /**
     * Check to see if the user is a user.
     * This method checks if the user's role ID matches the user role ID.
     *
     * @return bool
     *
     * @see User for the list of roles and their IDs
     * @see User::USER for the user role ID
     */
    public function isUser(): bool
    {
        return $this->role_id === User::USER;
    }

    /**
     * Check to see if the user is Admin or higher.
     *
     * @return bool
     *
     * @see Role for the list of roles and their IDs
     * @see User::isSuperAdmin and User::isAdmin
     */
    public function isAtleastAdmin(): bool
    {
        return $this->isSuperAdmin() || $this->isAdmin();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
