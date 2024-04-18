<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Bottom3 (Bottom3Controller)
 * Bottom3 Class to control bottom3 related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Bottom3 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bottom3_model', 'bm');
        $this->isLoggedIn();
        $this->module = 'Bottom3';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('bottom3/bottom3Listing');
    }

    /**
     * This function is used to load the bottom3 list
     */
    public function bottom3Listing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bm->bottom3ListingCount($searchText);
            $returns = $this->paginationCompress("bottom3Listing/", $count, 10);

            $data['records'] = $this->bm->bottom3Listing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Bottom3';

            $this->loadViews("bottom3/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Bottom3';
            $this->loadViews("bottom3/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new bottom3 to the system
     */
    public function addNewBottom3()
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
                $bottom3Info = array(
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

                $result = $this->bm->addNewBottom3($bottom3Info);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Bottom3 created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Bottom3 creation failed');
                }

                redirect('bottom3/bottom3Listing');
            }
        }
    }

    /**
     * This function is used load bottom3 edit information
     */
    public function edit($bottom3Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($bottom3Id == null) {
                redirect('bottom3/bottom3Listing');
            }

            $data['bottom3Info'] = $this->bm->getBottom3Info($bottom3Id);

            $this->global['pageTitle'] = 'CodeInsect : Edit Bottom3';

            $this->loadViews("bottom3/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the bottom3 information
     */
    public function editBottom3()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $bottom3Id = $this->input->post('bottom3Id');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Determine default value for Bottom3 Text field
            $defaultBottom3Text = "Default Text"; // Default value can be adjusted as per requirement

            // Check if Bottom3 Text field is empty
            if (empty($this->input->post('bottom3'))) {
                $bottom3Text = $defaultBottom3Text;
            } else {
                $bottom3Text = $this->input->post('bottom3');
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
                $this->edit($bottom3Id);
            } else {
                // Update bottom3 data
                $bottom3Info = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Update value of Bottom3 Text field
                    'nama' => $nama, // Update value of Bottom3 Text field
                    'mars' => $mars, // Update value of Bottom3 Text field
                    'bom' => $bom, // Update value of Bottom3 Text field
                    'qty' => $qty, // Update value of Bottom3 Text field
                    'mesin' => $mesin, // Update value of Bottom3 Text field
                    'wo' => $wo, // Update value of Bottom3 Text field
                    'io' => $io // Update value of Bottom3 Text field
                );

                $result = $this->bm->editBottom3($bottom3Info, $bottom3Id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Bottom3 updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Bottom3 updation failed');
                }

                redirect('bottom3/bottom3Listing');
            }
        }
    }

    /**
     * This function is used to delete the bottom3
     */
    public function deleteBottom3($bottom3_id)
    {
        // Call model to delete bottom3 data
        $this->load->model('Bottom3_model');
        $result = $this->Bottom3_model->deleteBottom3($bottom3_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Bottom3 deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete bottom3.');
        }

        // Redirect back to bottom3 listing page
        redirect('bottom3/bottom3Listing');
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