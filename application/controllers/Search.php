<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function key($q)
	{
		// echo "Got the query";
		$query = urldecode($q);
	    $CatProducts = $this->db->like('name', $query)->or_like('title', $query)->or_like('productCode', $query)->or_like('categories', $query)->or_like('shortDescription', $query)->or_like('longDescription', $query)->or_like('featurePoints', $query)->or_like('additionalInfo', $query)->or_like('seo_url', $query)->or_like('mtitle', $query)->or_like('mkeywords', $query)->or_like('mdescription', $query)->get("products")->result();
             
		$catInfo = (object)array(
			"name"=> $query
		);
		$this->load->view("category-page",["productList"=>$CatProducts,"categoryInfo"=>$catInfo,"query"=>$query]);
	}
	
	public function suggestionSearch($q="")
	{
		// echo "Got the query";
		$query = urldecode($q);
		if (!empty($query)) {
			$CatProducts = $this->db->like('name', $query)->or_like('title', $query)->or_like('productCode', $query)->or_like('categories', $query)->or_like('shortDescription', $query)->or_like('longDescription', $query)->or_like('featurePoints', $query)->or_like('additionalInfo', $query)->or_like('seo_url', $query)->or_like('mtitle', $query)->or_like('mkeywords', $query)->or_like('mdescription', $query)->where("status",1)->get("products")->result();
		}
		else{
			$CatProducts = $this->db->where("status",1)->order_by("id","desc")->limit(8)->get("products")->result();
		}
	    
             
		foreach ($CatProducts as $product) {
			?>
			<div class="col-md-12 col-sm-6">
	              <div class="p-2">
	                <a href="<?= base_url('product-detail/'.$product->seo_url)?>">
	                    <p class="list-product-title"><i class="w-icon-search mr-2"></i><?= substr($product->name, 0,70) ?>...</p>
	                </a>
	              </div>
	          </div>
			<?php
		}
		
	}

	
}


?>