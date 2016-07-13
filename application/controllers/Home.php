<?php

/**
 * Created by PhpStorm.
 * User: Origin
 * Date: 7/7/16
 * Time: 15:37
 */
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        session_start();
    }

    public function index()
    {
        $data['title'] = 'home';
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('home', $data);
    }

    public function test($sort = NULL, $page = 1)
    {
        if (isset($sort)) {
            echo 'sort:' . $sort . '   page:' . $page;
        } else {
            echo 'sort:all   page:' . $page;
        }
    }
}