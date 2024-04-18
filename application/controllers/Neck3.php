<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Neck3 (Neck3Controller)
 * Neck3 Class to control neck3 related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Neck3 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Neck3_model', 'bm');
        $this->isLoggedIn();
        $this->module = 'Neck3';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('neck3/neck3Listing');
    }

    /**
     * This function is used to load the neck3 list
     */
    public function neck3Listing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bm->neck3ListingCount($searchText);
            $returns = $this->paginationCompress("neck3Listing/", $count, 10);

            $data['records'] = $this->bm->neck3Listing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Neck3';

            $this->loadViews("neck3/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Neck3';
            $this->loadViews("neck3/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new neck3 to the system
     */
    public function addNewNeck3()
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
                $neck3Info = array(
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

                $result = $this->bm->addNewNeck3($neck3Info);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Neck3 created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Neck3 creation failed');
                }

                redirect('neck3/neck3Listing');
            }
        }
    }

    /**
     * This function is used load neck3 edit information
     */
    public function edit($neck3Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($neck3Id == null) {
                redirect('neck3/neck3Listing');
            }

            $data['neck3Info'] = $this->bm->getNeck3Info($neck3Id);

            $this->global['pageTitle'] = 'CodeInsect : Edit Neck3';

            $this->loadViews("neck3/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the neck3 information
     */
    public function editNeck3()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $neck3Id = $this->input->post('neck3Id');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Determine default value for Neck3 Text field
            $defaultNeck3Text = "Default Text"; // Default value can be adjusted as per requirement

            // Check if Neck3 Text field is empty
            if (empty($this->input->post('neck3'))) {
                $neck3Text = $defaultNeck3Text;
            } else {
                $neck3Text = $this->input->post('neck3');
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
                $this->edit($neck3Id);
            } else {
                // Update neck3 data
                $neck3Info = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Update value of Neck3 Text field
                    'nama' => $nama, // Update value of Neck3 Text field
                    'mars' => $mars, // Update value of Neck3 Text field
                    'bom' => $bom, // Update value of Neck3 Text field
                    'qty' => $qty, // Update value of Neck3 Text field
                    'mesin' => $mesin, // Update value of Neck3 Text field
                    'wo' => $wo, // Update value of Neck3 Text field
                    'io' => $io // Update value of Neck3 Text field
                );

                $result = $this->bm->editNeck3($neck3Info, $neck3Id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Neck3 updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Neck3 updation failed');
                }

                redirect('neck3/neck3Listing');
            }
        }
    }

    /**
     * This function is used to delete the neck3
     */
    public function deleteNeck3($neck3_id)
    {
        // Call model to delete neck3 data
        $this->load->model('Neck3_model');
        $result = $this->Neck3_model->deleteNeck3($neck3_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Neck3 deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete neck3.');
        }

        // Redirect back to neck3 listing page
        redirect('neck3/neck3Listing');
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