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
class Admin_Groups extends Admin_Controller
{
	protected $section = 'groups';

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('banners');
        $this->lang->load('groups');

        $this->load->driver('Streams');
    }

    // --------------------------------------------------------------------------

    /**
     * List all groups
     *
     * @access	public
     * @return	void
     */
    public function index()
    {    	
    	$extra['title'] = lang('group:list');
    	$extra['columns'] = array('group_title', 'group_slug');
    	$extra['sorting'] = false;
    	$extra['buttons'] = array(
    			array(
    					'label'     => lang('global:edit'),
    					'url'       => 'admin/banners/groups/edit/-entry_id-'
    			),
    			array(
    					'label'     => lang('global:delete'),
    					'url'       => 'admin/banners/groups/delete/-entry_id-',
    					'confirm'   => true
    			)
    	);
    	
    	$this->streams->cp->entries_table('groups', 'banner', 15, 'admin/banners/groups/index', true, $extra);    	
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
        $this->template->title(lang('group:new'));

        $extra = array(
            'return' => 'admin/banners/groups/',
            'success_message' => lang('group:submit_success'),
            'failure_message' => lang('group:submit_failure'),
            'title' => lang('group:new')
        );

        $this->streams->cp->entry_form('groups', 'banner', 'new', null, true, $extra);
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
        $this->template->title(lang('group:edit'));

        $extra = array(
            'return' => 'admin/banners/groups',
            'success_message' => lang('group:submit_success'),
            'failure_message' => lang('group:submit_failure'),
            'title' => lang('group:edit')
        );

        $this->streams->cp->entry_form('groups', 'banner', 'edit', $id, true, $extra);
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
        $this->streams->entries->delete_entry($id, 'groups', 'banner');
        $this->session->set_flashdata('error', lang('group:deleted'));
        redirect('admin/banners/groups/');
    }

}
/* End of file admin.php */
