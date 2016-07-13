<?php

/**
 * Created by PhpStorm.
 * User: Origin
 * Date: 7/7/16
 * Time: 15:15
 */
class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->helper('url_helper');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="ui error message"><p>', '</p></div>');
        session_start();
    }

    public function sign_in()
    {
        $config = array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required|min_length[6]|max_length[12]|alpha_dash'
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|min_length[6]'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() !== FALSE) {
            $loginUser = $this->account_model->login($this->input->post('username'));
            if (count($loginUser) === 1 && password_verify($this->input->post('password'), $loginUser[0]['pwd'])) {
                $_SESSION['user'] = $loginUser[0];
                $this->account_model->add_user_visit(array('user_id' => $loginUser[0]['id']));
                header("location: " . site_url('account/center'));
            } else {
                $data['result'] = FALSE;
            }
        }
        $data['title'] = array(
            'title' => 'Sign In',
            'description' => 'account sign in',
            'keywords' => 'myour,DasonCheng,脉友,个人博客'
        );
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('sign_in', $data);
    }

    public function sign_up()
    {
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|min_length[6]|max_length[12]|alpha_dash|callback_username_check'
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|min_length[6]'
            ),
            array(
                'field' => 'passconf',
                'label' => 'passconf|min_length[6]',
                'rules' => 'required|matches[password]'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() !== FALSE) {
            $registerUser = array(
                'name' => $this->input->post('username'),
                'pwd' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );
            if ($this->account_model->register($registerUser)) {
                $data['result'] = TRUE;
            } else {
                $data['result'] = FALSE;
            }
        }

        $data['title'] = array(
            'title' => 'Sign Up',
            'description' => 'account sign up',
            'keywords' => 'myour,DasonCheng,脉友,个人博客'
        );
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('sign_up', $data);
    }

    public function center()
    {

        $data['title'] = array(
            'title' => 'CENTER',
            'description' => 'preson center',
            'keywords' => 'myour,DasonCheng,脉友,个人博客'
        );
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('user_center', $data);
    }

    public function error()
    {

        $data['title'] = array(
            'title' => 'ERROR',
            'description' => 'err info',
            'keywords' => '脉友,个人博客'
        );
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('err', $data);
    }

    public function username_check($name)
    {
        if (count($this->account_model->login($name)) <= 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('username_check', '此用户名已被注册');
            return FALSE;
        }
    }
}