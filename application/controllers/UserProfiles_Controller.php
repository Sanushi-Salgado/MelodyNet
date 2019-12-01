<?php
class UserProfiles_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->model('Profile_Model');
    }

    public function index()
    {
        // Load the create profile view
        $this->load->view('pages/create_profile');
    }


    public function checkIfUrlExists($url)
    {
        $headers = get_headers($url);

        // Check the existence of a URL 
        if ($headers && strpos($headers[0], '200'))
            return true;
        else
            return false;
    }


    // Handle user profile creation
    public function createProfile()
    {
        
        $this->form_validation->set_rules('person_name', 'Name', 'required');

        // Check if both the name of the person has been entered
        if ($this->form_validation->run() === FALSE) {
            $data['genres'] = $this->Profile_Model->getAllGenres();
            $this->load->view('pages/create_profile', $data);

        } else if (isset($_POST['create_profile']) && (isset($_POST['person_name']) && isset($_POST['genres']))) {

            // Get the name of the person
            $data['name'] = $this->input->post('person_name');

            // Get the user's favourite genres 
            $favourite_genres = $this->input->post('genres');
            log_message('info', "User genres: " . print_r($favourite_genres, TRUE));

            // Set configurations for profile image upload
            $config['upload_path'] = './assets/img/users';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '200000';
            $config['max_width'] = '500';
            $config['max_height'] = '500';

            $this->load->library('upload', $config);

            $profile_image = "";

            if (!$this->upload->do_upload() && empty($this->input->post('url'))) {
                $errors = array('error' => $this->upload->display_errors());
            } else {
                if (empty($this->input->post('url'))) {
                    // If the user has uploaded an image for the profile picture
                    $data = array('upload_data' => $this->upload->data());

                    // Get the uploaded post image from the form
                    $profile_image = $_FILES['userfile']['name']; 

                } else {
                    // If the user has entered an image url for the profile picture
                    $image_url = $this->input->post('url');
                    $profile_image = $image_url;
                }
            }

            $username = "";
            if ($this->session->userdata('registered_user'))
                $username = $_SESSION['registered_user'];
            else if ($this->session->userdata('current_user'))
                $username = $_SESSION['current_user'];


            // Add the user profile information to the database
            $result1 = $this->Profile_Model->createProfile($this->input->post('person_name'), $profile_image);

            $index = 0;

            // Insert each favourite genre, to the user_genres table
            foreach ($favourite_genres as $favourite_genre) {               
                $user_details = $this->User_Model->getUserProfileDetails($username);
                $data['user_genres'][$index]['user_id'] = $user_details[0]->user_id;

                $genre_details = $this->Profile_Model->getGenreByName($favourite_genre);
                $data['user_genres'][$index]['genre_id'] =  $genre_details[0]['genre_id'];

                $index++;
            }

            log_message('info', 'User selected genres' . print_r($data['user_genres'], TRUE));

            $result2 = false;
            foreach ($data['user_genres'] as $user_genre_record) {
                $result2 = $this->Profile_Model->addUserGenres($user_genre_record);
                if (!$result2)
                    break;
            }


            if (($result1 > 0) && ($result2)) {
               	$this->load->view('pages/login');
            } else {
                // If the query fails to create the new profile
                $this->session->set_flashdata('profile_creation_failed_message', 'Failed to create profile. Please try again!');
                log_message('info', 'Failed to create profile');
                $data['genres'] = $this->Profile_Model->getAllGenres();
                $this->load->view('pages/create_profile', $data);
            }
        }
    }

}

?>
