<?php 

class Adminmodel extends CI_Model {

	// Product
	public function productList()
	{
		return $this->db->order_by("id","desc")->get("products")->result();
	}	
	public function singleProInfo($prId)
	{
		return $this->db->where("id",$prId)->get("products")->row();
	}
	// Product
	public function categoryList()
	{
		return $this->db->order_by("id","desc")->get("categories")->result();
	}

	public function imageList()
	{
		return $this->db->order_by("id","desc")->get("images")->result();
	}

	public function productExtraImgs($pid)
	{
		return $this->db->order_by("sorting","asc")->where("proId",$pid)->get("productimages")->result();
	}

	public function allcategory()
	{
		return $this->db->order_by("id","desc")->get("categories")->result();
	}

	public function categoryInfo($cid)
	{
		return $this->db->where("id",$cid)->get("categories")->row();
	}
	public function allsliders()
	{
		return $this->db->order_by("id","desc")->get("imagesliders")->result();	
	}
	public function slideInfo($sid)
	{
		return $this->db->where("id",$sid)->get("imagesliders")->row();
	}
	public function singleVariableSetInfo($varId)
	{
		return $this->db->where("id",$varId)->get("variables")->row();
	}

	public function updateUser($uid,$data)
	{
		return $this->db->where("id",$uid)->update("users",$data);
	}

}