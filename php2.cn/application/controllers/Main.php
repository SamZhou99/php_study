<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function index()
	{
		$category = [];
		$categoryRes = $this->db->query("SELECT * FROM `category` LIMIT 100");
		foreach ($categoryRes->result() as $categoryRow) {
			$linksRes = $this->db->query("SELECT * FROM `links` WHERE status=1 AND category=? LIMIT 1000", [$categoryRow->id]);
			$linksArr = [];
			foreach ($linksRes->result() as $linkRow) {
				// $category[] = array_merge(array($row), array($linkRow));
				// $category[]=$row->id;
				$linksArr[] = $linkRow;
			}
			$category[] = array(
				'id' => $categoryRow->id,
				'name' => $categoryRow->name,
				'data' => $linksArr
			);
		}
		// echo json_encode([
		// 	'data' => $category,
		// 	'num_rows' => $categoryRes->num_rows(),
		// ]);

		$this->load->view('main_message', ['category' => $category]);
	}
}
