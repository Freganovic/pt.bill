<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Inner (InnerController)
 * Inner Class to control inner related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Inner extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inner_model', 'im');
        $this->isLoggedIn();
        $this->module = 'Inner';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('inner/innerListing');
    }

    /**
     * This function is used to load the inner list
     */
    public function innerListing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->im->innerListingCount($searchText);
            $returns = $this->paginationCompress("innerListing/", $count, 10);

            $data['records'] = $this->im->innerListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Inner';

            $this->loadViews("inner/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    public function add()
    {
        $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'CodeInsect : Add New Inner';
            $this->loadViews("inner/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new inner to the system
     */
    public function addNewInner()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[256]');
            $this->form_validation->set_rules('mars', 'Mars', 'trim|required|max_length[256]');
            $this->form_validation->set_rules('bom', 'Bom', 'trim|required|max_length[256]');
            $this->form_validation->set_rules('qty', 'Qty', 'trim|required');
            $this->form_validation->set_rules('mesin', 'Mesin', 'trim|required');
            $this->form_validation->set_rules('wo', 'WO', 'trim|required');
            $this->form_validation->set_rules('io', 'IO', 'trim|required');
            $this->form_validation->set_rules('status', 'status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {
                $innerInfo = array(
                    'tanggal' => $this->input->post('tanggal'),
                    'nama' => $this->input->post('nama'),
                    'mars' => $this->input->post('mars'),
                    'bom' => $this->input->post('bom'),
                    'qty' => $this->input->post('qty'),
                    'mesin' => $this->input->post('mesin'),
                    'wo' => $this->input->post('wo'),
                    'io' => $this->input->post('io'),
                    'status' => $this->input->post('status')
                );

                $result = $this->im->addNewInner($innerInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Inner created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Inner creation failed');
                }

                redirect('inner/innerListing');
            }
        }
    }

    /**
     * This function is used load inner edit information
     */
    public function edit($innerId = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($innerId == null) {
                redirect('inner/innerListing');
            }

            $data['innerInfo'] = $this->im->getInnerInfo($innerId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Inner';

            $this->loadViews("inner/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the inner information
     */
    /**
     * This function is used to edit the inner information
     */
    public function editInner()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $innerId = $this->input->post('innerId');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Tentukan nilai default untuk bidang Inner Text
            $defaultInnerText = "Default Text"; // Nilai default bisa disesuaikan dengan kebutuhan

            // Periksa apakah bidang Inner Text kosong
            if (empty($this->input->post('inner'))) {
                $innerText = $defaultInnerText;
            } else {
                $innerText = $this->input->post('inner');
            }

            // Ambil nilai dari input form
            $tanggal = $this->input->post('tanggal');
            $nama = $this->input->post('nama');
            $mars = $this->input->post('mars');
            $bom = $this->input->post('bom');
            $qty = $this->input->post('qty');
            $mesin = $this->input->post('mesin');
            $wo = $this->input->post('wo');
            $io = $this->input->post('io');

            if ($this->form_validation->run() == FALSE) {
                $this->edit($innerId);
            } else {
                // Perbarui data inner
                $innerInfo = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Perbarui nilai bidang Inner Text
                    'nama' => $nama, // Perbarui nilai bidang Inner Text
                    'mars' => $mars, // Perbarui nilai bidang Inner Text
                    'bom' => $bom, // Perbarui nilai bidang Inner Text
                    'qty' => $qty, // Perbarui nilai bidang Inner Text
                    'mesin' => $mesin, // Perbarui nilai bidang Inner Text
                    'wo' => $wo, // Perbarui nilai bidang Inner Text
                    'io' => $io // Perbarui nilai bidang Inner Text
                );

                $result = $this->im->editInner($innerInfo, $innerId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Inner updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Inner updation failed');
                }

                redirect('inner/innerListing');
            }
        }
    }


    public function deleteInner($inner_id)
    {
        // Panggil model untuk menghapus data inner
        $this->load->model('Inner_model');
        $result = $this->Inner_model->deleteInner($inner_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Inner deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete inner.');
        }

        // Redirect kembali ke halaman listing inner
        redirect('inner/innerListing');
    }


    /**
     * Custom method to clean HTML
     */
    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}
?>
