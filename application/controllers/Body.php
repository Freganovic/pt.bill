<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Body (BodyController)
 * Body Class to control body related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Body extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Body_model', 'bm');
        $this->isLoggedIn();
        $this->module = 'Body';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('body/bodyListing');
    }

    /**
     * This function is used to load the body list
     */
    public function bodyListing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bm->bodyListingCount($searchText);
            $returns = $this->paginationCompress("bodyListing/", $count, 10);

            $data['records'] = $this->bm->bodyListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Body';

            $this->loadViews("body/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Body';
            $this->loadViews("body/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new body to the system
     */
    public function addNewBody()
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
            $this->form_validation->set_rules('tanggal_out', 'Tanggal_out', 'trim|required');
            $this->form_validation->set_rules('status', 'status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {
                $bodyInfo = array(
                    'tanggal' => $this->input->post('tanggal'),
                    'nama' => $this->input->post('nama'),
                    'mars' => $this->input->post('mars'),
                    'bom' => $this->input->post('bom'),
                    'qty' => $this->input->post('qty'),
                    'mesin' => $this->input->post('mesin'),
                    'wo' => $this->input->post('wo'),
                    'io' => $this->input->post('io'),
                    'tanggal_out' => $this->input->post('tanggal_out'),
                    'status' => $this->input->post('status')
                );

                $result = $this->bm->addNewBody($bodyInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Body created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Body creation failed');
                }

                redirect('body/bodyListing');
            }
        }
    }

    /**
     * This function is used load body edit information
     */
    public function edit($bodyId = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($bodyId == null) {
                redirect('body/bodyListing');
            }

            $data['bodyInfo'] = $this->bm->getBodyInfo($bodyId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Body';

            $this->loadViews("body/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the body information
     */
    public function editBody()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $bodyId = $this->input->post('bodyId');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Determine default value for Body Text field
            $defaultBodyText = "Default Text"; // Default value can be adjusted as per requirement

            // Check if Body Text field is empty
            if (empty($this->input->post('body'))) {
                $bodyText = $defaultBodyText;
            } else {
                $bodyText = $this->input->post('body');
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
            $tanggal_out = $this->input->post('tanggal_out');

            if ($this->form_validation->run() == FALSE) {
                $this->edit($bodyId);
            } else {
                // Update body data
                $bodyInfo = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Update value of Body Text field
                    'nama' => $nama, // Update value of Body Text field
                    'mars' => $mars, // Update value of Body Text field
                    'bom' => $bom, // Update value of Body Text field
                    'qty' => $qty, // Update value of Body Text field
                    'mesin' => $mesin, // Update value of Body Text field
                    'wo' => $wo, // Update value of Body Text field
                    'io' => $io, // Update value of Body Text field
                    'tanggal_out' => $tanggal_out
                );

                $result = $this->bm->editBody($bodyInfo, $bodyId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Body updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Body updation failed');
                }

                redirect('body/bodyListing');
            }
        }
    }

    /**
     * This function is used to delete the body
     */
    public function deleteBody($body_id)
    {
        // Call model to delete body data
        $this->load->model('Body_model');
        $result = $this->Body_model->deleteBody($body_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Body deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete body.');
        }

        // Redirect back to body listing page
        redirect('body/bodyListing');
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