<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Existing (ExistingController)
 * Existing Class to control existing related operations.
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Existing extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Existing_model', 'em');
        $this->isLoggedIn();
        $this->module = 'Existing';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('existing/existingListing');
    }

    /**
     * This function is used to load the existing list
     */
    function existingListing()
    {
        if (!$this->hasListAccess()) {
            $this->loadThis();
        } else {
            $searchText = '';
            if (!empty($this->input->post('searchText'))) {
                $searchText = $this->security->xss_clean($this->input->post('searchText'));
            }
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->em->existingListingCount($searchText);

            $returns = $this->paginationCompress("existingListing/", $count, 10);

            $data['records'] = $this->em->existingListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'CodeInsect : Existing';

            $this->loadViews("existing/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'CodeInsect : Add New Existing';

            $this->loadViews("existing/add", $this->global, NULL, NULL);
        }
    }

    /**
     * This function is used to add new existing to the system
     */
    function addNewExisting()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('existingTitle', 'Existing Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {
                $existingTitle = $this->security->xss_clean($this->input->post('existingTitle'));
                $description = $this->security->xss_clean($this->input->post('description'));

                $existingInfo = array('existingTitle' => $existingTitle, 'description' => $description, 'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s'));

                $result = $this->em->addNewExisting($existingInfo);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Existing created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Existing creation failed');
                }

                redirect('existing/existingListing');
            }
        }
    }


    /**
     * This function is used load existing edit information
     * @param number $existingId : Optional : This is existing id
     */
    function edit($existingId = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($existingId == null) {
                redirect('existing/existingListing');
            }

            $data['existingInfo'] = $this->em->getExistingInfo($existingId);

            $this->global['pageTitle'] = 'CodeInsect : Edit Existing';

            $this->loadViews("existing/edit", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to edit the existing information
     */
    function editExisting()
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $existingId = $this->input->post('existingId');

            $this->form_validation->set_rules('existingTitle', 'Existing Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->edit($existingId);
            } else {
                $existingTitle = $this->security->xss_clean($this->input->post('existingTitle'));
                $description = $this->security->xss_clean($this->input->post('description'));

                $existingInfo = array('existingTitle' => $existingTitle, 'description' => $description, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->em->editExisting($existingInfo, $existingId);

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Existing updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Existing updation failed');
                }

                redirect('existing/existingListing');
            }
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}

?>