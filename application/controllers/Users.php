<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Users extends CI_Controller {


function __construct()
	{
		date_default_timezone_set("Asia/Calcutta"); 
		parent::__construct();
		$this->load->library('session');
		$userId = $this->session->has_userdata('userid');
		if (!$userId) {
			redirect(base_url());
		}
	}
	
	public function myaccount()
	{
		$userid = login_user();
		
		$row["userinfo"] = user_info();
		// $row["addresses"] = $this->db->where("userid",$userid)->order_by("id","desc")->get("address_book")->result();
		$this->load->view("my_account",$row);
	}

	public function updateuser_details()
	{
		$userid = login_user();

		$userinfo = user_info();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha_numeric_spaces');

		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('new_password', 'Password', 'trim|min_length[3]');
		$this->form_validation->set_rules(
				'email_1', 'Email',
				'trim|required|valid_email',
			 	array('valid_email' => 'Please enter a valid email',)
			);
		$this->form_validation->set_rules(

        'phonenumber', 'Phone Number',

        'trim|required|min_length[10]|max_length[11]',

		        array(

		                'required'      => 'You have not provided %s.',

		                'is_unique'     => 'This %s already exists.'

		        )

		);
		if($this->input->post("new_password")){
			$pass = $this->input->post("new_password");
		}
		else{
			$pass = $userinfo->password;
		}



		if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('messages',validation_errors());
		   		$this->session->set_flashdata('alrt_cls',"alert-error");
			}
			else{
				$updata = array(
					'firstname' => $this->input->post("firstname"), 
					'lastname' => $this->input->post("lastname"), 
					'email' => $this->input->post("email_1"), 
					'phone' => $this->input->post("phonenumber"), 
					'password' => $pass, 
				);
				if ($this->db->where("id",$userid)->update("users",$updata)) {
					$this->session->set_flashdata('messages',"Profile updated successfully");
		   			$this->session->set_flashdata('alrt_cls',"alert-success");
				}
			}

		redirect("users/myaccount");
	}
	public function user_addresses($mode = "",$adId="")
	{
		$userid = login_user();
		if (!empty($mode) && $mode == "edit-address" && !empty($adId)) {
			$addressinfo = $this->db->where("id",$adId)->order_by("id","desc")->get("address_book")->row();
				$this->load->view("edit-address",["addressinfo"=>$addressinfo]);
		}
		else{
				$addressList = $this->db->where("userid",$userid)->order_by("id","desc")->get("address_book")->result();
				$this->load->view("user_addresses",["addressList"=>$addressList]);
		}
	}

	public function updateaddress()
	{
		$addrList = "";
		$user_id = login_user();
		$uaddressId = $this->input->post("uaddressId");
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
						$addrdata = array(
							'userid' => $user_id, 
							'firstname' => $this->input->post("ufname"), 
							'lastname' => $this->input->post("ulname"),
							'phone' => $this->input->post("uphone"),
							'email' => $this->input->post("uemail"),
							"address"=>$this->input->post("ufulladdress"),
							"address2"=>$this->input->post("ufulladdress2"),
							"city"=>$this->input->post("ucity"),
							"state"=>$this->input->post("ustate"),
							"country"=>$this->input->post("ucountry"),
							"pincode"=>$this->input->post("upincode"),
						);
						
						if ($this->db->where("userid",$user_id)->where("id", $uaddressId)->update("address_book",$addrdata)) {
							
							$msg = "Address is added successfully!";
							$msgColor = "#28a745";
							$status = "success";		
						}
						else{
								$msg = "Something wrong Please try after some time.";
								$msgColor = "#dc3545";
								$status = "failed";
						}
						
					// Edit to address book

					
				
			}
			

			$addressmsg = array(
					'msg' => $msg,
					'msgColor' => $msgColor,
					'status' =>$status,
					);

		echo json_encode($addressmsg);	
	}

	public function delete_user_addresses($adId)
	{
		if ($this->db->where("id",$adId)->delete("address_book")) {
			$this->session->set_flashdata('messages',"Address is deleted! ");
			$this->session->set_flashdata('alrt_cls',"alert-success"); 		
		}else
		{
		   $this->session->set_flashdata('messages',"Address is not deleted! Please try again");
		   $this->session->set_flashdata('alrt_cls',"alert-error"); 		
		}
		redirect("users/user_addresses");
	}

	public function orders($type="")
	{
		$odrstatus = "";
		if ($type == "processing-orders") {
			$odrstatus = 1;
		}
		elseif ($type == "canceled-orders") {
			$odrstatus = 2;
		}
		elseif ($type == "dispatched-orders") {
			$odrstatus = 3;
		}
		elseif ($type == "completed-orders") {
			$odrstatus = 4;
		}
		else{
			$odrstatus = "";
		}

		$userid = login_user();
		
		if (!empty($odrstatus)) {
			$orderInfo = $this->db->where("ordstatus",$odrstatus)->where("userid",$userid)->order_by("id","desc")->get("orders")->result();
		}
		else{
			$orderInfo = $this->db->where("userid",$userid)->order_by("id","desc")->get("orders")->result();
		}
		$this->load->view("user_orders",["orderlist"=>$orderInfo]);
	}


	public function ordersinfo($orderid="",$thanks='')
	{
		$userid = login_user();
		
		$odrInfo = $this->db->where("userid",$userid)->where("id",$orderid)->get("orders")->row();		

		if (!empty($odrInfo)) {
			$this->load->view("order-view",["thanks"=>$thanks,"odrInfo"=>$odrInfo]);
		}
		else{
			redirect(base_url('myaccount'));
		}
		
		
	}

	public function cancleorder($orderId)
	{
		$userid = login_user();
		$orderInfo = $this->db->where("id",$orderId)->get("orders")->row();
		$this->load->view("cancleorder",["odrInfo"=>$orderInfo]);
	}

	public function cancleorderData()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('description', 'Please mention cancellation reason!', 'trim|required');

		if ($this->form_validation->run() == FALSE){
				$msg = validation_errors();
				$msgColor = "#dc3545";
				$status = "failed";
			}
			else{
				$orderid = $this->input->post("orderId");
				$updata = array(
					'ordstatus' => 2, 
					"description" => $this->input->post("description"),
				);

				if ($this->db->where("id",$orderid)->update("orders",$updata)) {
					$msg = "Order is cancled successfully.";
					$msgColor = "#dc3545";
					$status = "success";
				}
				else{
					$msg = "Technical error";
					$msgColor = "#dc3545";
					$status = "success";
				}

			}

			$ordersmsg = array(
					'msg' => $msg,
					'msgColor' => $msgColor,
					'status' =>$status,
					);

		echo json_encode($ordersmsg);

		
	}

	public function addressForm()
	{
		$this->load->view('addressForm');
	}

	public function logout()
	{

		$this->session->unset_userdata('userid');

		redirect(base_url());

	}

}

