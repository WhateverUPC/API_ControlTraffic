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

    public function find_get()
    {
        ($this->get("id")) ? $id = $this->get("id") : $id = "";

        $this->load->model("Project_model");

        $this->response($this->Project_model->get($id));
    }

    public function user_get()
    {
        ($this->get("id")) ? $id = $this->get("id") : $id = "";

        $this->load->model("Project_model");

        $this->response($this->Project_model->get($id));
    }

    public function all_get()
    {
        $this->load->model("Project_model");

        $this->response($this->Project_model->get_all());
    }

}