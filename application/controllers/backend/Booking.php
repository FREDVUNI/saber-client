<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Booking extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/Booking_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model'); 
            $this->load->model('backend/Vehicle_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'Bookings';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['booking'] = $this->Booking_model->bookings();
            $this->load->view('backend/booking/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function delete($id){
            $data = $this->Booking_model->booking($id); 
            if($this->Booking_model->delete($id)):
                $this->session->set_flashdata('message','<div class="alert alert-success" role=" alert">
                    The booking has been deleted.</div>');
                return redirect('bookings');
            endif;
        }
    } 
