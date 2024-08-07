<?php

class Sign extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->load->library('form_validation');
    }

    public function registration() {

        // Set form validation rules
        $this->form_validation->set_rules('Login_name', 'Login Name', 'trim|required|regex_match[/^[a-zA-Z\s]+$/]|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('Email_Id', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('Mobile_Number', 'Mobile Number', 'trim|required|numeric|exact_length[10]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[14]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('aadhar_number', 'Aadhar Card Number', 'trim|required|numeric|exact_length[12]');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
        $this->form_validation->set_rules('agree_tnc', 'Terms and Conditions', 'required');
        $this->form_validation->set_rules('profile_image', 'Profile Image', 'callback_validate_image');

        // Check if form validation passes
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, load the sign-up form again with validation errors
            $this->load->view('sign_upview');
        } else {
            // Validation passed, process the form data and insert into the database
            $data = array(
                'Login_name' => $this->input->post('Login_name'),
                'Email_Id' => $this->input->post('Email_Id'),
                'Mobile_Number' => $this->input->post('Mobile_Number'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'aadhar_number' => $this->input->post('aadhar_number'),
                'dob' => $this->input->post('dob'),
                'profile_image' => $_FILES['profile_image']['name'] // Store the file name in the database
            );

            // Call the model method to insert data into the database
            $result = $this->Crud_model->registration($data);
            if ($result) {
                // Data inserted successfully
                $this->session->set_flashdata('registered', 'Registration is successfully completed. Please login.');
                redirect('Admin/registration');
            } else {
                // Failed to insert data
                $this->session->set_flashdata('error', 'Failed to register!');
                redirect('Admin/registration');
            }

                
            }
        
    }

    // Callback function to validate the uploaded image
    public function validate_image($str)
    {
        $allowed_types = array('jpg', 'jpeg', 'png');
        $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed_types)) {
            $this->form_validation->set_message('validate_image', 'The file must be a JPG or PNG image.');
            return false;
        }
        return true;
    }
    public function loginn(){
        $this->load->view('login');


    }
    public function login(){


        $this->form_validation->set_rules('Email_Id', 'Email ID', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[14]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
        // print_r('hii');exit;

        if ($this->form_validation->run() == true){
            //yahan par sahi email dalne ke bad -registration db ke table me dekhega ki email already register hai ya hai.
            $Email_Id = $this->input->post('$Email_Id');
            $result = $this->crud_model->login_check($Email_Id);
            // print_r('email got it');
            print_r('hello');
            
            if (!empty ($result)) {
                // login email entered successfuly successfully.Now password correct hai ya nahi uske liye condition likho.
                $password = $this->input->post('password');
                if (password_verify($password,$result['password']) == true){
                    $sessArry['id'] = $result['id'];
                    $sessArry['Login_name'] = $result['Login_name'];
                    $sessArry['Email_Id'] = $result['Email_Id'];
                    $this->session->set_userdata('registration',$sessArry);
                    redirect('Sign/dashboard/');
                    

                }
                else{
                // Failed to login data
                $this->session->set_flashdata('error', 'Failed to login! please enter correct email id or password ');
                print_r('thkisd isdfojsdlfksdfnsdm,fns');exit;
                redirect('Sign/login');
                }

            } 
            else {
                // Failed to login data
                $this->session->set_flashdata('error', 'Failed to login! please enter correct email id or password ');
                print_r('bahar aa gya');
                redirect('Sign/login');
            }
      
        }
        else {
        $this->load->view('login');
        }
    }
    public function dashboard() {
        $this->load->view('dashboard');
        $this->crud_model->getEmployeeData();
    }
}
?>