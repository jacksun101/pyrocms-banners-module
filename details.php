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
                'en' => 'Manage banners on your site.',
            	'zh' => '管理網站中的廣告看板。'
            ),
            'frontend' => false,
            'backend' => true,
            'menu' => 'content',
            'shortcuts' => array(
                'create' => array(
                    'name' => 'banner:new',
                    'uri' => 'admin/banners/create',
                    'class' => 'add'
                )
            )
        );
    }

    public function install()
    {
        // We're using the streams API to
        // do data setup.
        $this->load->driver('Streams');

        $this->load->language('banner/banners');

        // Add banners streams
        if ( ! $this->streams->streams->add_stream(lang('banner:banners'), 'banners', 'banner', 'banner_', null)) return false;

        // Add some fields
        $fields = array(
            array(
                'name' => 'Title',
                'slug' => 'title',
                'namespace' => 'banner',
                'type' => 'text',
                'extra' => array('max_length' => 200),
                'assign' => 'banners',
                'title_column' => true,
                'required' => true,
                'unique' => true
            ),
            array(
                'name' => 'Description',
                'slug' => 'description',
                'namespace' => 'banner',
                'type' => 'textarea',
                'assign' => 'banners',
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