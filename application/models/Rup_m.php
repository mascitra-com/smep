<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Rizki Herdatullah
 * Date: 1/27/2018
 * Time: 4:19 PM
 */

class Rup_m extends MY_Model
{

    public $table = 'rup'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key
    public function __construct()
    {
        $this->has_many['proyek'] = array('Proyek_m','rup_id','id');
        parent::__construct();
    }

}