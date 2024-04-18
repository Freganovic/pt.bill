<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Body3 (Body3Controller)
 * Body3 Class to control body3 related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Body3 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Body3_model', 'bm');
        $this->isLoggedIn();
        $this->module = 'Body3';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('body3/body3Listing');
    }

    /**
     * This function is used to load the body3 list
     */
    public function body3Listing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bm->body3ListingCount($searchText);
            $returns = $this->paginationCompress("body3Listing/", $count, 10);

            $data['records'] = $this->bm->body3Listing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Body3';

            $this->loadViews("body3/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Body3';
            $this->loadViews("body3/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new body3 to the system
     */
    public function addNewBody3()
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
                $body3Info = array(
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

                $result = $this->bm->addNewBody3($body3Info);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Body3 created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Body3 creation failed');
                }

                redirect('body3/body3Listing');
            }
        }
    }

    /**
     * This function is used load body3 edit information
     */
    public function edit($body3Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($body3Id == null) {
                redirect('body3/body3Listing');
            }

            $data['body3Info'] = $this->bm->getBody3Info($body3Id);

            $this->global['pageTitle'] = 'CodeInsect : Edit Body3';

            $this->loadViews("body3/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the body3 information
     */
    public function editBody3()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $body3Id = $this->input->post('body3Id');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Determine default value for Body3 Text field
            $defaultBody3Text = "Default Text"; // Default value can be adjusted as per requirement

            // Check if Body3 Text field is empty
            if (empty($this->input->post('body3'))) {
                $body3Text = $defaultBody3Text;
            } else {
                $body3Text = $this->input->post('body3');
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
                $this->edit($body3Id);
            } else {
                // Update body3 data
                $body3Info = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Update value of Body3 Text field
                    'nama' => $nama, // Update value of Body3 Text field
                    'mars' => $mars, // Update value of Body3 Text field
                    'bom' => $bom, // Update value of Body3 Text field
                    'qty' => $qty, // Update value of Body3 Text field
                    'mesin' => $mesin, // Update value of Body3 Text field
                    'wo' => $wo, // Update value of Body3 Text field
                    'io' => $io // Update value of Body3 Text field
                );

                $result = $this->bm->editBody3($body3Info, $body3Id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Body3 updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Body3 updation failed');
                }

                redirect('body3/body3Listing');
            }
        }
    }

    /**
     * This function is used to delete the body3
     */
    public function deleteBody3($body3_id)
    {
        // Call model to delete body3 data
        $this->load->model('Body3_model');
        $result = $this->Body3_model->deleteBody3($body3_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Body3 deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete body3.');
        }

        // Redirect back to body3 listing page
        redirect('body3/body3Listing');
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