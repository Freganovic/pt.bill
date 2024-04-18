<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Project1 (Project1Controller)
 * Project1 Class to control project1 related operations.
 * @author : Kishor Mali
 * @version : 1.5
 * @since : 19 Jun 2022
 */
class Project1 extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project1_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'Project1';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        // Redirect ke fungsi project1Listing()
        redirect('project1/project1Listing');
    }

    /**
     * This function is used to load the project1 list
     */
    function project1Listing()
    {
        // Mengatur judul halaman
        $this->global['pageTitle'] = 'CodeInsect : Project1';

        // Memuat view halaman project1
        $this->loadViews("project1/project1", $this->global, NULL, NULL);
    }


    /**
     * This function is used to load the add new form
     */
    function add()
    {
        if (!$this->hasCreateAccess()) {
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'CodeInsect : Add New Project1';

            $this->loadViews("project1/add", $this->global, NULL, NULL);
        }
    }

    public function html_clean($s, $v)
    {
        return strip_tags((string) $s);
    }
}

?>