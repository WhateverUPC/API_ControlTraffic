<?php
class User_model extends CI_Model
{

    public function get_all()
    {
        $sql = "SELECT * FROM users";
        $users = $this->db->query($sql)->result();

        if($users) $status = 1;

        return array("status" => $status,
                     "users" => $users);
    }

    public function login($my_username, $my_password)
    {
        $sql = "SELECT IF( EXISTS(
                SELECT username
                FROM users
                WHERE (username LIKE '{$my_username}' AND password LIKE '{$my_password}')), 1, 0) as login_success";
        
        $result_login = $this->db->query($sql)->first_row();
        
        $id        = null;
        $username  = null;
        $fullname  = null;
        $full_name = null;
        $email     = null;

        if($result_login->login_success == 1)
        {
            $sql_user = "SELECT id, fullname, username, email FROM users WHERE username = '{$my_username}' AND password = '{$my_password}'";
            $result_user = $this->db->query($sql_user)->first_row();

            $id        = $result_user->id;
            $username  = $result_user->username;
            $full_name = $result_user->fullname;
            $email     = $result_user->email;
        }

        return array("logged"   => $result_login->login_success,
                     "id"       => $id,
                     "username" => $username,
                     "fullname" => $fullname,
                     "email"    => $email);
        
    }

    public function get($id)
    {
        $sql = "SELECT * FROM users WHERE id = {$id}";
        $user = $this->db->query($sql)->result();

        if($user) $status = 1;

        return array("status" => $status,
                     "user" => $user);
    }

}
