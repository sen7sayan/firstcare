<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Home extends CI_Controller {

	public function index()

	{	
		
		$row["sliderListDesk"] = $this->db->where("status",1)->where("device",1)->or_where("device",3)->order_by("sortNum","asc")->get("imagesliders")->result();
		$row["sliderListmob"] = $this->db->where("status",1)->where("device",2)->or_where("device",3)->order_by("sortNum","asc")->get("imagesliders")->result();
		$row["mainslides"] = $this->db->where("status",1)->order_by("sortNum","asc")->get("imagesliders")->result();

		$row["recentPro"]  = $this->db->where("status",1)->order_by("id","desc")->limit(20)->get("products")->result();

		$row["homeoffersPros"]  = $this->db->select('*')->from('home_pro_offers')->join('products', 'home_pro_offers.product_id = products.id',"left")->where("home_pro_offers.status",1)->get()->result();

		$row["topCats"]  = $this->db->order_by("id","desc")->where("topCategory",1)->limit(12)->get("categories")->result();
		
		$this->load->view('index',$row);
	}
	
	
	public function shop($seoUrl)
	{
		$catInfo = "";
		
		if (empty($seoUrl)) {

			$productList = $this->db->order_by("id","desc")->where("status",1)->get("products")->result();
			

		}

		else{
			$catInfo = $this->Homemodel->categoryInfo($seoUrl);
			if (!empty($catInfo)) {
				$productList = $this->db->order_by("id","desc")->where("status",1)->where("categories",$catInfo->id)->get("products")->result();	
			}
			else{
				$productList = [];
			}

		}
		

		$this->load->view("category-page",["productList"=>$productList,"categoryInfo"=>$catInfo]);
	}

	public function about_us()
	{
		$pageinfo = $this->db->where("id",1)->get("pages")->row();
		$this->load->view("about-us",["pageinfo"=>$pageinfo]);
	}

	public function terms_and_conditions()
	{
		$pageinfo = $this->db->where("id",4)->get("pages")->row();
		$this->load->view("terms-condition",["pageinfo"=>$pageinfo]);
		
	}
	public function privacy_policy()
	{
		$pageinfo = $this->db->where("id",2)->get("pages")->row();
		$this->load->view("privacy_policy",["pageinfo"=>$pageinfo]);
	}
	public function cancellation_and_Refund()
	{
		$pageinfo = $this->db->where("id",3)->get("pages")->row();
		$this->load->view("refund_policy",["pageinfo"=>$pageinfo]);

	}

	public function shipping_and_delivery_policy()
	{
		$pageinfo = $this->db->where("id",5)->get("pages")->row();
		$this->load->view("shipping_and_delivery_policy",["pageinfo"=>$pageinfo]);
		
	}
	public function pageinfo($pageUrl)
	{
		$pageinfo = $this->db->where("seo_url",$pageUrl)->get("pages")->row();
		$this->load->view("pageinfo",["pageinfo"=>$pageinfo]);
	}

	public function contact()
	{
		$this->load->view("contact-us");
	}
	public function not_found()
	{
		$this->load->view("error-404");
	}

}

