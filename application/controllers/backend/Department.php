<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Department extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Vehicle_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'departments';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['department'] = $this->Department_model->departments();
            $this->load->view('backend/department/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function create(){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();
            $data['title'] = 'create department';

            $this->form_validation->set_rules('department', 'department','required|trim|is_unique[departments.department]', [
                'is_unique' => 'This department already exists.',
            ]);
            if ($this->form_validation->run() == FALSE) :
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('backend/department/create',$data);

                $this->load->view('templates/footer',$data);
            else:
                $data = array(
                    'department' => $this->input->post('department'),
                    'admin_id' => $data['user']['id'],
                );
                $this->db->set($data);
                $this->Department_model->save($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                 The department '.strtolower($data['department']) .' has been added.</div>');
                return redirect('departments');
            endif;
        }
        public function edit($id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['department'] = $this->Department_model->departments($id);
            $data['title'] =$data['department']['department'];

            if(empty($data['department'])) :
                return redirect('404');
            endif;

            $this->form_validation->set_rules('department','department','required|trim');
            if($this->form_validation->run() == FALSE):
                $this->load->view('templates/header',$data);

                $this->load->view('backend/department/edit',$data);
                $this->load->view('templates/sidebar');

                $this->load->view('templates/footer');
            else:
                $id=$this->input->post('id');
                $department=$this->input->post('department');
                $this->db->set('department',$department);
                $this->db->where('id',$id);

                $this->db->update("departments");
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                    The department has been updated.</div>');
                return redirect('departments');
            endif;
        }
        public function delete($id){
            $data = $this->Department_model->department($id);
            if(empty($data)) :
                return redirect('404');
            endif;
            if($this->Department_model->delete($id)):
            $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                The department has been deleted.</div>');
            return redirect('departments');
            endif;
        }
    } 
