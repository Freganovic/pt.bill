<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Project4 (Project4Controller)
 * Project4 Class to control project4 related operations.
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Project4 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project4_model', 'pm'); // Ubah nama model menjadi Project4_model
        $this->isLoggedIn();
        $this->module = 'Project4'; // Ubah modul menjadi Project4
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('project4/project4Listing'); // Ubah redirect ke project4
    }

    /**
     * This function is used to load the project4 list
     */
    function project4Listing()
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

            $count = $this->pm->project4ListingCount($searchText); // Ubah ke project4ListingCount

            $returns = $this->paginationCompress("project4Listing/", $count, 10); // Ubah ke project4Listing

            $data['records'] = $this->pm->project4Listing($searchText, $returns["page"], $returns["segment"]); // Ubah ke project4Listing

            $this->global['pageTitle'] = 'CodeInsect : Project4'; // Ubah ke Project4

            $this->loadViews("project4/project4", $this->global, $data, NULL); // Ubah ke project4
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Project4'; // Ubah ke Project4

            $this->loadViews("project4/add", $this->global, NULL, NULL); // Ubah ke project4
        }
    }

    /**
     * This function is used to add new project4 to the system
     */
    function addNewProject4()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('project4Title', 'Project4 Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {
                $project4Title = $this->security->xss_clean($this->input->post('project4Title'));
                $description = $this->security->xss_clean($this->input->post('description'));

                $project4Info = array('project4Title' => $project4Title, 'description' => $description, 'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s'));

                $result = $this->pm->addNewProject4($project4Info); // Ubah ke addNewProject4

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Project4 created successfully'); // Ubah ke Project4
                } else {
                    $this->session->set_flashdata('error', 'Project4 creation failed'); // Ubah ke Project4
                }

                redirect('project4/project4Listing'); // Ubah ke project4Listing
            }
        }
    }

    /**
     * This function is used load project4 edit information
     * @param number $project4Id : Optional : This is project4 id
     */
    function edit($project4Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($project4Id == null) {
                redirect('project4/project4Listing');
            }

            $data['project4Info'] = $this->pm->getProject4Info($project4Id); // Ubah ke getProject4Info

            $this->global['pageTitle'] = 'CodeInsect : Edit Project4'; // Ubah ke Project4

            $this->loadViews("project4/edit", $this->global, $data, NULL); // Ubah ke project4
        }
    }

    /**
     * This function is used to edit the project4 information
     */
    function editProject4()
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $project4Id = $this->input->post('project4Id');

            $this->form_validation->set_rules('project4Title', 'Project4 Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->edit($project4Id);
            } else {
                $project4Title = $this->security->xss_clean($this->input->post('project4Title'));
                $description = $this->security->xss_clean($this->input->post('description'));

                $project4Info = array('project4Title' => $project4Title, 'description' => $description, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->pm->editProject4($project4Info, $project4Id); // Ubah ke editProject4

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Project4 updated successfully'); // Ubah ke Project4
                } else {
                    $this->session->set_flashdata('error', 'Project4 updation failed'); // Ubah ke Project4
                }

                redirect('project4/project4Listing'); // Ubah ke project4Listing
            }
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}

?>