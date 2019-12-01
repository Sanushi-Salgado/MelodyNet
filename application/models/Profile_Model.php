<?php

class Profile_Model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }

    
    // Create a new user profile
    public function createProfile($person_name, $profile_image)
    {
        // Capitaliz the first letter of each word in the person name
        $this->db->set('name', ucwords($person_name));
        $this->db->set('profile_picture', $profile_image);
        $this->db->where('username', $_SESSION['registered_user']);
        $this->db->update('user');
        return $this->db->affected_rows(); // Returns the no. of affected rows from the query
    }


    // Get data related to a user profile 
    public function getSelectedProfile()
    {
        $query = $this->db->get('user');
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Get all user profiles
    public function getAllProfiles()
    {
        $query = $this->db->get('user');
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Get all music genres
    public function getAllGenres()
    {
        $query = $this->db->get('genre');
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Add all the genres that a user selected, when creating a profile
    public function addUserGenres($user_genre_record)
    {
        $data = array(
            'user_id' => $user_genre_record['user_id'],
            'genre_id' => $user_genre_record['genre_id']
        );

        return $this->db->insert('user_genre', $data);
    }


    // Get details of a particular genre by its name
    public function getGenreByName($name)
    {
        $query = $this->db->get_where('genre', array('name' => $name));
        if ($query->num_rows() > 0)
            return $query->result_array();
    }

}

?>