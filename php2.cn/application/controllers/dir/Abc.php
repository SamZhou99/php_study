<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Abc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'value' => '变量'
        ];
        $this->load->view('dir/abc_message', $data);
    }
}
