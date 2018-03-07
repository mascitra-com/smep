<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Rizki Herdatullah
 * Date: 1/27/2018
 * Time: 3:49 PM
 */

class Proyek_m extends MY_Model
{

    public $table = 'proyek'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key
    public function __construct()
    {
        $this->has_many['realisasi_keuangan'] = array('Realisasi_keuangan_m','proyek_id','id');
        parent::__construct();
    }
}