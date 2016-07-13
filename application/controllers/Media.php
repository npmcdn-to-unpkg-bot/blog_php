<?php

/**
 * Created by PhpStorm.
 * User: Origin
 * Date: 7/7/16
 * Time: 15:16
 */
class Media extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('media_model');
        $this->load->helper('url_helper');
        $this->load->library(array('form_validation', 'pagination'));
        $this->form_validation->set_error_delimiters('<div class="ui error message"><p>', '</p></div>');
        session_start();
    }

    public function index($sort = 'all', $page = 1)
    {
        $config['base_url'] = '/media/articles/' . $sort . '/';
        $config['per_page'] = 10;
        $config['num_links'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['use_global_url_suffix'] = TRUE;
        $config['full_tag_open'] = '<div class="ui pagination menu">';
        $config['full_tag_close'] = '</div>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = '<i class="caret right icon"></i>';
        $config['next_tag_open'] = '<a>';
        $config['next_tag_close'] = '</a>';
        $config['prev_link'] = '<i class="caret left icon"></i>';
        $config['prev_tag_open'] = '<a>';
        $config['prev_tag_close'] = '</a>';
        $config['cur_tag_open'] = '<div class="disabled item">';
        $config['cur_tag_close'] = '</div>';
        $config['attributes'] = array('class' => 'item');
        $config['total_rows'] = $this->media_model->get_article_count($sort);
        $this->pagination->initialize($config);
        if (is_numeric($page) && ($page >= 1)) {
            $data['title'] = 'MEDIA';
            $data['sorts'] = $this->media_model->get_sorts_article();
            $data['sort'] = 'all';
            $data['count'] = $this->media_model->get_article_count(NULL);
            $data['page'] = $this->media_model->get_article_count($sort) / 10 >= 1 ? $this->pagination->create_links() : '';
            $data['news'] = $this->media_model->get_article_list($sort, $page - 1);
            $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
            $this->load->view('article_list', $data);
        } else {
            show_404();
        }
    }

    public function articles($sort = 'all', $page = 1)
    {
        $config['base_url'] = '/media/articles/' . $sort . '/';
        $config['per_page'] = 10;
        $config['num_links'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['use_global_url_suffix'] = TRUE;
        $config['full_tag_open'] = '<div class="ui pagination menu">';
        $config['full_tag_close'] = '</div>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = '<i class="caret right icon"></i>';
        $config['next_tag_open'] = '<a>';
        $config['next_tag_close'] = '</a>';
        $config['prev_link'] = '<i class="caret left icon"></i>';
        $config['prev_tag_open'] = '<a>';
        $config['prev_tag_close'] = '</a>';
        $config['cur_tag_open'] = '<div class="disabled item">';
        $config['cur_tag_close'] = '</div>';
        $config['attributes'] = array('class' => 'item');
        $config['total_rows'] = $this->media_model->get_article_count($sort);
        $this->pagination->initialize($config);
        if (is_numeric($page) && ($page >= 1)) {
            $data['title'] = 'MEDIA';
            $data['sorts'] = $this->media_model->get_sorts_article();
            $data['sort'] = $sort;
            $data['count'] = $this->media_model->get_article_count(NULL);
            $data['page'] = $this->media_model->get_article_count($sort) / 10 >= 1 ? $this->pagination->create_links() : '';
            $data['news'] = $this->media_model->get_article_list($sort, $page - 1);
            $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
            $this->load->view('article_list', $data);
        } else {
            show_404();
        }
    }

    public function search_f()
    {
        $keywords = $this->input->post('searchKey');
        header("location: " . site_url('media/search/' . $keywords));
    }

    public function search($keywords = 'all', $page = 1)
    {
        $keywords = urldecode($keywords);
        $config['base_url'] = '/media/search/' . $keywords;
        $config['per_page'] = 10;
        $config['num_links'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['use_global_url_suffix'] = TRUE;
        $config['full_tag_open'] = '<div class="ui pagination menu">';
        $config['full_tag_close'] = '</div>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = '<i class="caret right icon"></i>';
        $config['next_tag_open'] = '<a>';
        $config['next_tag_close'] = '</a>';
        $config['prev_link'] = '<i class="caret left icon"></i>';
        $config['prev_tag_open'] = '<a>';
        $config['prev_tag_close'] = '</a>';
        $config['cur_tag_open'] = '<div class="disabled item">';
        $config['cur_tag_close'] = '</div>';
        $config['attributes'] = array('class' => 'item');

        if ($keywords != 'all') {
            if (is_numeric($page) && ($page >= 1)) {
                $data['news'] = $this->media_model->search_article_list($keywords, $page - 1);
                $config['total_rows'] = $this->media_model->search_article_count($keywords);
                $this->pagination->initialize($config);
                $data['page'] = $config['total_rows'] / 10 >= 1 ? $this->pagination->create_links() : '';
                $data['keywords'] = $keywords;
            } else {
                show_404();
            }
        } else {
            $config['total_rows'] = $this->media_model->get_article_count(NULL);
            $this->pagination->initialize($config);
            $data['news'] = $this->media_model->get_article_list(NULL, $page - 1);
            $data['page'] = $this->media_model->get_article_count(NULL) / 10 >= 1 ? $this->pagination->create_links() : '';
        }
        $data['title'] = 'SEARCH';
        $data['sorts'] = $this->media_model->get_sorts_article();
        $data['sort'] = 'search';
        $data['count'] = $this->media_model->get_article_count(NULL);
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('article_list', $data);
    }

    public function article($id)
    {
        if (isset($id) && is_numeric($id)) {
            $data['news_item'] = $this->media_model->get_article_info($id);
            $data['news_visit'] = $this->media_model->get_article_visit($id);
            if (empty($data['news_item'])) {
                show_404();
            }
            $data['title'] = $data['news_item']['title'];
            $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
            $user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 1;
            $this->media_model->add_article_visit(array(
                'author_id' => $user_id,
                'article_id' => $id
            ));
            $this->load->view('article_info', $data);
        } else {
            show_404();
        }
    }

    public function create()
    {
        if (!isset($_SESSION['user'])) {
            $this->error();
            return;
        }
        $config = array(
            array(
                'field' => 'title',
                'label' => 'title',
                'rules' => 'required|max_length[120]'
            ),
            array(
                'field' => 'sort[]',
                'label' => 'sort',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'description',
                'rules' => 'required|min_length[1]|max_length[800]'
            ),
            array(
                'field' => 'content',
                'label' => 'content',
                'rules' => 'required|max_length[100000]'
            )
        );
        $this->form_validation->set_rules($config);
        $data['sort'] = $this->input->post('sort[]');
        if ($this->form_validation->run() !== FALSE) {
            $article_item = array(
                'title' => $this->input->post('title'),
                'sort' => $this->input->post('sort[]'),
                'author_id' => $_SESSION['user']['id'],
                'description' => $this->input->post('description'),
                'content' => $this->input->post('content')
            );
            if ($this->media_model->create_article($article_item)) {
                $data['result'] = TRUE;
            } else {
                $data['result'] = FALSE;
            }
        }
        $data['title'] = 'EDITOR';
        $data['article_title'] = '';
        $data['article_content'] = '';
        $data['sorts'] = $this->media_model->get_sorts_all();
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('article_editor', $data);
    }

    public function update($id)
    {
        if (!isset($_SESSION['user'])) {
            $this->error();
            return;
        }
        $config = array(
            array(
                'field' => 'title',
                'label' => 'title',
                'rules' => 'required|max_length[120]'
            ),
            array(
                'field' => 'sort[]',
                'label' => 'sort',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'description',
                'rules' => 'required|min_length[1]|max_length[800]'
            ),
            array(
                'field' => 'content',
                'label' => 'content',
                'rules' => 'required|max_length[100000]'
            )
        );
        $this->form_validation->set_rules($config);
        $data['sort'] = $this->input->post('sort[]');
        if ($this->form_validation->run() !== FALSE) {
            $article_item = array(
                'id' => $id,
                'user_id' => $_SESSION['user']['id'],
                'title' => $this->input->post('title'),
                'sort' => $this->input->post('sort[]'),
                'description' => $this->input->post('description'),
                'content' => $this->input->post('content')
            );
            if ($this->media_model->update_article($article_item)) {
                $data['result'] = TRUE;
            } else {
                $data['result'] = FALSE;
            }
        }

        if (isset($id) && is_numeric($id)) {
            $data['news_item'] = $this->media_model->get_article_info($id);
            if (empty($data['news_item'])) {
                show_404();
            }
            $data['sorts'] = $this->media_model->get_sorts_all();
            $data['title'] = $data['news_item']['title'];
            $data['article_title'] = $data['news_item']['title'];
            $data['article_content'] = $data['news_item']['content'];
            $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
            $this->load->view('article_editor', $data);
        } else {
            show_404();
        }
    }

    public function delete($id)
    {
        if (!isset($_SESSION['user'])) {
            $this->error();
            return;
        }
        $delete_item = array(
            'user_id' => $_SESSION['user']['id'],
            'article_id' => $id
        );
        if (isset($id) && is_numeric($id) && $this->media_model->delete_article($delete_item)) {
            header("location: " . site_url('media'));
        } else {
            show_404();
        }
    }

    public function error()
    {
        $data['title'] = 'ERROR';
        $data['session'] = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;
        $this->load->view('err', $data);
    }
}