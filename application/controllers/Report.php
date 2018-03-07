<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login/', 'refresh');
        }

        if (!in_array($this->session->userdata('level'), array(1, 3, 5))) {
            redirect('/login/', 'refresh');
        }
        $this->load->helper('utilities');
    }

    public function is_logged_in()
    {
        return $this->session->userdata('is_logged_in');
    }

    function form()
    {
        $q_satker = $this->db->get("satker");
        $q_jenispengadaan = $this->db->get("jenis_pengadaan");

        $params = array();
        $params["satker"] = $q_satker->result_object();
        $params["jenispengadaan"] = $q_jenispengadaan->result_object();

        $this->load->view('report_form', $params);
    }

    function cetak()
    {
        $tgl = $this->input->post('tgl');
        switch ($this->input->post('jenis_report')) {
            case 'report1':
                $this->report1();
                break;
            case 'report2':
                $this->report2();
                break;
            case 'report3':
                $this->report3();
                break;
            case 'report4':
                $this->report4($tgl);
                break;
            case 'report5':
                $this->report5($tgl);
                break;
            case 'report6':
                $this->report6($tgl);
                break;
        }
    }

    function report1()
    {
        $filter1 = '';
        $filter2 = '';
        $params['jenis_pengadaan'] = '';

        if ($this->input->post('satker_id') > 0) {
            $filter1 = sprintf(" AND a.satker_id = %d", $this->input->post('satker_id'));
        }

        if ($this->input->post('jenis_pengadaan_id') > 0) {
            $filter1 = sprintf(" AND a.jenis_pengadaan_id = %d", $this->input->post('jenis_pengadaan_id'));
            $q = $this->db->get_where('jenis_pengadaan', array('id' => $this->input->post('jenis_pengadaan_id')));
            $r = $q->row();
            $params['jenis_pengadaan'] = $r->nama;
        }

        $sql = sprintf("
            SELECT 
                a.nama_paket, a.pagu, a.lokasi, a.volume, b.nilai_kontrak,
                b.id proyek_id, b.nama_perusahaan, b.alamat, b.npwp, b.no_kontrak, b.tgl_kontrak, b.waktu_awal, b.waktu_akhir,
                (b.nilai_kontrak - c.realisasi) sisa_kontrak,
                d.namasatker
            FROM rup a
            JOIN proyek b ON a.id = b.rup_id
            LEFT JOIN (
                SELECT proyek_id, SUM(jumlah) realisasi FROM realisasi_keuangan
                WHERE tgl <= '%s'
                GROUP BY proyek_id
            ) c ON b.id = c.proyek_id
            JOIN satker d ON a.satker_id = d.id
            WHERE a.tahun_anggaran = %d " . $filter1 . $filter2 . "             
            ORDER BY d.id, b.no_urut
        ", DateTime::createFromFormat('d/m/Y', $this->input->post('tgl'))->format('Y-m-d'), $this->session->userdata('tahun_anggaran'));

        $q = $this->db->query($sql);
        $params['data'] = $q->result_object();
        $params['tgl'] = $this->input->post('tgl');

        $this->load->view('report1', $params);
    }

    function report2()
    {
        $filter1 = '';
        $filter2 = '';
        $params['jenis_pengadaan'] = '';

        if ($this->input->post('satker_id') > 0) {
            $filter1 = sprintf(" AND a.satker_id = %d", $this->input->post('satker_id'));
        }

        if ($this->input->post('jenis_pengadaan_id') > 0) {
            $filter1 = sprintf(" AND a.jenis_pengadaan_id = %d", $this->input->post('jenis_pengadaan_id'));
            $q = $this->db->get_where('jenis_pengadaan', array('id' => $this->input->post('jenis_pengadaan_id')));
            $r = $q->row();
            $params['jenis_pengadaan'] = $r->nama;
        }

        $sql = sprintf("
            SELECT 
                a.nama_paket, a.pagu, a.lokasi, a.volume, b.nilai_kontrak, progres_id,
                b.id proyek_id, b.nama_perusahaan, b.alamat, b.npwp, b.no_kontrak, b.tgl_kontrak, b.waktu_awal, b.waktu_akhir,
                (b.nilai_kontrak - c.realisasi) sisa_kontrak,
                d.namasatker
            FROM rup a
            JOIN proyek b ON a.id = b.rup_id
            LEFT JOIN (
                SELECT proyek_id, SUM(jumlah) realisasi FROM realisasi_keuangan
                WHERE tgl <= '%s'
                GROUP BY proyek_id
            ) c ON b.id = c.proyek_id
            JOIN satker d ON a.satker_id = d.id
            WHERE a.tahun_anggaran = %d " . $filter1 . $filter2 . "             
            ORDER BY d.id, b.no_urut
        ", DateTime::createFromFormat('d/m/Y', $this->input->post('tgl'))->format('Y-m-d'), $this->session->userdata('tahun_anggaran'));

        $q = $this->db->query($sql);
        $params['data'] = $q->result_object();
        $params['tgl'] = $this->input->post('tgl');

        $this->load->view('report2', $params);
    }

    function report3()
    {

        $filter1 = '';
        $filter2 = '';
        $params['jenis_pengadaan'] = '';

        $this->db->select('namaprogram as nama_program, namakegiatan as nama_kegiatan, jenis_belanja.nama as belanja_langsung,
        jenis_pengadaan.nama as pengadaan_melalui, nama_paket as paket_pekerjaan');
        $this->db->from('rup');
        $this->db->join('program', 'rup.program_id = program.id', 'left');
        $this->db->join('kegiatan', 'rup.kegiatan_id = kegiatan.id', 'left');
        $this->db->join('jenis_belanja', 'rup.jenis_belanja_id = jenis_belanja.id', 'left');
        $this->db->join('jenis_pengadaan', 'rup.jenis_pengadaan_id = jenis_pengadaan.id', 'left');
        $q = $this->db->get();
        $params['data'] = $q->result_object();
        $params['tgl'] = $this->input->post('tgl');

        $this->load->view('report3', $params);
    }

    public function report4($tgl)
    {
        $satker = $this->db->select('id, namasatker')
            ->from('satker')
            ->get()->result_array();
        $satker = $this->subtitute($this->get_report($tgl), $satker, 'total');
        $data['satker'] = $satker;
        $data['bulan'] = DateTime::createFromFormat('d/m/Y', $tgl)->format('m');
        $this->load->view('report4', $data);
    }

    public function report5($tgl)
    {
        $satker = $this->db->select('id, namasatker')
            ->from('satker')
            ->get()->result_array();
        $satker = $this->subtitute($this->get_report($tgl), $satker, 'pagu');
        $data['satker'] = $satker;
        $data['bulan'] = DateTime::createFromFormat('d/m/Y', $tgl)->format('m');
        $this->load->view('report5', $data);
    }

    public function report6($tgl)
    {
        $this->load->model(array('program_m', 'sumber_dana_m'));
        $this->load->helper('dump');
        $data['bulan'] = DateTime::createFromFormat('d/m/Y', $tgl)->format('m');
        $laporan = $this->program_m
            ->fields('namaprogram')
            ->with_kegiatan(array(
                'fields' => 'kdkegiatan, namakegiatan',
                'with' => array(
                    'relation' => 'rup',
                    'fields' => 'id, jenis_belanja_id, nama_paket, lokasi, volume, sumber_dana, pagu, tahun_anggaran',
                    'with' => array(
                        'relation' => 'proyek',
                        'fields' => 'id, nama_ppk, nilai_kontrak, tgl_kontrak, tgl_selesai_kontrak, nama_perusahaan',
                        'with' => array(
                            'relation' => 'realisasi_keuangan',
                            'fields' => 'tgl, jumlah'
                        )
                    ),
                    'where' => "tahun_anggaran = " . $this->session->userdata('tahun_anggaran')
                ),
            ))
            ->as_array()
            ->get_all();
        $laporan = $this->program_m->filter_proyek($laporan);
        $data['program'] = $laporan;
        $data['sumber_dana'] = $this->sumber_dana_m->get_all();
        $this->load->view('report6', $data);
    }

    /**
     * @param $condition
     * @param $satker
     * @return mixed
     */
    private function subtitute($condition, $satker, $column)
    {
        foreach ($condition as $keyCondition => $cond) {
            foreach ($cond as $keyCond => $c) {
                foreach ($satker as $keySatker => $satuan) {
                    if ($c['id_satker'] == $satuan['id']) {
                        $satker["{$keySatker}"]["{$keyCondition}"] = (int)$c["{$column}"];
                    }
                }
            }
        }
        return $satker;
    }

    /**
     * @return mixed
     */
    private function get_report($tgl = NULL)
    {
        $bulan = "(rup.metode_awal BETWEEN 1 AND " . (int)DateTime::createFromFormat('d/m/Y', $tgl)->format('m') . ")";
        // Master Query
        $this->db->start_cache();
        $this->db->select('satker.id as id_satker, count(rup.satker_id) as total, SUM(rup.pagu) as pagu')
            ->from('satker')
            ->join('rup', 'satker.id = rup.satker_id', 'left outer')
            ->where($bulan)
            ->where('rup.tahun_anggaran', $this->session->userdata('tahun_anggaran'))
            ->group_by("satker.id");
        // TODO Bulan
        $this->db->stop_cache();
        // Total
        $data['total'] = $this->db->get()->result_array();
        // Barang / Jasa - Lelang Umum
        $this->db->where('rup.metode_pemilihan_id', '1')
            ->or_where('rup.metode_pemilihan_id', '12');
        $data['lelang_umum'] = $this->db->get()->result_array();
        // Barang / Jasa - Lelang Sederhana
        $this->db->where('rup.metode_pemilihan_id', '3')
            ->or_where('rup.metode_pemilihan_id', '13');
        $data['lelang_sederhana'] = $this->db->get()->result_array();
        // Konstruksi - Pelelangan Umum
        $this->db->where('rup.metode_pemilihan_id', '7');
        $data['umum'] = $this->db->get()->result_array();
        // Konstruksi - Pemilihan Langsung
        $this->db->where('rup.metode_pemilihan_id', '9');
        $data['pemilihan_langsung'] = $this->db->get()->result_array();
        // Konsultan - Seleksi Umum
        $this->db->where('rup.metode_pemilihan_id', '16');
        $data['seleksi_umum'] = $this->db->get()->result_array();
        // Konsultan - Seleksi Sederhana
        $this->db->where('rup.metode_pemilihan_id', '17');
        $data['seleksi_sederhana'] = $this->db->get()->result_array();

        // Dibawah 200jt / Non - Barang /Jasa
        $this->db->where('rup.metode_pemilihan_id', '5')
            ->or_where('rup.metode_pemilihan_id', '15');
        $data['barang_jasa'] = $this->db->get()->result_array();
        // Dibawah 200jt / Non - Konstruksi
        $this->db->where('rup.metode_pemilihan_id', '11');
        $data['konstruksi'] = $this->db->get()->result_array();
        // Dibawah 200jt / Non - Konsultasi
        $this->db->where('rup.metode_pemilihan_id', '19');
        $data['konsultan'] = $this->db->get()->result_array();

        // E-Purchasing
        $this->db->where('rup.metode_pemilihan_id', '6');
        $data['e_purchasing'] = $this->db->get()->result_array();
        // Penunjukan Langsung
        $this->db->where('rup.metode_pemilihan_id', '4')
            ->or_where('rup.metode_pemilihan_id', '10')
            ->or_where('rup.metode_pemilihan_id', '14')
            ->or_where('rup.metode_pemilihan_id', '18');
        $this->db->where('rup.pengadaan_melalui_id', '1');
        $data['penunjukan'] = $this->db->get()->result_array();
        // Swakelola
        $this->db->where('rup.pengadaan_melalui_id', '1');
        $data['swakelola'] = $this->db->get()->result_array();

        // Flush Cache
        $this->db->flush_cache();
        return $data;
    }
}