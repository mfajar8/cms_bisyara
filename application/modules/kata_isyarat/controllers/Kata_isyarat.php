<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Kata_isyarat extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Kata_isyarat_model');
            $this->load->library('form_validation');
	          $method=$this->router->fetch_method();
            // if($method != 'ajax_list'){
            //   if($this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
            if($this->session->userdata('status')!='login'){
              redirect(base_url('auth/login'));
            }
        }

        public function index()
        {$datakata_isyarat=$this->Kata_isyarat_model->getDataTable();//panggil ke modell
          $datafield=$this->Kata_isyarat_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'kata_isyarat/kata_isyarat/kata_isyarat_list',
             'sidebar'=>'kata_isyarat/sidebar',
             'css'=>'kata_isyarat/kata_isyarat/css',
             'js'=>'kata_isyarat/kata_isyarat/js',
             'datakata_isyarat'=>$datakata_isyarat,
             'datafield'=>$datafield,
             'module'=>'kata_isyarat',
             'titlePage'=>'kata_isyarat',
             'controller'=>'kata_isyarat'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->Kata_isyarat_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $Kata_isyarat_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $Kata_isyarat_model->arti_kata;
							$row[] = $Kata_isyarat_model->url_gambar;
							$row[] = $Kata_isyarat_model->id_kategori;

              $row[] ="
              <a href='kata_isyarat/edit/$Kata_isyarat_model->id_kata'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$Kata_isyarat_model->id_kata' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->Kata_isyarat_model->count_all(),
                          "recordsFiltered" => $this->Kata_isyarat_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'kata_isyarat/kata_isyarat/kata_isyarat_create',
             'sidebar'=>'kata_isyarat/sidebar',
             'action'=>'kata_isyarat/kata_isyarat/create_action',
             'module'=>'kata_isyarat',
             'titlePage'=>'kata_isyarat',
             'controller'=>'kata_isyarat'
            );
          $this->template->load($data);
        }

        public function edit($id_kata){
          $dataedit=$this->Kata_isyarat_model->get_by_id($id_kata);
           $data = array(
             'content'=>'kata_isyarat/kata_isyarat/kata_isyarat_edit',
             'sidebar'=>'kata_isyarat/sidebar',
             'action'=>'kata_isyarat/kata_isyarat/update_action',
             'dataedit'=>$dataedit,
             'module'=>'kata_isyarat',
             'titlePage'=>'kata_isyarat',
             'controller'=>'kata_isyarat'
            );
          $this->template->load($data);
        }
public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
					'arti_kata' => $this->input->post('arti_kata',TRUE),
					'url_gambar' => $this->input->post('url_gambar',TRUE),
					'id_kategori' => $this->input->post('id_kategori',TRUE),

);

            $this->Kata_isyarat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kata_isyarat/kata_isyarat'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'arti_kata' => $this->input->post('arti_kata',TRUE),
					'url_gambar' => $this->input->post('url_gambar',TRUE),
					'id_kategori' => $this->input->post('id_kategori',TRUE),

);

            $this->Kata_isyarat_model->update($this->input->post('id_kata', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kata_isyarat/kata_isyarat'));
        }
    }

    public function delete($id_kata)
    {
        $row = $this->Kata_isyarat_model->get_by_id($id_kata);

        if ($row) {
            $this->Kata_isyarat_model->delete($id_kata);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kata_isyarat/kata_isyarat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kata_isyarat/kata_isyarat'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('arti_kata', 'arti_kata', 'trim|required');
$this->form_validation->set_rules('url_gambar', 'url_gambar', 'trim|required');
$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required');


	$this->form_validation->set_rules('id_kata', 'id_kata', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}
