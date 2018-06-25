<?php
class Project_model extends CI_Model
{

    public function get_all()
    {
        $sql = "SELECT * FROM project";
        $projects = $this->db->query($sql)->result();

        if($projects) $status = 1; else $status = 0;

        return array("status" => $status,
                     "projects" => $projects);
    }

    public function get($id)
    {
        $sql = "SELECT * FROM project WHERE id = {$id}";
        $project = $this->db->query($sql)->first_row();

        if($project) $status = 1; else $status = 0;

        return array("status" => $status,
                     "project" => $project);
    }

    public function get_from_user($id)
    {
        $sql = "SELECT project.* FROM project INNER JOIN project_user ON project.id = project_user.project_id WHERE project_user.user_id = {$id}";
        $projects = $this->db->query($sql)->result();

        if($projects) $status = 1; else $status = 0;

        return array("status" => $status,
                     "projects" => $projects);
    }

    public function entry($projectid, $userid, $direction){
        $hour = date("H:i");
        $sql = "INSERT INTO project_entry (project_id, user_id, entry_date, entry_hour, direction) VALUES ({$projectid}, {$userid}, CURDATE(), '{$hour}', '{$direction}')";

        if($this->db->query($sql)){
            $status = 1;
        } else{
            $status = 0;
        }

        return array("status" => $status);
    }

}
