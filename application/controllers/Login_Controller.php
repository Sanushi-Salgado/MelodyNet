<?php

class Login_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->model('Post_Model');
        $this->load->model('Friend_Model');
        $this->load->model('Profile_Model');
    }

    
    public function index()
    {
        $this->load->view('pages/login');
    }


    // Handle user sign in
    public function handleUserLogin()
    {

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        //Check if both username & password has been entered & if the user is currently not logged in
        if ($this->form_validation->run() == FALSE && !($this->session->userdata('current_user'))) {
            $this->load->view('pages/login');
        } else if (isset($_POST['sign_in']) && (isset($_POST['username']) && isset($_POST['password']))) {

            //If both username & password has been entered then
            //Get the entered username & password from the login form
            $entered_username = $this->input->post('username');
            $entered_password = $this->input->post('password');

            //Check if the user has been registered before
            $result = $this->User_Model->checkIfUserExists($entered_username);

            if (count($result) > 0 && (strcmp($result[0]->username, $entered_username) === 0) ) {
                $db_password = $result[0]->password;

                /* Check if the user has created a profile before
                   if not, display the profile creation page to let the user complete his/her profile details*/
                if ((empty($result[0]->name)) && (empty($result[0]->profile_picture))) {
                    $this->session->set_flashdata('profile_error_message', 'You\'re one step ahead to use Melody Net. Please complete your profile details.');
                    $data['genres'] = $this->Profile_model->getAllGenres();
                    
                    $this->load->view('pages/create_profile', $data);

                } else {

                    //Check if the entered password matches to the real password
                    $hash = $db_password;
                    if (password_verify($entered_password, $hash)) {
                        $session_data = array(
                            'username' => $entered_username,
                            'isLoggedIn' => TRUE
                        );

                        //Set up a session when the user logins to the system
                        $this->session->set_userdata('current_user', $session_data);
                        log_message('info', 'User logged in');

                        //If login credentials are correct then display the home page of the user 
                        $this->displayUserHomePage();
                    } else {
                        //if the password doesn't match, then display an error message
                        $this->session->set_flashdata('incorrect_password_message', 'Incorrect Password');
                       redirect('/login');
                    }
                }
            } else {
                //if the username doesn't exist, then display an error message
                $this->session->set_flashdata('message', 'Username doesn\'t exist');
                redirect('/login');
            }
        }
    }


    // Handle user log out
    public function handleUserLogOut()
    {
        if ($this->session->userdata('current_user')) {
            $this->session->unset_userdata('current_user');
            log_message('info', 'User logged out');
        }

        $this->load->view('pages/login');
    }


    // Display the user's public home page
    public function displayUserHomePage()
    {

        if ($this->session->userdata('current_user')) {
            //Get the currently logged in user's details
            $user_details = $this->User_Model->getSelectedUser($_SESSION['current_user']['username']);
            $data['user_details'] = $user_details;

            //Get the people that the current user follows
            $following_users =  $this->Friend_Model->getFollowingUsers($user_details[0]->user_id);

            $data['no_of_followers'] = count($this->Friend_Model->getFollowersOfUser($user_details[0]->user_id));
            log_message('info',  "No of followers: " . count($this->Friend_Model->getFollowersOfUser($user_details[0]->user_id)));

            $data['no_of_following_people'] = count($this->Friend_Model->getFollowingUsers($user_details[0]->user_id));
            log_message('info', 'No of following people of user ' . count($this->Friend_Model->getFollowingUsers($user_details[0]->user_id)));

            //Get the user's favourite genres
            $favourite_genres[] = NULL;
            $index = 0;
            $user_genres = $this->User_Model->getAllGenresOfUser($user_details[0]->user_id);
            foreach ($user_genres as $genre) {
                $genre_id = $genre->genre_id;
                $genre = $this->User_Model->getGenreName($genre_id);
                $favourite_genres[$index] = $genre[0]->name;
                $index++;
            }
            $data['favourite_genres'] = $favourite_genres;
            log_message('info', "User Favourite Generes: " . print_r($data['favourite_genres'], TRUE));


            $post_author_ids = array();
            foreach ($following_users as $user) {
                array_push($post_author_ids, $user->following_user_id);
            }
            array_push($post_author_ids, $user_details[0]->user_id);
            log_message('info', 'Post author ids: ' . print_r($post_author_ids, TRUE));


            //Get all posts of the current user & the posts of the following people
            $data['all_posts'] = $this->Post_Model->getPosts($post_author_ids);
            log_message('info', 'All Posts in descending date/time order: ' . print_r($data['all_posts'], TRUE));

            
            foreach ($data['all_posts'] as $post) {
                $post_author_ids = $post->author_id;
                //We have to get the post author's profile picture
                $post_author_details = $this->User_Model->getUserById($post_author_ids);
                $post->post_author_profile_pic = $post_author_details[0]->profile_picture;
            }

            // Redirect the users' to their home page if login is successful
            $this->load->view('pages/user_home_page', $data);

        } else
            // Redirect the users' to the login page if login is not successful
            redirect('/login');
    }
}

?>