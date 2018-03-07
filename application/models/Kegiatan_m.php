<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Rizki Herdatullah
 * Date: 1/27/2018
 * Time: 4:19 PM
 */

class Kegiatan_m extends MY_Model
{

    public $table = 'kegiatan'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key
    public function __construct()
    {
        $this->has_many['rup'] = array('Rup_m','kegiatan_id','id');
//        $this->has_many_pivot['proyek'] = array(
//            'foreign_model'=>'proyek_m',
//            'pivot_table'=>'rup',
//            'local_key'=>'id',
//            'pivot_local_key'=>'kegiatan_id',
//            'foreign_key'=>'rup_id',
//            'get_relate'=>FALSE
//        );
        parent::__construct();
    }

}