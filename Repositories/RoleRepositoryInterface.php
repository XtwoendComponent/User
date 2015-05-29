<?php namespace Xtwoend\Component\User\Repositories;


interface RoleRepositoryInterface 
{	
	/**
     * add permission role
     * @param int $role_id
     * @param String | Array $permission
     * @return void 
     */
    public function addPermission($role_id, $permission = null);

    /**
     * remove permission role
     * @param int $role_id
     * @param String | Array $permission
     * @return void 
     */
    public function removePermission($role_id, $permission = null);
}