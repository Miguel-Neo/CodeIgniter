<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Users extends CI_Model {
	function get_users(){
/*
		$this->db->insert('users',[
			'name'=>'back-end'
			]);
//*/
//			/*
			$query = $this->db->get('users');

foreach ($query->result() as $row)
{
	print_r($row);
}
//*/
		//return $this->db->get('users')->row();
	}
	function get_user_details($user_id){
		$where['id'] = $user_id;
		return $this->db->get_where('users',$where)->row();
	}
	function algo(){
		///*
		$this->db->insert('templates',[
			'name'=>'front-end',
			'description'=>'Template front-end',
			'panel'=>'f',
			'default'=>1
			]);
		$this->db->insert('templates',[
			'name'=>'back-end',
			'description'=>'Template back-end',
			'panel'=>'b',
			'default'=>1
			]);
		
		$this->db->where(['id'=>2,'name'=>'back-end'])->update('templates',[
			'description'=>'Template back-end',
			'panel'=>'b',
			'default'=>1
			]);
		
		echo "<pre>";
		print_r($this->db->get('templates')->result());
		//*/
		/*
		$this->template->add_js('template','script1','utf-8',true,true);
		$this->template->add_css('view',['css1','css2'],'print');
		$this->template->add_css('url','http://css2.css','print');
		//*/
	}

}