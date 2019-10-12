<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$publicList = ['index', 'json', 'reserved_word', 'add', 'select', 'update', 'delete'];
		for ($i = 0; $i < count($publicList); $i++) {
			echo "<p><a href='./$publicList[$i]'>$publicList[$i]</a></p>";
		}
	}

	public function json()
	{
		$data = [
			'flag' => '1',
			'data' => 'Hello JSON',
			'randomStr' => $this->randomStr(32),
			'中文' => $this->randomCN(50),
		];
		echo json_encode($data);

		// echo $this->load->helper('string') . random_string('alnum', 16);
	}

	/**
	 * 保留关键字
	 */
	public function reserved_word()
	{
		$data = [
			'is_php' => is_php('5.1'),
			'html_escape' => html_escape('<div>test div</div>')
		];
		echo json_encode($data);
	}

	public function add()
	{
		$memberId = 1;
		$pageKey = null;
		$name = $this->randomStr();
		$email = $this->randomStr() . '@163.com';
		$comment = $this->randomCN(50);
		$ip = '127.0.0.1';
		$time = date('Y/m/d H:i:s', time());
		// 构造器插入
		// $this->db->insert('mytable', $data);
		$result = $this->db->query("INSERT INTO `message`(`member_id`, `page_key`, `name`, `email`, `comment`, `ip`, `time`) VALUES(?, ?, ?, ?, ?, ?, ?)", [$memberId, $pageKey, $name, $email, $comment, $ip, $time]);
		echo json_encode($result);
	}

	public function select()
	{
		$data = [];
		$total = $this->db->query("SELECT COUNT(0) AS total FROM `message`");
		$query = $this->db->query("SELECT `message`.`*`, `member`.`accout` FROM `message` LEFT JOIN `member` ON `member`.`id`=`message`.`member_id` ORDER BY `message`.`id` DESC LIMIT 3");
		foreach ($query->result() as $row) {
			// echo $row->title;
			$data[] = $row;
		}
		echo json_encode([
			'data' => $data,
			'num_rows' => $query->num_rows(),
			'total' => $total->row()->total
		]);
	}

	public function update($id = 0)
	{
		$email = $this->randomStr() . '@163.com';
		$comment = $this->randomCN(50);

		$result = $this->db->query("UPDATE `message` SET `email`=?, `comment`=? WHERE id=?", [$email, $comment, $id]);
		echo json_encode($result);
	}

	public function delete($id = 0)
	{
		$result = $this->db->query("DELETE FROM `message` WHERE id=?", [$id]);
		echo json_encode($result);
	}






	private function randomCN($num)
	{
		$b = '';
		for ($i = 0; $i < $num; $i++) {
			// 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
			$a = chr(mt_rand(0xB0, 0xD0)) . chr(mt_rand(0xA1, 0xF0));
			// 转码
			$b .= iconv('GB2312', 'UTF-8', $a);
		}
		return $b;
	}

	private function randomStr($len = 6)
	{
		$s = '';
		for ($i = 0; $i < $len; $i++) {
			$s .= $this->randomChr();
		}
		return $s;
	}

	private function randomChr()
	{
		$r = mt_rand(0, 3);
		if ($r === 0) {
			return chr(mt_rand(48, 57));
		} elseif ($r === 1) {
			return chr(mt_rand(65, 90));
		} else {
			return chr(mt_rand(97, 122));
		}
	}
}
