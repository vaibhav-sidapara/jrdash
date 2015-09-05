<?php
/**
 * User: vaibhav
 * Date: 8/18/15
 * Time: 10:04 AM
 */

class Note_model extends CRUD{

    protected $table = 'note';
    protected $_primary_key = 'note_id';

    public function __construct(){
        parent::__construct();
    }
}