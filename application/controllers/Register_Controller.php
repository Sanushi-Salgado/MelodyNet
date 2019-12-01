<?php

class Register_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->model('Profile_Model');
    }

    public function index()
    {
        // Load the sign up view
        $this->load->view('pages/register');
    }

    public function handleUserRegistration()
    {

        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|min_length[6]|max_length[12]',
            array(
                'required'      => 'You have not provided %s.'

            )
        );

        $this->form_validation->set_rules('password', 'Password', 'required');

        // Check if both username & password has been entered
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pages/register');

        } else if (isset($_POST['sign_up']) && (isset($_POST['username']) && isset($_POST['password']))) {
            
            // If both username & password has been entered then
            // Get the entered data from the user registration form
            $data['username'] = $this->input->post('username');

            // Perform hashing for the password
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
             
            // Check if the username is not taken before
            $result = $this->User_Model->checkIfUserExists($data['username']);
            if (count($result) > 0) {
                $this->session->set_flashdata('message', 'Username already exists');
                $this->index();
            } else {
                // If the username doesn't exist & if the user has filled all the fields correctly, then register the user
                $result = $this->User_Model->addUser($data);

                if ($result) {
                    // If registration is successful
                    // Set up a new session for the registered user
                    $this->session->set_userdata('registered_user', $this->input->post('username'));

                    $data['genres'] = $this->Profile_Model->getAllGenres();

                    $this->session->set_flashdata('success_message', 'You have been registered successfully');
                    log_message('info', 'User registered successfully');

                    // Redirect the user to the profile creation page
                    $this->load->view('pages/create_profile', $data);
                } else {
                    // If the query fails to add the new user
                    $this->session->set_flashdata('error_message', 'Registration failed');
                    log_message('error', 'Failed to register new user');
                    $this->index();
                }
            }
        }
    }
}

?>
