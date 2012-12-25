<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Banners extends Module
{

    public $version = '1.0';

    public function info()
    {
        return array(
            'name' => array(
                'en' => 'Banners',
            	'zh' => '廣告看板'
            ),
            'description' => array(
                'en' => 'Manage different banners on your site.',
            	'zh' => '管理網站中各式各樣的廣告看板。'
            ),
            'frontend' => false,
            'backend' => true,
            'menu' => 'content',
            /* 'shortcuts' => array(
                'create' => array(
                    'name' => 'banner:new',
                    'uri' => 'admin/banners/create',
                    'class' => 'add'
                )
            ), */
        		'sections' => array(
        				'banners' => array(
        						'name' => 'banner:banners',
        						'uri' => 'admin/banners',
        						'shortcuts' => array(
        								array(
        										'name' => 'banner:new',
        										'uri' => 'admin/banners/create',
        										'class' => 'add'
        								),
        						),
        				),
        				'groups' => array(
        						'name' => 'group:groups',
        						'uri' => 'admin/banners/groups',
        						'shortcuts' => array(
        								array(
        										'name' => 'group:new',
        										'uri' => 'admin/banners/groups/create',
        										'class' => 'add'
        								)
        						)
        				)
        		)
        );
    }

    public function install()
    {
        // We're using the streams API to
        // do data setup.
        $this->load->driver('Streams');

        $this->load->language('banners/banners');
        $this->load->language('banners/groups');

        // Add banners streams
        if ( ! $this->streams->streams->add_stream(lang('banner:banners'), 'banners', 'banner', 'banner_', null)) return false;
        
        // Add groups streams
        if ( ! $this->streams->streams->add_stream(lang('group:groups'), 'groups', 'banner', 'banner_', null)) return false;

        // Add some fields
        $fields = array(
        	// For banners stream
            array(
                'name' => 'Group',
                'slug' => 'group',
                'namespace' => 'banner',
                'assign' => 'banners',
                'type' => 'relationship',
                'extra' => array(
					'choose_stream'	=> $this->streams->streams->get_stream('groups', 'banner')->id
                ),
                'required' => true
            ),
            array(
                'name' => 'Status',
                'slug' => 'status',
                'namespace' => 'banner',
                'assign' => 'banners',
                'type' => 'choice',
                'extra' => array(
					'max_length' 	=> 1,
					'default_value' => '0',
					'choice_type'	=> 'dropdown',
					'choice_data'	=> "0 : lang:banner:draft\n1 : lang:banner:live"
                ),
                'required' => true
            ),
            array(
                'name' => 'Title',
                'slug' => 'title',
                'namespace' => 'banner',
                'assign' => 'banners',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Description',
                'slug' => 'description',
                'namespace' => 'banner',
                'assign' => 'banners',
                'type' => 'textarea',
                'required' => false
            ),
            array(
                'name' => 'URL',
                'slug' => 'url',
                'namespace' => 'banner',
                'assign' => 'banners',
                'type' => 'url',
                'required' => true
            ),
	        array(
	            'name' => 'Start Date',
	            'slug' => 'start_date',
	            'namespace' => 'banner',
	            'type' => 'datetime',
	            'assign' => 'banners',
	            // error occurred without input_type when create new banner, don't know why.
	            'extra' => array('use_time' => 'yes', 'input_type' => 'datepicker'),	
	            'required' => true,
	            'unique' => false
	        ),
	        array(
	            'name' => 'End Date',
	            'slug' => 'end_date',
	            'namespace' => 'banner',
	            'type' => 'datetime',
	            'assign' => 'banners',
	            'extra' => array('use_time' => 'yes', 'input_type' => 'datepicker'),
	            'required' => true,
	            'unique' => false
	        ),
            array(
                'name' => 'Image file',
                'slug' => 'image_file',
                'namespace' => 'banner',
                'assign' => 'banners',
                'type' => 'image',
                'extra' => array('folder' => 3, 'allowed_types' => 'jpg|gif|png'),
                'required' => true
            ),
            
            // For groups stream
            array(
                'name' => 'Title',
                'slug' => 'group_title',
                'namespace' => 'banner',
                'assign' => 'groups',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Slug',
                'slug' => 'group_slug',
                'namespace' => 'banner',
                'assign' => 'groups',
                'type' => 'slug',
                'extra' => array('space_type' => '-', 'slug_field' => 'group_title'),
                'required' => true
            )
        );
        		
        $this->streams->fields->add_fields($fields);

        return true;
    }

    public function uninstall()
    {
        $this->load->driver('Streams');

        $this->streams->utilities->remove_namespace('banner');

        return true;
    }

    public function upgrade($old_version)
    {
        // Your Upgrade Logic
        return true;
    }

    public function help()
    {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}