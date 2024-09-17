<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	// admin user area
		public function admin()
		{
			$this->load->view('admin/sign-in');
		}

		public function adminloginData()
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$chek = $this->db->where("username",$username)->where("password",md5($password))->get("admin_logins")->row();
			if ($chek) {
				$adminId = $chek->id;
				$this->session->set_userdata('adminId',$adminId);
				redirect('admin/product_list');
				
			}
			else{
				redirect('account/admin');	
			}
		}

		public function adminlogout()
		{
			
			$this->session->unset_userdata('adminId');
			return redirect('account/admin');
		}
	// admin user area




	// Customer area

	public function loginForm($redirect="")
		{
			$this->load->view('loginForm',["redirect"=>$redirect]);

		}	

	public function login()

	{

		if ($this->session->has_userdata('userid'))

		{

			redirect(base_url());

		}

		else

		{

			$this->load->view("login");

		}

	}

	public function logindata()

	{

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules(

				'email', 'Email',

				'trim|required|valid_email',

			 	array('valid_email' => "Please enter a valid email",)

			);

		$this->form_validation->set_rules('password', 'Password', 'trim|required');



		if ($this->form_validation->run() == FALSE)

		{

				$message = validation_errors();

				$msgColor = "#dc3545";

				$status = "falied";	

		}

		else{

			$email = $this->input->post("email");

			$pass = $this->input->post("password");

			$uinfo = $this->db->where("email",$email)->where("password",$pass)->get("users")->row();

			if ($uinfo) {

				if ($uinfo->status == 1 ) {

					$this->session->set_userdata('userid', $uinfo->id);

					$message = "Login successfully! Enjoy Shopping";

					$msgColor = "#28a745";	

					$status = "success";

				}

				else{

					$message = "Your account is not active yet. Please call our support to re-active your account.";

					$msgColor = "#dc3545";	

					$status = "failed";	

				}

			}

			else

			{

				$message = "Entered email address is not registred. Please Register!";

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

	public function registration()

	{

		if ($this->session->has_userdata('userid'))

		{

			redirect(base_url());

		}

		else

		{

			$this->load->view("register");

		}

		

	}

	public function registrationdata()

	{

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules(

        'cphone', 'Phone Number',

        'trim|required|min_length[10]|max_length[11]|is_unique[users.phone]',

		        array(

		                'required'      => 'You have not provided %s.',

		                'is_unique'     => 'This %s already exists.'

		        )

		);

		$this->form_validation->set_rules('cpass', 'Password', 'trim|required');

		$this->form_validation->set_rules('cfname', 'First Name', 'trim|required|alpha_numeric_spaces');

		$this->form_validation->set_rules('clname', 'Last Name', 'trim|required|alpha_numeric_spaces');

		$this->form_validation->set_rules(

			'cemail', 'Email',

			 'trim|required|valid_email|is_unique[users.email]',

			 array('is_unique' => 'This %s already registered.', )

			);



		if ($this->form_validation->run() == FALSE)

            {

            	if ($this->input->post("adminonly") == "1") {

					

					$this->session->set_flashdata('message',validation_errors());

					$this->session->set_flashdata('alrt_class',"alert-danger");

					

					redirect("admin/user_setting");

					

				}

				else

				{

					$cartmsg = array(

						'msg' => validation_errors() ,

						'msgColor' => "#dc3545",

						'status' => "failed"

					 );

					echo json_encode($cartmsg);	

				}

                    

            }

            else

            {

                    $emailc = $this->input->post("cemail");

					$phonec = $this->input->post("cphone");

					$check = $this->db->where("email",$emailc)->or_where("phone",$phonec)->get("users")->result();

					if (count($check)) {

						if ($this->input->post("adminonly") == "1") {

					

							$this->session->set_flashdata('message',"user is already registered ");

							$this->session->set_flashdata('alrt_class',"alert-danger");

							

							redirect("admin/user_setting");

							

						}

						else

						{

							$cartmsg = array(

								'msg' =>"user is already registered with either same email or same phone number" ,

								'msgColor' => "danger",

								'status' => "failed"

							 );

							echo json_encode($cartmsg);	

						}

					}

					else{

						$fnamec = $this->input->post("cfname");

						$lnamec = $this->input->post("clname");

						$comapnyc = $this->input->post("ccompany");

						$gstnumberc = $this->input->post("cgstnumber");

						

						$paasc =$this->input->post("cpass");

						$data = array(

								'firstname' => $fnamec,

								'lastname' => $lnamec,

								'phone' => $phonec,

								'email' => $emailc,

								'password' => $paasc,

								'company_name' => $comapnyc,

								'gstnum' => $gstnumberc,

								'status' => 1

							 );

						if ($this->db->insert("users",$data)) {

							$insert_id = $this->db->insert_id();
							$this->session->set_userdata('userid', $insert_id);
							$message = "Your account is registered successfully ";

							$msgColor = "#28a745";

							$status = "success";

						}

						else{

							$message ="Please Fill all field care fully";

							$msgColor = "#dc3545";

							$status = "failed";

						}

						

						$cartmsg = array(

								'msg' =>$message ,

								'msgColor' => $msgColor,

								'status' => $status

							 );

						if ($this->input->post("adminonly") == "1") {

							if ($status == "success") {

								$this->session->set_flashdata('message',"user is added ");

								$this->session->set_flashdata('alrt_class',"alert-success");

							}

							else

							{

								$this->session->set_flashdata('message',"user is not added! ");

								$this->session->set_flashdata('alrt_class',"alert-danger");

							}

							redirect("admin/user_setting");

							

						}

						else{

							echo json_encode($cartmsg);	

						}

					}

            }



		

		

		

		

	}

		// Customer area

}

 ?>
