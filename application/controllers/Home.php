<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $parser = [
            'judul' => 'Selamat Datang',
            'isi' => $this->load->view('home/beranda', '', true)
        ];
        $this->parser->parse('template/main', $parser);
    }
}