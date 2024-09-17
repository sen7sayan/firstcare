<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	
	public function product_detail($proUrl)
	{
		
		$proInfo = $this->Productmodel->singleProInfo($proUrl);

		if ($proInfo) {

			// recently viewed product
			/*$recentlyViewed = $this->session->userdata('recentlyViewed');
		    if(!is_array($recentlyViewed)){
		        $recentlyViewed = array();  
		    }
		    //change this to 10
		    if(sizeof($recentlyViewed)>3){
		        array_shift($recentlyViewed);
		    }
		    //here set your id or page or whatever
		    if(!in_array($data['id'],$recentlyViewed)){
		        array_push($recentlyViewed,$data['id']);
		    }
		    $this->session->set_userdata('recentlyViewed', $recentlyViewed);    
		    $recentlyViewed = array_reverse($recentlyViewed);*/
			// recently viewed product

			$catInfo = $this->Homemodel->categoryInfoById($proInfo->categories);
			$samecatPro = $this->db->where("categories",$catInfo->id)->where("id != ",$proInfo->id)->get("products")->result();
			$moreImgs = $this->Adminmodel->productExtraImgs($proInfo->id);
			$this->load->view("product-details",["proInfo"=>$proInfo,"catInfo"=>$catInfo,"moreImgs"=>$moreImgs,"samecatPro"=>$samecatPro]);
		}
		else
		{
			redirect(base_url());
		}
	}

	public function getVarvalue()
	{
		$varComb = $this->input->post("varComb");
		$prodId = $this->input->post("prId");
		$getVariable = $this->db->where("combinations", $varComb)->where("proId",$prodId)->get("productvariabledetails")->row();
			if ($getVariable) {
				if (!empty($getVariable->dis_price)) {
					$prPrice = $getVariable->dis_price;
				}
				else
				{
					$prPrice = $getVariable->price;	
				}
				$cartmsg = array(
					'msg' => 0,
					'msgColor' => "alert-success",
					"pPrice"=> $prPrice,
					
				 );
		
			}
			else{
				$cartmsg = array(
					'msg' => "Please wait",
					'msgColor' => "alert-warning",
				 );
				
			}

			
		echo json_encode($cartmsg);

		
	}
	public function addToCart()
	{
		$giftwap = 0;
		$message ="";
		$msgColor="";
		$varComb = $this->input->post("varComb");
		$prodId = $this->input->post("prId");
		$pqty = $this->input->post("prQty");


		$proInfo = $this->Productmodel->singleProInfoById($prodId);
		if (empty($proInfo->moq)) {
			$qty = $pqty;
		}
		else{
			$qty = $pqty * $proInfo->moq;
		}
		
		// $proname = str_replace( array( '\'','~','!','@','#','$','%','^','&','*','(',')','_','+','=','-','`','<','>','?',',','.','/',':','"',';','{','}','|','[',']' ), ' ', $proInfo->name);

		$proname = url_title($proInfo->name," ",true);
		$mainImg = $proInfo->featureImg;
		if ($proInfo->stockStatus == 1) {
			
			if ($proInfo->price_tax == 1) {
				$taxType = "included";
			}
			else{
				$taxType = "Not included";
			}

			if ($proInfo->taxSlab != 0) {
					$totalTaxPer = $proInfo->taxSlab;
				}
				else{
					$stdTaxInfo = $this->db->where("its_default",1)->get("taxes")->row();
					$totalTaxPer = $stdTaxInfo->id;
				}
				
				// Tax calculation
				$prtax1 = 0;
				$taxArr = explode(",", $totalTaxPer);
                 for ($k=0; $k < count($taxArr) ; $k++) { 
                    $taxInfo= $this->db->where("id",$taxArr[$k])->get("taxes")->row();
                    $prtax1 = $prtax1 + $taxInfo->taxpercent;
                    
                 }
                // echo $prtax;
				// Tax Calculation

				if ($proInfo->proType == 2) {
					$getVariable = $this->db->where("combinations", $varComb)->where("proId",$prodId)->get("productvariabledetails")->row();
					if ($getVariable) {
						if (!empty($getVariable->dis_price)) {
							$prPrice = $getVariable->dis_price;
						}
						else
						{
							$prPrice = $getVariable->price;	
						}
						$taxprice = ($prPrice * $prtax1)/100;
						$prtax = round($taxprice,1);

						if ($proInfo->price_tax == 1) {
							$realPrice = $prPrice;
						}
						else{
							$realPrice = $prPrice + $prtax;
						}
						
						$cartData = array(
					        'id'      => $prodId,
					        'qty'     => $qty,
					        'price'   => $realPrice,
					        'name'    => $proname,
					        'options' => array(
					        	'variable' => $varComb,
					        	'taxType' => $taxType,
					        	'tax'=> $prtax,
					        	'giftwap' =>$giftwap,
					        	'seo_url' => $proInfo->seo_url,
					        	'mainImg' => $mainImg,
					        )
						);
						$message =$proInfo->name."(".$varComb.") - is added to cart";
						$msgColor="success";
						$this->cart->insert($cartData);
					}
					else
					{
						$message ="Please choose correct option from given available options!";
						$msgColor="danger";
					}
				}
				else
				{
						if (!empty($proInfo->disc_price)) {
							$prPrice = $proInfo->disc_price;
						}
						else
						{
							$prPrice = $proInfo->price;	
						}
					
					$taxprice = ($prPrice * $prtax1)/100;
					$prtax = round($taxprice,1);

						if ($proInfo->price_tax == 1) {
							$realPrice = $prPrice;
						}
						else{
							$realPrice = $prPrice + $prtax;
						}

					$cartData = array(
					        'id'      => $prodId,
					        'qty'     => $qty,
					        'price'   => $realPrice,
					        'name'    => $proname,
					        'options' => array(
					        	'variable' => $varComb,
					        	'taxType' => $taxType,
					        	'tax'=> $prtax,
					        	'giftwap' => $giftwap,
					        	'seo_url' => $proInfo->seo_url,
					        	'mainImg' => $mainImg,
					        )
						);
					$message =$proname." - is added to cart";
					$msgColor="success";
					$this->cart->insert($cartData);
				}
		}
		else{
				$message ="Product is out of Stock! Please call our executive to notify you while, it will be in stock";
				$msgColor="danger";	
		}
		$allitems = "";
		foreach ($this->cart->contents() as $cartItem) {
			$allitems .= $this->load->view('includes/side_cart_item', ["cartItem"=>$cartItem], TRUE);

		}
		
		$cartmsg = array(
				'msg' =>$message ,
				'msgColor' => $msgColor,
				"cartQty"=> $this->cart->total_items(),
				"carttotal" =>$this->cart->total(),
				"allvars" => $varComb,
				"allitems"=>$allitems,
			 );
		echo json_encode($cartmsg);
		
		
	}
	public function buynow($proid,$qty=1)
	{
		$proInfo = $this->Productmodel->singleProInfoById($proid);
		$proname = str_replace( array( '\'','~','!','@','#','$','%','^','&','*','(',')','_','+','=','-','`','<','>','?',',','.','/',':','"',';','{','}','|','[',']' ), ' ', $proInfo->name);	
		 		
			if (!empty($proInfo->disc_price)) {
					$prPrice = $proInfo->disc_price;
			}
			else
			{
				$prPrice = $proInfo->price;	
			}

			if ($proInfo->taxSlab != 0) {
				$prtax = $proInfo->taxSlab;
			}
			else{
				$stdTaxInfo = $this->db->where("its_default",1)->get("taxes")->row();
				$prtax = $stdTaxInfo->id;
			}
		if ($proInfo->stockStatus == 1) {
			$cartData = array(
		        'id'      => $proInfo->id,
		        'qty'     => $qty * $proInfo->moq,
		        'price'   => $prPrice,
		        'name'    => $proname,
		        'options' => array(
		        	'variable' => "",
		        	'tax'=>$prtax
		        )
			);
			if ($this->cart->insert($cartData)) {
				redirect("/shopping-cart");
			}
			else{
				redirect("/pet-product/".$proInfo->seo_url);
			}	
		}
		else{
				redirect("/pet-product/".$proInfo->seo_url);
			}	
		
	}
	public function shoppingCart()
	{
		$row["recentPro"]  = $this->db->where("status",1)->order_by("id","desc")->limit(20)->get("products")->result();
		$this->load->view("mybag.php",$row);
	}
	public function updatecart()
	{
		$prIds = $this->input->post("proids");
		$prQty = $this->input->post("quantity");
		$poIds = $this->input->post("poIds");
		$giftwrapings = $this->input->post("giftWrap");
		// print_r($giftwrapings);
		$taxes = $this->input->post("taxes");
		$seo_url = $this->input->post("seo_url");
		$mainImg = $this->input->post("mainImg");
		// print_r($prIds);
		for ($i=0; $i < sizeof($prIds) ; $i++) { 

			$proInfo = $this->Productmodel->singleProInfoById($poIds[$i]);	
			if ($proInfo->moq < $prQty[$i] ) {
				$adQty = $prQty[$i];
			}
			else{
				$adQty = $proInfo->moq;	
			}
			
			$giftwrap = $giftwrapings[$i];
			
			if ($proInfo->price_tax == 1) {
				$taxType = "included";
			}
			else{
				$taxType = "Not included";
			}


			$data = array(
				        'rowid' => $prIds[$i],
				        'qty'   => $adQty,
				        'options' => array(
				        	'giftwap' => $giftwrap,
				        	'variable' => "",
				        	'taxType' => $taxType,
		        			'tax'=>$taxes[$i],
		        			'seo_url' => $proInfo->seo_url,
				        	'mainImg' => $mainImg[$i],
				        )
				);
			if($this->cart->update($data)) {
				$msg = "Cart updated";
				$alertType = "alert-success";
			}
			else{
				$msg = "Cart is not updated";	
				$alertType = "alert-danger";
			}
			
		}
		$this->session->set_flashdata('cartMsg', $msg);
		$this->session->set_flashdata('msgType', $alertType);
		redirect("/shopping-cart");
	}

	public function removeitemcart($prId)
	{
		$data = array(
				        'rowid' => $prId,
				        'qty'   => 0
				);
			if ($this->cart->update($data)) {
				$msg = "Item Removed";
				$alertType = "alert-success";
			
				$couponData = array('couponcode', 'coupontype', 'offtype', 'couponoffvalue', 'discountprice');
				$this->session->unset_tempdata($couponData);
			}

		$i=0;
        $savedPrice = 0;
        $singProsave = 0;	
		foreach ($this->cart->contents() as $cartItem){
                // print_r($cartItem);
			$proinfo = $this->Productmodel->singleProInfoById($cartItem["id"]);
			 	if (!empty($proinfo->disc_price)) {
                    $priceDiff = $proinfo->price - $proinfo->disc_price;
                    $singProsave = $priceDiff * $cartItem['qty'];
                    $savedPrice = $savedPrice + $singProsave;
                }
                
                $this->load->view('includes/cart-items',['proinfo'=>$proinfo,"cartItem"=>$cartItem,"iteration"=>$i,"savedPrice"=>$savedPrice,"singProsave"=>$singProsave]);
                $i++;
            }	


	}
	public function emptyCart()
	{
		$this->cart->destroy();
		$this->session->set_flashdata('cartMsg', "All items are removed Successfully from cart!");
		$this->session->set_flashdata('msgType', "alert-success");
		redirect("shopping-cart");
	}
	
	public function checkout($guest="")
	{
		
		if($this->session->has_userdata('userid') && sizeof($this->cart->contents()) > 0 && empty($guest))
		{
			$userid = login_user();
			
			$addressList = $this->db->where("userid",$userid)->order_by("id","desc")->get("address_book")->result();
			$this->load->view("checkout-page",["addressList"=>$addressList]);
		}
		elseif (!empty($guest) && $guest == "guest-checkout") {
			$addressList = array();
			$this->load->view("checkout-page",["addressList"=>$addressList]);
		}
		else
		{
			redirect(base_url('/shopping-cart'));
		}
		
	}
	public function orderConfirm()
	{
		$user_id = login_user();
		if ($this->cart->total() == 0) {
			$cartmsg = array(
					'msg' => "Cart is empty!",
					'msgColor' => "#dc3545",
					'status' =>"failed",
				 );
		}
		else
		{
			// validation
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules('discountprice', 'Coupon', 'trim');
				$this->form_validation->set_rules('coupontype', 'Coupon', 'trim');
				$this->form_validation->set_rules('couponcode', 'Coupon', 'trim');
				$this->form_validation->set_rules('offtype', 'Coupon', 'trim');
				$this->form_validation->set_rules('couponoffvalue', 'Coupon', 'trim');

				$this->form_validation->set_rules('uCompany_name', 'Company Name', 'trim|alpha_numeric_spaces');
				$this->form_validation->set_rules('ugstnumber', 'GST Number', 'trim|alpha_numeric',
				array(
						'alpha_numeric' => "Please add valid GST Number",
					)	
			);
				$this->form_validation->set_rules('paymentmethod', 'Please Select Payment method!', 'trim|required|alpha');
				$this->form_validation->set_rules('optradio', 'Please Select/ Add  Address!', 'trim|required|numeric',
					array(
						'numeric' => "Not valid address",
						'required' => "Please Select/ Add  Address! ",
					)
			);
				
				
					if ($this->form_validation->run() == FALSE){
						$cartmsg = array(
							'msg' => validation_errors(),
							'msgColor' => "#dc3545",
							'status' =>"failed",
							);
						
					}
					else{
						$addId =  $this->input->post("optradio");
						$addressCheck = $this->db->where("id",$addId)->get("address_book");
						if ($addressCheck->num_rows() > 0) {
							$addInfo = $addressCheck->row();
							
							$paymentmethod = $this->input->post("paymentmethod");
							if ($paymentmethod == "cod") {
								$pm = 0;
								$payment_method_name = "cod";
							}
							else{
								$pm = 1;
								$payment_method_name = 'phonepe';
							}



							$orderContent = array();
							$totalQty = 0;
							foreach ($this->cart->contents() as $cartItem) {
									array_push($orderContent,$cartItem);
									$totalQty = $totalQty + $cartItem["qty"];
								}

								$address1 = $addInfo->address; 
								$address2 = $addInfo->address2; 
								$city = $addInfo->city; 
								$state = $addInfo->state; 
								$pincode = $addInfo->pincode; 
								$country = $addInfo->country; 
								$phone = $addInfo->phone; 
								$email = $addInfo->email; 
								$firstname = $addInfo->firstname; 
								$lastname = $addInfo->lastname; 

								$address = $address1." ".$address2.", ".$city.", ".$state.", ".$pincode.", ".$country;
								$userfullName = $firstname." ".$lastname;
								$data = array(
									'userid' => $user_id, 
									'user_name' => $userfullName, 
									'userPhone' => $phone,
									'email' => $email,
									'amount' => $this->cart->total(), 
									"orderDetail"=> serialize($orderContent),
									"totalItems"=>$totalQty,
									"billaddress"=>$address,
									"shipaddress"=>$address,
									"address"=>$address1,
									"address2"=>$address2,
									"city"=>$city,
									"state"=>$state,
									"country"=>$country,
									"pincode"=>$pincode,
									"paymentStatus"=>0,
									'payment_method'=>$pm,
									'payment_method_name'=>$payment_method_name,
									'coupontype'=>$this->input->post('coupontype'),
									'discount_offtype'=>$this->input->post('offtype'),
									'discountedAmount'=>$this->input->post('discountprice'),
									'couponcode'=>$this->input->post('couponcode'),
									'couponoffvalue'=>$this->input->post('couponoffvalue'),
									"companyName"=> $this->input->post("uCompany_name"),
									"gstNumber" => $this->input->post("ugstnumber"),
								);

								if ($this->db->insert("orders",$data)) {
									$insert_id = $this->db->insert_id();


									if ($pm == 0) {
										$cartmsg = array(
										'msg' => "Order Placed Successfully",
										'msgColor' => "#28a745",
										'status' =>"success",
										'orderId' =>$insert_id,
										"pm"=>$pm,
										);

										$this->cart->destroy();

									}else{
										$this->session->set_userdata('rec_orderId', $insert_id);
										$cartmsg = array(
											'msg' => "Page will be Redirect to phonepe PG",
											'msgColor' => "#28a745",
											'status' =>"success",
											'orderId' =>$insert_id,
											"pm"=>$pm,
											);
									}
									
								}
								else{
									$cartmsg = array(
									'msg' => "Order is not Placed! PLease Fill all details Properly",
									'msgColor' => "#dc3545",
									'status' =>"failed",
									);
								}
						}
						else{
							$cartmsg = array(
							'msg' => "Please choose/add a valid address",
							'msgColor' => "#dc3545",
							'status' =>"failed",
							);

						}
							
						
					}

			// validation
			
		}
		 
		echo json_encode($cartmsg);
	}

	public function add_new_address()
	{
		$addrList = "";
		$state = "";
		$user_id = login_user();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules(
				'uemail', 'Email',
				'trim|required|valid_email',
			 	array('valid_email' => 'Please enter a valid email',)
			);



		$this->form_validation->set_rules('ufname', 'User First Name', 'trim|required');
		$this->form_validation->set_rules('ulname', 'User Last Name', 'trim|required');
		$this->form_validation->set_rules('uphone', 'Phone Number', 'trim|required|exact_length[10]');
		$this->form_validation->set_rules('ufulladdress', 'Address', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('ufulladdress2', 'Apartment, Suite, etc.', 'trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('ucity', 'City Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('ustate', 'State Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('ucountry', 'Country Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules(
				'upincode', 'Pincode Number',
				'trim|required|numeric|exact_length[6]',
			 	array(
			 		'numeric' => 'Please enter a valid pincode',
			 		'exact_length' => 'Please enter a valid pincode',
			 	)
			);

		if ($this->form_validation->run() == FALSE){
				$msg = validation_errors();
				$msgColor = "#dc3545";
				$status = "failed";
			}
			else{

					// add to address book
						$state = $this->input->post("ustate");
						$addrdata = array(
							'userid' => $user_id, 
							'firstname' => $this->input->post("ufname"), 
							'lastname' => $this->input->post("ulname"),
							'phone' => $this->input->post("uphone"),
							'email' => $this->input->post("uemail"),
							"address"=>$this->input->post("ufulladdress"),
							"address2"=>$this->input->post("ufulladdress2"),
							"city"=>$this->input->post("ucity"),
							"state"=>$state,
							"country"=>$this->input->post("ucountry"),
							"pincode"=>$this->input->post("upincode"),
							"last_used"=>1,
						);
						
						if ($this->db->insert("address_book",$addrdata)) {
							$last_id = $this->db->insert_id();
							$updata = array(
								'last_used' => 0, 
							);
							
							$this->db->where("userid",$user_id)->where("id !=", $last_id)->update("address_book",$updata);
						}
						
					// add to address book

					$msg = "Address is added successfully!";
					$msgColor = "#28a745";
					$status = "success";
					
				
			}
			$addressList = $this->db->where("userid",$user_id)->order_by("id","desc")->get("address_book")->result();
			foreach ($addressList as $addres) {
				$addrList .= $this->load->view("includes/addressview",["addres"=>$addres],true);
			}

			$shipInfo = shipping_charge_helper_fun($state);
                
			
			$addressmsg = array(
					'msg' => $msg,
					'msgColor' => $msgColor,
					'status' =>$status,
					'shipcharge' => price_symbol($shipInfo["shipcharge"]),
					'discounted' => price_symbol($shipInfo["discounted"]),
					"finalPrice" => price_symbol($shipInfo["finalPrice"]),
					'adList' => $addrList
					);

		echo json_encode($addressmsg);			
	}

	public function submitorder_payInfo($payCode,$trId,$mercgId,$cheks)
    {
        $orderId = $this->session->userdata('rec_orderId');
        
        if ($payCode == "PAYMENT_SUCCESS") {
            
        		$shipInfo = $this->placeorder($orderId);

            $updata = array(
                'phonep_transactionId' => $trId, 
                'phonep_merchantOrderId' => $mercgId, 
                'phonep_checksum' => $cheks, 
                'paymentStatus' => 1, 
                "ordstatus"=>1,
                'ship_order_id' => (empty($shipInfo->order_id)) ? $shipInfo->order_id : '', 
            	 'ship_shipment_id' => (empty($shipInfo->shipment_id)) ? $shipInfo->shipment_id : '', 
            	'ship_status' => (empty($shipInfo->status)) ? $shipInfo->status : '', 
            	'ship_status_code' => (empty($shipInfo->status_code)) ? $shipInfo->status_code : '', 
            	'ship_onboarding_completed_now' => (empty($shipInfo->onboarding_completed_now)) ? $shipInfo->onboarding_completed_now : '', 
            	'ship_awb_code' => (empty($shipInfo->awb_code)) ? $shipInfo->awb_code : '', 
            	'ship_courier_company_id' => (empty($shipInfo->courier_company_id)) ? $shipInfo->courier_company_id : '', 
            	'ship_courier_name' => (empty($shipInfo->courier_name)) ? $shipInfo->courier_name : '', 
            	'ship_new_channel' => (empty($shipInfo->new_channel)) ? $shipInfo->new_channel : '', 
            	'ship_packaging_box_error' => (isset($shipInfo->packaging_box_error)) ? $shipInfo->packaging_box_error : '', 
            	'ship_updated_at' => date("d-M-Y h:i:s"), 
            );

            $this->db->where("id",$orderId)->update("orders",$updata);
            
            $this->cart->destroy();
            $this->session->unset_userdata('rec_orderId');
            


            $this->load->view('payment_success',["orderId"=>$orderId]);
        }
        else{

            $updata = array(
                'phonep_transactionId' => $trId, 
                'phonep_merchantOrderId' => $mercgId, 
                'phonep_checksum' => $cheks, 
                'paymentStatus' => 0, 
                "ordstatus"=>2,
            );
            $this->db->where("id",$orderId)->update("orders",$updata);

            $this->load->view('payment_failure'); 
        }

    }

    public function paycancled_order($orderId)
    {
    	$this->session->set_userdata('rec_orderId', $orderId);
    	redirect('payment/order_payment/');
    }

    public function pro_quickview()
    {
    	$prodId = $this->input->post("prId");
    	$proInfo = $this->db->where("id",$prodId)->get("products")->row();
		$catInfo = $this->Homemodel->categoryInfoById($proInfo->categories);
		$moreImgs = $this->Adminmodel->productExtraImgs($proInfo->id);
		
    	$this->load->view('includes/product-popup',["proInfo"=>$proInfo,"catInfo"=>$catInfo,"moreImgs"=>$moreImgs]);
    }

	public function wishlistPros()
	{
		$userId = login_user();
        if (isset($userId)) {
            $row["wishlist"] = $this->db->where('userId',$userId)->where("deleted",0)->get("wishlist")->result();
        }
        else{
            $row["wishlist"] = [];
        }   
		$this->load->view("wishlist",$row);
	}	
	public function addwishlist()
	{
		
		$wishQty = 0;
		$prodId = $this->input->post("prId");
		$checkPro = $this->Productmodel->singleProInfoById($prodId);

		$userId = login_user();

		if ($checkPro && isset($userId)) {
			
			$prodId = $this->input->post("prId");
			$loginTrig = true;
			$msgColor = "success";
			

			$check_wish_pro_user = $this->db->where('userId',$userId)->where("deleted",0)->where('products',$prodId)->get("wishlist")->result();
			
			if (count($check_wish_pro_user)==0) {
				$data = array( 
					'userId' => $userId, 
					'products'=>$prodId,
					'dateNtime' => date("d-M-Y h:i:s"),
				);
				$this->db->insert("wishlist",$data);
			}
		 $wishQty = count($this->db->where('userId',$userId)->where("deleted",0)->get("wishlist")->result());
		}
		else{
			$prodId = "";
			$msgColor = "danger";
			$loginTrig = false;
		}
		
		
		$cartmsg = array(
				'prodId' =>$prodId,
				'wishQty' =>$wishQty,
				'msgColor' => $msgColor,
				'loginUser' => $loginTrig
			 );
		echo json_encode($cartmsg);
	}

	public function removeFromWishList()
	{
		$wishId = $this->input->post("wishId");

		$wishlistView = "";

		$userId = $this->session->userdata('userid');
		if (isset($userId)) {
			$data = array(
				'deleted' => 1, 
			);
			if ($this->db->where("id",$wishId)->update("wishlist",$data)) {
				$msgColor = "success";
			}
			else{
				$msgColor = "danger";
			}

			$wishlist = $this->db->where('userId',$userId)->where("deleted",0)->get("wishlist")->result();
			foreach ($wishlist as $key => $wishpro) {
				$prod = $this->db->where("id",$wishpro->products)->get("products");
               if ($prod->num_rows()) {
                   $proInfo = $prod->row();
                   $wishlistView .= $this->load->view('includes/wishlist_product_view', ["proInfo"=>$proInfo,"wishId"=>$wishpro->id], TRUE);
               }
			}
		}

		$cartmsg = array(
				'wishlist' =>$wishlistView,
				'msgColor' => $msgColor,
			 );
		echo json_encode($cartmsg);

	}

	public function testAddTocart()
	{
		// $this->session->set_userdata('userid', 1);

		$this->load->view("testPage");
		
	}

	public function apikeycreate()
	{
			$curl = curl_init();
		  curl_setopt_array($curl, array(
		    CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => "",
		    CURLOPT_MAXREDIRS => 10,
		    CURLOPT_TIMEOUT => 0,
		    CURLOPT_FOLLOWLOCATION => true,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => "POST",
		    CURLOPT_POSTFIELDS =>"{\n    \"email\": \"techidata1@gmail.com\",\n    \"password\": \"Techidata@123\"\n}",
		    CURLOPT_HTTPHEADER => array(
		      "Content-Type: application/json"
		    ),
		  ));
		  $SR_login_Response = curl_exec($curl);
		  curl_close($curl);
		  $SR_login_Response_out = json_decode($SR_login_Response);
		  echo $token = $SR_login_Response_out->{'token'};
	}

	public function placeorder($orderId)
	{
		$orderInfo = $this->db->where("id",$orderId)->get("orders")->row();
		$fullName = explode(" ", $orderInfo->user_name);
		$firstname = $fullName[0];
		$lastname = $fullName[1];
		$phone = $orderInfo->userPhone;
		$odrData = (unserialize($orderInfo->orderDetail));
		$items = array();
		$totalAmt = 0;
		for ($i=0; $i < sizeof($odrData) ; $i++) { 
			$prId = $odrData[$i]["id"];
			$pros = array(
				"name" => $odrData[$i]["name"],
		      "sku"=> $prId,
		      "units"=> $odrData[$i]["qty"],
		      "selling_price"=> $odrData[$i]["price"],
		      "discount"=> "",
		      "tax"=> "",
		      "hsn"=> "", 
		   	);
		    array_push($items, $pros);

		    if ($odrData[$i]["options"]["taxType"] == "included"){
 					$prWithTax = $odrData[$i]["subtotal"] ;
 					
 				}
 				else{
 					$prWithTax = $odrData[$i]["subtotal"] + $taxPrice;	
 				}

 				
 				$totalAmt = $totalAmt + $prWithTax;

		 }
			$allItems =  json_encode($items);

		$apykey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjQ4MDM0MjgsInNvdXJjZSI6InNyLWF1dGgtaW50IiwiZXhwIjoxNzIyNzczMTgwLCJqdGkiOiI4Y1RGZ1Nub2djWVJZVElqIiwiaWF0IjoxNzIxOTA5MTgwLCJpc3MiOiJodHRwczovL3NyLWF1dGguc2hpcHJvY2tldC5pbi9hdXRob3JpemUvdXNlciIsIm5iZiI6MTcyMTkwOTE4MCwiY2lkIjo0NjcxNjEsInRjIjozNjAsInZlcmJvc2UiOmZhbHNlLCJ2ZW5kb3JfaWQiOjAsInZlbmRvcl9jb2RlIjoid29vY29tbWVyY2UifQ.x-vbzC27tbAgIAcR8-SZDli3OzgDLG7R8nfEPLF0PII";


		$curl = curl_init();
		  curl_setopt_array($curl, array(
		    CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_ENCODING => "",
		    CURLOPT_MAXREDIRS => 10,
		    CURLOPT_TIMEOUT => 0,
		    CURLOPT_FOLLOWLOCATION => true,
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_CUSTOMREQUEST => "POST",
		    CURLOPT_POSTFIELDS =>'{"order_id": "'.$orderId.'",
		  "order_date": "'.date("d-M-Y h:i:s").'",
		  "pickup_location": "SRM 4NO",
		  "billing_customer_name": "'.$firstname.'",
		  "billing_last_name": "'.$lastname.'",
		  "billing_address": "'.$orderInfo->address.'",
		  "billing_address_2": "'.$orderInfo->address2.'",
		  "billing_city": "'.$orderInfo->city.'",
		  "billing_pincode": "'.$orderInfo->pincode.'",
		  "billing_state": "'.$orderInfo->state.'",
		  "billing_country": "'.$orderInfo->address.'",
		  "billing_email": "'.$orderInfo->email.'",
		  "billing_phone": "'.$phone.'",
		  "shipping_is_billing": true,
		  "shipping_customer_name": "",
		  "shipping_last_name": "",
		  "shipping_address": "",
		  "shipping_address_2": "",
		  "shipping_city": "",
		  "shipping_pincode": "",
		  "shipping_country": "",
		  "shipping_state": "",
		  "shipping_email": "",
		  "shipping_phone": "",
		  "order_items": '.$allItems.',
		  "payment_method": "Prepaid",
		  "shipping_charges": 0,
		  "giftwrap_charges": 0,
		  "transaction_charges": 0,
		  "total_discount": 0,
		  "sub_total": '.$totalAmt.',
		  "length": 10,
		  "breadth": 15,
		  "height": 20,
		  "weight": 2.5
			}',
		    CURLOPT_HTTPHEADER => array(
		      "Content-Type: application/json",
			   "Authorization: Bearer $apykey"
		    ),
		  ));
		  $SR_login_Response = curl_exec($curl);
		  curl_close($curl);
		  $SR_login_Response_out = json_decode($SR_login_Response);
		  
		  // print_r($SR_login_Response_out);
		  // echo '<pre>';
		  return $SR_login_Response_out;



	}


	// Review
	public function submitReview()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules(

				'uemail', 'Email',

				'trim|required|valid_email',

			 	array('valid_email' => "Please enter a valid email",)

			);

		$this->form_validation->set_rules(

				'urating', 'Star',

				'trim|required|numeric',

			 	array('numeric' => "Please star rating.",)

			);

		$this->form_validation->set_rules(

				'uname', 'Name',

				'trim|required|alpha_numeric_spaces',

			 	array('alpha_numeric_spaces' => "Please enter a valid Name",)

			);

		$this->form_validation->set_rules(

        'uphone', 'Phone Number',

        'trim|required|min_length[10]|max_length[11]',

		        array(
		                'required'=> 'You have not provided %s.',
		        )

		);

		$this->form_validation->set_rules(
			'ucomment', 'Review Comment', 
			'trim|alpha_numeric_spaces',
			array('alpha_numeric_spaces' => "Special character is not allowed.",)
		);



		if ($this->form_validation->run() == FALSE)

		{

				$message = validation_errors();

				$msgColor = "#dc3545";

				$status = "falied";	

		}

		else{

			$produId = $this->input->post("productId");
			$uname = $this->input->post("uname");
			$uemail = $this->input->post("uemail");
			$uphone = $this->input->post("uphone");
			$comment = $this->input->post("comment");
			$urating = $this->input->post("urating");
			

			$uinfo = $this->db->where("id",$produId)->get("products")->row();

			if ($uinfo) {
					
					if (login_user()) {
						$userid = login_user();
						$reviewType = 1;
					}
					else{
						$userid ="";
						$reviewType = 0;
					}
					$updata = array(
						'userid' => $userid, 
						'productId' => $produId, 
						'name' => $uname, 
						'email' => $uemail, 
						'phone' => $uphone, 
						'comment' => $comment, 
						'urating' => $urating,
						"type" => $reviewType,
					);

					if ($this->db->insert("review",$updata)) {
						// code...
					}

					$message = "Your product review successfully! ";

					$msgColor = "#28a745";	

					$status = "success";
				
			}

			else

			{

				$message = "Something Wrong! Please try again.";

				$msgColor = "#dc3545";

				$status = "falied";

			}
		}


		$cartmsg = array(

					'msg' =>$message ,

					'msgColor' => $msgColor,

					'status' => $status

				 );

		echo json_encode($cartmsg);
	}


	// Review

	// Coupon 
	private function coupon_price_calculation($codeInfo,$ccode,$notCart="")
	{
		if (empty($notCart)) {
			$finalPrice = $this->cart->total();
		}
		else{
			$finalPrice = $notCart;
		}
		
		if ($codeInfo->offType == 1) {
  	 			$offvalue = (($finalPrice * $codeInfo->offPrice)/100);
  	 			$finalPrice = $finalPrice - $offvalue;
  	 		}
  	 		else{
  	 			$offvalue = $codeInfo->offPrice;
  	 			$finalPrice = $finalPrice - $offvalue ;
  	 		}
  	 	
  	 	if ($offvalue > $this->cart->total()) {
  	 		$finalPrice = 0;
  	 	}
  	 	else{
  	 		$couponData = array(
			        'couponcode'  => $ccode,
			        'coupontype'     => $codeInfo->type,
			        'offtype' => $codeInfo->offType,
			        'couponoffvalue' => $codeInfo->offPrice,
			        'discountprice' => $offvalue
			);
  	 		
  	 		$this->session->set_tempdata($couponData, NULL, 5400);
  	 	}

  	 		
  	 		
  	 		return $finalPrice;
	}
	public function applycoupon()
	{
				$finalPrice = $this->cart->total();
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules('couponcode', 'Coupon Code', 'trim|alpha_numeric|required',
					array(
						'alpha_numeric' => "Please add valid Coupon Code",
						'required' => "Please add valid Coupon Code",
					)	
			);

			if ($this->form_validation->run() == FALSE){
						$msg = validation_errors();
						$msgColor = "#dc3545";
						$status ="failed";

					}else{
						$curDate = date('Y-m-d');
						$ccode = $this->input->post("couponcode");
						$checkCode = $this->db->where("code",$ccode)->where("status",1)->where("startDate <=",$curDate)->where("endDate >=",$curDate)->get("coupons");

						if ($checkCode->num_rows() > 0) {
							$codeInfo = $checkCode->row();
							
							switch ($codeInfo->type) {
									  case 0:
									  		$finalPrice = $this->coupon_price_calculation($codeInfo,$ccode);

								  	 		$msg = "Coupon applied successfully!";
											$msgColor = "#28a745";
											$status ="success";
											
									   break;
									  case 1:
									  	 if (login_user()) {

									  	 		$finalPrice = $this->coupon_price_calculation($codeInfo,$ccode);

									  	 		$msg = "Coupon applied successfully!";
												$msgColor = "#28a745";
												$status ="success";
									  	 	}
									  	 	else{
									  	 		$msg = "Please login to apply this coupon code!";
												$msgColor = "#ec693e";
												$status ="success";
									  	 	}	
									    break;
									  case 2:

									  	 $prprice=0;
									    $pros = explode(",", $codeInfo->typeValue);
									    $profound = 0;
									    foreach($this->cart->contents() as $items) {
										    	if (in_array($items["id"], $pros)) {
										    		$prprice += $items["price"] * $items["qty"];
										    		$profound = 1;
										    	}
											}

											if ($profound == 1) {
												$finalPrice = $this->coupon_price_calculation($codeInfo,$ccode,$prprice);
												
									  	 		$msg = "Coupon applied successfully!";
												$msgColor = "#28a745";
												$status ="success";
											}
											else{
												$msg = "Please add valid Coupon Code";
												$msgColor = "#dc3545";
												$status ="failed";
											}

									    break;
									  case 3:
									  		if ($finalPrice >= $codeInfo->typeValue) {
									  			$finalPrice = $this->coupon_price_calculation($codeInfo,$ccode);
												
									  	 		$msg = "Coupon applied successfully!";
												$msgColor = "#28a745";
												$status ="success";
									  		}
									  		else{
									  			$msg = "This coupon code is valid only for orders of ".price_symbol($codeInfo->typeValue)." or more.";
												$msgColor = "#dc3545";
												$status ="failed";
									  		}
									    break;
								    case 4:
								    	 $cats = explode(",", $codeInfo->typeValue);
									    $prolist = $this->db->select("id")->where_in("categories",$cats)->get("products")->result();
									    $pros = array();
									    foreach ($prolist as $pitems) {
									    	array_push($pros, $pitems->id);
									    }
									    // print_r($pros);
									    // same as fron case 2
									    $prprice=0;
									    $profound = 0;
									    foreach($this->cart->contents() as $items) {
										    	if (in_array($items["id"], $pros)) {
										    		$prprice += $items["price"] * $items["qty"];
										    		$profound = 1;
										    	}
											}

											if ($profound == 1) {
												$finalPrice = $this->coupon_price_calculation($codeInfo,$ccode,$prprice);
												
									  	 		$msg = "Coupon applied successfully!";
												$msgColor = "#28a745";
												$status ="success";
											}
											else{
												$msg = "Please add valid Coupon Code";
												$msgColor = "#dc3545";
												$status ="failed";
											}
									    // same as from case 2
									    break;
								    case 5:
									  		if ($finalPrice <= $codeInfo->typeValue) {
									  			$finalPrice = $this->coupon_price_calculation($codeInfo,$ccode);
												
									  	 		$msg = "Coupon applied successfully!";
												$msgColor = "#28a745";
												$status ="success";
									  		}
									  		else{
									  			$msg = "This coupon code is valid only for orders of ".price_symbol($codeInfo->typeValue)." or less.";
												$msgColor = "#dc3545";
												$status ="failed";
									  		}
									    break;
									  default:
									    echo "Default";
									}							

								/*	$msg = "Coupon applied successfully!";
									$msgColor = "#28a745";
									$status ="success";*/
							
						}
						else{
							$msg = "Please add valid Coupon Code";
							$msgColor = "#dc3545";
							$status ="failed";
						}
					}

					// if cart has lesser value than coupon
					if ($finalPrice == 0) {
						$msg = "Cart has less amount than discount! please add more products";
						$msgColor = "#dc3545";
						$status ="failed";
						$finalPrice = $this->cart->total();

					}

					$cartmsg = array(
						'msg' => $msg,
						'msgColor' => $msgColor,
						'status' =>$status,
						"finalPrice" => price_symbol($finalPrice),
						);
			echo json_encode($cartmsg);
	}
	public function removecoupon()
	{
		$couponData = array('couponcode', 'coupontype', 'offtype', 'couponoffvalue', 'discountprice');

		$this->session->unset_tempdata($couponData);
	}
	// Coupon
	// Shipping
	
	public function getshipcharge()
		{
			$shipstate = $this->input->post("stateName");
			
			$shipInfo = shipping_charge_helper_fun($shipstate);

			$chargemsg = array(
                'shipcharge' => price_symbol($shipInfo["shipcharge"]),
                'discounted' => price_symbol($shipInfo["discounted"]),
                "finalPrice" => price_symbol($shipInfo["finalPrice"]),
                );
			
			echo json_encode($chargemsg); 
		}	
	// Shipping

	public function coupontest()
	{
		$price = 0;
		foreach($this->cart->contents() as $items) {
			echo $items["price"] * $items["qty"];
			echo "<br>";
			$price += $items["price"] * $items["qty"];
		}
		echo $price;
		
	}
	
}

