<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Project3_model (Project3 Model)
 * Project3 model class to handle project3 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Project3_model extends CI_Model
{
    /**
     * This function is used to get the project3 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function project3ListingCount($searchText)
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
     * This function is used to get the project3 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function project3Listing($searchText, $page, $segment)
    {
        $this->db->select('id, neck, body, bottom');
        $this->db->from('moll');
        if (!empty($searchText)) {
            $likeCriteria = "(moll.neck LIKE '%" . $searchText . "%' OR moll.body LIKE '%" . $searchText . "%' OR moll.button LIKE '%" . $searchText . "%')";
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
     * This function is used to add new project3 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProject3($project3Info)
    {
        $this->db->trans_start();
        $this->db->insert('moll', $project3Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get project3 information by id
     * @param number $project3Id : This is project3 id
     * @return array $result : This is project3 information
     */
    function getProject3Info($project3Id)
    {
        $this->db->select('id, neck, body, bottom');
        $this->db->from('moll');
        $this->db->where('id', $project3Id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }


    /**
     * This function is used to update the project3 information
     * @param array $project3Info : This is project3 updated information
     * @param number $project3Id : This is project3 id
     */
    function editProject3($project3Info, $project3Id)
    {
        $this->db->where('id', $project3Id);
        $this->db->update('moll', $project3Info);

        return TRUE;
    }
}
