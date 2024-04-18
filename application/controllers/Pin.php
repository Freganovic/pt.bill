<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Pin (PinController)
 * Pin Class to control pin related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Pin extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pin_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'Pin';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('pin/pinListing');
    }

    /**
     * This function is used to load the pin list
     */
    public function pinListing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->pm->pinListingCount($searchText);
            $returns = $this->paginationCompress("pinListing/", $count, 10);

            $data['records'] = $this->pm->pinListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Pin';

            $this->loadViews("pin/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Pin';
            $this->loadViews("pin/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new pin to the system
     */
    public function addNewPin()
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
                $pinInfo = array(
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

                $result = $this->pm->addNewPin($pinInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Pin created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Pin creation failed');
                }

                redirect('pin/pinListing');
            }
        }
    }

    /**
     * This function is used load pin edit information
     */
    public function edit($pinId = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($pinId == null) {
                redirect('pin/pinListing');
            }

            $data['pinInfo'] = $this->pm->getPinInfo($pinId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Pin';

            $this->loadViews("pin/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the pin information
     */
    /**
     * This function is used to edit the pin information
     */
    public function editPin()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $pinId = $this->input->post('pinId');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Tentukan nilai default untuk bidang Pin Text
            $defaultPinText = "Default Text"; // Nilai default bisa disesuaikan dengan kebutuhan

            // Periksa apakah bidang Pin Text kosong
            if (empty($this->input->post('pin'))) {
                $pinText = $defaultPinText;
            } else {
                $pinText = $this->input->post('pin');
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
                $this->edit($pinId);
            } else {
                // Perbarui data pin
                $pinInfo = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Perbarui nilai bidang Pin Text
                    'nama' => $nama, // Perbarui nilai bidang Pin Text
                    'mars' => $mars, // Perbarui nilai bidang Pin Text
                    'bom' => $bom, // Perbarui nilai bidang Pin Text
                    'qty' => $qty, // Perbarui nilai bidang Pin Text
                    'mesin' => $mesin, // Perbarui nilai bidang Pin Text
                    'wo' => $wo, // Perbarui nilai bidang Pin Text
                    'io' => $io // Perbarui nilai bidang Pin Text
                );

                $result = $this->pm->editPin($pinInfo, $pinId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Pin updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Pin updation failed');
                }

                redirect('pin/pinListing');
            }
        }
    }


    public function deletePin($pin_id)
    {
        // Panggil model untuk menghapus data pin
        $this->load->model('Pin_model');
        $result = $this->Pin_model->deletePin($pin_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Pin deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete pin.');
        }

        // Redirect kembali ke halaman listing pin
        redirect('pin/pinListing');
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