<?php

class Post_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    // Create a new post
    public function addPost($author_id,  $author_name, $post_image, $post_content)
    {
        // Data related to the post, to be added
        $data = array(
            'author_id' => $author_id,
            'author_name' => $author_name,
            'created_date' => time(), // Insert the current timestamp
            'content' => $post_content,
            'image' => $post_image,
        );

        return $this->db->insert('post', $data);
    }


    // Edit a post
    public function editPost($post_id, $post_content, $post_image)
    {
        $this->db->set('created_date', time());
        $this->db->set('content', $post_content);
        $this->db->set('image', $post_image);
        $this->db->where('post_id', $post_id);
        return $this->db->update('post');
    }


    // Delete a post
    public function deletePost($post_id)
    {
       return $this->db->delete('post', array('post_id' => $post_id));
    }


    // Get all posts of a particular user & from following people in descending date/time order
    public function getPosts($id_array)
    {
        /* In order to display posts according to the descending order of data/time 
           we need to sort the posts by the descending order of their post ids */
        $this->db->select('*');
        $this->db->from('post');
        $this->db->where_in('author_id', $id_array);
        $this->db->order_by('post_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    // Get a post by its id
    public function getPostById($post_id)
    {
        $query = $this->db->get_where('post', array('post_id' => $post_id));
        return $query->result();
    }


}
