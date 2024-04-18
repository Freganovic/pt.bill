<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Inner_model (Inner Model)
 * Inner model class to handle inner related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Inner_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the inner listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function innerListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('inner as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the inner listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function innerListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('inner as BaseTbl');
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
     * This function is used to add new inner to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewInner($innerInfo)
    {
        $this->db->trans_start();
        $this->db->insert('inner', $innerInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get inner information by id
     * @param number $innerId : This is inner id
     * @return array $result : This is inner information
     */
    public function getInnerInfo($innerId)
    {
        // Lakukan pengambilan data inner berdasarkan innerId
        $this->db->where('id', $innerId);
        $query = $this->db->get('inner');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the inner information
     * @param array $innerInfo : This is inner updated information
     * @param number $innerId : This is inner id
     */
    function editInner($innerInfo, $innerId)
    {
        try {
            // Lakukan pemeriksaan jika $innerInfo atau $innerId tidak valid
            if (empty($innerInfo) || empty($innerId)) {
                throw new Exception("Invalid inner information or inner ID provided");
            }

            // Lakukan validasi $innerId untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($innerId) || $innerId <= 0) {
                throw new Exception("Invalid inner ID provided");
            }

            // Lakukan validasi $innerInfo untuk memastikan itu adalah array yang valid
            if (!is_array($innerInfo) || empty($innerInfo)) {
                throw new Exception("Invalid inner information provided");
            }

            // Lakukan pembaruan ke tabel inner
            $this->db->where('id', $innerId);
            $this->db->update('inner', $innerInfo);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editInner(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateInner($updatedData, $innerId)
    {
        // Lakukan update data inner berdasarkan innerId
        $this->db->where('id', $innerId);
        $this->db->update('inner', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteInner($inner_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $inner_id)->delete('inner');
    }

}
