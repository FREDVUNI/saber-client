<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Service extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/service_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Vehicle_model');
            $this->load->model('backend/Vendor_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'services';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['service'] = $this->service_model->services();
            $this->load->view('backend/service/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function create(){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();
            $data['title'] = 'create service';

            $this->form_validation->set_rules('vehicle_id', 'vehicle','required|trim');
            $this->form_validation->set_rules('service', 'service','required|trim');
            $this->form_validation->set_rules('amount', 'amount','required|trim');
            $this->form_validation->set_rules('comment', 'comment','required|trim');
            $this->form_validation->set_rules('vendor_id', 'vendor','required|trim');

            if ($this->form_validation->run() == FALSE) :
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $data['vendors'] = $this->Vendor_model->vendors();
                $data['vehicles'] = $this->Vehicle_model->vehicles();
                $this->load->view('backend/service/create',$data);

                $this->load->view('templates/footer',$data);
            else:
                $data['vehicle_id'] = $this->input->post('vehicle_id');
                $data['service'] = $this->input->post('service');
                $data['amount'] = $this->input->post('amount');
                $data['comment'] = $this->input->post('comment');
                $data['vendor_id'] = $this->input->post('vendor_id');

                if($_FILES['userfile']['name'] != '' || $_FILES['userfile']['size'] != 0):
                    //uploading the image link to the database.
                    $config['upload_path'] = './assets/uploads/receipts/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '9024';
                    $config['max_height'] = '9024';
                    $config['encrypt_name'] = true;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('userfile')):
                        $this->session->set_flashdata('message', '<div class="alert alert-danger role=" alert">
                            '.$this->upload->display_errors().'</div>');
                        return redirect('service');
                    else:
                        $fileData = $this->upload->data();
                        $data['userfile'] =
                        'https://sb.rafahgroup.com/assets/uploads/receipts/'.$fileData['file_name'];
                    endif;
                else :
                    $this->session->set_flashdata('message', '<div class="alert alert-danger role=" alert">
                        Invalid image.please try again.</div>');
                    return redirect('service');
                endif;
                $this->Service_model->save($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                    The service has been added.</div>');
                return redirect('service-list');
            endif;
        }
        
        public function edit($id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['service'] = $this->Service_model->services($id); 
            $data['title'] =word_limiter($data['service']['service'],2);

            if(empty($data['service'])) :
                return redirect('404');
            endif;

            $this->form_validation->set_rules('vehicle_id', 'vehicle_id','required|trim');
            $this->form_validation->set_rules('service', 'service','required|trim');
            $this->form_validation->set_rules('amount', 'amount','required|trim');
            $this->form_validation->set_rules('comment', 'comment','required|trim');
            $this->form_validation->set_rules('payment_receipt', 'payment_receipt','required|trim');

            if($this->form_validation->run() == FALSE):
                $this->load->view('templates/header',$data);
                $data['vendors'] = $this->Vendor_model->vendors();
                $data['vehicles'] = $this->Vehicle_model->vehicles();
                $this->load->view('backend/driver/edit',$data);
                $this->load->view('templates/sidebar');

                $this->load->view('templates/footer');
            else:
                $id=$this->input->post('id');
                $service=$this->input->post('service');
                $amount=$this->input->post('amount');
                $vehicle_id=$this->input->post('vehicle_id');
                $comment=$this->input->post('comment');

                $this->db->set('service',$service);
                $this->db->set('amount',$amount);
                $this->db->set('vehicle_id',$vehicle_id);
                $this->db->set('comment',$comment);
                $this->db->where('service_id',$id);

                $this->db->update("services");
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                    The service has been updated.</div>');
                return redirect('service-list');
            endif;
        }
         public function delete($id){
           $data = $this->Service_model->services($id);
           $imagePath = str_replace('https://sb.rafahgroup.com/assets/uploads/receipts/','',$data->image);
            if(empty($data)) :
                return redirect('404');
            endif;
            $path = './assets/uploads/receipts/';

            @unlink($path . $imagePath);
            if($this->Service_model->delete($id)):
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                    The service has been deleted.</div>');
                return redirect('service-list');
            endif;
        }
    } 
