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
        if(!$this->user->has_permission('root') ){
            #si no es root no podra ver el permiso root
            $this->db->where('name !=', 'root');
        }
        return $this->db->get($this->tables['permissions'])->result();
    }
    public function getPermisoname($name){
        $row = $this->db->get_where($this->tables['permissions'],['name'=>$name])->row_array();
        return  $row;
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
    /**
     * 
     * @param type $permission array asociativo 
     */
    public function insertpermission($permission){
        $where['name'] = $permission['name'];
        $existe = $this->db->get_where($this->tables['permissions'], $where)->row();
        if (!$existe) {
            $this->db->insert($this->tables['permissions'],[
                'title'=>$permission['title'],
                'name'=>$permission['name']
            ]);
            return true;
        }
        return false;
    }
    public function eliminarpermiso($IDpermission){
        if($this->db->delete($this->tables['permissions'], array('id' => $IDpermission))){
            $this->db->delete($this->tables['user_permissions'], array('permission' => $IDpermission));
            $this->db->delete($this->tables['role_permissions'], array('permission' => $IDpermission));
            return true;
        }else{
            return false;
        }
    }
    
}
