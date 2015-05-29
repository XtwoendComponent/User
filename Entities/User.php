<?php namespace Xtwoend\Component\User\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Xtwoend\Component\User\Roles\RoleTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, RoleTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'first_name', 'last_name', 'verified'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'token'];

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->token = str_random(30);
        });
    }

    /**
     * is user verified.
     *
     * @return bolean
     */
    public function isVerified()
    {
        return $this->attributes['verified'];
    }

    /**
     * user is banned
     * @return boolean 
     */
    public function isBan()
    {
        return $this->attributes['ban'];
    }

    /**
     * Confirm the user.
     *
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }

    /**
     * fullname.
     *
     * @return
     */
    public function getFullnameAttribute()
    {
        return $this->attributes['first_name'] .' '.$this->attributes['last_name'];
    }

    /*
     * Friends 
     */
    // friendship that I started
    public function friendsOfMine()
    {
        return $this->belongsToMany( get_class() , 'user_friends', 'user_id', 'user_to')
            ->wherePivot('approved', '=', 'y') // to filter only accepted
            ->withPivot('approved_date','approved');
    }

    // friendship that I started
    public function friendsOfMineNo()
    {
        return $this->belongsToMany( get_class() , 'user_friends', 'user_id', 'user_to')
            ->wherePivot('approved', '=', 'n') // to filter only accepted
            ->withPivot('approved_date','approved');
    }

    // friendship that I was invited to 
    public function friendOf()
    {
        return $this->belongsToMany( get_class() , 'user_friends', 'user_to', 'user_id')
            ->wherePivot('approved', '=', 'y') // to filter only accepted
            ->withPivot('approved_date','approved');
    }

    // friendship that I was invited to 
    public function friendOfNo()
    {
        return $this->belongsToMany( get_class() , 'user_friends', 'user_to', 'user_id')
            ->wherePivot('approved', '=', 'n') // to filter only accepted
            ->withPivot('approved_date','approved');
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();

        return $this->getRelation('friends');
    }

    // load friends
    protected function loadFriends()
    {
        if ( ! array_key_exists('friends', $this->relations))
        {
            $friends = $this->mergeFriends();

            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }
}
