<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Existing_model (Existing Model)
 * Existing model class to handle existing related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Existing_model extends CI_Model
{
    /**
     * This function is used to get the existing listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function existingListingCount($searchText)
    {
        $this->db->select('BaseTbl.existingId, BaseTbl.existingTitle, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('tbl_existing as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.existingTitle LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the existing listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function existingListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.existingId, BaseTbl.existingTitle, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('tbl_existing as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.existingTitle LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.existingId', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to add new existing to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewExisting($existingInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_existing', $existingInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get existing information by id
     * @param number $existingId : This is existing id
     * @return array $result : This is existing information
     */
    function getExistingInfo($existingId)
    {
        $this->db->select('existingId, existingTitle, description');
        $this->db->from('tbl_existing');
        $this->db->where('existingId', $existingId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }


    /**
     * This function is used to update the existing information
     * @param array $existingInfo : This is existing updated information
     * @param number $existingId : This is existing id
     */
    function editExisting($existingInfo, $existingId)
    {
        $this->db->where('existingId', $existingId);
        $this->db->update('tbl_existing', $existingInfo);

        return TRUE;
    }
}
