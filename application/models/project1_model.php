<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Project1_model (Project1 Model)
 * Project1 model class to handle project1 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Project1_model extends CI_Model
{
    /**
     * This function is used to get the project1 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function project1ListingCount($searchText)
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
     * This function is used to get the project1 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function project1Listing($searchText, $page, $segment)
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
     * This function is used to add new project1 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProject1($project1Info)
    {
        $this->db->trans_start();
        $this->db->insert('moll', $project1Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get project1 information by id
     * @param number $project1Id : This is project1 id
     * @return array $result : This is project1 information
     */
    function getProject1Info($project1Id)
    {
        $this->db->select('id, neck, body, bottom');
        $this->db->from('moll');
        $this->db->where('id', $project1Id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }


    /**
     * This function is used to update the project1 information
     * @param array $project1Info : This is project1 updated information
     * @param number $project1Id : This is project1 id
     */
    function editProject1($project1Info, $project1Id)
    {
        $this->db->where('id', $project1Id);
        $this->db->update('moll', $project1Info);

        return TRUE;
    }
}
