<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class : Body3_model (Body3 Model)
 * Body3 model class to handle body3 related data 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 18 Jun 2022
 */
class Body3_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This function is used to get the body3 listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function body3ListingCount($searchText)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('body3 as BaseTbl');
        if (!empty($searchText)) {
            $likeCriteria = "(BaseTbl.nama LIKE '%" . $searchText . "%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get the body3 listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function body3Listing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.id, BaseTbl.tanggal, BaseTbl.nama, BaseTbl.mars, BaseTbl.bom, BaseTbl.qty, BaseTbl.mesin, BaseTbl.wo, BaseTbl.io, BaseTbl.status');
        $this->db->from('body3 as BaseTbl');
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
     * This function is used to add new body3 to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBody3($body3Info)
    {
        $this->db->trans_start();
        $this->db->insert('body3', $body3Info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get body3 information by id
     * @param number $body3Id : This is body3 id
     * @return array $result : This is body3 information
     */
    public function getBody3Info($body3Id)
    {
        // Lakukan pengambilan data body3 berdasarkan body3Id
        $this->db->where('id', $body3Id);
        $query = $this->db->get('body3');

        // Jika query berhasil, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    /**
     * This function is used to update the body3 information
     * @param array $body3Info : This is body3 updated information
     * @param number $body3Id : This is body3 id
     */
    function editBody3($body3Info, $body3Id)
    {
        try {
            // Lakukan pemeriksaan jika $body3Info atau $body3Id tidak valid
            if (empty($body3Info) || empty($body3Id)) {
                throw new Exception("Invalid body3 information or body3 ID provided");
            }

            // Lakukan validasi $body3Id untuk memastikan itu adalah angka dan bukan string kosong
            if (!is_numeric($body3Id) || $body3Id <= 0) {
                throw new Exception("Invalid body3 ID provided");
            }

            // Lakukan validasi $body3Info untuk memastikan itu adalah array yang valid
            if (!is_array($body3Info) || empty($body3Info)) {
                throw new Exception("Invalid body3 information provided");
            }

            // Lakukan pembaruan ke tabel body3
            $this->db->where('id', $body3Id);
            $this->db->update('body3', $body3Info);

            // Kembalikan TRUE jika pembaruan berhasil
            return TRUE;
        } catch (Exception $e) {
            // Tangani kesalahan dengan mencatat pesan kesalahan dan mungkin melakukan tindakan yang sesuai
            error_log('Error in editBody3(): ' . $e->getMessage());
            return FALSE;
        }
    }
    public function updateBody3($updatedData, $body3Id)
    {
        // Lakukan update data body3 berdasarkan body3Id
        $this->db->where('id', $body3Id);
        $this->db->update('body3', $updatedData);

        // Kembalikan true jika update berhasil, false jika gagal
        return $this->db->affected_rows() > 0 ? true : false;
    }

    public function deleteBody3($body3_id)
    {
        // Lakukan proses penghapusan berdasarkan ID
        return $this->db->where('id', $body3_id)->delete('body3');
    }

}
