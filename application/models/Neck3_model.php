<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Neck3_model (Neck3 Model)
 * Neck3 model class to handle neck3 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Neck3_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the neck3 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function neck3ListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('neck3 as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the neck3 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function neck3Listing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('neck3 as BaseTbl');
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
     * This function is used to add new neck3 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewNeck3($neck3Info)
    {
        $this->db->trans_start();
        $this->db->insert('neck3', $neck3Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get neck3 information by id
     * @param number $neck3Id : This is neck3 id
     * @return array $result : This is neck3 information
     */
    public function getNeck3Info($neck3Id)
    {
        // Lakukan pengambilan data neck3 berdasarkan neck3Id
        $this->db->where('id', $neck3Id);
        $query = $this->db->get('neck3');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the neck3 information
     * @param array $neck3Info : This is neck3 updated information
     * @param number $neck3Id : This is neck3 id
     */
    function editNeck3($neck3Info, $neck3Id)
    {
        try {
            // Lakukan pemeriksaan jika $neck3Info atau $neck3Id tidak valid
            if (empty($neck3Info) || empty($neck3Id)) {
                throw new Exception("Invalid neck3 information or neck3 ID provided");
            }

            // Lakukan validasi $neck3Id untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($neck3Id) || $neck3Id <= 0) {
                throw new Exception("Invalid neck3 ID provided");
            }

            // Lakukan validasi $neck3Info untuk memastikan itu adalah array yang valid
            if (!is_array($neck3Info) || empty($neck3Info)) {
                throw new Exception("Invalid neck3 information provided");
            }

            // Lakukan pembaruan ke tabel neck3
            $this->db->where('id', $neck3Id);
            $this->db->update('neck3', $neck3Info);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editNeck3(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateNeck3($updatedData, $neck3Id)
    {
        // Lakukan update data neck3 berdasarkan neck3Id
        $this->db->where('id', $neck3Id);
        $this->db->update('neck3', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteNeck3($neck3_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $neck3_id)->delete('neck3');
    }

}
