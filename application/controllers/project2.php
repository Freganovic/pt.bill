<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Project2 (Project2Controller)
 * Project2 Class to control project2 related operations.
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Project2 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project2_model', 'pm'); // Ganti nama model menjadi Project2_model
        $this->isLoggedIn();
        $this->module = 'Project2'; // Ganti modul menjadi Project2
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('project2/project2Listing'); // Ubah redirect ke project2
    }

    /**
     * This function is used to load the project2 list
     */
    function project2Listing()
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

            $count = $this->pm->project2ListingCount($searchText); // Ganti ke project2ListingCount

            $returns = $this->paginationCompress("project2Listing/", $count, 10); // Ubah ke project2Listing

            $data['records'] = $this->pm->project2Listing($searchText, $returns["page"], $returns["segment"]); // Ganti ke project2Listing

            $this->global['pageTitle'] = 'CodeInsect : Project2'; // Ganti ke Project2

            $this->loadViews("project2/project2", $this->global, $data, NULL); // Ubah ke project2
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
            $this->global['pageTitle'] = 'CodeInsect : Add New Project2'; // Ubah ke Project2

            $this->loadViews("project2/add", $this->global, NULL, NULL); // Ubah ke project2
        }
    }

    /**
     * This function is used to add new project2 to the system
     */
    function addNewProject2()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('project2Title', 'Project2 Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->add();
            } else {
                $project2Title = $this->security->xss_clean($this->input->post('project2Title'));
                $description = $this->security->xss_clean($this->input->post('description'));

                $project2Info = array('project2Title' => $project2Title, 'description' => $description, 'createdBy' => $this->vendorId, 'createdDtm' => date('Y-m-d H:i:s'));

                $result = $this->pm->addNewProject2($project2Info); // Ganti ke addNewProject2

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Project2 created successfully'); // Ganti ke Project2
                } else {
                    $this->session->set_flashdata('error', 'Project2 creation failed'); // Ganti ke Project2
                }

                redirect('project2/project2Listing'); // Ganti ke project2Listing
            }
        }
    }

    /**
     * This function is used load project2 edit information
     * @param number $project2Id : Optional : This is project2 id
     */
    function edit($project2Id = NULL)
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            if ($project2Id == null) {
                redirect('project2/project2Listing');
            }

            $data['project2Info'] = $this->pm->getProject2Info($project2Id); // Ganti ke getProject2Info

            $this->global['pageTitle'] = 'CodeInsect : Edit Project2'; // Ganti ke Project2

            $this->loadViews("project2/edit", $this->global, $data, NULL); // Ganti ke project2
        }
    }

    /**
     * This function is used to edit the project2 information
     */
    function editProject2()
    {
        if (!$this->hasUpdateAccess()) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $project2Id = $this->input->post('project2Id');

            $this->form_validation->set_rules('project2Title', 'Project2 Title', 'trim|callback_html_clean|required|max_length[256]');
            $this->form_validation->set_rules('description', 'Description', 'trim|callback_html_clean|required|max_length[1024]');

            if ($this->form_validation->run() == FALSE) {
                $this->edit($project2Id);
            } else {
                $project2Title = $this->security->xss_clean($this->input->post('project2Title'));
                $description = $this->security->xss_clean($this->input->post('description'));

                $project2Info = array('project2Title' => $project2Title, 'description' => $description, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:s'));

                $result = $this->pm->editProject2($project2Info, $project2Id); // Ganti ke editProject2

                if ($result == true) {
                    $this->session->set_flashdata('success', 'Project2 updated successfully'); // Ganti ke Project2
                } else {
                    $this->session->set_flashdata('error', 'Project2 updation failed'); // Ganti ke Project2
                }

                redirect('project2/project2Listing'); // Ganti ke project2Listing
            }
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}

?>