<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Bottom2_model (Bottom2 Model)
 * Bottom2 model class to handle bottom2 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Bottom2_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the bottom2 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function bottom2ListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('bottom2 as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the bottom2 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function bottom2Listing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('bottom2 as BaseTbl');
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
     * This function is used to add new bottom2 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBottom2($bottom2Info)
    {
        $this->db->trans_start();
        $this->db->insert('bottom2', $bottom2Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get bottom2 information by id
     * @param number $bottom2Id : This is bottom2 id
     * @return array $result : This is bottom2 information
     */
    public function getBottom2Info($bottom2Id)
    {
        // Get bottom2 data based on bottom2Id
        $this->db->where('id', $bottom2Id);
        $query = $this->db->get('bottom2');

        // If query is successful, return the result
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the bottom2 information
     * @param array $bottom2Info : This is bottom2 updated information
     * @param number $bottom2Id : This is bottom2 id
     */
    function editBottom2($bottom2Info, $bottom2Id)
    {
        try {
            // Check if $bottom2Info or $bottom2Id is not valid
            if (empty($bottom2Info) || empty($bottom2Id)) {
                throw new Exception("Invalid bottom2 information or bottom2 ID provided");
            }

            // Validate $bottom2Id to ensure it's a number and not an empty string
            if (!is_numeric($bottom2Id) || $bottom2Id <= 0) {
                throw new Exception("Invalid bottom2 ID provided");
            }

            // Validate $bottom2Info to ensure it's a valid array
            if (!is_array($bottom2Info) || empty($bottom2Info)) {
                throw new Exception("Invalid bottom2 information provided");
            }

            // Perform update to the bottom2 table
            $this->db->where('id', $bottom2Id);
            $this->db->update('bottom2', $bottom2Info);

            // Return TRUE if update is successful
            return TRUE;
        } catch (Exception $e) {
            // Handle error by logging the error message and possibly taking appropriate action
            error_log('Error in editBottom2(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateBottom2($updatedData, $bottom2Id)
    {
        // Update bottom2 data based on bottom2Id
        $this->db->where('id', $bottom2Id);
        $this->db->update('bottom2', $updatedData);

        // Return true if update is successful, false if failed
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteBottom2($bottom2_id)
    {
        // Perform deletion process based on ID
        return $this->db->where('id', $bottom2_id)->delete('bottom2');
    }

}
