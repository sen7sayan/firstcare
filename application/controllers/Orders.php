<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	public function index($userid=0)
	{	
		if ($userid == 0) {
			$allOdrs = $this->db->order_by("id","desc")->get("orders")->result();
		}
		else
		{
			$allOdrs = $this->db->where("userid",$userid)->order_by("id","desc")->get("orders")->result();	
		}
		
		$this->load->view("admin/orderSetting",["allOdrs"=>$allOdrs]);	
	}
	public function billing($odrId)
	{
		$odrInfo = $this->db->where("id",$odrId)->get("orders")->row();
		$this->load->view("admin/billing",["odrInfo"=>$odrInfo]);	
	}

	
}
