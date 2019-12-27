<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isyarat extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('Dbs'));
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }


  function get_kata(){
    header('Content-Type: application/json');
      //StartPagination
      if(isset($_GET['page'])){//cek parameter page
        $page=$_GET['page'];
      }else{
        $page=1;//default jika parameter page tidak diload
      }
      $limitDb=1000;
      $offsetDb=0;
      if($page!=1 and $page!=0){
        $offsetDb=$limitDb*($page-1);
      }
      //End Pagination
      //default fungsi dari : getdata($table,$where=null,$limit=9,$offset=0){
      $table='kata_isyarat';
      $loadDb=$this->Dbs->getdata($table,null,$limitDb,$offsetDb);//database yang akan di load
      $check=$loadDb->num_rows();
      if($check>0){
        $get=$loadDb->result(); //Uncomment ini untuk contoh
        $data=array(
          'status'=>'success',
          'message'=>'found',
          'total_result'=>$check,
          // 'results'=>"ISI DARI RESULT DATABASE",
          'results'=>$get //Uncomment ini untuk contoh
        );
      }else{
        $data=array(
          'status'=>'success',
          'total_result'=>$check,
          'message'=>'not found'
        );
      }

    $json=json_encode($data);
    echo $json;
  }

}
