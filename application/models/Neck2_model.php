<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Neck2_model (Neck2 Model)
 * Neck2 model class to handle neck2 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Neck2_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the neck2 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function neck2ListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('neck2 as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the neck2 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function neck2Listing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('neck2 as BaseTbl');
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
     * This function is used to add new neck2 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewNeck2($neck2Info)
    {
        $this->db->trans_start();
        $this->db->insert('neck2', $neck2Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get neck2 information by id
     * @param number $neck2Id : This is neck2 id
     * @return array $result : This is neck2 information
     */
    public function getNeck2Info($neck2Id)
    {
        // Lakukan pengambilan data neck2 berdasarkan neck2Id
        $this->db->where('id', $neck2Id);
        $query = $this->db->get('neck2');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the neck2 information
     * @param array $neck2Info : This is neck2 updated information
     * @param number $neck2Id : This is neck2 id
     */
    function editNeck2($neck2Info, $neck2Id)
    {
        try {
            // Lakukan pemeriksaan jika $neck2Info atau $neck2Id tidak valid
            if (empty($neck2Info) || empty($neck2Id)) {
                throw new Exception("Invalid neck2 information or neck2 ID provided");
            }

            // Lakukan validasi $neck2Id untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($neck2Id) || $neck2Id <= 0) {
                throw new Exception("Invalid neck2 ID provided");
            }

            // Lakukan validasi $neck2Info untuk memastikan itu adalah array yang valid
            if (!is_array($neck2Info) || empty($neck2Info)) {
                throw new Exception("Invalid neck2 information provided");
            }

            // Lakukan pembaruan ke tabel neck2
            $this->db->where('id', $neck2Id);
            $this->db->update('neck2', $neck2Info);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editNeck2(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateNeck2($updatedData, $neck2Id)
    {
        // Lakukan update data neck2 berdasarkan neck2Id
        $this->db->where('id', $neck2Id);
        $this->db->update('neck2', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteNeck2($neck2_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $neck2_id)->delete('neck2');
    }

}
