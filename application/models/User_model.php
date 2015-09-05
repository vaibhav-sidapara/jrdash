<?php
/**
 * User: vaibhav
 * Date: 8/4/15
 * Time: 3:26 PM
 */

class User_model extends CRUD{

    protected $table = 'user';
    protected $_primary_key = 'user_id';

    public function __construct(){
        parent::__construct();
    }
}