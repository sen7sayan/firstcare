<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	
	function __construct()
		{
			
	        header("Access-Control-Allow-Origin: *");
	        date_default_timezone_set("Asia/Calcutta"); 
			parent::__construct();
			$this->load->library('session');
			$vendorid = $this->session->userdata('adminId');
			if (!isset($vendorid)) {
				$this->session->unset_userdata('adminId');
				redirect('account/admin');
			}
			
		}
		
	/*private function slug($string, $spaceRepl = "-")
		{
		    $string = str_replace("&", "and", $string);

		    $string = preg_replace("/[^a-zA-Z0-9 _-]/", "", $string);

		    $string = strtolower($string);

		    $string = preg_replace("/[ ]+/", " ", $string);

		    $string = str_replace(" ", $spaceRepl, $string);

		    return $string;
		}*/
	public function index()
		{
			$this->load->view('admin/dashboard');
		}

	// product setting 
	public function product_list()
	{
		$allpros = $this->Adminmodel->productList();
		$this->load->view('admin/product_list',["allpros"=>$allpros]);
		
	}

	public function add_products()
	{	
		$allcats = $this->Adminmodel->categoryList();
		$this->load->view('admin/add_new_product',["allcats"=>$allcats]);
		
	}

	public function add_products_data()
	{
		 $mCats = $this->input->post("otherCats");
		 $taxInclude = $this->input->post("taxinclude");
		 
		 if ($this->input->post("cross_products")) {
		 	$crossPros = implode(",", $this->input->post("cross_products"));
		 }
		 else{
		 	$crossPros = "";
		 }

		 $taxes = $this->input->post("taxes");
		 if (isset($mCats) && count($mCats)> 0) {
		 	$moreCats = implode(",", $mCats);
			
		 }
		 else
		 {
		 	$moreCats = "";
		 }

		 if (isset($taxes) && count($taxes)> 0) {
		 	$proTaxes = implode(",", $taxes);
			
		 }
		 else
		 {
		 	$proTaxes = 0;
		 }
		
		if ($taxInclude) {
			$taxInc = 1;
		}
		else
		{
			$taxInc = 0;	
		}
		$seoUrl = url_title($this->input->post("seoUrl"));
		$checkExisted = $this->db->where("seo_url",$seoUrl)->get("products")->result();
		
		if (count($checkExisted) !=0) {
			$randNum = rand(1000,2000);
			$seoUrl = $seoUrl.'-'.count($checkExisted)+$randNum;
		}
		$prName = $this->input->post("proName");
		$prCode = $this->input->post("proCode");
		$pr_hsn_code = $this->input->post("proHsn");
		$prCat = $this->input->post("proCat");
		$prprice = $this->input->post("pPrice");
		$prDisPrice = $this->input->post("disPrice");
		$prFimg = $this->input->post("modalboximage");
		$prType = $this->input->post("protype");
		$prShortDesc = $this->input->post("shortDetails");
		$prlongDesc = $this->input->post("longDetails");
		$prFeaturePt = $this->input->post("featureeDetails");
		$prAdditionalPt = $this->input->post("additionalDetails");
		$prStkSts = $this->input->post("stockstatus");
		$prStkQty = $this->input->post("stockqty");
		$proSlug = $seoUrl;
		$prPageTitle = $this->input->post("ptitle");
		$prMtitle = $this->input->post("mtitle");
		$prMKeywords = $this->input->post("mkeywords");
		$prMDes = $this->input->post("mdescription");
		$min_oq = $this->input->post("moq");
		
        $proData = array(
        	'name' => $prName, 
        	'productCode'=>$prCode,
        	'pro_hsn'=>$pr_hsn_code,
        	'categories' => $prCat,
        	"moreProCats" =>$moreCats,
        	'price' => $prprice, 
        	'disc_price' => $prDisPrice, 
        	'featureImg' => $prFimg, 
        	'proType' => $prType, 
        	'shortDescription' => $prShortDesc, 
        	'longDescription' => $prlongDesc, 
        	'featurePoints' => $prFeaturePt, 
        	'additionalInfo' => $prAdditionalPt, 
        	'stockStatus' => $prStkSts, 
        	'stockQty' => $prStkQty, 
        	'seo_url' => $proSlug, 
        	'title' => $prPageTitle, 
        	'mtitle' => $prMtitle, 
        	'mkeywords' => $prMKeywords, 
        	'mdescription' => $prMDes,
        	'price_tax' =>$taxInc,
        	'taxSlab' =>$proTaxes,
        	'moq' =>$min_oq,
        	'cross_sell_products' => $crossPros,
        	);
        	
        	if ($this->db->insert("products",$proData)) {
        		$this->session->set_flashdata('message', 'Product added successfully.');
            	$this->session->set_flashdata('alrt_class', 'alert-success');
        	}
        	else
        	{
        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
            	$this->session->set_flashdata('alrt_class', 'alert-danger');
        	}
        	redirect("admin/add_products");
	}

	public function edit_products($proId)
	{	
		$singProInfo = $this->Adminmodel->singleProInfo($proId);
		$allcats = $this->Adminmodel->categoryList();
		$this->load->view('admin/edit_product',["allcats"=>$allcats,"proInfo"=>$singProInfo]);
		
	}
	public function edit_product_data()
	{
		$seoUrl = $this->input->post("seoUrl");
		$productId = $this->input->post("proId");
		$proSlug = url_title($seoUrl,"-",true);

		$checkExisted = $this->db->where("seo_url",$proSlug)->get("products")->result();
		
		if(count($checkExisted) > 1)
        {
        	$this->session->set_flashdata('message', 'SEO Url Is already assigned to a product. Please try diffrent ');
            	$this->session->set_flashdata('alrt_class', 'alert-danger');
        }
        else
        {
        	if ($this->input->post("cross_products")) {
			 	$crossPros = implode(",", $this->input->post("cross_products"));
			 }
			 else{
			 	$crossPros = "";
			 }
        	$mCats = $this->input->post("otherCats");
        	$taxInclude = $this->input->post("taxinclude");
		 	$taxes = $this->input->post("taxes");
			 if (isset($mCats) && count($mCats)> 0) {
			 	$moreCats = implode(",", $mCats);
				
			 }
			 else
			 {
			 	$moreCats ="";
			 }
			 if (isset($taxes) && count($taxes)> 0) {
			 	$proTaxes = implode(",", $taxes);
				
			 }
			 else
			 {
			 	$proTaxes = 0;
			 }
			
			if ($taxInclude) {
				$taxInc = 1;
			}
			else
			{
				$taxInc = 0;	
			}

        	$prName = $this->input->post("proName");
        	$prCode = $this->input->post("proCode");
        	$pr_hsn_code = $this->input->post("proHsn");
			$prCat = $this->input->post("proCat");
			$prprice = $this->input->post("pPrice");
			$prDisPrice = $this->input->post("disPrice");
			$prFimg = $this->input->post("modalboximage");
			$prType = $this->input->post("protype");
			$prShortDesc = $this->input->post("shortDetails");
			$prlongDesc = $this->input->post("longDetails");
			$prFeaturePt = $this->input->post("featureeDetails");
			$prAdditionalPt = $this->input->post("additionalDetails");
			$prStkSts = $this->input->post("stockstatus");
			$prStkQty = $this->input->post("stockqty");
			$prSlug = $proSlug;
			$prPageTitle = $this->input->post("ptitle");
			$prMtitle = $this->input->post("mtitle");
			$prMKeywords = $this->input->post("mkeywords");
			$prMDes = $this->input->post("mdescription");
			$min_oq = $this->input->post("moq");
			
	        $proData = array(
	        	'name' => $prName, 
	        	'productCode'=>$prCode,
	        	'pro_hsn'=>$pr_hsn_code,
	        	'categories' => $prCat, 
	        	"moreProCats" =>$moreCats,
	        	'price' => $prprice, 
	        	'disc_price' => $prDisPrice, 
	        	'featureImg' => $prFimg, 
	        	'proType' => $prType, 
	        	'shortDescription' => $prShortDesc, 
	        	'longDescription' => $prlongDesc, 
	        	'featurePoints' => $prFeaturePt, 
	        	'additionalInfo' => $prAdditionalPt, 
	        	'stockStatus' => $prStkSts, 
	        	'stockQty' => $prStkQty, 
	        	'seo_url' => $prSlug, 
	        	'title' => $prPageTitle, 
	        	'mtitle' => $prMtitle, 
	        	'mkeywords' => $prMKeywords, 
	        	'mdescription' => $prMDes,
	        	'price_tax' =>$taxInc,
	        	'taxSlab' =>$proTaxes,
	        	'moq' =>$min_oq,
	        	'cross_sell_products' => $crossPros,
	        	);
	        	
	        	if ($this->db->where("id",$productId)->update("products",$proData)) {
	        		$this->session->set_flashdata('message', 'Product updated successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
	        	redirect("admin/edit_products/".$productId);
        }
	}

	public function deleteproduct($pid)
	{
		if ($this->db->where("id",$pid)->delete("products")) {
			$this->session->set_flashdata('message',"Product is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('message',"Product is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/product_list");
	}
	public function changestatusproduct($pid)
	{
			$singProInfo = $this->Adminmodel->singleProInfo($pid);
            if ($singProInfo->status == 0) {
                $pstatus = 1;
            }
            else{
                $pstatus = 0;
            }

            $proData = array(
	        	'status' => $pstatus,
	        );

            if ($this->db->where("id",$pid)->update("products",$proData)) {
	        		$this->session->set_flashdata('message', 'Product status is changed successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
        	redirect("admin/product_list");
	}

	public function addmoreImages($pid)
	{
		$singProInfo = $this->db->select("name,id")->where("id",$pid)->get("products")->row();
		$proImages = $this->Adminmodel->productExtraImgs($pid);
		$this->load->view('admin/addmoreproImgs',["singProInfo"=>$singProInfo,"proImages"=>$proImages]);	
	}
	public function addmoreImagesData()
	{
		$proId = $this->input->post("productId");
		$imgAlt = $this->input->post("altText");
		$sorted = $this->input->post("sorted");
		$prFimg = $this->input->post("modalboximage");

		$data = array(
			'proId' => $proId, 
			'imagepath' => $prFimg, 
			'alt' => $imgAlt, 
			'sorting'=>$sorted
		);

		if ($this->db->insert("productimages",$data)) {
        		$this->session->set_flashdata('message', 'Image added successfully.');
            	$this->session->set_flashdata('alrt_class', 'alert-success');
        	}
        	else
        	{
        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
            	$this->session->set_flashdata('alrt_class', 'alert-danger');
        	}
        	redirect("admin/addmoreImages/".$proId);

	}
	public function deleteproImage($imgId,$proid)
	{
		if ($this->db->where("id",$imgId)->delete("productimages")) {
			$this->session->set_flashdata('message',"Product Image is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('message',"Product image is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/addmoreImages/$proid");
	}
	public function updateImgPosition()
	{
		$posNum = $this->input->post("imgPos");
		$imgId = $this->input->post("imgId");
		$proid = $this->input->post("proid");
		$data = array(
			'sorting' => $posNum
		);
		 if ($this->db->where("id",$imgId)->update("productimages",$data)) {
	        		$this->session->set_flashdata('message', 'Product postion is changed successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
        	redirect("admin/addmoreImages/".$proid);
	}
		
	// Product Variable setting

	public function productVariableSetting($proId)
	{
			$allValues = $this->db->order_by("id","desc")->get("variables")->result();
			$productVariableList = $this->db->where("proId",$proId)->get("productvaries")->result();
			
			$this->load->view("admin/Productvariablesetting",["productVariableList"=>$productVariableList,"allValues"=>$allValues,"proId"=>$proId]);

	}
	public function addProVarData()
	{
		$productId = $this->input->post("proId");
		$productVariableList = $this->db->where("proId",$productId)->get("productvaries")->result();
		
		if (count($productVariableList) < 3) {
				
				$vValue = $this->input->post("varValues");
				$vId = $this->input->post("varName");

				$varibaleValues = implode(",", $vValue);
				$varInfo = $this->db->where("id",$vId)->get("variables")->row();

				$data = array(
					'proId' => $productId, 
					'varname' => $varInfo->varname, 
					'varvalues' => $varibaleValues, 
					'varId' => $vId, 
					'vartype' =>$this->input->post("varType")
					
				);
				if ($this->db->insert("productvaries",$data)) {
		            	$this->session->set_flashdata('message', 'Product Variable added successfully.');
		        		$this->session->set_flashdata('alrt_class', 'alert-success');
		            }
		            else
		            {
		            	$this->session->set_flashdata('message', $this->db->error());
		        		$this->session->set_flashdata('alrt_class', 'alert-danger');
		            }
		}
		else
		{
			$this->session->set_flashdata('message', "Only Three(3) variables are allowed!");
        		$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		
         redirect("admin/productVariableSetting/".$productId);  

	}
	public function deleteProVariable($varId)
	{
		$productId = $this->db->select("proId")->where("id",$varId)->get("productvaries")->row()->proId;

		if ($this->db->where("id",$varId)->delete("productvaries")) {
			$this->session->set_flashdata('message',"Variable is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}
		else
		{
		   $this->session->set_flashdata('message',"Variable is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/productVariableSetting/".$productId);
	}

	public function editProVariable($vid)
	{
		$proVarInfo = $this->db->where("id",$vid)->get("productvaries")->row();
		$varvalueInfo = $this->db->where("id",$proVarInfo->varId)->get("variables")->row()->varValues;
		$allValues = $this->db->order_by("id","desc")->get("variables")->result();
		$this->load->view("admin/editProvariable",["allValues"=>$allValues,"proVarInfo"=>$proVarInfo,"varvalueInfo"=>$varvalueInfo]);
	}
	
	public function editProVarData()
	{
		
		$proVarId = $this->input->post("proVarId");
		$vValue = $this->input->post("varValues");
		$varibaleValues = implode(",", $vValue);
		$data = array(
			'varvalues' => $varibaleValues, 
		);
		if($this->db->where("id",$proVarId)->update("productvaries",$data)) {
            	$this->session->set_flashdata('message', 'Product Variable updated successfully.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
        }
        else
        {
        	$this->session->set_flashdata('message', $this->db->error());
    		$this->session->set_flashdata('alrt_class', 'alert-danger');
        }
         redirect("admin/editProVariable/".$proVarId);  
	}
	

	public function getVarValues($varId)
	{
		$list = $this->db->where("id",$varId)->get("variables")->row();
		echo $list->varValues;
	}
	public function regenerate($proId)
	{
		if ($this->db->where("proId",$proId)->delete("productvariabledetails")) {
			echo "reset";
		}
		else
		{
			echo "try again";
		}
		
	}
	public function updateVariableValues()
	{
		$varId = $this->input->post("proVariableId");
		$data = array(
			'price' => $this->input->post("pPrice"), 
			'dis_price' => $this->input->post("disPrice"), 
			'stockStatus' => $this->input->post("stockstatus"), 
			'stockQty' => $this->input->post("stockqty"), 
			'productCode' => $this->input->post("proCode"), 
			'description' =>$this->input->post("shortDescription")
		);

		$result = $this->db->where("id",$varId)->update("productvariabledetails",$data);

		if ($result) {
			echo "success";
		}
		else
		{
			echo "failed";
		}
		


	}
	// Product Variable setting

// product setting 

// product Variable setting 
		public function variableSetting()
		{
			$parentArray = array();
			$allValues = $this->db->order_by("id","desc")->get("variables")->result();
			foreach ($allValues as $merging) {
				$currArray = explode(',', $merging->varValues);
				$parentArray = array_merge($parentArray, $currArray);
			}
			 $allUniqueValues = array_unique($parentArray);


			$this->load->view("admin/variablesetting",["parentArray"=>$parentArray ,"allUniqueValues"=>$allUniqueValues,"allValues"=>$allValues]);
		}
		public function addVarData()
		{
			$vValue = $this->input->post("varValues");
			 if (isset($vValue) && count($vValue)> 0) {
			 	$varibaleValues = implode(",", $vValue);
				$data = array(
					'varname' => $this->input->post("vName"),
					'varTypes'=>$this->input->post("vtype"),
					'varValues'=>$varibaleValues
					 );

				 if ($this->db->insert("variables",$data)) {
	                	
	                	$this->session->set_flashdata('message', 'Variable Added successfully.');
	            		$this->session->set_flashdata('alrt_class', 'alert-success');
	                }
	                else
	                {
	                	$this->session->set_flashdata('message', $this->db->error());
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	                }
			 }
			 else
			 {
			 	$this->session->set_flashdata('message', 'Please Enter Variable Values');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
			 }
		 redirect("admin/variableSetting");
		}
		public function editVar($vid)
		{
			$parentArray = array();
			$allValues = $this->db->order_by("id","desc")->get("variables")->result();

			foreach ($allValues as $merging) {
				$currArray = explode(',', $merging->varValues);
				$parentArray = array_merge($parentArray, $currArray);
			}
			 $allUniqueValues = array_unique($parentArray);

			 $singleVarInfo = $this->Adminmodel->singleVariableSetInfo($vid);

			$this->load->view("admin/editvariablesetting",["parentArray"=>$parentArray ,"allUniqueValues"=>$allUniqueValues,"allValues"=>$allValues,"singleVarInfo"=>$singleVarInfo]);
		}
		public function editVarSetData()
		{
			$vValue = $this->input->post("varValues");
			$varId = $this->input->post("varId");
			 if (isset($vValue) && count($vValue)> 0) {
			 	$varibaleValues = implode(",", $vValue);
				$data = array(
					'varname' => $this->input->post("vName"),
					'varTypes'=>$this->input->post("vtype"),
					'varValues'=>$varibaleValues
					 );

				 if ($this->db->where("id",$varId)->update("variables",$data)) {
	                	
	                	$this->session->set_flashdata('message', 'Variable updated successfully.');
	            		$this->session->set_flashdata('alrt_class', 'alert-success');
	                }
	                else
	                {
	                	$this->session->set_flashdata('message', $this->db->error());
	            		$this->session->set_flashdata('alrt_class', 'alert-danger');
	                }
			 }
			 else
			 {
			 	$this->session->set_flashdata('message', 'Please Enter Variable Values');
            	$this->session->set_flashdata('alrt_class', 'alert-danger');
			 }
		 redirect("admin/editVar/$varId");
		}

	public function deleteVariable($varId)
	{
		if ($this->db->where("id",$varId)->delete("variables")) {
		$this->session->set_flashdata('message',"Variable is deleted! ");
		$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}
		else
		{
		   $this->session->set_flashdata('message',"Variable is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/variableSetting");
	}
	// product variable setting 

	// Image setting 
	private function set_upload_options()
	{   
	    //upload an image options
	    $bytes = random_bytes(4);
        $newName =  time().bin2hex($bytes);
	    $config = array();
	    $config['upload_path'] = './uploads/';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|webp|svg';
	    $config['max_size'] = 2048;
	    $config['file_name'] = $newName;
	    return $config;
	}

	private function compress_img($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}

	public function imageSetting()
	{
		$allImages = $this->Adminmodel->imageList();
		$this->load->view("admin/imagesetting",["allImages"=>$allImages]);
	}
	public function addimageDataTest()
	{	
			$imagePath = "";
			$msg = "";
			$msgColor = "bg-danger";
			$status = "";
			$imgName = "";

			$this->load->library('upload');
			$dataInfo = array();
		    $files = $_FILES;
		    $cpt = count($_FILES['userfile']['name']);

		    for($i=0; $i<$cpt; $i++)
		    {           
		        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

		        $this->upload->initialize($this->set_upload_options());
		        $uploadInfo = $this->upload->do_upload('userfile');

		        if ($uploadInfo) {
		        	$dataInfo[] = $this->upload->data();
		            $path = 'uploads/'.$dataInfo[$i]["file_name"];
		            $source_path = base_url().'uploads/'.$dataInfo[$i]["file_name"];
		            $target_path = base_url().'uploads/thumbs';
		            // makingthumb
		          	$this->resizeImage($dataInfo[$i]["file_name"],150,150);	  
		          	$thumPath = 'uploads/thumbs/'.$dataInfo[$i]["raw_name"].'_thumb'.$dataInfo[$i]["file_ext"];
				    
				    // makingthumb
			         $imgdata = array(
		                	'path' => $path,
		                	'thumbnail'=>$thumPath
		                );
		                if ($this->db->insert("images",$imgdata)) {
		                	$imagePath = $path;
		            		$msg = "Image is uploaded successfully!";
		            		$msgColor = "bg-success";
		            		$status = 1;
		                }
		                else
		                {
		                	$imagePath = "";
		                	$msg = "Image is not uploaded! Please try again!";
		                	$msgColor = "bg-danger";
		                	$status = 0;
		                }
		        }
		        else{
		        	$imagePath = "";
	        		$msg =  $this->upload->display_errors();
	        		$msgColor = "bg-danger";
	        		$status = 0;
		        }
		        
		    }
		
		$uploadmsg = array(
					'imgpath' =>$imagePath,

					'msg' =>$msg ,

					'msgColor' => $msgColor,

					'status' => $status,

				 );

		echo json_encode($uploadmsg);		

	}
	public function allimages()
	{
		$setterid =  $this->input->post("setterId");
		
		$imageList = $this->db->order_by("id","desc")->get("images")->result();
		foreach ($imageList as $images) {
			$this->load->view("admin/includes/modal_image_card",["setId"=>$setterid,"imgurl"=>$images->path,"images"=>$images]);
		}
	}
	
	private function resizeImage($filename,$width=150,$height=150)
	   {
	       	$this->load->library('image_lib');
		    $config['image_library']  = 'gd2';
		    $config['source_image']   =  'uploads/'.$filename;       
		    $config['create_thumb']   = TRUE;
		    $config['maintain_ratio'] = TRUE;
		    $config['width']          = $width;
		    $config['height']         = $width;
		    $config['new_image']      = 'uploads/thumbs/'.$filename;
		    $this->image_lib->initialize($config);
		    $this->image_lib->resize();
	   }

	public function deleteImage($imgId)
	{
		$singleImgInfo = $this->db->where("id",$imgId)->get("images")->row();
		$image_path = $singleImgInfo->path;
		$thum_path = $singleImgInfo->thumbnail;
		if ($this->db->where("id",$imgId)->delete("images")) {
			if (file_exists($image_path)) {
				unlink($image_path);
				if (file_exists($thum_path)) {
					unlink($thum_path);
				}
			}
			
			$this->session->set_flashdata('message',"Product Image is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('message',"Product image is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/imageSetting");
	}
	public function delete_multiple_images()
	{
		$imageIds = $this->input->post("imageIds");
		$imagefileArr = $this->db->select("path,thumbnail")->where_in('id', $imageIds)->get("images")->result();
		foreach ($imagefileArr as $imgs) {
			if (file_exists($imgs->path)) {
				unlink($imgs->path);
				if (file_exists($imgs->thumbnail)) {
					unlink($imgs->thumbnail);	
				}
				
			}
		}
		 if (!empty($imageIds)) {
		        if ($this->db->where_in('id', $imageIds)->delete('images')) {
		        	$this->session->set_flashdata('message',"Selected images deleted successfully! ");
					$this->session->set_flashdata('alrt_class',"alert-success"); 
		        }
		        else{
		        	$this->session->set_flashdata('message',"Something wrong! ");
					$this->session->set_flashdata('alrt_class',"alert-danger"); 
		        }
		    }
		    else{
		        	$this->session->set_flashdata('message',"Something wrong! ");
					$this->session->set_flashdata('alrt_class',"alert-danger"); 
		        }
	        redirect("admin/imageSetting");
	}
	// Image setting 

	// Product Category Setting

	public function categorySetting()
	{
		$allcategory = $this->Adminmodel->allcategory();
		$this->load->view("admin/product_category",["allcats"=>$allcategory]);
	}
	public function add_category()
	{
		$allcategory = $this->Adminmodel->allcategory();
		$this->load->view("admin/add-category",["allcats"=>$allcategory]);	
	}
	public function addCategoryData()
	{
		$catSlug =  url_title($this->input->post('seoUrl'),"-",true); 
        $catData = array(
        	'name' => $this->input->post('catName'), 
        	'seo_url' => $catSlug, 
        	'parentCat' => $this->input->post('parentCat'), 
        	'title' => $this->input->post('ptitle'), 
        	'description' => $this->input->post('categoryDetails'), 
        	'mtitle' => $this->input->post('mtitle'), 
        	'mkeywords' => $this->input->post('mkeywords'), 
        	'mdescription' => $this->input->post('mdescription'), 
        	'featureimage' => $this->input->post('modalboximage'), 

        );
        
        if ($this->db->insert("categories",$catData)) {
            $this->session->set_flashdata('message',"Product Category Is addedd successfully! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
        }
        else
        {
        	$this->session->set_flashdata('message',"Something Wrong! Please try again!");
			$this->session->set_flashdata('alrt_class',"alert-danger"); 			
        }
        redirect("admin/categorySetting");
	}

	public function edit_category($cid)
	{
		$singleCatInfo = $this->Adminmodel->categoryInfo($cid);
		$allcategory = $this->Adminmodel->allcategory();
		$this->load->view("admin/edit-category",["allcats"=>$allcategory,"catInfo"=>$singleCatInfo]);	
	}
	public function editCategoryData()
	{
		$catId = $this->input->post('categoId');
		$seoUrl = $this->input->post("seoUrl");
		$catSlug = url_title($seoUrl,"-",true);

		$checkExisted = $this->db->where("seo_url",$catSlug)->get("categories")->result();
		
		if(count($checkExisted) > 1)
        {
        	$this->session->set_flashdata('message', 'SEO Url Is already assigned to a category. Please try diffrent ');
            	$this->session->set_flashdata('alrt_class', 'alert-danger');
        }
        else
        {
        	$catData = array(
        	'name' => $this->input->post('catName'), 
        	'seo_url' => $catSlug, 
        	'parentCat' => $this->input->post('parentCat'), 
        	'title' => $this->input->post('ptitle'), 
        	'description' => $this->input->post('categoryDetails'), 
        	'mtitle' => $this->input->post('mtitle'), 
        	'mkeywords' => $this->input->post('mkeywords'), 
        	'mdescription' => $this->input->post('mdescription'), 
        	'featureimage' => $this->input->post('modalboximage'), 
        	'topCategory' => $this->input->post('topcat'), 
        	
        	
			);

        	if ($this->db->where("id",$catId)->update("categories",$catData)) {
	        		$this->session->set_flashdata('message', 'Category is updated successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
    	redirect("admin/edit_category/".$catId);


        }
	}

	public function changestatusCategory($pid)
	{
			$singCatInfo = $this->Adminmodel->categoryInfo($pid);
            if ($singCatInfo->status == 0) {
                $pstatus = 1;
            }
            else{
                $pstatus = 0;
            }

            $proData = array(
	        	'status' => $pstatus,
	        );

            if ($this->db->where("id",$pid)->update("categories",$proData)) {
	        		$this->session->set_flashdata('message', 'Category status is changed successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
        	redirect("admin/categorySetting");
	}
	public function deletecategory($cid)
	{
		if ($this->db->where("id",$cid)->delete("categories")) {
			$this->session->set_flashdata('message',"Category is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('message',"Category is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/categorySetting");
	}
	// Product Category Setting

	// slider setting
	public function sliderList()
	{
		$allslides = $this->Adminmodel->allsliders();
		$this->load->view("admin/all_sliders",["slides"=>$allslides]);
	}
	
	public function add_slide()
	{
		$this->load->view("admin/add_slide");
	}
	public function add_slide_data()
	{
		$data = array(
			'imgPath' => $this->input->post('modalboximage'), 
			'sortNum' => $this->input->post('sequence'), 
			'link' => $this->input->post('slideLink'), 
			'alttext' => $this->input->post('altText'), 
			'slideText' => $this->input->post('sliderDetails'), 
			'device' => $this->input->post('deviceSlide'), 
		);
		 if ($this->db->insert("imagesliders",$data)) {
            $this->session->set_flashdata('message',"Slide Is addedd successfully! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
        }
        else
        {
        	$this->session->set_flashdata('message',"Something Wrong! Please try again!");
			$this->session->set_flashdata('alrt_class',"alert-danger"); 			
        }
        redirect("admin/sliderList");
	}
	public function edit_slide($sid)
	{
		$singslideInfo = $this->Adminmodel->slideInfo($sid);
		$this->load->view("admin/edit_slide",["slideInfo"=>$singslideInfo]);
	}
	public function edit_slideData()
	{
		$sid = $this->input->post('slideId');
		$data = array(
			'imgPath' => $this->input->post('modalboximage'), 
			'sortNum' => $this->input->post('sequence'), 
			'link' => $this->input->post('slideLink'), 
			'alttext' => $this->input->post('altText'), 
			'device' => $this->input->post('deviceSlide'), 
	
		);
		 if ($this->db->where("id",$sid)->update("imagesliders",$data)) {
            $this->session->set_flashdata('message',"Slide Is updated successfully! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
        }
        else
        {
        	$this->session->set_flashdata('message',"Something Wrong! Please try again!");
			$this->session->set_flashdata('alrt_class',"alert-danger"); 			
        }
        redirect("admin/sliderList");
	}
	public function changestatusSlide($sid)
	{
			$singslideInfo = $this->Adminmodel->slideInfo($sid);
            if ($singslideInfo->status == 0) {
                $pstatus = 1;
            }
            else{
                $pstatus = 0;
            }

            $proData = array(
	        	'status' => $pstatus,
	        );

            if ($this->db->where("id",$sid)->update("imagesliders",$proData)) {
	        		$this->session->set_flashdata('message', 'Slide status is changed successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
        	redirect("admin/sliderList");
	}

	public function deleteslide($cid)
	{
		if ($this->db->where("id",$cid)->delete("imagesliders")) {
			$this->session->set_flashdata('message',"Slide is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('message',"Slide is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/sliderList");
	}
	// Slide setting

	// UserSetting
	public function user_setting()
	{
		$allUsers = $this->db->order_by("id","desc")->get("users")->result();
		$this->load->view("admin/allusers",["allUsers"=>$allUsers]);	
	}
	public function changeuserStatus($uid)
	{
		$uInfo = $this->db->where("id",$uid)->get("users")->row();
		if ($uInfo->status == 0) {
			$ustatus = 1;
		}
		else{
			$ustatus = 0;	
		}
		$data = array('status' => $ustatus);
		if ($this->Adminmodel->updateUser($uid,$data)) {
			$this->session->set_flashdata('message',"User status is changed! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 			
		}
		else{
			$this->session->set_flashdata('message',"User status is not changed! Please try again. ");
			$this->session->set_flashdata('alrt_class',"alert-danger"); 				
		}
		redirect("admin/user_setting");
		
	}
	public function deleteUser($uid)
	{
		if ($this->db->where("id",$uid)->delete("users")) {
			$this->session->set_flashdata('message',"user is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('message',"User is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/user_setting");
	}
	// UserSetting
	// menu Setting
	public function menulist()
	{
		$menuInfo = $this->db->get("menus")->result();
		$this->load->view("admin/menu_list",["menuInfo"=>$menuInfo]);
	}
	public function menu_setting($menuId)
	{
		$menuInfo = $this->db->where("id",$menuId)->get("menus")->row();
		$this->load->view("admin/menu_setting",["menuInfo"=>$menuInfo]);
	}
	public function updatedMenu()
	{
		$menuId =  $this->input->post("menuId");
		$cont =  $this->input->post("content");	
		$menuData = array('content' => $cont );
		// $contArray = json_decode($cont, true);
		if ($this->db->where("id",$menuId)->update("menus",$menuData)) {
        		echo "success";
        	}
        	else
        	{
        		echo "failed";
        	}

	}
	
	// menu Setting

	// home categories
	public function homecatlist()
	{
		$clist = $this->db->order_by("id","desc")->get("homecats")->result();
		$this->load->view("admin/homecatList",["clist"=>$clist]);
	}
	public function add_cat_slide()
	{
		$allcats = $this->Adminmodel->categoryList();
		$this->load->view("admin/add_cat_slide",["allcats"=>$allcats]);
	}
	public function add_cat_slide_data()
	{
		$mCats = $this->input->post("otherCats");
		 if (isset($mCats) && count($mCats)> 0) {
		 	$moreCats = implode(",", $mCats);
			
		 }
		 else{
		 	$moreCats="";
		 }
		 $cName = $this->input->post("catName");
		 $cPrefer = $this->input->post("preference");
		 $image = $this->input->post("modalboximage");
		 $moreLink = $this->input->post("moreLink");
		 $data = array(
		 	'name' => $cName, 
		 	'cats' => $moreCats, 
		 	'preference' => $cPrefer, 
		 	'features_img' => $image,
		 	'more_pro_link' => $moreLink
		 );
		 if ($this->db->insert("homecats",$data)) {
        		$this->session->set_flashdata('message', 'Cat List is added successfully.');
            	$this->session->set_flashdata('alrt_class', 'alert-success');
        	}
        	else
        	{
        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
            	$this->session->set_flashdata('alrt_class', 'alert-danger');
        	}
        	redirect("admin/homecatlist");
	}

	public function changestatuscatSlide($sid='')
	{
		if (!empty($sid)) {
			$singslideInfo = $this->db->where("id",$sid)->get("homecats")->row();
            if ($singslideInfo->status == 0) {
                $pstatus = 1;
            }
            else{
                $pstatus = 0;
            }

            $proData = array(
	        	'status' => $pstatus,
	        );

            if ($this->db->where("id",$sid)->update("homecats",$proData)) {
	        		$this->session->set_flashdata('message', 'Category list status is changed successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
        	}
		}
		
        	redirect("admin/homecatlist");
	}
	public function edit_cat_slide($sid)
	{
		$allcats = $this->Adminmodel->categoryList();
		$singslideInfo = $this->db->where("id",$sid)->get("homecats")->row();
		$this->load->view("admin/edit_cat_slide",["singslideInfo"=>$singslideInfo,"allcats"=>$allcats]);
	}
	public function edit_cat_slide_data()
	{
		$sid = $this->input->post("catslideId");
		$mCats = $this->input->post("otherCats");
		 if (isset($mCats) && count($mCats)> 0) {
		 	$moreCats = implode(",", $mCats);
			
		 }
		 else{
		 	$moreCats="";
		 }
		 $cName = $this->input->post("catName");
		 $cPrefer = $this->input->post("preference");
		 $image = $this->input->post("modalboximage");
		 $moreLink = $this->input->post("moreLink");
		 $data = array(
		 	'name' => $cName, 
		 	'cats' => $moreCats, 
		 	'preference' => $cPrefer, 
		 	'features_img' => $image,
		 	'more_pro_link' => $moreLink
		 );
		 if ($this->db->where("id",$sid)->update("homecats",$data)) {
        		$this->session->set_flashdata('message', 'Cat List is updated successfully.');
            	$this->session->set_flashdata('alrt_class', 'alert-success');
        	}
        	else
        	{
        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
            	$this->session->set_flashdata('alrt_class', 'alert-danger');
        	}
        	redirect("admin/edit_cat_slide/".$sid);
	}
	public function deletecatslide($pid)
	{
		if ($this->db->where("id",$pid)->delete("homecats")) {
			$this->session->set_flashdata('message',"Cat List is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('message',"Cat List is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/homecatlist");
	}
	// home categories

	// tax Setting

	public function taxSetting()
		{
			$taxList = $this->db->order_by("id","desc")->get("taxes")->result();
			$this->load->view("admin/taxsetting",["taxList"=>$taxList]);
		}

		public function addnewtaxData()
			{
				$tname = $this->input->post("tname");
				$dname = $this->input->post("dname");
				$tper = $this->input->post("tpercent");
				$data = array(
					'name' => $dname, 
					'taxName' => $tname, 
					'taxpercent' => $tper, 
				);

				if ($this->db->insert("taxes",$data)) {
	        		$this->session->set_flashdata('message', 'Tax is added successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
	        	redirect("admin/taxSetting");

			}	
public function makeTaxDefault($taxId)
	{
				$zeroarr = array( 
					'its_default' =>0 ,
					 );
				if ($this->db->where("id !=","")->update("taxes",$zeroarr)) {
					$defArr = array( 
						'its_default' =>1 ,
					 );
					if ($this->db->where("id",$taxId)->update("taxes",$defArr)) {
						$this->session->set_flashdata('message', 'Default Tax is changed successfully.');
	            		$this->session->set_flashdata('alrt_class', 'alert-success');
					}
					else{
						$this->session->set_flashdata('message', 'Default Tax is not changed,Please try again.');
	            		$this->session->set_flashdata('alrt_class', 'alert-danger');
					}
				}
				else{
						$this->session->set_flashdata('message', 'Default Tax is not changed,Please try again.');
	            		$this->session->set_flashdata('alrt_class', 'alert-danger');
					}
			redirect("admin/taxSetting");		
	}	

	public function changestatustax($taxId)
	{
			$singTaxInfo = $this->db->where("id",$taxId)->get("taxes")->row();
            if ($singTaxInfo->status == 0) {
                $pstatus = 1;
            }
            else{
                $pstatus = 0;
            }

            $proData = array(
	        	'status' => $pstatus,
	        );

            if ($this->db->where("id",$taxId)->update("taxes",$proData)) {
	        		$this->session->set_flashdata('message', 'Tax status is changed successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
        	redirect("admin/taxSetting");
	}

	public function deletetaxinfo($taxId)
	{
		// checking here, being deleted tax setting is already used in any product or not if requested deleted tax is already in used any of product then it can't be change coz later in billing it can be show error; 
		
		
		$bigstring = "";
		$checkProduct = $this->db->select("taxSlab")->where("taxSlab !=",0)->where("status",1)->get("products")->result();
		foreach ($checkProduct as $makearr) {
			$bigstring.= $makearr->taxSlab.",";
		}
		$instArr = explode(",", $bigstring);
		if (in_array($taxId, $instArr)) {
			$counter = array_count_values($instArr)[$taxId];

			$this->session->set_flashdata('message', 'Tax can not be deleted because this tax is used in '.$counter.' Products.');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		else{
				$taxInfo = $this->db->where("id",$taxId)->get("taxes")->row();
				if ($taxInfo->its_default == 0) {
					if ($this->db->where("id",$taxId)->delete("taxes")) {
						$this->session->set_flashdata('message',"Tax is deleted! ");
						$this->session->set_flashdata('alrt_class',"alert-success"); 		
					}else
					{
					   $this->session->set_flashdata('message',"Tax is not deleted! Please try again.");
					   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
					}
				}
				else{
					$this->session->set_flashdata('message',"Default Tax can not be deleted! Please change default tax before deleteing!");
					   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
				}
			
		}
		redirect("admin/taxSetting");

	}
	public function edit_taxesInfo($taxId)
	{
		$taxInfo = $this->db->where("id",$taxId)->get("taxes")->row();
		$this->load->view("admin/edit-tax",["taxtinfo"=>$taxInfo]);
	}
	public function edit_taxesInfoData()
	{
		$taxId = $this->input->post("taxId");
		$tname = $this->input->post("tname");
		$dname = $this->input->post("dname");
		$tper = $this->input->post("tpercent");
		$data = array(
			'name' => $dname, 
			'taxName' => $tname, 
			'taxpercent' => $tper, 
		);

		if ($this->db->where("id",$taxId)->update("taxes",$data)) {
    		$this->session->set_flashdata('message', 'Tax is updated successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
    	}
    	else
    	{
    		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
    	}
    	redirect("admin/taxSetting");
	}
	// tax Setting

	// Home Banners
	public function banners_setting()
	{
		$banList = $this->db->get("home_banners")->result();
		$this->load->view("admin/banners_setting",["banList"=>$banList]);
	}
	public function edit_banner($sid)
	{
		$singslideInfo = $this->db->where("id",$sid)->get("home_banners")->row();
		$this->load->view("admin/edit_banner",["slideInfo"=>$singslideInfo]);
	}
	public function edit_bannerData()
	{
		$sid = $this->input->post('banId');
		$data = array(
			'image' => $this->input->post('modalboximage'), 
			'imagelink' => $this->input->post('banLink'), 
	
		);
		 if ($this->db->where("id",$sid)->update("home_banners",$data)) {
            $this->session->set_flashdata('message',"Banner is updated successfully! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
        }
        else
        {
        	$this->session->set_flashdata('message',"Something Wrong! Please try again!");
			$this->session->set_flashdata('alrt_class',"alert-danger"); 			
        }
        redirect("admin/banners_setting");
	}
	public function changestatusbanner($sid)
	{
			$singslideInfo = $this->db->where("id",$sid)->get("home_banners")->row();
            if ($singslideInfo->status == 0) {
                $pstatus = 1;
            }
            else{
                $pstatus = 0;
            }

            $proData = array(
	        	'status' => $pstatus,
	        );

            if ($this->db->where("id",$sid)->update("home_banners",$proData)) {
	        		$this->session->set_flashdata('message', 'Banner status is changed successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
        	redirect("admin/banners_setting");
	}
	// Home Banners

	// product offers
	public function home_product_offers()
	{
		$allproducts = $this->db->where("status",1)->order_by("id","desc")->get("products")->result();
		$alloffers = $this->db->order_by("id","desc")->get("home_pro_offers")->result();
		$this->load->view("admin/product_offers",["allproducts"=>$allproducts,"alloffers"=>$alloffers]);
	}
	public function add_offers_data()
	{
		$productId = $this->input->post("productId");

		$checkExisted = $this->db->where("status",1)->where("product_id",$productId)->get("home_pro_offers")->num_rows();

		if ($checkExisted > 1) {
			$this->session->set_flashdata('message', 'This product has already an offer! Please edit this offer to change offer date');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		else{
			$data = array(
				'name' => $this->input->post("offerName"), 
				'product_id' => $productId, 
				'sale_start' => $this->input->post("startdate"), 
				'sale_end' => $this->input->post("enddate"), 
			);
			if ($this->db->insert("home_pro_offers",$data)) {
				$this->session->set_flashdata('message', 'Offer is added successfully.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
			}
			else{
				$this->session->set_flashdata('message', 'Offer is not added! Please try again');
        		$this->session->set_flashdata('alrt_class', 'alert-danger');
			}
		}
		redirect('admin/home_product_offers');
	}

	public function homeofferInfo($offerId)
	{
		$offerInfo = $this->db->where("id",$offerId)->get("home_pro_offers")->row();
		if ($offerInfo) {
			$offername = $offerInfo->name;
			$offerproductId = $offerInfo->product_id;
			$offersalesStart = $offerInfo->sale_start;
			$offersalesEnd = $offerInfo->sale_end;
			$status = "success";
		}else{
			$offername = "";
			$offerproductId = "";
			$offersalesStart = "";
			$offersalesEnd = "";
			$status = "failed";
		}
			
		$offermsg = array(
					'offName' =>$offername ,
					'offproid' => $offerproductId,
					'offstart' =>$offersalesStart ,
					'offend' =>$offersalesEnd ,
					'status' => $status
				 );

		echo json_encode($offermsg);	
		

	}
	public function edit_offers_data()
	{
		$offId = $this->input->post("offerId");
		$productId = $this->input->post("productId");

			$data = array(
				'name' => $this->input->post("offerName"), 
				'product_id' => $productId, 
				'sale_start' => $this->input->post("startdate"), 
				'sale_end' => $this->input->post("enddate"), 
			);
			if ($this->db->where("id",$offId)->update("home_pro_offers",$data)) {
				$this->session->set_flashdata('message', 'Offer is updated successfully.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
			}
			else{
				$this->session->set_flashdata('message', 'Offer is not updated! Please try again');
        		$this->session->set_flashdata('alrt_class', 'alert-danger');
			}
		
		redirect('admin/home_product_offers');
	}
	public function deleteoffer($pid)
	{
		if ($this->db->where("id",$pid)->delete("home_pro_offers")) {
			$this->session->set_flashdata('message',"Home Product offer is deleted! ");
			$this->session->set_flashdata('alrt_class',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('message',"Offer is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_class',"alert-danger"); 		
		}
		redirect("admin/home_product_offers");
	}
	public function changestatusoffer($pid)
	{
			$singProInfo = $this->db->where("id",$pid)->get("home_pro_offers")->row();
            if ($singProInfo->status == 0) {
                $pstatus = 1;
            }
            else{
                $pstatus = 0;
            }

            $proData = array(
	        	'status' => $pstatus,
	        );

            if ($this->db->where("id",$pid)->update("home_pro_offers",$proData)) {
	        		$this->session->set_flashdata('message', 'Offer status is changed successfully.');
	            	$this->session->set_flashdata('alrt_class', 'alert-success');
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('message', 'Something wrong! Please try again.');
	            	$this->session->set_flashdata('alrt_class', 'alert-danger');
	        	}
        	redirect("admin/home_product_offers");
	}
	// product offers

	// Page Setting
	public function add_new_page()
	{
		$this->load->view("admin/add_new_page");
	}
	public function add_new_page_data()
	{
		$seoUrl = $this->input->post("pageurl");
		$pageName = $this->input->post("pagename");
		$pagecont = $this->input->post("pageContent");
		$pagurl = url_title($seoUrl);
		$pageinfo = $this->db->where("seo_url",$pagurl)->get("pages");
		if($pageinfo->num_rows() > 0){
			$pageNum = $pageinfo->num_rows()+1;
			$pagurl = url_title($seoUrl).$pageNum;
		}
		$data = array(
			'name' => $pageName, 
			'content' => $pagecont,
			'seo_url' => $pagurl,
		);

		if ($this->db->insert("pages",$data)) {
			$this->session->set_flashdata('message', 'Page is added successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
        	redirect("admin/pageList/");
		}
		else{
			$this->session->set_flashdata('message', 'Page is not added! Please try again.');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
        	redirect("admin/add_new_page");
		}
		
	}
	public function pageList()
	{
		$staticPages = array(1,2,3,4,5);
		$allpages = $this->db->order_by("id","asc")->where_not_in("id",$staticPages)->get("pages")->result();
		$this->load->view("admin/allpages",["allpages"=>$allpages]);
	}
	public function page_setting($pageId)
	{
		$pageInfo = $this->db->where("id",$pageId)->get("pages")->row();
		$this->load->view("admin/page_setting",["pageInfo"=>$pageInfo]);

	}
	public function page_settingData()
	{
		$seoUrl = $this->input->post("pageurl");
		$pageName = $this->input->post("pagename");
		$pagecont = $this->input->post("pageContent");
		$pageId = $this->input->post("page");
		$pagurl = url_title($seoUrl);
		$pageinfo = $this->db->where("seo_url",$pagurl)->get("pages");
		if($pageinfo->num_rows() > 1){
			$pageNum = $pageinfo->num_rows()+1;
			$pagurl = url_title($seoUrl).$pageNum;
		}
		$data = array(
			'name' => $pageName, 
			'content' => $pagecont,
		);

		if ($this->db->where("id",$pageId)->update("pages",$data)) {
			$this->session->set_flashdata('message', 'Page is updated successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Page is not updated! Please try again.');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/page_setting/".$pageId);
	}
	public function deletepage($pageId)
	{
		if ($this->db->where("id",$pageId)->delete("pages")) {
			$this->session->set_flashdata('message', 'Page is delete successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Page is not deleted! Please try again.');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/pageList/");
	}
	// Page Setting

	// footer Setting
	public function footersetting()
	{
		$footInfo = $this->db->where("id",1)->get("others_settings")->row();
		$this->load->view("admin/footersetting",["footInfo"=>$footInfo]);
	}
	public function footersettingData()
	{
		if ($this->input->post("enabled")) {
			$status = 1;
		}
		else{
			$status = 0;
		}
		$content = $this->input->post("footercontent");

		$data = array(
			'status' => $status ,
			'content' => $content
			 );
		if ($this->db->where("id",1)->update("others_settings",$data)) {
			$this->session->set_flashdata('message', 'Footer is updated successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Footer is not updated! Please try again.');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/footersetting/");
	}
	// Footer Setting

	// Shipping
	public function shippingSetting()
	{
		$codInfo = $this->db->where("id",2)->get("others_settings")->row();
		$shipList = $this->db->order_by("id","desc")->get("shipping")->result();
		$this->load->view("admin/codSetting",["codInfo"=>$codInfo,'shipList'=>$shipList]);
	}
	public function codSettingData()
	{
		
		if ($this->input->post("enabled") == 'enable') {
			$status = 1;
		}
		else{
			$status = 0;
		}
		
		$data = array(
			'status' => $status ,
			 );
		if ($this->db->where("id",2)->update("others_settings",$data)) {
			$this->session->set_flashdata('message', 'COD Status is updated successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'COD Status is not updated! Please try again.');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/shippingSetting/");
	}
	public function add_new_ship()
	{
		$this->load->view("admin/add_new_ship");
	}
	public function add_new_ship_data()
	{
		$name = $this->input->post("shipname");
		$type = $this->input->post("shiptype");
		$cartvalue = $this->input->post("shipcart");
		if ($this->input->post("shipstate")) {
			$states = implode(",", $this->input->post("shipstate"));
		}
		else{
			$states = "";
		}
		
		$chanrges = $this->input->post("shipprice");
		$afterchanrges = $this->input->post("aftershipprice");

		$inData = array(
			'name' => $name, 
			'type' => $type,
			'cartvalues' => $cartvalue,
			'shipcharge' => $chanrges,
			'after_shipcharge' => $afterchanrges,
			'states' => $states,
		);
		if ($this->db->insert("shipping",$inData)) {
			$this->session->set_flashdata('message', 'Shipping is added successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Shipping is not added! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/shippingSetting");
	}
	public function edit_new_ship($sid)
	{
		$shipInfo = $this->db->where("id",$sid)->get("shipping")->row();
		$this->load->view("admin/edit_new_ship",["shipInfo"=>$shipInfo]);
	}
	public function edit_new_ship_data()
	{
		$shipId = $this->input->post("shipId");
		$name = $this->input->post("shipname");
		$type = $this->input->post("shiptype");
		$cartvalue = $this->input->post("shipcart");
		$states = implode(",", $this->input->post("shipstate"));
		$chanrges = $this->input->post("shipprice");
		$afterchanrges = $this->input->post("aftershipprice");

		$inData = array(
			'name' => $name, 
			'type' => $type,
			'cartvalues' => $cartvalue,
			'shipcharge' => $chanrges,
			'after_shipcharge' => $afterchanrges,
			'states' => $states,
		);
		if ($this->db->where("id",$shipId)->update("shipping",$inData)) {
			$this->session->set_flashdata('message', 'Shipping is updated successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Shipping is not updated! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/shippingSetting");
	}
	public function changeshipStatus($id,$status)
	{
		if ($status == 1) {
			$st = 0;
		}
		else{
			$st = 1;
		}
		$updata = array(
			'status' => $st, 
		);
		if ($this->db->where("id",$id)->update("shipping",$updata)) {
			$this->session->set_flashdata('message', 'Shipping status is changed successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Shipping status is not changed! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/shippingSetting");

	}
	public function makeshipdefault($id)
	{
		
		$rmdata = array(
			'default_ship' => 0, 
		);

		$this->db->update("shipping",$rmdata);


		$updata = array(
			'default_ship' => 1, 
		);

		if ($this->db->where("id",$id)->update("shipping",$updata)) {
			$this->session->set_flashdata('message', 'Shipping setting is changed successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Shipping setting is not changed! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/shippingSetting");

	}
	public function deleteshiping($id)
	{
		
		if ($this->db->where("id",$id)->delete("shipping")) {
			$this->session->set_flashdata('message', 'Shipping is deleted successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Shipping is not deleted! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/shippingSetting");

	}
	// Shipping

	// Coupon
	public function coupon_setting()
	{
		$coupList = $this->db->order_by("id","desc")->get("coupons")->result();
		$this->load->view("admin/coupon_setting",["coupList"=>$coupList]);
	}
	public function add_new_coupon()
	{
		$row['productList'] = $this->db->order_by("id","desc")->where("status",1)->get("products")->result();
		$row['catList'] = $this->db->order_by("id","desc")->where("status",1)->get("categories")->result();
		$this->load->view("admin/add_new_coupon",$row);
	}
	public function add_new_coupon_data()
	{
		$couponcode = $this->input->post("couponcode");
		$offtype = $this->input->post("offtype");
		$offprice = $this->input->post("offprice");
		$maxuse = $this->input->post("maxuse");
		$coupontype = $this->input->post("coupontype");
		if ($coupontype == 3 || $coupontype == 5) {
			$couponapplies = $this->input->post("couponapplies");
		}
		else{
			$couponapplies = implode(",", $this->input->post("couponapplies"));
		}
		

		$startdate = $this->input->post("startdate");
		$enddate = $this->input->post("enddate");

		$inData = array(
			'code' => $couponcode, 
			'offType' => $offtype , 
			'offPrice' => $offprice, 
			'maxUse' => $maxuse, 
			'type' => $coupontype,
			'typeValue' =>$couponapplies,
			'startDate' =>$startdate,
			'endDate' =>$enddate,
		);
		if ($this->db->insert("coupons",$inData)) {
			$this->session->set_flashdata('message', 'Coupon is added successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Coupon is not added! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/coupon_setting");

	}
	public function deleteCoupon($id)
	{
		if ($this->db->where("id",$id)->delete("coupons")) {
			$this->session->set_flashdata('message', 'Coupon is delete successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Coupon is not deleted! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/coupon_setting");

	}
	public function changeCouponStatus($id,$status)
	{
		if ($status == 1) {
			$st = 0;
		}
		else{
			$st = 1;
		}
		$updata = array(
			'status' => $st, 
		);
		if ($this->db->where("id",$id)->update("coupons",$updata)) {
			$this->session->set_flashdata('message', 'Coupon status is changed successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Coupon status is not changed! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/coupon_setting");

	}
	public function editcoupon($coupId)
	{
		$coupon = $this->db->where("id",$coupId)->get("coupons")->row();
		$this->load->view("admin/editcoupon",["coupon"=>$coupon]);
	}

	public function edit_coupon_data()
	{
		$coupId = $this->input->post("coupId");
		$couponcode = $this->input->post("couponcode");
		$offtype = $this->input->post("offtype");
		$offprice = $this->input->post("offprice");
		$maxuse = $this->input->post("maxuse");
		
		$startdate = $this->input->post("startdate");
		$enddate = $this->input->post("enddate");

		$inData = array(
			'code' => $couponcode, 
			'offType' => $offtype , 
			'offPrice' => $offprice, 
			'maxUse' => $maxuse, 
			'startDate' =>$startdate,
			'endDate' =>$enddate,
		);
		if ($this->db->where("id",$coupId)->update("coupons",$inData)) {
			$this->session->set_flashdata('message', 'Coupon is updated successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Coupon is not updated! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/coupon_setting");

	}
	public function getcouponTypeInput()
	{
		$dataType = "";
		$text = "";
		$coupType = $this->input->post("coupontype");

		if ($coupType == 2) {
			$proList= $this->db->where("status",1)->order_by("id","desc")->get("products")->result();
			foreach ($proList as $proinfo) {
				$dataType .= '<option value="'.$proinfo->id.'">'.$proinfo->name.'</option>';
			}
			$text = "Select Product"; 
			
		}
		elseif ($coupType == 1) {
			$dataType .= '<option selected value="1">Applicable for Logged in User Only </option>';
			$text = "Coupon will be applicable only for Logged in User "; 
		}
		elseif ($coupType == 3 || $coupType == 5 ) {
			if ($coupType == 5) {
				$text = "Enter Maximum cart amount"; 
			}
			else{
				$text = "Enter minimum cart amount"; 
			}
			
			$dataType .= '<input type="number" name="couponapplies" class="form-control" placeholder="'.$text.'">';
			
		}
		elseif ($coupType == 4) {
			$proList= $this->db->where("status",1)->order_by("id","desc")->get("categories")->result();
			foreach ($proList as $proinfo) {
				$dataType .= '<option value="'.$proinfo->id.'">'.$proinfo->name.'</option>';
			}
			$text = "Select Categories"; 
		}
		else{
			$dataType .= '<option selected value="0">All Products</option>';
			$text = "All Products "; 
		}
		$coupMsg  = array(
				'text' => $text, 
				"dataType" => $dataType,
			);
		echo json_encode($coupMsg);			

	}
	// Coupon

	// Review System
	public function review_setting()
	{
		$row['allReviews'] = $this->db->order_by("id","desc")->get("review")->result();
		$this->load->view("admin/review_setting",$row);
	}
	public function changeReviewStatus($id,$status)
	{
		if ($status == 1) {
			$st = 0;
		}
		else{
			$st = 1;
		}
		$updata = array(
			'status' => $st, 
		);
		if ($this->db->where("id",$id)->update("review",$updata)) {
			$this->session->set_flashdata('message', 'Review status is changed successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Review status is not changed! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/review_setting");

	}
	public function deleteReview($id)
	{
		if ($this->db->where("id",$id)->delete("review")) {
			$this->session->set_flashdata('message', 'Review is delete successfully.');
        	$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Review is not deleted! Please try again');
        	$this->session->set_flashdata('alrt_class', 'alert-danger');
		}
		redirect("admin/review_setting");

	}
	// Review System

	// Company Setting

	public function company_setting()
	{
		$row["comp_name"] = $this->db->where("id",4)->get("others_settings")->row();
		$row["comp_logo"] = $this->db->where("id",5)->get("others_settings")->row();
		$row["comp_favicon"] = $this->db->where("id",6)->get("others_settings")->row();
		$row["comp_gst"] = $this->db->where("id",7)->get("others_settings")->row();
		$row["comp_address"] = $this->db->where("id",8)->get("others_settings")->row();
		$row["comp_prim_phone"] = $this->db->where("id",9)->get("others_settings")->row();
		$row["comp_sec_phone"] = $this->db->where("id",10)->get("others_settings")->row();
		$row["comp_prim_email"] = $this->db->where("id",11)->get("others_settings")->row();
		$row["comp_sec_email"] = $this->db->where("id",12)->get("others_settings")->row();

		$this->load->view("admin/company_setting",$row);
		
		
	}
	public function updateCompany_name()
	{
		$compName = $this->input->post("companyName");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company Name is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}

	public function updateCompany_gst()
	{
		$compName = $this->input->post("companyGst");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company GST is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}

	public function updateCompany_logo()
	{
		$compName = $this->input->post("modalboximage");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company logo is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}

	public function updateCompany_favicon()
	{
		$compName = $this->input->post("modalboximage");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company favicon is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}

	public function updateCompany_address()
	{
		$compName = $this->input->post("companyaddr");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company address is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}
	public function updateCompany_priPhone()
	{
		$compName = $this->input->post("companypriPhone");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company primary phone number is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}
	public function updateCompany_secPhone()
	{
		$compName = $this->input->post("companysecPhone");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company secondary phone number is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}

	public function updateCompany_priEmail()
	{
		$compName = $this->input->post("companypriemail");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company primary phone number is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}
	public function updateCompany_secEmail()
	{
		$compName = $this->input->post("companysecEmail");
		$setId = $this->input->post("settingid");
		$updata  = array(
			'content' => $compName,
			 );
		if ($this->db->where("id",$setId)->update("others_settings",$updata)) {
				$this->session->set_flashdata('message', 'Company secondary phone number is updated');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		else{
			$this->session->set_flashdata('message', 'Something Wrong! Please try again.');
        		$this->session->set_flashdata('alrt_class', 'alert-success');
		}
		redirect("admin/company_setting");
	}
	
	
	// Company Setting

	// admin settings
	public function adminprofile()
	{
		$vendorid = $this->session->userdata('adminId');
		$row['adminInfo'] = $this->db->where("id",$vendorid)->get("admin_logins")->row();
		$this->load->view("admin/adminprofile",$row);
	}
	public function edit_admin_user($uid)
	{
		$row["userInfo"] = $this->db->where("id",$uid)->get("admin_logins")->row();
		$this->load->view("admin/edit_admin_user",$row);
	}
	public function updateadminprofile()
	{
		$vendorid = $this->input->post("userId");
		$this->load->library('form_validation');
		$this->form_validation->set_rules('uname', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		

		if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message',validation_errors());
		   		$this->session->set_flashdata('alrt_class',"alert-danger");
			}
		else{
				
				$usr = $this->input->post("username");
				$uname = $this->input->post("uname");
				if ($this->input->post("password")) {

					$pass = $this->input->post("password");
					$updata = array(
						'username' => $usr, 
						'password' => md5($pass),
						'name'=> $uname
					);		
				}
				else{
					$updata = array(
						'username' => $usr, 
						'name'=> $uname
					);		
				}
				

				if ($this->db->where("id",$vendorid)->update("admin_logins",$updata)) {
					$this->session->set_flashdata('message',"Profile updated successfully");
		   			$this->session->set_flashdata('alrt_class',"alert-success");
				}
				else{
					$this->session->set_flashdata('message',"Something wrong! please try again.");
		   			$this->session->set_flashdata('alrt_class',"alert-danger");
				}
			}
		redirect("admin/edit_admin_user/".$vendorid);
		

	}
	public function adminUserSetting()
	{
		$row['adminuserList'] = $this->db->where("id !=",1)->order_by("id","desc")->get("admin_logins")->result();
		$this->load->view("admin/adminUserSetting",$row);
	}
	public function addnew_admin_user()
	{

		$this->load->view("admin/addnew_admin_user");
	}

	public function addadminprofile()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('uname', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message',validation_errors());
		   		$this->session->set_flashdata('alrt_class',"alert-danger");
			}
		else{
				$usr = $this->input->post("username");
				$pass = $this->input->post("password");
				$uname = $this->input->post("uname");
				$updata = array(
					'username' => $usr, 
					'password' => md5($pass),
					'name'=> $uname
				);		

				if ($this->db->insert("admin_logins",$updata)) {
					$this->session->set_flashdata('message',"New admin profile is created successfully");
		   			$this->session->set_flashdata('alrt_class',"alert-success");
				}
				else{
					$this->session->set_flashdata('message',"Something wrong! please try again.");
		   			$this->session->set_flashdata('alrt_class',"alert-danger");
				}
			}
		redirect("admin/adminUserSetting");
		

	}
	
	public function edit_admin_user_permission($userid)
	{
		$row["userInfo"] = $this->db->select("id,permissions,name")->where("id",$userid)->get("admin_logins")->row();
		$this->load->view("admin/edit_admin_user_permission",$row);

	}
	public function updateadminpermission()
	{
		$userId = $this->input->post("userid");
		if ($this->input->post("permissions")) {
			echo $permis =  implode(",", $this->input->post("permissions"));
		}
		else{
			$permis = "";
		}
		
		$updata = array(
			'permissions' => $permis ,
			 );
		if ($this->db->where("id",$userId)->update("admin_logins",$updata)) {
			$this->session->set_flashdata('message',"Admin user permission is updated successfully");
   			$this->session->set_flashdata('alrt_class',"alert-success");
		}
		else{
			$this->session->set_flashdata('message',"Something wrong! please try again.");
   			$this->session->set_flashdata('alrt_class',"alert-danger");
		}
		redirect("admin/edit_admin_user_permission/".$userId);
	}
	// admin Settings

}
