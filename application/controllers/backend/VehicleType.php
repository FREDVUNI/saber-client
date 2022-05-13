<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class VehicleType extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/VehicleType_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Vehicle_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'vehicle types';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['vehicletype'] = $this->VehicleType_model->vehicletypes();
            $this->load->view('backend/vehicletype/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function create(){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();
            $data['title'] = 'create vehicle type';

            $this->form_validation->set_rules('vehicletype','vehicle type','trim|required|is_unique[vehicletypes.vehicletype]'
            ,array('is_unique' => 'This vehicle type already exists.'));
            if ($this->form_validation->run() == FALSE) :
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $this->load->view('backend/vehicletype/create',$data);

                $this->load->view('templates/footer',$data);
            else:
            $data = array(
                'vehicletype' => $this->input->post('vehicletype'),
                'admin_id' => $data['user']['id'],
            );
            $this->db->set($data);
            $this->VehicleType_model->save($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                The vehicle type has been added.</div>');
            return redirect('vehicle-types');
            endif;
        }

        public function edit($id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['vehicletype'] = $this->VehicleType_model->vehicletypes($id);
            $data['title'] = word_limiter($data['vehicletype']['vehicletype'],2);

            if(empty($data['vehicletype'])) :
                return redirect('404');
            endif;

            $this->form_validation->set_rules('vehicletype', 'vehicletype','required|trim');

            if($this->form_validation->run() == FALSE):
                $this->load->view('templates/header',$data);

                $this->load->view('backend/vehicletype/edit',$data);
                $this->load->view('templates/sidebar');

                $this->load->view('templates/footer');
            else:
                $id=$this->input->post('id');
                $vehicletype=$this->input->post('vehicletype');

                $this->db->set('vehicletype',$vehicletype);
                $this->db->where('vehicletype_id',$id);

                $this->db->update("vehicletype");
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                    The vehicle type has been updated.</div>');
                return redirect('vehicle-types');
            endif;
        }
        public function delete($id){
            $data = $this->VehicleType_model->vehicletype($id);
            if(empty($data)) :
                return redirect('404');
            endif;
            if($this->VehicleType_model->delete($id)):
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                The vehicle type has been deleted.</div>');
            return redirect('vehicle-types');
            endif;
        }
    } 
