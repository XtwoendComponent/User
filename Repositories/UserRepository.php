<?php namespace Xtwoend\Component\User\Repositories;

/**
 * Part of the package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @package    
 * @version    0.1
 * @author     Abdul Hafidz Anshari
 * @license    BSD License (3-clause)
 * @copyright  (c) 2014 
 */

use Xtwoend\Component\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
	/**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return "Xtwoend\\Component\\User\\Entities\\User";
    }


    /**
     * register new user.
     *
     * @return
     */
    public function register(array $attributes = array())
    {   
        $email = explode("@", $attributes['email']);
        $username = $email[0];
        $attributes['username'] = $username;
        
    	return $this->model->create($attributes);
    }

    /**
     * confirm email by email.
     * @param String $token 
     * @return bolean
     */
    public function confirmByEmail($token)
    {   
        $user = $this->model->whereToken($token)->firstOrFail();
        $user->confirmEmail();
        return $user;
    }
    
    /** 
     * Add user role
     * @param Int $id
     * @param String | Array $role
     * @return mixed
     */
    public function addRole($id, $role = null)
    {   
        $user = $this->model->findOrFail($id);
        $user->addRole($role);
    }

    /** 
     * remove user role
     * @param Int $id
     * @param String | Array $role
     * @return mixed
     */
    public function removeRole($id, $role = null)
    {
        $user = $this->model->findOrFail($id);
        $user->removeRole($role);
    }

    /** 
     * ban user
     * @param Int $id
     * @param Datetime $until
     * @return mixed
     */
    public function banUser($id, $until = null)
    {
        $user = $this->model->findOrFail($id);
        $user->ban = true;
        $user->ban_until = $until;
        return $user->save();
    }
}