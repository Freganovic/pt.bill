<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Body_model (Body Model)
 * Body model class to handle body related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Body_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the body listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function bodyListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('body as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the body listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function bodyListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('body as BaseTbl');
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
     * This function is used to add new body to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBody($bodyInfo)
    {
        $this->db->trans_start();
        $this->db->insert('body', $bodyInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get body information by id
     * @param number $bodyId : This is body id
     * @return array $result : This is body information
     */
    public function getBodyInfo($bodyId)
    {
        // Lakukan pengambilan data body berdasarkan bodyId
        $this->db->where('id', $bodyId);
        $query = $this->db->get('body');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the body information
     * @param array $bodyInfo : This is body updated information
     * @param number $bodyId : This is body id
     */
    function editBody($bodyInfo, $bodyId)
    {
        try {
            // Lakukan pemeriksaan jika $bodyInfo atau $bodyId tidak valid
            if (empty($bodyInfo) || empty($bodyId)) {
                throw new Exception("Invalid body information or body ID provided");
            }

            // Lakukan validasi $bodyId untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($bodyId) || $bodyId <= 0) {
                throw new Exception("Invalid body ID provided");
            }

            // Lakukan validasi $bodyInfo untuk memastikan itu adalah array yang valid
            if (!is_array($bodyInfo) || empty($bodyInfo)) {
                throw new Exception("Invalid body information provided");
            }

            // Lakukan pembaruan ke tabel body
            $this->db->where('id', $bodyId);
            $this->db->update('body', $bodyInfo);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editBody(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateBody($updatedData, $bodyId)
    {
        // Lakukan update data body berdasarkan bodyId
        $this->db->where('id', $bodyId);
        $this->db->update('body', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteBody($body_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $body_id)->delete('body');
    }

}
