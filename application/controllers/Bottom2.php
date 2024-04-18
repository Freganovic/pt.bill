<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/BaseController.php';

/**
 * Class : Bottom2 (Bottom2Controller)
 * Bottom2 Class to control bottom2 related operations.
 * 
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Bottom2 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bottom2_model', 'bm');
        $this->isLoggedIn();
        $this->module = 'Bottom2';
        $this->load->library('form_validation');
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('bottom2/bottom2Listing');
    }

    /**
     * This function is used to load the bottom2 list
     */
    public function bottom2Listing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = $this->input->post('searchText');
            $searchText = !empty($searchText) ? $this->security->xss_clean($searchText) : '';

            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->bm->bottom2ListingCount($searchText);
            $returns = $this->paginationCompress("bottom2Listing/", $count, 10);

            $data['records'] = $this->bm->bottom2Listing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Bottom2';

            $this->loadViews("bottom2/list", $this->global, $data, NULL);
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Bottom2';
            $this->loadViews("bottom2/add", $this->global, NULL, NULL);
        }
    }


    /**
     * This function is used to add new bottom2 to the system
     */
    public function addNewBottom2()
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
                $bottom2Info = array(
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

                $result = $this->bm->addNewBottom2($bottom2Info);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Bottom2 created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Bottom2 creation failed');
                }

                redirect('bottom2/bottom2Listing');
            }
        }
    }

    /**
     * This function is used load bottom2 edit information
     */
    public function edit($bottom2Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($bottom2Id == null) {
                redirect('bottom2/bottom2Listing');
            }

            $data['bottom2Info'] = $this->bm->getBottom2Info($bottom2Id);

            $this->global['pageTitle'] = 'CodeInsect : Edit Bottom2';

            $this->loadViews("bottom2/edit", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to edit the bottom2 information
     */
    public function editBottom2()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $bottom2Id = $this->input->post('bottom2Id');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[complete,pending]');

            // Determine default value for Bottom2 Text field
            $defaultBottom2Text = "Default Text"; // Default value can be adjusted as per requirement

            // Check if Bottom2 Text field is empty
            if (empty($this->input->post('bottom2'))) {
                $bottom2Text = $defaultBottom2Text;
            } else {
                $bottom2Text = $this->input->post('bottom2');
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
                $this->edit($bottom2Id);
            } else {
                // Update bottom2 data
                $bottom2Info = array(
                    'status' => $this->input->post('status'),
                    'tanggal' => $tanggal, // Update value of Bottom2 Text field
                    'nama' => $nama, // Update value of Bottom2 Text field
                    'mars' => $mars, // Update value of Bottom2 Text field
                    'bom' => $bom, // Update value of Bottom2 Text field
                    'qty' => $qty, // Update value of Bottom2 Text field
                    'mesin' => $mesin, // Update value of Bottom2 Text field
                    'wo' => $wo, // Update value of Bottom2 Text field
                    'io' => $io // Update value of Bottom2 Text field
                );

                $result = $this->bm->editBottom2($bottom2Info, $bottom2Id);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Bottom2 updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Bottom2 updation failed');
                }

                redirect('bottom2/bottom2Listing');
            }
        }
    }

    /**
     * This function is used to delete the bottom2
     */
    public function deleteBottom2($bottom2_id)
    {
        // Call model to delete bottom2 data
        $this->load->model('Bottom2_model');
        $result = $this->Bottom2_model->deleteBottom2($bottom2_id);

        if ($result) {
            $this->session->set_flashdata('success', 'Bottom2 deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete bottom2.');
        }

        // Redirect back to bottom2 listing page
        redirect('bottom2/bottom2Listing');
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