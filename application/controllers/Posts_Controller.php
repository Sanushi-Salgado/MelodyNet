<?php

class Posts_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->model('Post_Model');
    }

    //Create new post
    public function createPost()
    {
        //Set validation rules for the create post form 
        $this->form_validation->set_rules('post_content', 'Description', 'required');

        if ($this->form_validation->run() === FALSE) {
            //If the form has not been submitted then
            //If the user has been logged out then load the login page
            if (!($this->session->userdata('current_user')))
                $this->load->view('pages/login');
            else
                //If the user has been logged in then load the create post page
                $this->load->view('pages/create_post');
        } else {
            //If the form has been submitted then
            //Set configurations for image upload
            $config['upload_path'] = './assets/img/posts';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10000000';
            $config['max_width'] = '500';
            $config['max_height'] = '500';

            $this->load->library('upload', $config);

            $post_image = "";

            if (!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $post_image = "";
            } else {
                $data = array('upload_data' => $this->upload->data());
                //Get the uploaded post image 
                $post_image = $_FILES['userfile']['name'];
            }

            //Turn sections of the post that are hyperlinks (i.e., of the form “http://…..” should be turned into clickable hyperlinks).
            $post_content = $this->handleSpecialUrls($this->input->post('post_content'));

            //Get the currently logged in user 
            $user_details = $this->User_Model->getSelectedUser($_SESSION['current_user']['username']);

            //Create the new post
            $result = $this->Post_Model->addPost($user_details[0]->user_id, $user_details[0]->name, $post_image, $post_content);

            if (count($result) > 0) {
                log_message('info', 'Post created successfully');
                $this->session->set_flashdata('success_message', 'Your post has been created successfully');
            } else {
                log_message('error', 'Failed to create new post');
                $this->session->set_flashdata('error_message', 'Failed to create your post');
            }

            redirect('/user/home'); //Redirect to the timeline
        }
    }


    //View a particular post by clicking on the Read More button
    public function viewPost($post_id = NULL)
    {
        $data['post'] = $this->Post_Model->getPostById($post_id);

        if (empty($data['post']))
            show_404();

        //If the user has been logged out then load the login page
        if (!($this->session->userdata('current_user')))
            $this->load->view('pages/login');
        else
            //If the user has been logged in then load the post 
            $this->load->view('pages/view_post', $data);
    }


    // Delete an existing post
    public function deletePost($post_id = NULL)
    {

        //If the user has been logged out then load the login page
        if (!($this->session->userdata('current_user')))
            $this->load->view('pages/login');
        else {

            $result =    $this->Post_Model->deletePost($post_id);

            if ($result) {
                log_message('info', 'Post deleted successfully');
                $this->session->set_flashdata('success_message', 'Your post has been deleted successfully');
            } else {
                log_message('error', 'Failed to delete post');
                $this->session->set_flashdata('error_message', 'Failed to delete post');
            }

            redirect('/user/home');
        }
    }


    //Turning hyperlinks into clickable links and image links into displayable images
    public function handleSpecialUrls($post_content)
    {
        // Reference - https://stackoverflow.com/questions/36976527/php-find-and-convert-all-links-and-images-to-display-them-in-html
        $regex_for_image_links = '~https?://\S+?(?:png|gif|jpe?g)~';
        $regex_for_links = '~
                (?<!src=\') # negative lookbehind (no src=\' allowed!)
                https?://   # http:// or https://
                \S+         # anything not a whitespace
                \b          # a word boundary
                ~x';        # verbose modifier for these explanations

        $post_content = preg_replace($regex_for_image_links, "<img src='\\0'>", $post_content);
        $post_content = preg_replace($regex_for_links, "<a href='\\0'>\\0</a>", $post_content);
        return $post_content;
    }
}
