<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Permissions extends CI_Model {

    private $tables = [
        'roles' => 'acl_roles',
        'permissions' => 'acl_permissions',
        'role_permissions' => 'acl_role_permissions',
        'user_permissions'=>'acl_user_permissions',
        'users'=>'acl_users'
    ];

    public function __construct() {
        parent::__construct();
    }
    

/*****************************************************************************/    
    
    
    
    public function getPermissions() {
        return $this->db->get($this->tables['permissions'])->result();
    }
    public function editPermissions($permission){
        $id = $permission['id'];
        $title = $permission['title'];
        $name = $permission['name'];
        $this->db->query(
                "replace into ".$this->tables['permissions']." set " .
                "id = $id , title = '$title', name ='$name'"
        );
    }
    public function insertpermission($permission){
        $this->db->insert($this->tables['permissions'],[
            'title'=>$permission['title'],
            'name'=>$permission['name']
        ]);
    }
    public function eliminarpermiso($IDpermission){
        if($this->db->delete($this->tables['permissions'], array('id' => $IDpermission))){
            return true;
        }else{
            return false;
        }
    }
    
}