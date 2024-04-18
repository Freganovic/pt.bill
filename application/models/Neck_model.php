<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Neck_model (Neck Model)
 * Neck model class to handle neck related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Neck_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the neck listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function neckListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('neck as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the neck listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function neckListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('neck as BaseTbl');
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
     * This function is used to add new neck to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewNeck($neckInfo)
    {
        $this->db->trans_start();
        $this->db->insert('neck', $neckInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get neck information by id
     * @param number $neckId : This is neck id
     * @return array $result : This is neck information
     */
    public function getNeckInfo($neckId)
    {
        // Lakukan pengambilan data neck berdasarkan neckId
        $this->db->where('id', $neckId);
        $query = $this->db->get('neck');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the neck information
     * @param array $neckInfo : This is neck updated information
     * @param number $neckId : This is neck id
     */
    function editNeck($neckInfo, $neckId)
    {
        try {
            // Lakukan pemeriksaan jika $neckInfo atau $neckId tidak valid
            if (empty($neckInfo) || empty($neckId)) {
                throw new Exception("Invalid neck information or neck ID provided");
            }

            // Lakukan validasi $neckId untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($neckId) || $neckId <= 0) {
                throw new Exception("Invalid neck ID provided");
            }

            // Lakukan validasi $neckInfo untuk memastikan itu adalah array yang valid
            if (!is_array($neckInfo) || empty($neckInfo)) {
                throw new Exception("Invalid neck information provided");
            }

            // Lakukan pembaruan ke tabel neck
            $this->db->where('id', $neckId);
            $this->db->update('neck', $neckInfo);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editNeck(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateNeck($updatedData, $neckId)
    {
        // Lakukan update data neck berdasarkan neckId
        $this->db->where('id', $neckId);
        $this->db->update('neck', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteNeck($neck_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $neck_id)->delete('neck');
    }

}
