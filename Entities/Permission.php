<?php namespace Xtwoend\Component\User\Entities;



use Illuminate\Database\Eloquent\Model;


class Permission extends Model {

    /**
     * Fillable property.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];
    /**
     * Relation to "Role".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('Xtwoend\Component\User\Entities\Role')->withTimestamps();
    }

}