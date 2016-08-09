<?php

/**
 * Created by PhpStorm.
 * User: Origin
 * Date: 8/9/16
 * Time: 16:48
 */
class Mail extends CI_Controller
{
    public function send()
    {
        $this->load->library('email');
        $this->email->from('dasoncheng@foxmial.com', 'DasonCheng');
        $this->email->to('dasoncheng@yahoo.com');
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');
        $this->email->send();
        echo "ok";
    }
}