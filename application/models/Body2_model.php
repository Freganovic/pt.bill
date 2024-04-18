<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Body2_model (Body2 Model)
 * Body2 model class to handle body2 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Body2_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the body2 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function body2ListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('body2 as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the body2 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function body2Listing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('body2 as BaseTbl');
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
     * This function is used to add new body2 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBody2($body2Info)
    {
        $this->db->trans_start();
        $this->db->insert('body2', $body2Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get body2 information by id
     * @param number $body2Id : This is body2 id
     * @return array $result : This is body2 information
     */
    public function getBody2Info($body2Id)
    {
        // Lakukan pengambilan data body2 berdasarkan body2Id
        $this->db->where('id', $body2Id);
        $query = $this->db->get('body2');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the body2 information
     * @param array $body2Info : This is body2 updated information
     * @param number $body2Id : This is body2 id
     */
    function editBody2($body2Info, $body2Id)
    {
        try {
            // Lakukan pemeriksaan jika $body2Info atau $body2Id tidak valid
            if (empty($body2Info) || empty($body2Id)) {
                throw new Exception("Invalid body2 information or body2 ID provided");
            }

            // Lakukan validasi $body2Id untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($body2Id) || $body2Id <= 0) {
                throw new Exception("Invalid body2 ID provided");
            }

            // Lakukan validasi $body2Info untuk memastikan itu adalah array yang valid
            if (!is_array($body2Info) || empty($body2Info)) {
                throw new Exception("Invalid body2 information provided");
            }

            // Lakukan pembaruan ke tabel body2
            $this->db->where('id', $body2Id);
            $this->db->update('body2', $body2Info);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editBody2(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateBody2($updatedData, $body2Id)
    {
        // Lakukan update data body2 berdasarkan body2Id
        $this->db->where('id', $body2Id);
        $this->db->update('body2', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteBody2($body2_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $body2_id)->delete('body2');
    }

}
