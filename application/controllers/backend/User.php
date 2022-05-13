<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class User extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Vehicle_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'users';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['user'] = $this->User_model->users();
            $this->load->view('backend/user/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function create(){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();
            $data['title'] = 'create user';

            $this->form_validation->set_rules('department_id', 'department_id','required|trim');
            $this->form_validation->set_rules('firstname', 'firstname','required|trim');
            $this->form_validation->set_rules('lastname', 'lastname','required|trim');
            $this->form_validation->set_rules('email', 'email','required|trim|valid_email');
            $this->form_validation->set_rules('phone','phone
            number','trim|required|max_length[15]|callback_phone_check|is_unique[users.phone]'
            ,array('is_unique' => 'A user with this phone number already exists.'));
            $this->form_validation->set_rules('password', 'password','required|trim');

        if ($this->form_validation->run() == FALSE) :
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['departments'] = $this->Department_model->departments();
            $this->load->view('backend/user/create',$data);

            $this->load->view('templates/footer',$data);
        else:
            $data = array(
                'department_id' => $this->input->post('department_id'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'admin_id' => $data['user']['id'],
                'password'=> password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'image' =>'noimage.png'
            );
            $this->db->set($data); 
            $this->User_model->save($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                The user has been added.</div>');
            return redirect('users');
        endif;
        }

        public function edit($id){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();

            $data['users'] = $this->User_model->users($id);
            $data['title'] = word_limiter($data['users']['firstname'],2);

            if(empty($data['users'])) :
                return redirect('404');
            endif;

            $this->form_validation->set_rules('department_id', 'department_id','required|trim');
            $this->form_validation->set_rules('firstname', 'firstname','required|trim');
            $this->form_validation->set_rules('lastname', 'lastname','required|trim');
            $this->form_validation->set_rules('email', 'email','required|trim|valid_email');
            $this->form_validation->set_rules('phone','phone
            number','trim|required|max_length[15]|callback_phone_check');
            $this->form_validation->set_rules('password', 'password','required|trim');

            if($this->form_validation->run() == FALSE):
                $this->load->view('templates/header',$data);
                $data['departments'] = $this->Department_model->departments();
                $this->load->view('backend/user/edit',$data);
                $this->load->view('templates/sidebar');

                $this->load->view('templates/footer');
            else:
                $id=$this->input->post('id');
                $firstname=$this->input->post('firstname');
                $department=$this->input->post('department_id');
                $lastname=$this->input->post('lastname');
                $email=$this->input->post('email');
                $phone=$this->input->post('phone');
                $password=password_hash($this->input->post('password'),PASSWORD_DEFAULT);

                $this->db->set('firstname',$firstname);
                $this->db->set('lastname',$lastname);
                $this->db->set('email',$email);
                $this->db->set('phone',$phone);
                $this->db->set('department_id',$department);
                $this->db->set('password',$password);
                $this->db->where('user_id',$id);

                $this->db->update("users");
            $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                The user has been updated.</div>');
            return redirect('users');
        endif;
        }
        public function delete($id){
            $data = $this->User_model->user($id);
            if(empty($data)) :
                return redirect('404');
            endif;
            if($this->User_model->delete($id)):
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                The user has been deleted.</div>');
                return redirect('users');
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
