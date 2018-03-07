<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Rizki Herdatullah
 * Date: 1/27/2018
 * Time: 4:18 PM
 */

class Program_m extends MY_Model
{

    public $table = 'program'; // Set the name of the table for this model.
    public $primary_key = 'id'; // Set the primary key

    public function __construct()
    {
        $this->has_many['kegiatan'] = array('Kegiatan_m','program_id','id');
        parent::__construct();
    }

    public function filter_proyek($data)
    {
        $array = array();
        $data = $this->objToArray($data, $array);
        foreach ($data as $indexProgram => &$program) {
            $have_rup = FALSE;
            if(isset($program['kegiatan']) && !empty($program['kegiatan'])){
                foreach ($program['kegiatan'] as $indexKegiatan => &$kegiatan){
                    if(isset($kegiatan['rup'])){
                        $have_rup = TRUE;
                        foreach ($kegiatan['rup'] as $indexRup => &$rup){
                            $nilai_kontrak = 0;
                            $nilai_realisasi = 0;
                            $realisasi_bln_ini = 0;
                            $realisasi_bln_lalu = 0;
                            $nama_perusahaan = '';
                            if(!isset($rup['proyek'])){
                                unset($data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]);
                            } else {
                                foreach ($rup['proyek'] as $indexProyek => &$proyek){
                                    $nilai_kontrak = $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['proyek'][$indexProyek]['nilai_kontrak'];
                                    if(isset($proyek['nama_perusahaan']))
                                    if(isset($proyek['realisasi_keuangan'])){
                                        foreach ($proyek['realisasi_keuangan'] as $indexRealisasi => $realisasi){
                                            $nilai_realisasi += $realisasi['jumlah'];
                                            if(strtolower(date('m/Y',strtotime($realisasi['tgl']))) == strtolower(date('m/Y'))){
                                                $realisasi_bln_ini = $realisasi['jumlah'];
                                            }else{
                                                $realisasi_bln_lalu += $realisasi['jumlah'];
                                            }
                                        }
                                    }
                                }
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['nama_ppk'] = $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['proyek'][$indexProyek]['nama_ppk'];
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['tgl_kontrak'] = $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['proyek'][$indexProyek]['tgl_kontrak'];
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['tgl_selesai_kontrak'] = $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['proyek'][$indexProyek]['tgl_selesai_kontrak'];
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['nilai_kontrak'] = $nilai_kontrak;
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['sisa_kontrak'] = $nilai_kontrak - $nilai_realisasi;
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['nama_perusahaan'] = $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['proyek'][$indexProyek]['nama_perusahaan'];
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['realisasi_bln_ini'] = $realisasi_bln_ini;
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['realisasi_bln_lalu'] = $realisasi_bln_lalu;
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['nilai_realisasi'] = $nilai_realisasi;
                                $pagu = $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['pagu'];
                                $sisa_anggaran = $pagu - $nilai_realisasi;;
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['persen_realisasi'] = isset($nilai_realisasi) ? (int) ($nilai_realisasi / $nilai_kontrak * 100) : 0;
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['sisa_anggaran'] = $sisa_anggaran;
                                $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['persen_kegiatan'] = isset($sisa_anggaran) ? (int) ($nilai_realisasi / $pagu * 100) : 0;
                                unset($data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'][$indexRup]['proyek'][$indexProyek]);
                            }
                        }
                        $data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'] = $this->array_sort($data[$indexProgram]['kegiatan'][$indexKegiatan]['rup'], 'jenis_belanja_id');
                    } else {
                        unset($data[$indexProgram]['kegiatan'][$indexKegiatan]);
                    }
                }
            }
            if(!$have_rup)
                unset($data[$indexProgram]);
        }
        return $data;
    }

    function array_sort($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }

    public function objToArray($obj, &$arr){

        if(!is_object($obj) && !is_array($obj)){
            $arr = $obj;
            return $arr;
        }

        foreach ($obj as $key => $value)
        {
            if (!empty($value))
            {
                $arr[$key] = array();
                $this->objToArray($value, $arr[$key]);
            }
            else
            {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

    public function get_monev($bulan, $satker_id = NULL)
    {
        $this->db->select('program.id, namaprogram');
        $this->db->from('program');
        $this->db->join('rup', 'program.id = rup.program_id');
        $this->db->where('rup.waktu_akhir <=', $bulan);
        if($satker_id)
            $this->db->where('rup.satker_id', $satker_id);
        $this->db->group_by('program.id');
        $program =  $this->db->get()->result_array();
        foreach ($program as $keyPro => $valPro) {
            // Get Kegiatan
            $this->db->select('id, kdkegiatan, namakegiatan');
            $this->db->from('kegiatan');
            $this->db->where('program_id', $valPro['id']);
            $kegiatan = $this->db->get()->result_array();
            foreach ($kegiatan as $keyKeg => $valKeg){
                $program[$keyPro]['kegiatan'][$keyKeg] = $valKeg;

                // Get RUP
                $this->db->select('id, jenis_belanja_id, nama_paket, lokasi, volume, sumber_dana, pagu, tahun_anggaran');
                $this->db->from('rup');
                $this->db->where('kegiatan_id', $valKeg['id']);
                $rup = $this->db->get()->result_array();
                if($rup) {
                    foreach ($rup as $keyRup => $valRup) {

                        // Get Proyek
                        $this->db->select('id, nama_ppk, nilai_kontrak, tgl_kontrak, tgl_selesai_kontrak, nama_perusahaan');
                        $this->db->from('proyek');
                        $this->db->where('rup_id', $valRup['id']);
                        $proyek = $this->db->get()->result_array();
                        if ($proyek) {
                            $program[$keyPro]['kegiatan'][$keyKeg]['rup'][$keyRup] = $valRup;
                            foreach ($proyek as $keyProyek => $valProyek) {
                                $program[$keyPro]['kegiatan'][$keyKeg]['rup'][$keyRup]['proyek'][$keyProyek] = $valProyek;

                                $this->db->select('id, tgl, jumlah');
                                $this->db->from('realisasi_keuangan');
                                $this->db->where('proyek_id', $valProyek['id']);
                                $realisasi = $this->db->get()->result_array();
                                if ($realisasi) {
                                    foreach ($realisasi as $keyRea => $valRea) {
                                        $program[$keyPro]['kegiatan'][$keyKeg]['rup'][$keyRup]['proyek'][$keyProyek]['realisasi_keuangan'][$keyRea] = $valRea;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $program;
    }
}