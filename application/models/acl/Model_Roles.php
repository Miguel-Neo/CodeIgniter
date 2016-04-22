<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Roles extends CI_Model {

    private $tables = [
        'roles' => 'acl_roles',
        'permissions' => 'acl_permissions',
        'role_permissions' => 'acl_role_permissions'
    ];

    public function __construct() {
        parent::__construct();
    }

    public function getRole($roleID) {
        $where['id'] = $roleID;
        return $this->db->get_where($this->tables['roles'], $where)->row();
    }

    public function getRoles() {
        $this->db->where('role !=', 'root');
        return $this->db->get($this->tables['roles'])->result_array();
    }

    public function getPermissionsAll() {
        $this->db->where('name !=', 'root');
        
        $query = $this->db->get($this->tables['permissions']);

        foreach ($query->result() as $row) {
            $data[$row->name] = [
                'permission' => $row->name,
                'title' => $row->title,
                'value' => 'x',
                'id' => $row->id,
            ];
        }
        if (!isset($data)) {
            show_error("empty permissions");
        }

        // Si no existe ningun permiso marca error
        return $data;
    }

    public function getPermissionsRole($roleID) {
        $data = array();
        
        $idRoot = $this->_getIdPermission('root');
        $this->db->where('permission !=', $idRoot);
        
        $where['role'] = $roleID;
        
        
        $query = $this->db->get_where($this->tables['role_permissions'], $where);
        foreach ($query->result() as $row) {
            $key = $this->getPermissionsKey($row->permission);

            if ($row->value == 1) {
                $v = 1;
            } else {
                $v = 0;
            }
            $data[$key] = [
                'permission' => $key,
                'title' => $this->getPermissionsTitle($row->permission),
                'value' => $v,
                'id' => $row->permission,
            ];
        }
        $data = array_merge($this->getPermissionsAll(), $data);
        return $data;
    }
    private function _getIdPermission($name){
        $where['name'] = $name;
        return $this->db->get_where($this->tables['permissions'], $where)->row()->id;
    }

    public function removePermissionsRole($roleID, $permissionsID) {
        $this->db->simple_query("DELETE FROM " . $this->tables['role_permissions'] . " WHERE role = $roleID AND permission = $permissionsID");
    }

    public function editPermissionsRole($roleID, $permissionsID, $valor) {
        $this->db->simple_query("REPLACE INTO " . $this->tables['role_permissions'] . " SET role = $roleID, permission = $permissionsID, value=$valor");
    }

    public function editnameRole($roleID, $valor) {
        $data = array('role' => $valor);
        $where = "id = $roleID";
        $sql = $this->db->update_string($this->tables['roles'], $data, $where);

        return $this->db->simple_query($sql);

    }

    public function removeRole($id) {
        $this->db->delete($this->tables['roles'], array('id' => $id));
    }

    public function getPermissionsKey($permissionsID) {
        $where['id'] = $permissionsID;
        return $this->db->get_where($this->tables['permissions'], $where)->row()->name;
    }

    public function getPermissionsTitle($permissionsID) {
        $where['id'] = $permissionsID;
        return $this->db->get_where($this->tables['permissions'], $where)->row()->title;
    }

    public function insertarRole($role) {
        $where['role'] = $role;
        $existe = $this->db->get_where($this->tables['roles'], $where)->row();
        if (!$existe) {
            $sql = "INSERT INTO " . $this->tables['roles'] . " VALUES (null, " . $this->db->escape($role) . ")";
            $fds = $this->db->query($sql);
            return true;
        }
        return false;
    }

}
