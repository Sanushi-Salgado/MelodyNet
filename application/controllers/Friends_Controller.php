<?php

class Friends_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->model('Post_Model');
        $this->load->model('Friend_Model');
    }

    public function handleUserSearch()
    {
        /// Get the currently logged in user's details
        if ($this->session->userdata('current_user')) {
            $user_details = $this->User_Model->getSelectedUser($_SESSION['current_user']['username']);
            $data['user_details'] = $user_details;

            if ((isset($_GET['search']) && isset($_GET['genre'])) && !empty($this->input->get('genre'))) {

                // Get the genre that the user searched for
                $genre_details = $this->User_Model->getGenreDetails(strtolower($this->input->get('genre')));

                if (empty($genre_details)) {
                    // If the user searches for something other than a music genre then display an error message
                    $data['incorrect_user_search_message'] = "No matching genre found!";
                    $this->load->view('pages/search_results', $data);
                } else {
                    // Get all users from that genre
                    $search_results = $this->User_Model->getUsersByGenre($genre_details[0]->genre_id, $user_details[0]->user_id);
                    log_message('info', 'Search results: ' . print_r($search_results, TRUE));

                    if (count($search_results) > 0) {
                        // If there are any users related to the searched genre then
                        $index = 0;
                        foreach ($search_results as $user) {
                            $user_id =  $user->user_id;
                            $user = $this->User_Model->getUserById($user_id);

                            if (!empty($user)) {
                                // If the user doesn't exist in the database by any chance
                                // Get the name & profile picture of people related to the search results
                                $user_name = $user[0]->name;
                                $pic = $user[0]->profile_picture;

                                // Check if the user is already following another person
                                $result = $this->Friend_Model->isFollowing($user_details, $user_id);

                                $is_following = (count($result) > 0) ? true : false;

                                $data['friends'][$index] = array('user_id' => $user_id, 'name' => $user_name, 'profile_picture' => $pic, 'is_following' =>  $is_following);
                                $index++;
                            }
                        }
                        $this->load->view('pages/search_results', $data);
                       
                    } else {
                        // If no people found for a particular genre
                        $data['message'] = "No matching results found!";
                        $this->load->view('pages/search_results', $data);
                    }
                }
            }
        }
    }

    // Display followers & following people of the current user in the friends page
    public function viewAllFriends()
    {
        if ($this->session->userdata('current_user')) {
            // Get the currently logged in user's details
            $user_details = $this->User_Model->getSelectedUser($_SESSION['current_user']['username']);
            $data['user_details'] =  $user_details;

            // We need to get the followers of the current user
            $data['followers'] =  $this->Friend_Model->getFollowersOfUser($user_details[0]->user_id);

            // Also we need to get the people that the current user follows
            $data['following_users'] =  $this->Friend_Model->getFollowingUsers($user_details[0]->user_id);

            if (!empty($data['followers']) &&  empty($data['following_users']))
                $data['all_friends'] = $data['followers'];
            else if (empty($data['followers']) &&  !empty($data['following_users']))
                $data['all_friends'] = $data['following_users'];
            else if (!empty($data['followers']) &&  !empty($data['following_users']))
                // Merge these two arrays to get one single array containing all friends
                $data['all_friends'] = array_merge($data['followers'], $data['following_users']);
            else
                $data['all_friends'] = array();

            // Now we need to get their person names and profile pictures to display on the friends page
            if (!empty($data['all_friends'])) {
                foreach ($data['all_friends'] as $friend) {
                    if (property_exists($friend, 'follower_user_id'))
                        $friend_id_array[]  = $friend->follower_user_id;
                    else if (property_exists($friend, 'following_user_id'))
                        $friend_id_array[] = $friend->following_user_id;
                }

                // Here we need to remove all duplicates from the merged array
                // Otherwise in some cases the same person might get displayed more than once
                // Ex: (a following b) & (b following a)
                $friend_id_array = (array_unique($friend_id_array));

                $data['all_friends'] = null;
                $index = 0;
                foreach ($friend_id_array as $id) {
                    $friend_user_details = $this->User_Model->getUserById($id);
                    if (!empty($friend_user_details)) {
                        // In case if a user doesn't exist in the database
                        $friend_name = $friend_user_details[0]->name;
                        $friend_profile_picture = $friend_user_details[0]->profile_picture;

                        $data['all_friends'][$index]['user_id'] = $friend_user_details[0]->user_id;
                        $data['all_friends'][$index]['name'] = $friend_name;
                        $data['all_friends'][$index]['profile_picture'] = $friend_profile_picture;
                        $index++;
                    }
                }
            }

            $data['total_no_of_friends'] =  count($data['all_friends']);
            log_message('info', 'Total no. of friends of user: ' .  $data['total_no_of_friends']);
            log_message('info', 'All friends of user: ' . print_r($data['all_friends'], TRUE));

            $this->load->view('pages/view_all_friends', $data);
        } else
            $this->load->view('pages/login');
    }

    // Display the user's public home page
    public function displayUserPublicHomePage($user_id)
    {
        if ($this->session->userdata('current_user')) {
            $data['user_data'] = $this->User_Model->getUserById($user_id);
            log_message('info',  "user details: " . (print_r($data['user_data'], TRUE)));

            $data['no_of_followers'] = count($this->Friend_Model->getFollowersOfUser($user_id));
            log_message('info',  "No of followers: " . count($this->Friend_Model->getFollowersOfUser($user_id)));

            $data['no_of_following_people'] = count($this->Friend_Model->getFollowingUsers($user_id));
            log_message('info',  "No of following people: " . count($this->Friend_Model->getFollowingUsers($user_id)));

            // Get the user's favourite genres
            $favourite_genres[] = NULL;
            $index = 0;
            $user_genres = $this->User_Model->getAllGenresOfUser($user_id);
            foreach ($user_genres as $genre) {
                $genre_id = $genre->genre_id;
                $genre = $this->User_Model->getGenreName($genre_id);
                $favourite_genres[$index] = $genre[0]->name;
                $index++;
            }

            $data['favourite_genres'] = $favourite_genres;
            $id_array = array($user_id);
            $data['all_posts'] = $this->Post_Model->getPosts($id_array);

            foreach ($data['all_posts'] as $post) {
                $post_author_ids = $user_id;
                // We have to get the post author's profile picture
                $post_author_details = $this->User_Model->getUserById($post_author_ids);
                $profile_pictures_of_post_author =  $post_author_details[0]->profile_picture;
                $post->post_author_profile_pic = $profile_pictures_of_post_author;
            }

            $this->load->view('pages/user_public_home_page', $data);
        } else
            $this->load->view('pages/login');
    }

    
    // Handle user following and unfollowing
    public function handleUserFollowAction()
    {
        $user_details = $this->User_Model->getSelectedUser($_SESSION['current_user']['username']);
        $follower_user_id = $user_details[0]->user_id;
        $following_user_id = $this->input->post('following_user_id');

        if (isset($_POST['follow'])) {
            if ($this->Friend_Model->addFriend($follower_user_id, $following_user_id)) {
                log_message('info', 'Friend added successfully');
                $this->session->set_flashdata('success_message', 'Friend added successfully');
            } else {
                log_message('error', 'Failed to add new friend');
                $this->session->set_flashdata('error_message', 'Failed to add new friend');
            }

            redirect('/friends/view');

        } else if (isset($_POST['unfollow'])) {
            if ($this->Friend_Model->removeFriend($follower_user_id, $following_user_id))
                log_message('info', 'Friend removed successfully');
            else
                log_message('error', 'Failed to remove friend');

            redirect('/friends/view');
        }
    }
}

?>
