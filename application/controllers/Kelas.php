<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller {
    //Tambah Construct
    public function __construct() {
        parent::__construct();
        $this->load->model(array("m_kelas"));
    }
    public function index()
    {
        $this->load->helper(array("currency"));
        // $data["datakelas"] = $this->db->get("masterkelas")->result();
        // diubah
        $data["datakelas"]=$this->m_kelas->getkelas()->result();
        // $this->load->view("kelas/datakelas", $data);
        // diubah
        $data["content"]="kelas/datakelas";
        $this->load->view("layouts/index", $data) ;
    }
    public function tambah()
    {
        // $this->load->view("kelas/tambahkelas");
        // menjadi
        $data["content"]="kelas/tambahkelas";
        $this->load->view("layouts/index", $data);
    }
    public function simpantambah()
    {
        $postData = $this->input->post();
        unset($postData['submit']);
        // $this->db->insert("masterkelas", $postData);
        // diubah
       $this->m_kelas->savekelas($postData);
        redirect(site_url("kelas"));
    }
    public function hapus()
    {
        $where['id'] = $this->uri->segment(3);
        // $this->db->where($where)->delete("masterkelas");
        // diubah
        $this->m_kelas->deletekelas($where);
        redirect(site_url("kelas"));
    }
    public function edit()
    {
        $where['id'] = $this->uri->segment(3);
        $data["datakelas"] = $this->db->where($where)->get("masterkelas")->row();
        // diubah
        // $data["datakelas"]=$this->m_kelas->getsinglekelas($where)->row();
        // $this->load->view("kelas/editkelas", $data);
        // menjadi
        $data["content"]="kelas/editkelas";
        $this->load->view("layouts/index", $data);
    }
    public function simpanedit()
    {
        $postData = $this->input->post();
        $where['id'] = $postData['id'];
        unset($postData['submit'], $postData['id']);
        // $this->db->where($where)->update("masterkelas", $postData);
        // diubah
        $this->m_kelas->updatekelas($where, $postData);
        redirect(site_url("kelas"));
    }
}
