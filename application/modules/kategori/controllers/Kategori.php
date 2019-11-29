<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Kategori extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('Kategori_model');
            $this->load->library('form_validation');
	    $method=$this->router->fetch_method();
            // if($method != 'ajax_list'){
            //   if($this->session->userdata('status')!='login'){
            //     redirect(base_url('login'));
            //   }
            // }
        }

        public function index()
        {$datakategori=$this->Kategori_model->getDataTable();//panggil ke modell
          $datafield=$this->Kategori_model->get_field();//panggil ke modell

           $data = array(
             'content'=>'kategori/kategori/kategori_list',
             'sidebar'=>'kategori/sidebar',
             'css'=>'kategori/kategori/css',
             'js'=>'kategori/kategori/js',
             'datakategori'=>$datakategori,
             'datafield'=>$datafield,
             'module'=>'kategori',
             'titlePage'=>'kategori',
             'controller'=>'kategori'
            );
          $this->template->load($data);
        }

        //DataTable
        public function ajax_list()
      {
          $list = $this->Kategori_model->get_datatables();
          $data = array();
          $no = $_POST['start'];
          foreach ($list as $Kategori_model) {
              $no++;
              $row = array();
              $row[] = $no;
							$row[] = $Kategori_model->nama_kategori;
							
              $row[] ="
              <a href='kategori/edit/$Kategori_model->id_kategori'><i class='m-1 feather icon-edit-2'></i></a>
              <a class='modalDelete' data-toggle='modal' data-target='#responsive-modal' value='$Kategori_model->id_kategori' href='#'><i class='feather icon-trash'></i></a>";
              $data[] = $row;
          }

          $output = array(
                          "draw" => $_POST['draw'],
                          "recordsTotal" => $this->Kategori_model->count_all(),
                          "recordsFiltered" => $this->Kategori_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


        public function create(){
           $data = array(
             'content'=>'kategori/kategori/kategori_create',
             'sidebar'=>'kategori/sidebar',
             'action'=>'kategori/kategori/create_action',
             'module'=>'kategori',
             'titlePage'=>'kategori',
             'controller'=>'kategori'
            );
          $this->template->load($data);
        }

        public function edit($id_kategori){
          $dataedit=$this->Kategori_model->get_by_id($id_kategori);
           $data = array(
             'content'=>'kategori/kategori/kategori_edit',
             'sidebar'=>'kategori/sidebar',
             'action'=>'kategori/kategori/update_action',
             'dataedit'=>$dataedit,
             'module'=>'kategori',
             'titlePage'=>'kategori',
             'controller'=>'kategori'
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
					'nama_kategori' => $this->input->post('nama_kategori',TRUE),
					
);

            $this->Kategori_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kategori/kategori'));
        }
    }




    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id', TRUE));
        } else {
            $data = array(
					'nama_kategori' => $this->input->post('nama_kategori',TRUE),
					
);

            $this->Kategori_model->update($this->input->post('id_kategori', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kategori/kategori'));
        }
    }

    public function delete($id_kategori)
    {
        $row = $this->Kategori_model->get_by_id($id_kategori);

        if ($row) {
            $this->Kategori_model->delete($id_kategori);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kategori/kategori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori/kategori'));
        }
    }

    public function _rules()
    {
$this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'trim|required');


	$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

    }

}