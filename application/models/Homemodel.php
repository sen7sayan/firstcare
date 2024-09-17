<?php 

class Homemodel extends CI_Model {

	public function allsliders()
	{
		return $this->db->order_by("sortNum","asc")->get("imagesliders")->result();	
	}
	// Cat Products
	public function catProduct($url,$limit=0)
	{
		if ($limit !=0) {
			return $this->db->order_by("id","desc")->where("categories",$url)->limit($limit)->get("products")->result();
		}
		else
		{
			return $this->db->order_by("id","desc")->where("categories",$url)->get("products")->result();
		}
		
	}
	// Cat Products
	public function catList()
	{
		return $this->db->order_by("id","asc")->get("categories")->result();		
	}
	public function categoryInfo($url)
	{
		return $this->db->where("seo_url",$url)->get("categories")->row();
	}
	public function categoryInfoById($id)
	{
		return $this->db->where("id",$id)->get("categories")->row();
	}

}