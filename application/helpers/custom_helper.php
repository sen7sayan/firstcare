<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('login_user'))
{
    function login_user()
    {
        $ci = get_instance();
        $ci->load->library('session');
        
        $userId = $ci->session->userdata('userid');
        if (isset($userId)) {
            return $userId;
        }
        else{
            return false;
        }   
    }   
}

if ( ! function_exists('user_info'))
{
    function user_info()
    {
        $ci = get_instance();
        $ci->load->library('session');
        $ci->load->database();
        
        $userId = $ci->session->userdata('userid');
        if (isset($userId)) {
            return $ci->db->where("id",$userId)->where("status",1)->get("users")->row();
        }
        else{
            return [];
        }   
    }   
}

if ( ! function_exists('price_symbol')){
    function price_symbol($price="")
    {
        return "₹".$price;
    }
}


if ( ! function_exists('state_list')){
    function state_list()
    {
        $states = ["Andhra Pradesh","Andaman and Nicobar Islands","Arunachal Pradesh","Assam","Bihar","Chandigarh","Chhattisgarh","Dadar and Nagar Haveli","Daman and Diu","Delhi","Lakshadweep","Puducherry","Goa","Gujarat","Haryana","Himachal Pradesh","Jammu and Kashmir","Jharkhand","Karnataka","Kerala","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Punjab","Rajasthan","Sikkim","Tamil Nadu","Telangana","Tripura","Uttar Pradesh","Uttarakhand","West Bengal",];
        
        return $states;
    }
}

if ( ! function_exists('shipping_charge_helper_fun')){
    function shipping_charge_helper_fun($shipstate='')
    {
        $ci = get_instance();
        $ci->load->library('session');
        $ci->load->database();
        $ci->load->library('cart');

        if ($ci->session->tempdata('discountprice')) {
                $discountprice =  $ci->session->tempdata('discountprice');
            }
            else{
                $discountprice = 0; // amount in INR    
            }


        if(empty($shipstate)){
            $shipCharge = 0;
        }
        else{
            
            
            $shipInfo = $ci->db->where("status",1)->like("states",$shipstate)->get("shipping")->row();

            if ($shipInfo) {
                if ($shipInfo->type == 0) {
                   $shipCharge = 0;
               }
               else{
                       if ($shipInfo->cartvalues < $ci->cart->total()) {
                           $shipCharge = $shipInfo->after_shipcharge;

                        }
                        else{
                               $shipCharge = $shipInfo->shipcharge;
                           }    
               }

                // print_r($shipInfo);
            }
            else{
                $shipCharge =  0;
            }
        }
        $finalPrice = $ci->cart->total() + $shipCharge - $discountprice;
        $chargemsg = array(
                'shipcharge' => $shipCharge,
                'discounted' => $discountprice,
                "finalPrice" => $finalPrice,
                );
        
        return $chargemsg;
    }
}
if ( ! function_exists('admin_info')){
    function admin_info($vendorid)
    {
        $ci = get_instance();
        $ci->load->database();   
        
        if (isset($vendorid)) {
            return $ci->db->where("id",$vendorid)->where("status",1)->get("admin_logins")->row();;    
        }
        else{
            return [];
        }   
         
    }
}