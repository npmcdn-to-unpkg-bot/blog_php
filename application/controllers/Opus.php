<?php

/**
 * Created by PhpStorm.
 * User: Origin
 * Date: 7/7/16
 * Time: 16:21
 */
class Opus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        session_start();
    }

    public function index()
    {
        $data['title'] = 'CASE';
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('case', $data);
    }
}