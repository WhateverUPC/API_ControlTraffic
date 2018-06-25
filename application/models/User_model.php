<?php
class User_model extends CI_Model
{

    public function get_all()
    {
        $sql = "SELECT * FROM users";
        return $this->db->query($sql)->result();
    }

    public function login($username, $password)
    {
        $sql = "SELECT IF( EXISTS(
                SELECT username
                FROM users
                WHERE (username LIKE '{$username}' AND password LIKE '{$password}')), 1, 0) as login_success";
        
        $result_login = $this->db->query($sql)->first_row();
        
        $id        = null;
        $username  = null;
        $fullname  = null;
        $full_name = null;
        $email     = null;

        if($result_login->login_success == 1)
        {
            $sql_user = "SELECT id, fullname, username, email FROM users WHERE username = '{$username}' AND password = '{$password}'";
            $result_user = $this->db->query($sql)->first_row();

            $id        = $result_user->id;
            $username  = $result_user->username;
            $full_name = $result_user->fullname;
            $email     = $result_user->email;
        }

        return array("logged"   => $result_login,
                     "id"       => $id,
                     "username" => $username,
                     "fullname" => $fullname,
                     "email"    => $email);
        
    }

}
