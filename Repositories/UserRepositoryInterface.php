<?php namespace Xtwoend\Component\User\Repositories;


interface UserRepositoryInterface 
{
	/**
     * register new user.
     *
     * @return
     */
    public function register(array $attributes = array());

    /**
     * confirm email by email.
     * @param String $token 
     * @return bolean
     */
    public function confirmByEmail($token);

    /** 
     * Add user role
     * @param Int $id
     * @param String | Array $role
     * @return mixed
     */
    public function addRole($id, $role = null);

    /** 
     * remove user role
     * @param Int $id
     * @param String | Array $role
     * @return mixed
     */
    public function removeRole($id, $role = null);

    /** 
     * ban user
     * @param Int $id
     * @param Datetime $until
     * @return mixed
     */
    public function banUser($id, $until = null);
}