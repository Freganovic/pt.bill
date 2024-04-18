<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Project3 (Project3Controller)
 * Project3 Class to control project3 related operations.
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Project3 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project3_model', 'pm'); // Ubah nama model menjadi Project3_model
        $this->isLoggedIn();
        $this->module = 'Project3'; // Ubah modul menjadi Project3
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('project3/project3Listing'); // Ubah redirect ke project3
    }

    /**
     * This function is used to load the project3 list
     */
    function project3Listing()
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

            $count = $this->pm->project3ListingCount($searchText); // Ubah ke project3ListingCount

            $returns = $this->paginationCompress("project3Listing/", $count, 10); // Ubah ke project3Listing

            $data['records'] = $this->pm->project3Listing($searchText, $returns["page"], $returns["segment"]); // Ubah ke project3Listing

            $this->global['pageTitle'] = 'CodeInsect : Project3'; // Ubah ke Project3

            $this->loadViews("project3/project3", $this->global, $data, NULL); // Ubah ke project3
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Project3'; // Ubah ke Project3

            $this->loadViews("project3/add", $this->global, NULL, NULL); // Ubah ke project3
        }
    }

    /**
     * This function is used to add new project3 to the system
     */
    function addNewProject3()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('project3Title', 'Project3 Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {
                $project3Title = $this->security->xss_clean($this->input->post('project3Title'));
                $description = $this->security->xss_clean($this->input->post('description'));

                $project3Info = array('project3Title' => $project3Title, 'description' => $description, 'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s'));

                $result = $this->pm->addNewProject3($project3Info); // Ubah ke addNewProject3

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Project3 created successfully'); // Ubah ke Project3
                } else {
                    $this->session->set_flashdata('error', 'Project3 creation failed'); // Ubah ke Project3
                }

                redirect('project3/project3Listing'); // Ubah ke project3Listing
            }
        }
    }

    /**
     * This function is used load project3 edit information
     * @param number $project3Id : Optional : This is project3 id
     */
    function edit($project3Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($project3Id == null) {
                redirect('project3/project3Listing');
            }

            $data['project3Info'] = $this->pm->getProject3Info($project3Id); // Ubah ke getProject3Info

            $this->global['pageTitle'] = 'CodeInsect : Edit Project3'; // Ubah ke Project3

            $this->loadViews("project3/edit", $this->global, $data, NULL); // Ubah ke project3
        }
    }

    /**
     * This function is used to edit the project3 information
     */
    function editProject3()
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $project3Id = $this->input->post('project3Id');

            $this->form_validation->set_rules('project3Title', 'Project3 Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->edit($project3Id);
            } else {
                $project3Title = $this->security->xss_clean($this->input->post('project3Title'));
                $description = $this->security->xss_clean($this->input->post('description'));

                $project3Info = array('project3Title' => $project3Title, 'description' => $description, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->pm->editProject3($project3Info, $project3Id); // Ubah ke editProject3

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Project3 updated successfully'); // Ubah ke Project3
                } else {
                    $this->session->set_flashdata('error', 'Project3 updation failed'); // Ubah ke Project3
                }

                redirect('project3/project3Listing'); // Ubah ke project3Listing
            }
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}

?>