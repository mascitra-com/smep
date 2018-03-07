<?php
/**
 * Created by PhpStorm.
 * User: Rizki Herdatullah
 * Date: 1/29/2018
 * Time: 4:24 PM
 */

class Realisasi_keuangan_m extends MY_Model
{

    public $table = 'realisasi_keuangan'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key
    public function __construct()
    {
        parent::__construct();
    }

}