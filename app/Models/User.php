<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const USER_STATUS_ACTIVE    = 1;
    const USER_STATUS_BLOCKED   = 0;
    const ADMIN_USER            = 1;
    const CLIENT_USER           = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'referrer_id',
        'name',
        'username',
        'email',
        'phone',
        'password',
        'country',
        'active',
        'package',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['referral_link'];

    /**
     * Get the user's referral link.
     *
     * @return string
     */
    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['ref' => $this->username]);
    }

    /**
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(self::class, 'referrer_id', 'id');
    }

    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(self::class, 'referrer_id', 'id');
    }

    /**
     * A user active referrals.
     *
     * @return active user's referral number
     */
    public function activeReferrals()
    {
        return self::where('referrer_id', Auth::user()->id)
                    ->where('active', self::USER_STATUS_ACTIVE)
                    ->get();
    }

    public function getAllUsers()
    {
        $user = self::all();
        $users_number = count($user) ?? 0;
        return $users_number;
    }

    public function getAllActiveUsers()
    {
        $user = self::where('active',1)->get();
        $users_number = count($user) ?? 0;
        return $users_number;
    }
}
