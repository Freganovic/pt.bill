<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Neck (NeckController)
 * Neck Class to control neck related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Neck extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Neck_model', 'nm');
        $this->isLoggedIn();
        $this->module = 'Neck';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('neck/neckListing');
    }

    /**
     * This function is used to load the neck list
     */
    public function neckListing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->nm->neckListingCount($searchText);
            $returns = $this->paginationCompress("neckListing/", $count, 10);

            $data['records'] = $this->nm->neckListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Neck';

            $this->loadViews("neck/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Neck';
            $this->loadViews("neck/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new neck to the system
     */
    public function addNewNeck()
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
                $neckInfo = array(
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

                $result = $this->nm->addNewNeck($neckInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Neck created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Neck creation failed');
                }

                redirect('neck/neckListing');
            }
        }
    }

    /**
     * This function is used load neck edit information
     */
    public function edit($neckId = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($neckId == null) {
                redirect('neck/neckListing');
            }

            $data['neckInfo'] = $this->nm->getNeckInfo($neckId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Neck';

            $this->loadViews("neck/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the neck information
     */
    /**
     * This function is used to edit the neck information
     */
    public function editNeck()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $neckId = $this->input->post('neckId');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Tentukan nilai default untuk bidang Neck Text
            $defaultNeckText = "Default Text"; // Nilai default bisa disesuaikan dengan kebutuhan

            // Periksa apakah bidang Neck Text kosong
            if (empty($this->input->post('neck'))) {
                $neckText = $defaultNeckText;
            } else {
                $neckText = $this->input->post('neck');
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
                $this->edit($neckId);
            } else {
                // Perbarui data neck
                $neckInfo = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Perbarui nilai bidang Neck Text
                    'nama' => $nama, // Perbarui nilai bidang Neck Text
                    'mars' => $mars, // Perbarui nilai bidang Neck Text
                    'bom' => $bom, // Perbarui nilai bidang Neck Text
                    'qty' => $qty, // Perbarui nilai bidang Neck Text
                    'mesin' => $mesin, // Perbarui nilai bidang Neck Text
                    'wo' => $wo, // Perbarui nilai bidang Neck Text
                    'io' => $io // Perbarui nilai bidang Neck Text
                );

                $result = $this->nm->editNeck($neckInfo, $neckId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Neck updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Neck updation failed');
                }

                redirect('neck/neckListing');
            }
        }
    }


    public function deleteNeck($neck_id)
    {
        // Panggil model untuk menghapus data neck
        $this->load->model('Neck_model');
        $result = $this->Neck_model->deleteNeck($neck_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Neck deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete neck.');
        }

        // Redirect kembali ke halaman listing neck
        redirect('neck/neckListing');
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