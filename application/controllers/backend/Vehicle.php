<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Vehicle extends CI_Controller{
        public function __construct(){
            parent::__construct();
            is_logged_in();
            $this->load->helper('text');
            $this->load->model('backend/Vehicle_model');
            $this->load->model('backend/Driver_model');
            $this->load->model('backend/Department_model');
            $this->load->model('backend/User_model');
            $this->load->model('backend/Vehicle_model');
            $this->load->model('backend/VehicleType_model');
        }
        public function index(){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();
            
            $data['title'] = 'vehicles';
            $data['drivers'] = $this->Driver_model->countDrivers();
            $data['departments'] = $this->Department_model->countDepartments();
            $data['users'] = $this->User_model->countUsers();
            $data['vehicles'] = $this->Vehicle_model->countVehicles();
            $data['booked'] = $this->Vehicle_model->countBooked();
            $data['available'] = $this->Vehicle_model->countAssigned();

            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $data['vehicle'] = $this->Vehicle_model->vehicles();
            $this->load->view('backend/vehicle/index',$data);
            
            $this->load->view('templates/footer',$data);
        }
        public function create(){
            $data['user'] = $this->db->get_where('admins',['email'=>$this->session->userdata('email')])->row_array();
            $data['title'] = 'create vehicle';

            $this->form_validation->set_rules('vehicletype_id', 'vehicletype_id','required|trim');
            $this->form_validation->set_rules('vehicle', 'vehicle','required|trim');
            $this->form_validation->set_rules('license_plate','license plate','trim|required|is_unique[vehicles.license_plate]'
            ,array('is_unique' => 'This vehicle already exists.'));

            if ($this->form_validation->run() == FALSE) :
                $this->load->view('templates/header',$data);
                $this->load->view('templates/sidebar',$data);
                $data['vehicletype'] = $this->VehicleType_model->vehicletypes();
                $this->load->view('backend/vehicle/create',$data);

                $this->load->view('templates/footer',$data);
            else:
                $data['vehicletype_id'] = $this->input->post('vehicletype_id');
                $data['vehicle'] = $this->input->post('vehicle');
                $data['license_plate'] = $this->input->post('license_plate');

                if($_FILES['userfile']['name'] != '' || $_FILES['userfile']['size'] != 0):
                //uploading the image link to the database.
                $config['upload_path'] = './assets/uploads/vehicles/';
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
                        return redirect('vehicle');
                    else:
                        $fileData = $this->upload->data();
                        $data['userfile'] =
                        'https://sb.rafahgroup.com/assets/uploads/vehicles/'.$fileData['file_name'];
                    endif;
                else :
                $this->session->set_flashdata('message', '<div class="alert alert-danger role=" alert">
                	Invalid image.please try again.</div>');
                return redirect('vehicle');
                endif;
                $this->Vehicle_model->save($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                    The vehicle has been added.</div>');
                return redirect('vehicles');
            endif;
        }

        public function edit($id){
            $data['user'] = $this->db->get_where('admins',['email'=>
            $this->session->userdata('email')])->row_array();

            $data['vehicle'] = $this->Vehicle_model->vehicles($id);
            $data['title'] =word_limiter($data['vehicle']['vehicle'],2);

            if(empty($data['vehicle'])) :
                return redirect('404');
            endif;

            $this->form_validation->set_rules('vehicletype_id', 'vehicle type','required|trim');
            $this->form_validation->set_rules('vehicle', 'vehicle','required|trim');
            $this->form_validation->set_rules('license_plate', 'license plate','required|trim');

            if($this->form_validation->run() == FALSE):
                $this->load->view('templates/header',$data);
                $data['vehicletype'] = $this->VehicleType_model->vehicletypes();
                $this->load->view('backend/vehicle/edit',$data);
                $this->load->view('templates/sidebar');

                $this->load->view('templates/footer');
            else:
                $id=$this->input->post('id');
                $vehicle=$this->input->post('vehicle');
                $license_plate=$this->input->post('license_plate');
                $vehicletype_id=$this->input->post('vehicletype_id');

                if($_FILES['userfile']['name'] != $data['vehicle']['image']):
                    //uploading the image link to the database.
                    $config['upload_path'] = './assets/uploads/vehicles/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['max_size'] = '2048';
                    $config['max_width'] = '9024';
                    $config['max_height'] = '9024';
                    $config['encrypt_name'] = true;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('userfile')) :
                        $old_image =  
                        str_replace('https://sb.rafahgroup.com/assets/uploads/vehicles/','',$data['vehicle']['image']);
                        if ($old_image != 'noimage.png') :
                            unlink(FCPATH . './assets/uploads/vehicles/' . $old_image);
                        endif;
                            $new_image = $this->upload->data('file_name');
                            $this->db->set('image', 'https://sb.rafahgroup.com/assets/uploads/vehicles/'.$new_image);
                    else :
                        $error = array('error' => $this->upload->display_errors());
                    endif;
                else :
                    $this->session->set_flashdata('message', '<div class="alert alert-danger role=" alert">
                        Invalid image.please try again.</div>');
                    return redirect('vehicle');
                endif;

                $this->db->set('vehicle',$vehicle);
                $this->db->set('license_plate',$license_plate);
                $this->db->set('vehicletype_id',$vehicletype_id);
                $this->db->where('vehicle_id',$id);

                $this->db->update("vehicles");
                $this->session->set_flashdata('message','<div class="alert alert-success role=" alert">
                    The vehicle has been updated.</div>');
                return redirect('vehicles');
            endif;
        }
        public function delete($id){
            $data = $this->Vehicle_model->vehicle($id);
            $imagePath = str_replace('https://sb.rafahgroup.com/assets/uploads/vehicles/','',$data->image);
            if(empty($data)) :
                return redirect('404');
            endif;
            $path = './assets/uploads/vehicles/';
            @unlink($path . $imagePath);
                if ($this->Vehicle_model->delete($id)) :
                    $this->session->set_flashdata('message', '<div class="alert alert-success role=" alert">
                        The vehicle has been deleted.</div>');
                    redirect('vehicles');
                endif;
        }
    } 
