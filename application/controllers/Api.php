<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('todo_model');
        $this->load->model('note_model');
    }

    private function _require_login(){

        if($this->session->userdata('user_id') == false){
            $this->output->set_content_type('application_json');
            $error_msg = array
            (
                array('You are not authorized')
            );
            $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
        }
    }

    public function login(){

        $this->output->set_content_type('application_json');

        $this->form_validation->set_rules('login','Login','required');
        $this->form_validation->set_rules('password','Password','required');

        if($this->form_validation->run()==false){
            $this->output->set_output(json_encode(['result' => 0, 'error'=> $this->form_validation->error_array()]));
            return false;
        }

        $login = $this->input->post('login');
        $password = $this->input->post('password');

        $result = $this->user_model->get([
            'login'=> $login,
            'password'=> hash('sha256', $password.SALT)
        ]);

        if($result){
            $this->session->set_userdata(['user_id'=>$result[0]['user_id']]);
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }

        $error_msg = array
        (
            array('Invalid Username and Password')
        );
        $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
    }

    public function register(){
        $this->output->set_content_type('application_json');

        $this->form_validation->set_rules('login','Login','required|min_length[4]|max_length[16]|is_unique[user.login]');
        $this->form_validation->set_rules('password','Password','required|min_length[4]|max_length[16]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[user.email]');
        $this->form_validation->set_message('matches', 'Passwords do not match');
        $this->form_validation->set_message('is_unique', 'This %s is already taken.');

        if($this->form_validation->run()==false){
            $this->output->set_output(json_encode(['result' => 0, 'error'=> $this->form_validation->error_array()]));
            return false;
        }

        $login = $this->input->post('login');
        $password = $this->input->post('password');
        $email = $this->input->post('email');

        $result = $this->user_model->insert([
            'login'=>$login,
            'password'=>hash('sha256', $password.SALT),
            'email'=>$email,
            'date_added'=> DATETIME
        ]);

        if($result){
            $this->session->set_userdata(['user_id'=>$result]);
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }

        $error_msg = array
        (
            array('User Not Created')
        );
        $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
    }

    public function create_todo(){
        $this->_require_login();
        $this->form_validation->set_rules('content','Todo Item','required|max_length[255]');
        if($this->form_validation->run() == false){
            $this->output->set_output(json_encode([
                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));
            return false;
        }

        $result = $this->todo_model->insert([
            'user_id'=> $this->session->userdata('user_id'),
            'content'=> $this->input->post('content'),
            'date_added' => DATETIME
        ]);

        if ($result){
            $this->output->set_output(json_encode([
                'result' => 1,
                'new_entry'=>$this->todo_model->get($result)
            ]));
            return false;
        }

        $error_msg = array
        (
            array('Todo Item Not Created')
        );
        $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
    }

    public function get_todo($id = null){

        $this->_require_login();

        if($id != null){
            $result = $this->todo_model->get([
                'todo_id'=> $id,
                'user_id'=> $this->session->userdata('user_id')
            ]);
        } else {
            $result = $this->todo_model->get([
                'user_id'=> $this->session->userdata('user_id')
            ]);
        }
        $this->output->set_output(json_encode($result));
    }

    public function update_todo(){

        $this->_require_login();
        $todo_id = $this->input->post('todo_id');
        $completed = $this->input->post('completed');

        $result = $this->todo_model->update([
            'completed'=>$completed
        ],$todo_id);

        if ($result){
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }

        $error_msg = array
        (
            array('Todo Item Not Updated')
        );
        $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
    }

    public function delete_todo(){

        $this->_require_login();
        $result = $this->todo_model->delete([
            'todo_id' => $this->input->post('todo_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result){
            $this->output->set_output(json_encode([
                'result' => 1
            ]));
            return false;
        }

        $error_msg = array
        (
            array('Todo Item Not Deleted')
        );
        $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
    }

    public function create_note(){

        $this->_require_login();
        $this->form_validation->set_rules('title','Note Title','required|max_length[50]');
        $this->form_validation->set_rules('content','Note Content','required|max_length[500]');
        if($this->form_validation->run() == false){
            $this->output->set_output(json_encode([
                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));
            return false;
        }

        $result = $this->note_model->insert([
            'user_id'=> $this->session->userdata('user_id'),
            'title'=> $this->input->post('title'),
            'content'=> $this->input->post('content'),
            'date_added' => DATETIME
        ]);

        if ($result){
            $this->output->set_output(json_encode([
                'result' => 1,
                'new_entry'=>$this->note_model->get($result)
            ]));
            return false;
        }

        $error_msg = array
        (
            array('Note Not Created')
        );
        $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
    }

    public function get_note($id = null){

        $this->_require_login();

        if($id != null){
            $result = $this->note_model->get([
                'note_id'=> $id,
                'user_id'=> $this->session->userdata('user_id')
            ]);
        } else {
            $result = $this->note_model->get([
                'user_id'=> $this->session->userdata('user_id')
            ]);
        }
        $this->output->set_output(json_encode($result));
    }

    public function update_note(){

        $this->_require_login();

        $this->form_validation->set_rules('title','Note Title','required|max_length[50]');
        $this->form_validation->set_rules('content','Note Content','required|max_length[500]');
        if($this->form_validation->run() == false){
            $this->output->set_output(json_encode([
                'result' => 0,
                'error' => $this->form_validation->error_array()
            ]));
            return false;
        }

        $result = $this->note_model->update([
            'title'=> $this->input->post('title'),
            'content'=> $this->input->post('content'),
            'date_modified' => DATETIME
        ], $this->input->post('note_id'));

        if ($result){
            $this->output->set_output(json_encode(['result' => 1]));
            return false;
        }

        $error_msg = array
        (
            array('Note Not Updated')
        );
        $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
    }

    public function delete_note(){

        $this->_require_login();
        $result = $this->note_model->delete([
            'note_id' => $this->input->post('note_id'),
            'user_id' => $this->session->userdata('user_id')
        ]);

        if ($result){
            $this->output->set_output(json_encode([
                'result' => 1
            ]));
            return false;
        }

        $error_msg = array
        (
            array('Note Not Deleted')
        );
        $this->output->set_output(json_encode(['result' => 0, 'error'=> $error_msg]));
    }
}