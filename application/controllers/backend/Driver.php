<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Driver extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Vehicle_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'drivers';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['driver'] = $this->Driver_model->drivers();
            $this->load->view('backend/driver/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function create(){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();
            $data['title'] = 'create driver';

            $this->form_validation->set_rules('vehicle_id', 'vehicle_id','required|trim');
            $this->form_validation->set_rules('firstname', 'firstname','required|trim');
            $this->form_validation->set_rules('lastname', 'lastname','required|trim');
            $this->form_validation->set_rules('phone',
                'phone','required|trim|callback_phone_check|is_unique[drivers.phone]', [
                'is_unique' => 'A driver with this phone number already exists.',
            ]);
            if ($this->form_validation->run() == FALSE) :
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $data['vehicle'] = $this->Vehicle_model->vehicles();
                $this->load->view('backend/driver/create',$data);

                $this->load->view('templates/footer',$data);
            else:
            $data = array(
                'vehicle_id' => $this->input->post('vehicle_id'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'phone' => $this->input->post('phone'),
                'admin_id' => $data['user']['id'],
                'status' => 'active'
            );
            $this->db->set($data);
            $this->Driver_model->save($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                The driver has been added.</div>');
            return redirect('drivers');
        endif;
        }

        public function edit($id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['driver'] = $this->Driver_model->drivers($id);
            $data['title'] = $data['driver']['firstname'];

            if(empty($data['driver'])) :
                return redirect('404');
            endif;

            $this->form_validation->set_rules('phone','phone
            number','trim|required|max_length[15]|callback_phone_check');
            $this->form_validation->set_rules('vehicle_id', 'vehicle_id','required|trim');
            $this->form_validation->set_rules('firstname', 'firstname','required|trim');
            $this->form_validation->set_rules('lastname', 'lastname','required|trim');

            if($this->form_validation->run() == FALSE):
                $this->load->view('templates/header',$data);
                $data['vehicle'] = $this->Vehicle_model->vehicles();
                $this->load->view('backend/driver/edit',$data);
                $this->load->view('templates/sidebar');

                $this->load->view('templates/footer');
            else:
                $id=$this->input->post('id');
                $firstname=$this->input->post('firstname');
                $lastname=$this->input->post('lastname');
                $vehicle_id=$this->input->post('vehicle_id');
                $phone=$this->input->post('phone');

                $this->db->set('firstname',$firstname);
                $this->db->set('lastname',$lastname);
                $this->db->set('vehicle_id',$vehicle_id);
                $this->db->set('phone',$phone);
                $this->db->where('driver_id',$id); 

                $this->db->update("drivers");
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                The driver has been updated.</div>');
                return redirect('drivers');
            endif;
        }
        public function delete($id){
            if(empty($data)) :
                return redirect('404');
            endif;
            $data = $this->Driver_model->driver($id);
            if($this->Driver_model->delete($id)):
            $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                The driver has been deleted.</div>');
            return redirect('drivers');
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
    
