<?php
class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library([
            'form_validation'
        ]);
        $this->load->model('Modelmahasiswa', 'mahasiswa');
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

    public function formtambah()
    {
        if ($this->input->is_ajax_request() == true) {
            $msg = [
                'sukses' => $this->load->view('mahasiswa/modaltambah', '', true)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandata()
    {
        if ($this->input->is_ajax_request() == true) {
            $nobp = $this->input->post('nobp', true);
            $nama = $this->input->post('nama', true);
            $tempat = $this->input->post('tempat', true);
            $tgl = $this->input->post('tgl', true);
            $jenkel = $this->input->post('jenkel', true);

            $this->form_validation->set_rules(
                'nobp',
                'No.BP',
                'trim|required|is_unique[mahasiswa.nobp]',
                [
                    'required' => '%s tidak boleh kosong',
                    'is_unique' => '%s sudah ada didalam database'
                ]
            );

            $this->form_validation->set_rules(
                'nama',
                'Nama Mahasiswa',
                'trim|required',
                [
                    'required' => '%s tidak boleh kosong',
                ]
            );


            if ($this->form_validation->run() == TRUE) {
                $this->mahasiswa->simpan($nobp, $nama, $tempat, $tgl, $jenkel);

                $msg = [
                    'sukses' => 'data mahasiswa berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    ' . validation_errors() . '
                </div>'
                ];
            }

            echo json_encode($msg);
        }
    }
}