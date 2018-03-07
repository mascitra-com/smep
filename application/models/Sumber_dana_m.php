<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Rizki Herdatullah
 * Date: 1/27/2018
 * Time: 4:20 PM
 */

class Sumber_dana_m extends MY_Model
{

    public $table = 'sumber_dana'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key
    public function __construct()
    {
        parent::__construct();
    }

}