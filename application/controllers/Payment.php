<?php 
    
    defined('BASEPATH') OR exit('No direct script access allowed');

        class Payment extends CI_Controller {
           
            
            public function testpay()
                {
                    $this->load->view("testing");
                }


            public function order_payment()
            {
                $orderId = $this->session->userdata('rec_orderId');
                $orderInfo = $this->db->where("id",$orderId)->get("orders")->row();
                
                // Replace these with your actual PhonePe API credentials

                $merchantId = 'SHOP24UONLINE'; // sandbox or test merchantId
                $apiKey="6877b51f-149b-4733-a2b0-7061cb31dc20"; // sandbox or test APIKEY
                $redirectUrl = base_url('payment/payment_status');
                $salt_index = 1; 
                // Set transaction details
                $order_id = $orderId; 
                $name=$orderInfo->user_name;
                $email=$orderInfo->email;
                $mobile=$orderInfo->userPhone;
                if ($this->session->tempdata('discountprice')) {
                    $discountprice =  $this->session->tempdata('discountprice');
                    $amount = $orderInfo->amount - $discountprice; // amount in INR
                }
                else{
                    $amount = $orderInfo->amount; // amount in INR    
                }
                
                $description = 'Order Payment';


                $paymentData = array(
                    'merchantId' => $merchantId,
                    'merchantTransactionId' => "M-".rand(1111111111,99999999999), // test transactionID
                    "merchantUserId"=>"TD-".uniqid(),
                    'amount' => $amount*100,
                    'redirectUrl'=>$redirectUrl,
                    'redirectMode'=>"POST",
                    'callbackUrl'=>$redirectUrl,
                    "merchantOrderId"=>$order_id,
                   "mobileNumber"=>$mobile,
                   "message"=>$description,
                   "email"=>$email,
                   "shortName"=>$name,
                   "paymentInstrument"=> array(    
                    "type"=> "PAY_PAGE",
                  )
                );


                 $jsonencode = json_encode($paymentData);
                 $payloadMain = base64_encode($jsonencode);
                 
                 $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
                 $sha256 = hash("sha256", $payload);
                 $final_x_header = $sha256 . '###' . $salt_index;
                 $request = json_encode(array('request'=>$payloadMain));
                    
                $curl = curl_init();
                curl_setopt_array($curl, [
                  CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                   CURLOPT_POSTFIELDS => $request,
                  CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                     "X-VERIFY: " . $final_x_header,
                     "accept: application/json"
                  ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);
                
                if ($err) {
                  echo "cURL Error #:" . $err;
                } else {
                   $res = json_decode($response);
                    
                        if(isset($res->success) && $res->success=='1'){
                        $paymentCode=$res->code;
                        $paymentMsg=$res->message;
                        $payUrl=$res->data->instrumentResponse->redirectInfo->url;
                        
                        header('Location:'.$payUrl) ;
                    }
                    
                }
    }
            

    public function payment_status()
    {
        print_r($_POST);
        $odrId = $_POST['merchantOrderId'];
        $trId = $_POST["transactionId"];
        $mercgId = $_POST["merchantOrderId"];
        $cheks = $_POST["checksum"];
        $payCode = $_POST["code"];


        $orderInfo = $this->db->where("id",$odrId)->get("orders")->row();
        
        $this->session->set_userdata('userid', $orderInfo->userid);
        $this->session->set_userdata('rec_orderId', $odrId);

        redirect("product/submitorder_payInfo/$payCode/$trId/$mercgId/$cheks");
        
    }

    

            
            






        }


 ?>

