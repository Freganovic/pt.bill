<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Head_model (Head Model)
 * Head model class to handle head related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Head_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the head listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function headListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('head as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the head listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function headListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('head as BaseTbl');
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
     * This function is used to add new head to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewHead($headInfo)
    {
        $this->db->trans_start();
        $this->db->insert('head', $headInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get head information by id
     * @param number $headId : This is head id
     * @return array $result : This is head information
     */
    public function getHeadInfo($headId)
    {
        // Lakukan pengambilan data head berdasarkan headId
        $this->db->where('id', $headId);
        $query = $this->db->get('head');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the head information
     * @param array $headInfo : This is head updated information
     * @param number $headId : This is head id
     */
    function editHead($headInfo, $headId)
    {
        try {
            // Lakukan pemeriksaan jika $headInfo atau $headId tidak valid
            if (empty($headInfo) || empty($headId)) {
                throw new Exception("Invalid head information or head ID provided");
            }

            // Lakukan validasi $headId untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($headId) || $headId <= 0) {
                throw new Exception("Invalid head ID provided");
            }

            // Lakukan validasi $headInfo untuk memastikan itu adalah array yang valid
            if (!is_array($headInfo) || empty($headInfo)) {
                throw new Exception("Invalid head information provided");
            }

            // Lakukan pembaruan ke tabel head
            $this->db->where('id', $headId);
            $this->db->update('head', $headInfo);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editHead(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateHead($updatedData, $headId)
    {
        // Lakukan update data head berdasarkan headId
        $this->db->where('id', $headId);
        $this->db->update('head', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteHead($head_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $head_id)->delete('head');
    }

}
