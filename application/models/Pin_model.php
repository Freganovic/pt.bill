<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Pin_model (Pin Model)
 * Pin model class to handle pin related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Pin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the pin listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function pinListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('pin as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the pin listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function pinListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('pin as BaseTbl');
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
     * This function is used to add new pin to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewPin($pinInfo)
    {
        $this->db->trans_start();
        $this->db->insert('pin', $pinInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get pin information by id
     * @param number $pinId : This is pin id
     * @return array $result : This is pin information
     */
    public function getPinInfo($pinId)
    {
        // Lakukan pengambilan data pin berdasarkan pinId
        $this->db->where('id', $pinId);
        $query = $this->db->get('pin');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the pin information
     * @param array $pinInfo : This is pin updated information
     * @param number $pinId : This is pin id
     */
    function editPin($pinInfo, $pinId)
    {
        try {
            // Lakukan pemeriksaan jika $pinInfo atau $pinId tidak valid
            if (empty($pinInfo) || empty($pinId)) {
                throw new Exception("Invalid pin information or pin ID provided");
            }

            // Lakukan validasi $pinId untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($pinId) || $pinId <= 0) {
                throw new Exception("Invalid pin ID provided");
            }

            // Lakukan validasi $pinInfo untuk memastikan itu adalah array yang valid
            if (!is_array($pinInfo) || empty($pinInfo)) {
                throw new Exception("Invalid pin information provided");
            }

            // Lakukan pembaruan ke tabel pin
            $this->db->where('id', $pinId);
            $this->db->update('pin', $pinInfo);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editPin(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updatePin($updatedData, $pinId)
    {
        // Lakukan update data pin berdasarkan pinId
        $this->db->where('id', $pinId);
        $this->db->update('pin', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deletePin($pin_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $pin_id)->delete('pin');
    }

}
