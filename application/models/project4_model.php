<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Project4_model (Project4 Model)
 * Project4 model class to handle project4 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Project4_model extends CI_Model
{
    /**
     * This function is used to get the project4 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function project4ListingCount($searchText)
    {
        $this->db->select('id');
        $this->db->from('moll');
        if (!empty($searchText)) {
            $likeCriteria = "(moll.neck LIKE '%" . $searchText . "%' OR moll.body LIKE '%" . $searchText . "%' OR moll.bottom LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('moll.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the project4 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function project4Listing($searchText, $page, $segment)
    {
        $this->db->select('id, neck, body, bottom');
        $this->db->from('moll');
        if (!empty($searchText)) {
            $likeCriteria = "(moll.neck LIKE '%" . $searchText . "%' OR moll.body LIKE '%" . $searchText . "%' OR moll.bottom LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('moll.isDeleted', 0);
        $this->db->order_by('moll.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to add new project4 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProject4($project4Info)
    {
        $this->db->trans_start();
        $this->db->insert('moll', $project4Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get project4 information by id
     * @param number $project4Id : This is project4 id
     * @return array $result : This is project4 information
     */
    function getProject4Info($project4Id)
    {
        $this->db->select('id, neck, body, bottom');
        $this->db->from('moll');
        $this->db->where('id', $project4Id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }


    /**
     * This function is used to update the project4 information
     * @param array $project4Info : This is project4 updated information
     * @param number $project4Id : This is project4 id
     */
    function editProject4($project4Info, $project4Id)
    {
        $this->db->where('id', $project4Id);
        $this->db->update('moll', $project4Info);

        return TRUE;
    }
}
