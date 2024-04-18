<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Bottom_model (Bottom Model)
 * Bottom model class to handle bottom related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Bottom_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the bottom listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function bottomListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('bottom as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the bottom listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function bottomListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('bottom as BaseTbl');
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
     * This function is used to add new bottom to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBottom($bottomInfo)
    {
        $this->db->trans_start();
        $this->db->insert('bottom', $bottomInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get bottom information by id
     * @param number $bottomId : This is bottom id
     * @return array $result : This is bottom information
     */
    public function getBottomInfo($bottomId)
    {
        // Lakukan pengambilan data bottom berdasarkan bottomId
        $this->db->where('id', $bottomId);
        $query = $this->db->get('bottom');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the bottom information
     * @param array $bottomInfo : This is bottom updated information
     * @param number $bottomId : This is bottom id
     */
    function editBottom($bottomInfo, $bottomId)
    {
        try {
            // Lakukan pemeriksaan jika $bottomInfo atau $bottomId tidak valid
            if (empty($bottomInfo) || empty($bottomId)) {
                throw new Exception("Invalid bottom information or bottom ID provided");
            }

            // Lakukan validasi $bottomId untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($bottomId) || $bottomId <= 0) {
                throw new Exception("Invalid bottom ID provided");
            }

            // Lakukan validasi $bottomInfo untuk memastikan itu adalah array yang valid
            if (!is_array($bottomInfo) || empty($bottomInfo)) {
                throw new Exception("Invalid bottom information provided");
            }

            // Lakukan pembaruan ke tabel bottom
            $this->db->where('id', $bottomId);
            $this->db->update('bottom', $bottomInfo);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editBottom(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateBottom($updatedData, $bottomId)
    {
        // Lakukan update data bottom berdasarkan bottomId
        $this->db->where('id', $bottomId);
        $this->db->update('bottom', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteBottom($bottom_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $bottom_id)->delete('bottom');
    }

}
