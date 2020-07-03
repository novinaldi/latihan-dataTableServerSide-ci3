<?php
class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $parser = [
            'judul' => '<i class="fa fa-users"></i> Data Mahasiswa',
            'isi' => $this->load->view('mahasiswa/tampildata', '', true)
        ];
        $this->parser->parse('template/main', $parser);
    }
    public function ambildata()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->load->model('Modelmahasiswa', 'mahasiswa');
            $list = $this->mahasiswa->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();

                $row[] = $no;
                $row[] = $field->nobp;
                $row[] = $field->nama;
                $row[] = $field->tmplahir;
                $row[] = $field->tgllahir;
                $row[] = $field->jenkel;
                $row[] = "";
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->mahasiswa->count_all(),
                "recordsFiltered" => $this->mahasiswa->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
}