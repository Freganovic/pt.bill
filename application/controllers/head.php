<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Head (HeadController)
 * Head Class to control head related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Head extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Head_model', 'hm');
        $this->isLoggedIn();
        $this->module = 'Head';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('head/headListing');
    }

    /**
     * This function is used to load the head list
     */
    public function headListing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->hm->headListingCount($searchText);
            $returns = $this->paginationCompress("headListing/", $count, 10);

            $data['records'] = $this->hm->headListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Head';

            $this->loadViews("head/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Head';
            $this->loadViews("head/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new head to the system
     */
    public function addNewHead()
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
                $headInfo = array(
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

                $result = $this->hm->addNewHead($headInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Head created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Head creation failed');
                }

                redirect('head/headListing');
            }
        }
    }

    /**
     * This function is used load head edit information
     */
    public function edit($headId = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($headId == null) {
                redirect('head/headListing');
            }

            $data['headInfo'] = $this->hm->getHeadInfo($headId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Head';

            $this->loadViews("head/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the head information
     */
    public function editHead()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $headId = $this->input->post('headId');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Determine default value for Head Text field
            $defaultHeadText = "Default Text"; // Default value can be adjusted as per requirement

            // Check if Head Text field is empty
            if (empty($this->input->post('head'))) {
                $headText = $defaultHeadText;
            } else {
                $headText = $this->input->post('head');
            }

            // Get values from form input
            $tanggal = $this->input->post('tanggal');
            $nama = $this->input->post('nama');
            $mars = $this->input->post('mars');
            $bom = $this->input->post('bom');
            $qty = $this->input->post('qty');
            $mesin = $this->input->post('mesin');
            $wo = $this->input->post('wo');
            $io = $this->input->post('io');

            if ($this->form_validation->run() == FALSE) {
                $this->edit($headId);
            } else {
                // Update head data
                $headInfo = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Update value of Head Text field
                    'nama' => $nama, // Update value of Head Text field
                    'mars' => $mars, // Update value of Head Text field
                    'bom' => $bom, // Update value of Head Text field
                    'qty' => $qty, // Update value of Head Text field
                    'mesin' => $mesin, // Update value of Head Text field
                    'wo' => $wo, // Update value of Head Text field
                    'io' => $io, // Update value of Head Text field
                );

                $result = $this->hm->editHead($headInfo, $headId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Head updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Head updation failed');
                }

                redirect('head/headListing');
            }
        }
    }

    /**
     * This function is used to delete the head
     */
    public function deleteHead($head_id)
    {
        // Call model to delete head data
        $this->load->model('Head_model');
        $result = $this->Head_model->deleteHead($head_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Head deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete head.');
        }

        // Redirect back to head listing page
        redirect('head/headListing');
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