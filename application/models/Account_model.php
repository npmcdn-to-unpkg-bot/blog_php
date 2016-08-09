<?php

/**
 * Created by PhpStorm.
 * User: Origin
 * Date: 7/7/16
 * Time: 15:14
 */
class Account_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function login($name)
    {
        $sql = "SELECT * FROM users WHERE name=?";
        $query = $this->db->query($sql, $name);
        return $query->result_array();
    }

    public function add_user_visit($visit)
    {
        return $this->db->insert('user_visit', $visit);
    }

    public function register($user)
    {
        return $this->db->insert('users', $user);
    }

    public function password($user)
    {
        $sql = "UPDATE users SET pwd=? WHERE id=?";
        $this->db->query($sql, $user);
        return $this->db->affected_rows();
    }
}