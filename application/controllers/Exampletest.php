<?php
/**
 * User: vaibhav
 * Date: 8/4/15
 * Time: 3:28 PM
 */

class Exampletest extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->model('user_model');
    }

    public function index(){
        $this->output->enable_profiler(true);

//        Get
//        $result = $this->user_model->get();

//        Insert
//        $result = $this->user_model->insert([
//            'login' => 'Mark',
//            'password' => '123'
//        ]);

//        Delete
//        $result = $this->user_model->delete([
//            'login'=>'Steve'
//        ]);

//        Update
//        $result = $this->user_model->update([
//            'password'=>'789'
//        ],[
//            'login'=>'Elon'
//        ]);

//        insertUpdate
//        $result = $this->user_model->insertUpdate([
//            'login' => 'elon',
//            'password'=> hash('sha256', 'elon'.SALT),
//            'email' => 'elon@musk.com'
//        ],3);

        echo "<pre>";
        print_r($result);
    }
}
