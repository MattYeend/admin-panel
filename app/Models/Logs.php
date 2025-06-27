<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Logs extends Model
{
    // Log in/out
    public const ACTION_LOGIN = 1;
    public const ACTION_LOGOUT = 2;
    
    // User logs
    public const ACTION_CREATE_USER = 3;
    public const ACTION_UPDATE_USER = 4;
    public const ACTION_DELETE_USER = 5;
    public const ACTION_VIEW_USERS = 6;
    public const ACTION_SHOW_USER = 7;
    public const ACTION_REINSTATE_USER = 8;
    public const ACTION_WELCOME_EMAIL_SENT = 9;
    public const ACTION_CONFIRM_PASSWORD = 10;
    public const ACTION_FORGOT_PASSWORD = 11;
    public const ACTION_NEW_PASSWORD = 12;
    public const ACTION_REGISTER_USER = 13;
    
    // Login logs
    public const ACTION_LOGIN_FAILED = 14;
    public const ACTION_LOGIN_PASSWORD_FAILED = 15;
    public const ACTION_LOGIN_EMAIL_FAILED = 16;
    public const ACTION_LOGIN_USERNAME_FAILED = 17;
    public const ACTION_LOGIN_SUCCESS = 18;
    
    // Reset logs
    public const ACTION_RESET_PASSWORD = 19;
    public const ACTION_RESET_EMAIL = 20;
    public const ACTION_RESET_USERNAME = 21;
    
    // Verify user
    public const ACTION_VERIFY_USER = 22;
    
    // Password change
    public const ACTION_PASSWORD_CHANGED = 23;
    
    // MFA (multi-factor authentication)
    public const ACTION_MFA_ENABLED = 24;
    public const ACTION_MFA_DISABLED = 25;
    
    // Profile logs
    public const ACTION_PROFILE_UPDATED = 26;
    public const ACTION_PROFILE_DELETED = 27;
    
    // Update email
    public const ACTION_EMAIL_UPDATED = 28;
    
    // Assign role
    public const ACTION_ROLE_ASSIGNED = 29;
    
    // Permission logs
    public const ACTION_PERMISSION_GRANTED = 30;
    public const ACTION_PERMISSION_REVOKED = 31;
    
    // Error logs
    public const ACTION_GENERAL_ERROR = 32;
    public const ACTION_FOUR_HUNDRED_ERROR = 33;
    public const ACTION_FOUR_ZERO_THREE_ERROR = 34;
    public const ACTION_FOUR_ZERO_FOUR_ERROR = 35;
    public const ACTION_FOUR_ONE_NINE_ERROR = 36;
    public const ACTION_FOUR_TWO_NINE_ERROR = 37;
    public const ACTION_FIVE_HUNDRED_ERROR = 38;
    public const ACTION_FIVE_ZERO_THREE_ERROR = 39;
    
    // Clear cache
    public const ACTION_CLEAR_CACHE = 40;

    protected $table = 'logs';

    protected $fillable = [
        'action_id',
        'data',
        'logged_in_user_id',
        'related_to_user_id',
    ];

    protected $casts = [
        'data' => 'string',
    ];

    public function loggedInUser()
    {
        return $this->belongsTo(User::class, 'logged_in_user_id');
    }

    public function relatedToUser()
    {
        return $this->belongsTo(User::class, 'related_to_user_id');
    }

    public static function log(
        $action = 0,
        $data = null,
        $logged_in_user_id = null,
        $related_to_user_id = null
    ) {
        if (isset($action)) {
            $logged_in_user_id = $logged_in_user_id ?? Auth::id();

            if (is_array($data)) {
                $data = json_encode($data);
            } elseif (! is_null($data)) {
                throw new \InvalidArgumentException(
                    'Data must be an array or null.'
                );
            }

            $log = new self();
            $log->logged_in_user_id = $logged_in_user_id;
            $log->action_id = $action;
            $log->related_to_user_id = $related_to_user_id;
            $log->data = $data;
            $log->save();
        }
    }
}
