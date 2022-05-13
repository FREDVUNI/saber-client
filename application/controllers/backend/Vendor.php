<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Vendor extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/Vendor_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Vehicle_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'Vendors';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['vendor'] = $this->Vendor_model->vendors();
            $this->load->view('backend/vendor/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function create(){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();
            $data['title'] = 'create user';

            $this->form_validation->set_rules('vendor','vendor','trim|required|is_unique[vendors.vendor]'
            ,array('is_unique' => 'This vendor already exists.'));
            $this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[vendors.email]'
            ,array('is_unique' => 'This vendor already exists.'));
            $this->form_validation->set_rules('website','website','trim|required|is_unique[vendors.website]'
             ,array('is_unique' => 'This vendor already exists.'));
            $this->form_validation->set_rules('contactPerson', 'contactPerson','required|trim');
            $this->form_validation->set_rules('location', 'location','required|trim');
            $this->form_validation->set_rules('phone','phone
            number','trim|required|max_length[15]|callback_phone_check|is_unique[users.phone]'
            ,array('is_unique' => 'A vendor with this phone number already exists.'));

            if ($this->form_validation->run() == FALSE) :
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('backend/vendor/create',$data);

                $this->load->view('templates/footer',$data);
            else:
                $data = array(
                'vendor' => $this->input->post('vendor'),
                'email' => $this->input->post('email'),
                'website' => $this->input->post('website'),
                'contactPerson' => $this->input->post('contactPerson'),
                'location' => $this->input->post('location'),
                'phone' => $this->input->post('phone'),
                'admin_id' => $data['user']['id'],
                'status' =>1
                );
                $this->db->set($data);
                $this->Vendor_model->save($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                    The vendor has been added.</div>');
                return redirect('vendors');
            endif;
        }

        public function edit($id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['vendor'] = $this->Vendor_model->vendors($id); 
            $data['title'] =word_limiter($data['vendor']['vendor'],2);

            if(empty($data['vendor'])) :
                return redirect('404');
            endif;

            $this->form_validation->set_rules('vendor', 'vendor','required|trim');
            $this->form_validation->set_rules('email', 'email','required|trim|valid_email');
            $this->form_validation->set_rules('website', 'website','required|trim');
            $this->form_validation->set_rules('contactPerson', 'contactPerson','required|trim');
            $this->form_validation->set_rules('location', 'location','required|trim');
            $this->form_validation->set_rules('phone','phone
            number','trim|required|max_length[15]|callback_phone_check');

            if($this->form_validation->run() == FALSE):
                $this->load->view('templates/header',$data);

                $this->load->view('backend/vendor/edit',$data);
                $this->load->view('templates/sidebar');

                $this->load->view('templates/footer');
            else:
                $id=$this->input->post('id');
                $vendor=$this->input->post('vendor');
                $website=$this->input->post('website');
                $email=$this->input->post('email');
                $contactPerson=$this->input->post('contactPerson');
                $location=$this->input->post('location');
                $phone=$this->input->post('phone');

                $this->db->set('vendor',$vendor);
                $this->db->set('website',$website);
                $this->db->set('email',$email);
                $this->db->set('contactPerson',$contactPerson);
                $this->db->set('location',$location);
                $this->db->set('phone',$phone);
                $this->db->where('vendor_id',$id);

                $this->db->update("vendors");
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                    The vendor has been updated.</div>');
                return redirect('vendors');
            endif;
        }
        public function delete($id){
            $data = $this->Vendor_model->vendor($id);
            if(empty($data)) :
                return redirect('404');
            endif;
            if($this->Vendor_model->delete($id)):
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                The vendor has been deleted.</div>');
                return redirect('vendors');
            endif;
        }
        public function phone_check($str){
            if (!preg_match('/^(?:256|\+256|(0)?7(?:(?:[0127589][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/',$str)):
                $this->form_validation->set_message('phone_check', 'The phone number is invalid.');
                return FALSE;
            else:
                return TRUE;
            endif;
        }
    } 
