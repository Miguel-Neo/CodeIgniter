<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Users extends CI_Model {

    private $tables = [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'role_permissions' => 'role_permissions'
    ];

    public function __construct() {
        parent::__construct();
    }
    function setUser(){
         $this->load->helper('date');
         date_default_timezone_set('America/Mexico_City');
	$now = time();
        ///*
        $this->db->insert('users',[
            'name'=>'back-end',
              'created_at'=>unix_to_human($now, TRUE, 'eu')// Es un formato Europeo 24 horas y con seconds
          ]);
        //*/
    }
    function get_users() {
        $this->load->helper('date');
        /*
          SELECT * FROM wp_posts
WHERE post_date >= '2014-03-19 00:00:00'
AND post_date <= '2014-03-19 23:59:59'
AND post_status = 'publish'
ORDER BY post_date ASC
          // */
//			/*
        
        date_default_timezone_set('America/Mexico_City');
	$fechaDeRegistro = time();
        
$now = time();
echo unix_to_human($fechaDeRegistro, TRUE,'eu'); // Euro time with seconds
 echo '<br>';
echo unix_to_human($now, TRUE, 'us'); // U.S. time with seconds
 echo '<br>';
echo unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
echo '<br>';
$datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
$time = time();
echo mdate($datestring, $time);
          echo '<br>';
        print_r(time());
        echo '<br>';
        print_r(date('Y'));
        echo '<br>';
        echo '<br>';
       $query = $this->db->query("SELECT * FROM users
WHERE created_at >= '2016-04-01 11:00:00'
AND created_at <= '2016-04-02 23:59:59'
ORDER BY created_at ASC");
       
       $query = $this->db->query("SELECT  * FROM users
");

foreach ($query->result() as $row)
{
    print_r($row);
}
//*/
        //return $this->db->get('users')->row();
    }

    function get_user_details($user_id) {
        $where['id'] = $user_id;
        return $this->db->get_where('users', $where)->row();
    }

    function algo() {
        ///*
        $this->db->insert('templates', [
            'name' => 'front-end',
            'description' => 'Template front-end',
            'panel' => 'f',
            'default' => 1
        ]);
        $this->db->insert('templates', [
            'name' => 'back-end',
            'description' => 'Template back-end',
            'panel' => 'b',
            'default' => 1
        ]);

        $this->db->where(['id' => 2, 'name' => 'back-end'])->update('templates', [
            'description' => 'Template back-end',
            'panel' => 'b',
            'default' => 1
        ]);

        echo "<pre>";
        print_r($this->db->get('templates')->result());
        //*/
        /*
          $this->template->add_js('template','script1','utf-8',true,true);
          $this->template->add_css('view',['css1','css2'],'print');
          $this->template->add_css('url','http://css2.css','print');
          // */
    }

    
/*****************************************************************************/    
    
    
    
    public function getUsuarios() {
        $usuarios = $this->db->query("select u.*,r.role from users u, roles r where u.role = r.id");
        return $usuarios->result();
    }

    public function getUsuario($usuarioID) {
        $usuarios = $this->db->query("select u.name,r.role from users u, roles r where u.role = r.id AND u.id = $usuarioID");
        //echo "<pre>";
        //print_r($usuarios->result_array());
        //exit;
        return $usuarios->row();
    }

    public function getPermissionsAll() {
        $query = $this->db->get($this->tables['permissions']);
        foreach ($query->result() as $row) {
            $data[$row->name] = [
                'permission' => $row->name,
                'title' => $row->title,
                'value' => 'x',
                'inherited' => '',
                'id' => $row->id
            ];
        }
        return $data;
    }

    public function getPermisosUsuario($usuarioID) {
        $User = new User(['id' => $usuarioID, 'lang' => 'spanish']); # CREA ACL CON ID
        //echo "<pre>";
        $data = $User->permissions();
        $data = array_merge($this->getPermissionsAll(), $data);
        //print_r($data);
        //exit;
        return $data;
    }

    public function eliminarPermiso($usuarioID, $permisoID) {
        $this->db->query(
                "delete from user_permissions where " .
                "user = $usuarioID and 	permission = $permisoID"
        );
    }

    public function editarPermiso($usuarioID, $permisoID, $valor) {
        $this->db->query(
                "replace into user_permissions set " .
                "user = $usuarioID , permission = $permisoID, value ='$valor'"
        );
    }

}
