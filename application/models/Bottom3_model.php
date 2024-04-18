<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Bottom3_model (Bottom3 Model)
 * Bottom3 model class to handle bottom3 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Bottom3_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the bottom3 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function bottom3ListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('bottom3 as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the bottom3 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function bottom3Listing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('bottom3 as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to add new bottom3 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBottom3($bottom3Info)
    {
        $this->db->trans_start();
        $this->db->insert('bottom3', $bottom3Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get bottom3 information by id
     * @param number $bottom3Id : This is bottom3 id
     * @return array $result : This is bottom3 information
     */
    public function getBottom3Info($bottom3Id)
    {
        // Get bottom3 data based on bottom3Id
        $this->db->where('id', $bottom3Id);
        $query = $this->db->get('bottom3');

        // If query is successful, return the result
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the bottom3 information
     * @param array $bottom3Info : This is bottom3 updated information
     * @param number $bottom3Id : This is bottom3 id
     */
    function editBottom3($bottom3Info, $bottom3Id)
    {
        try {
            // Check if $bottom3Info or $bottom3Id is not valid
            if (empty($bottom3Info) || empty($bottom3Id)) {
                throw new Exception("Invalid bottom3 information or bottom3 ID provided");
            }

            // Validate $bottom3Id to ensure it's a number and not an empty string
            if (!is_numeric($bottom3Id) || $bottom3Id <= 0) {
                throw new Exception("Invalid bottom3 ID provided");
            }

            // Validate $bottom3Info to ensure it's a valid array
            if (!is_array($bottom3Info) || empty($bottom3Info)) {
                throw new Exception("Invalid bottom3 information provided");
            }

            // Perform update to the bottom3 table
            $this->db->where('id', $bottom3Id);
            $this->db->update('bottom3', $bottom3Info);

            // Return TRUE if update is successful
            return TRUE;
        } catch (Exception $e) {
            // Handle error by logging the error message and possibly taking appropriate action
            error_log('Error in editBottom3(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateBottom3($updatedData, $bottom3Id)
    {
        // Update bottom3 data based on bottom3Id
        $this->db->where('id', $bottom3Id);
        $this->db->update('bottom3', $updatedData);

        // Return true if update is successful, false if failed
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteBottom3($bottom3_id)
    {
        // Perform deletion process based on ID
        return $this->db->where('id', $bottom3_id)->delete('bottom3');
    }

}
