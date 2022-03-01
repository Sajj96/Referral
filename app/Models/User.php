<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getLevelOneActiveReferrals($id) {
        $referral = DB::table('users','t1')
                        ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                        ->where(DB::raw('t1.id'), DB::raw($id))
                        ->where(DB::raw('t1.active'), DB::raw(self::USER_STATUS_ACTIVE))
                        ->where(DB::raw('t2.active'), DB::raw(self::USER_STATUS_ACTIVE))
                        ->get();

        return $referral;
    }

    public function getLevelOneDownlines($id) {
        $downlines = DB::table('users','t1')
                    ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                    ->select(DB::raw('t2.username as username'),DB::raw('t2.phone as phone'),DB::raw('t2.active as active'))
                    ->where(DB::raw('t1.id'), DB::raw($id))
                    ->get();

        return $downlines;
    }

    public function getLevelTwoActiveReferrals($id) {
        $referral = DB::table('users','t1')
                        ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                        ->leftJoin('users as t3', 't3.referrer_id','=','t2.id')
                        ->where(DB::raw('t1.id'), DB::raw($id))
                        ->where(DB::raw('t1.active'), DB::raw(User::USER_STATUS_ACTIVE))
                        ->where(DB::raw('t2.active'), DB::raw(User::USER_STATUS_ACTIVE))
                        ->where(DB::raw('t3.active'), DB::raw(User::USER_STATUS_ACTIVE))
                        ->get();

        return $referral;
    }

    public function getLevelTwoDownlines($id) {
        $downlines = DB::table('users','t1')
                        ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                        ->leftJoin('users as t3', 't3.referrer_id','=','t2.id')
                        ->select(DB::raw('t3.username as username'),DB::raw('t3.phone as phone'),DB::raw('t3.active as active'))
                        ->where(DB::raw('t1.id'), DB::raw($id))
                        ->get();

        return $downlines;
    }

    public function getLevelThreeActiveReferrals($id) {
        $referral = DB::table('users','t1')
                        ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                        ->leftJoin('users as t3', 't3.referrer_id','=','t2.id')
                        ->leftJoin('users as t4', 't4.referrer_id','=','t3.id')
                        ->where(DB::raw('t1.id'), DB::raw($id))
                        ->where(DB::raw('t1.active'), DB::raw(User::USER_STATUS_ACTIVE))
                        ->where(DB::raw('t2.active'), DB::raw(User::USER_STATUS_ACTIVE))
                        ->where(DB::raw('t3.active'), DB::raw(User::USER_STATUS_ACTIVE))
                        ->where(DB::raw('t4.active'), DB::raw(User::USER_STATUS_ACTIVE))
                        ->get();

        return $referral;
    }

    public function getLevelThreeDownlines($id) {
        $downlines = DB::table('users','t1')
                        ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                        ->leftJoin('users as t3', 't3.referrer_id','=','t2.id')
                        ->leftJoin('users as t4', 't4.referrer_id','=','t3.id')
                        ->select(DB::raw('t4.username as username'),DB::raw('t4.phone as phone'),DB::raw('t4.active as active'))
                        ->where(DB::raw('t1.id'), DB::raw($id))
                        ->get();

        return $downlines;
    }
}
