<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Bottom (BottomController)
 * Bottom Class to control bottom related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Bottom extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bottom_model', 'bm');
        $this->isLoggedIn();
        $this->module = 'Bottom';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('bottom/bottomListing');
    }

    /**
     * This function is used to load the bottom list
     */
    public function bottomListing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bm->bottomListingCount($searchText);
            $returns = $this->paginationCompress("bottomListing/", $count, 10);

            $data['records'] = $this->bm->bottomListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Bottom';

            $this->loadViews("bottom/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Bottom';
            $this->loadViews("bottom/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new bottom to the system
     */
    public function addNewBottom()
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
                $bottomInfo = array(
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

                $result = $this->bm->addNewBottom($bottomInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Bottom created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Bottom creation failed');
                }

                redirect('bottom/bottomListing');
            }
        }
    }

    /**
     * This function is used load bottom edit information
     */
    public function edit($bottomId = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($bottomId == null) {
                redirect('bottom/bottomListing');
            }

            $data['bottomInfo'] = $this->bm->getBottomInfo($bottomId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Bottom';

            $this->loadViews("bottom/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the bottom information
     */
    public function editBottom()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $bottomId = $this->input->post('bottomId');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Tentukan nilai default untuk bidang Bottom Text
            $defaultBottomText = "Default Text"; // Nilai default bisa disesuaikan dengan kebutuhan

            // Periksa apakah bidang Bottom Text kosong
            if (empty($this->input->post('bottom'))) {
                $bottomText = $defaultBottomText;
            } else {
                $bottomText = $this->input->post('bottom');
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
                $this->edit($bottomId);
            } else {
                // Perbarui data bottom
                $bottomInfo = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Perbarui nilai bidang Bottom Text
                    'nama' => $nama, // Perbarui nilai bidang Bottom Text
                    'mars' => $mars, // Perbarui nilai bidang Bottom Text
                    'bom' => $bom, // Perbarui nilai bidang Bottom Text
                    'qty' => $qty, // Perbarui nilai bidang Bottom Text
                    'mesin' => $mesin, // Perbarui nilai bidang Bottom Text
                    'wo' => $wo, // Perbarui nilai bidang Bottom Text
                    'io' => $io // Perbarui nilai bidang Bottom Text
                );

                $result = $this->bm->editBottom($bottomInfo, $bottomId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Bottom updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Bottom updation failed');
                }

                redirect('bottom/bottomListing');
            }
        }
    }


    public function deleteBottom($bottom_id)
    {
        // Panggil model untuk menghapus data bottom
        $this->load->model('Bottom_model');
        $result = $this->Bottom_model->deleteBottom($bottom_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Bottom deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete bottom.');
        }

        // Redirect kembali ke halaman listing bottom
        redirect('bottom/bottomListing');
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