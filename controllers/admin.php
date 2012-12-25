<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Banners Module
 *
 * This is a banners module for PyroCMS.
 *
 * @author 		Jack Sun - O-Matic Digital Studio
 * @website		http://www.omatic.com.tw
 * @package 	PyroCMS
 * @subpackage 	Banners Module
 */
class Admin extends Admin_Controller
{
	protected $section = 'banners';

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('banners');
        $this->lang->load('groups');

        $this->load->driver('Streams');
    }

    // --------------------------------------------------------------------------

    /**
     * List all banners
     *
     * @access	public
     * @return	void
     */
    public function index()
    {    	
    	$extra['title'] = lang('banner:list');
    	$extra['columns'] = array('group', 'status', 'title', 'url','start_date', 'end_date', 'image_file');    	
    	$extra['sorting'] = true;
    	$extra['buttons'] = array(
    			array(
    					'label'     => lang('global:edit'),
    					'url'       => 'admin/banners/edit/-entry_id-'
    			),
    			array(
    					'label'     => lang('global:delete'),
    					'url'       => 'admin/banners/delete/-entry_id-',
    					'confirm'   => true
    			)
    	);
    	
    	$this->streams->cp->entries_table('banners', 'banner', 15, 'admin/banners/index', true, $extra);    	
    }

    // --------------------------------------------------------------------------

    /**
     * Create a new entry
     *
     * @access	public
     * @return	void
     */
    public function create()
    {
        $this->template->title(lang('banner:new'));

        $extra = array(
            'return' => 'admin/banners',
            'success_message' => lang('banner:submit_success'),
            'failure_message' => lang('banner:submit_failure'),
            'title' => lang('banner:new')
        );

        $this->streams->cp->entry_form('banners', 'banner', 'new', null, true, $extra);
    }

    // --------------------------------------------------------------------------
    
    /**
     * Edit an entry
     *
     * @access	public
     * @return	void
     */
    public function edit($id = 0)
    {
        $this->template->title(lang('banner:edit'));

        $extra = array(
            'return' => 'admin/banners',
            'success_message' => lang('banner:submit_success'),
            'failure_message' => lang('banner:submit_failure'),
            'title' => lang('banner:edit')
        );

        $this->streams->cp->entry_form('banners', 'banner', 'edit', $id, true, $extra);
    }

    // --------------------------------------------------------------------------

    /**
     * Delete an entry
     * 
     * @access  public
     * @param   int $id The id of banner to be deleted
     * @return  void
     * @todo    This function does not currently hava any error checking.
     */
    public function delete($id = 0)
    {
        $this->streams->entries->delete_entry($id, 'banners', 'banner');
        $this->session->set_flashdata('error', lang('banner:deleted'));
        redirect('admin/banners/');
    }

}
/* End of file admin.php */
