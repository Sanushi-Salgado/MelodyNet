<?php

class Friend_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    // Following a user
    public function addFriend($follower_user_id, $following_user_id)
    {
        //Returns 1 if the data gets successfully saved in the db, else returns 0
        return $this->db->insert('user_friend', array('follower_user_id' => $follower_user_id,  'following_user_id' => $following_user_id)); 
    }


    // Unfollowing a user
    public function removeFriend($follower_user_id, $following_user_id)
    {
        $this->db->delete('user_friend', array('follower_user_id' => $follower_user_id,  'following_user_id' => $following_user_id));
        return $this->db->affected_rows();
    }


    // Check if the user is already following another person
    public function isFollowing($user_details, $user_id)
    {
        $this->db->select('*');
        $this->db->from('user_friend');
        $this->db->where('follower_user_id', $user_details[0]->user_id);
        $this->db->where('following_user_id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();
    }


    // Get all the followers of a user
    public function getFollowersOfUser($user_id)
    {
        $this->db->select('follower_user_id');
        $this->db->from('user_friend');
        $this->db->where('following_user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }


    // Get all the users that a person is following
    public function getFollowingUsers($user_id)
    {
        $this->db->select('following_user_id');
        $this->db->from('user_friend');
        $this->db->where('follower_user_id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

}

?>