<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mobile extends CI_Controller {

		public function homeslider()
		{
			try {
				// Fetch home banners from the database
				$banners = $this->db
					->select("id, image, imagelink, level, status, created_at")
					->where("status", 1)
					->order_by("level", "asc")
					->get("home_banners")
					->result();
				// Return banners as JSON
				echo json_encode($banners);
			} catch (Exception $e) {
				// Handle any exceptions that occur
				$this->output
					->set_status_header(500)
					->set_output(json_encode([
						'status' => 'error',
						'message' => 'An unexpected error occurred'
					]));
			}
		}

		public function get_prescribed_categories()
		{
			$prescribedCategories = $this->db->where("prescribed", 1)->get("categories")->result();
			echo json_encode($prescribedCategories);
		}
		public function get_non_prescribed_categories()
		{
			$nonPrescribedCategories = $this->db->where("prescribed", 0)->get("categories")->result();
			echo json_encode($nonPrescribedCategories);
		}

			// 		ALTER TABLE `categories` 
			// ADD COLUMN `prescribed` INT(1) NOT NULL DEFAULT 0 COMMENT '1->Yes 0->No';

	}


