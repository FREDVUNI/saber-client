<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/Admin_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Vehicle_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'Dashboard';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $jsondata = $this->User_model->get_data()->result();
            $data['graphdata'] = json_encode($jsondata);

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('backend/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function admins(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['title'] = 'Administrators';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['user'] = $this->Admin_model->admins();
            $this->load->view('backend/admin/index',$data);

            $this->load->view('templates/footer',$data);
        }
        public function create(){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();
            $data['title'] = 'create admin';

            $this->form_validation->set_rules('username','username','trim|required|is_unique[admins.username]'
            ,array('is_unique' => 'This username already exists.'));
            $this->form_validation->set_rules('email','email','trim|required|valid_email|is_unique[admins.email]'
            ,array('is_unique' => 'This admin already exists.'));
            $this->form_validation->set_rules('organisation','organisation','trim|required|is_unique[admins.organisation]'
            ,array('is_unique' => 'This organisation already exists.'));
            $this->form_validation->set_rules('password', 'password','required|trim');
            $this->form_validation->set_rules('role', 'role','required|trim');

            if ($this->form_validation->run() == FALSE) :
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('backend/admin/create',$data);

            $this->load->view('templates/footer',$data);
            else:
            $data = array(
                'username' => $this->input->post('username'),
                'organisation' => $this->input->post('organisation'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'role' => $this->input->post('role'),
                'image' => 'default.png',
                'is_active' => 1,
                'expires' => 65483,
            );
            $this->db->set($data);
            $this->Admin_model->save($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                The admin has been added.</div>');
            return redirect('admins');
            endif;
        }
        public function delete($id){
            $data = $this->Admin_model->admin($id);
            if($this->Admin_model->delete($id)):
            $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                The admin has been deleted.</div>');
            return redirect('admins');
            endif;
        }
    } 
