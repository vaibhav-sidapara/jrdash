<?php
/**
 * User: vaibhav
 * Date: 8/18/15
 * Time: 10:04 AM
 */

class Todo_model extends CRUD{

    protected $table = 'todo';
    protected $_primary_key = 'todo_id';

    public function __construct(){
        parent::__construct();
    }
}