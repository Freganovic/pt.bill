<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Body2 (Body2Controller)
 * Body2 Class to control body2 related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Body2 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Body2_model', 'bm');
        $this->isLoggedIn();
        $this->module = 'Body2';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('body2/body2Listing');
    }

    /**
     * This function is used to load the body2 list
     */
    public function body2Listing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bm->body2ListingCount($searchText);
            $returns = $this->paginationCompress("body2Listing/", $count, 10);

            $data['records'] = $this->bm->body2Listing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Body2';

            $this->loadViews("body2/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Body2';
            $this->loadViews("body2/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new body2 to the system
     */
    public function addNewBody2()
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
                $body2Info = array(
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

                $result = $this->bm->addNewBody2($body2Info);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Body2 created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Body2 creation failed');
                }

                redirect('body2/body2Listing');
            }
        }
    }

    /**
     * This function is used load body2 edit information
     */
    public function edit($body2Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($body2Id == null) {
                redirect('body2/body2Listing');
            }

            $data['body2Info'] = $this->bm->getBody2Info($body2Id);

            $this->global['pageTitle'] = 'CodeInsect : Edit Body2';

            $this->loadViews("body2/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the body2 information
     */
    public function editBody2()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $body2Id = $this->input->post('body2Id');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Determine default value for Body2 Text field
            $defaultBody2Text = "Default Text"; // Default value can be adjusted as per requirement

            // Check if Body2 Text field is empty
            if (empty($this->input->post('body2'))) {
                $body2Text = $defaultBody2Text;
            } else {
                $body2Text = $this->input->post('body2');
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
                $this->edit($body2Id);
            } else {
                // Update body2 data
                $body2Info = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Update value of Body2 Text field
                    'nama' => $nama, // Update value of Body2 Text field
                    'mars' => $mars, // Update value of Body2 Text field
                    'bom' => $bom, // Update value of Body2 Text field
                    'qty' => $qty, // Update value of Body2 Text field
                    'mesin' => $mesin, // Update value of Body2 Text field
                    'wo' => $wo, // Update value of Body2 Text field
                    'io' => $io // Update value of Body2 Text field
                );

                $result = $this->bm->editBody2($body2Info, $body2Id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Body2 updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Body2 updation failed');
                }

                redirect('body2/body2Listing');
            }
        }
    }

    /**
     * This function is used to delete the body2
     */
    public function deleteBody2($body2_id)
    {
        // Call model to delete body2 data
        $this->load->model('Body2_model');
        $result = $this->Body2_model->deleteBody2($body2_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Body2 deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete body2.');
        }

        // Redirect back to body2 listing page
        redirect('body2/body2Listing');
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