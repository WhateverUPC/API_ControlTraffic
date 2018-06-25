<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
require APPPATH . '/libraries/REST_Controller.php';

class Projects extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper("url");
    }

    public function login_get()
    {
        ($this->get("username")) ? $username = $this->get("username") : $username = "";
        ($this->get("password")) ? $password = $this->get("password") : $password = "";

        $this->load->model("User_model");

        $this->response($this->User_model->login($username, $password));
    }

}