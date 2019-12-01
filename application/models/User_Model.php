<?php

class User_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    // Register a new user 
    public function addUser($data)
    {
        return $this->db->insert('user', $data);
    }


    // Get data related to a particular user 
    public function getSelectedUser($username)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->result();
    }


    // Get data related to a particular user by the user id
    public function getUserById($user_id)
    {
        $query = $this->db->get_where('user', array('user_id' => $user_id));
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Check if a user already exists
    public function checkIfUserExists($username)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->result();
    }


    // Get user profile details
    public function getUserProfileDetails($username)
    {
        $this->db->select('user_id, name, profile_picture');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Get all users related to the user searched genre
    public function getGenreDetails($genre)
    {
        // Perform a full text search to display the search results
        $this->db->select('genre_id');
        $this->db->from('genre');
        $this->db->where('MATCH (name) AGAINST ("' . $genre .   '")', NULL, FALSE);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Get the name of a particular genre by its id
    public function getGenreName($genre_id)
    {
        $this->db->select('name');
        $this->db->from('genre');
        $this->db->where('genre_id', $genre_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Get all users related to a particular genre
    public function getUsersByGenre($genre_id, $user_id_of_current_user)
    {
        $this->db->select('user_id');
        $this->db->from('user_genre');
        $this->db->where('genre_id', $genre_id);
        $this->db->where('user_id !=', $user_id_of_current_user);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Get all the favourite genres of a user
    public function getAllGenresOfUser($user_id)
    {
        $query = $this->db->get_where('user_genre', array('user_id' => $user_id));
        return $query->result();
    }

}

?>