<?php 

class Productmodel extends CI_Model {

	public function singleProInfo($proUrl)
	{
		return $this->db->where("seo_url",$proUrl)->get("products")->row();
	}

	public function singleProInfoById($pid)
	{
		return $this->db->where("id",$pid)->get("products")->row();
	}
	

	
}