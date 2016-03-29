<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Acl extends CI_Model {
	private $tables = [
		'roles'=>'roles',
		'permissions'=>'permissions',
		'role_permissions'=>'role_permissions'
	];
	public function __construct(){
		parent::__construct();
	}
	public function getRole($roleID){
		$where['id'] = $roleID;
		return $this->db->get_where($this->tables['roles'],$where)->row();
	}
	public function getRoles(){

		return $this->db->get($this->tables['roles']);
	}
	public function getPermissionsAll(){
		$query = $this->db->get($this->tables['permissions']);
		foreach($query->result() as $row){
			$data[$row->title] = [
				'key'   => $row->title,
				'value' => 'x',
				'name'  => $row->name,
				'id'    => $row->id

			];
		}
		return $data;
	}
	public function getPermissionsRole($roleID){
		$data = array();
		$where['role'] = $roleID;
		$query = $this->db->get_where($this->tables['role_permissions'],$where);
		foreach($query->result() as $row){
			$key = $this->getPermissionsKey($row->permission);

			if($row->value == 1){
				$v = 1;
			}else{
				$v = 0;
			}
			$data[$key] = [
				'key'   => $key,
				'value' => $v,
				'name'  => $this->getPermissionsName($row->permission),
				'id'    => $row->permission

			];
		}

		$data = array_merge($this->getPermissionsAll(),$data);
		return $data;
	}
	public function removePermissionsRole($roleID,$permissionsID){
		$this->db->simple_query("DELETE FROM role_permissions WHERE role = $roleID AND permission = $permissionsID");
	}
	public function editPermissionsRole($roleID,$permissionsID,$valor){
		$this->db->simple_query("REPLACE INTO role_permissions SET role = $roleID, permission = $permissionsID, value=$valor");
	}
	public function getPermissionsKey($permissionsID){
		$where['id'] = $permissionsID;
		return $this->db->get_where($this->tables['permissions'],$where)->row()->title;
	}
	public function getPermissionsName($permissionsID){
		$where['id'] = $permissionsID;
		return $this->db->get_where($this->tables['permissions'],$where)->row()->name;
	}

	public function insertarRole($role)
    {	
    	$where['role'] = $role;
		$existe = $this->db->get_where($this->tables['roles'],$where)->row();
		if(!$existe){
			$sql = "INSERT INTO roles VALUES (null, ".$this->db->escape($role).")";
			$fds = $this->db->query($sql);
			return true;
		}
		return false;
    }

}