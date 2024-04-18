<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Neck2 (Neck2Controller)
 * Neck2 Class to control neck2 related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Neck2 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Neck2_model', 'bm');
        $this->isLoggedIn();
        $this->module = 'Neck2';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('neck2/neck2Listing');
    }

    /**
     * This function is used to load the neck2 list
     */
    public function neck2Listing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bm->neck2ListingCount($searchText);
            $returns = $this->paginationCompress("neck2Listing/", $count, 10);

            $data['records'] = $this->bm->neck2Listing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Neck2';

            $this->loadViews("neck2/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Neck2';
            $this->loadViews("neck2/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new neck2 to the system
     */
    public function addNewNeck2()
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
                $neck2Info = array(
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

                $result = $this->bm->addNewNeck2($neck2Info);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Neck2 created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Neck2 creation failed');
                }

                redirect('neck2/neck2Listing');
            }
        }
    }

    /**
     * This function is used load neck2 edit information
     */
    public function edit($neck2Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($neck2Id == null) {
                redirect('neck2/neck2Listing');
            }

            $data['neck2Info'] = $this->bm->getNeck2Info($neck2Id);

            $this->global['pageTitle'] = 'CodeInsect : Edit Neck2';

            $this->loadViews("neck2/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the neck2 information
     */
    public function editNeck2()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $neck2Id = $this->input->post('neck2Id');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Determine default value for Neck2 Text field
            $defaultNeck2Text = "Default Text"; // Default value can be adjusted as per requirement

            // Check if Neck2 Text field is empty
            if (empty($this->input->post('neck2'))) {
                $neck2Text = $defaultNeck2Text;
            } else {
                $neck2Text = $this->input->post('neck2');
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
                $this->edit($neck2Id);
            } else {
                // Update neck2 data
                $neck2Info = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Update value of Neck2 Text field
                    'nama' => $nama, // Update value of Neck2 Text field
                    'mars' => $mars, // Update value of Neck2 Text field
                    'bom' => $bom, // Update value of Neck2 Text field
                    'qty' => $qty, // Update value of Neck2 Text field
                    'mesin' => $mesin, // Update value of Neck2 Text field
                    'wo' => $wo, // Update value of Neck2 Text field
                    'io' => $io // Update value of Neck2 Text field
                );

                $result = $this->bm->editNeck2($neck2Info, $neck2Id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Neck2 updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Neck2 updation failed');
                }

                redirect('neck2/neck2Listing');
            }
        }
    }

    /**
     * This function is used to delete the neck2
     */
    public function deleteNeck2($neck2_id)
    {
        // Call model to delete neck2 data
        $this->load->model('Neck2_model');
        $result = $this->Neck2_model->deleteNeck2($neck2_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Neck2 deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete neck2.');
        }

        // Redirect back to neck2 listing page
        redirect('neck2/neck2Listing');
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