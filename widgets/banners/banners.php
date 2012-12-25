<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Widget_Banners extends Widgets
{
    // The widget title,  this is displayed in the admin interface
    public $title = 'Banners';
 
    //The widget description, this is also displayed in the admin interface.  Keep it brief.
    public $description = array(
    		'en' => 'Display banners in your webpage.',
    		'zh' => '在網頁中顯示不同形式的廣告看板。'
    );
    // The author's name
    public $author = 'Jack Sun';
 
    // The authors website for the widget
    public $website = 'http://www.omatic.com.tw/';
 
    //current version of your widget
    public $version = '1.0';
 
    /**
     * $fields array fore storing widget options in the database.
     * values submited through the widget instance form are serialized and
     * stored in the database.
     */
    public $fields = array(
        array(
			'field' => 'html',
			'label' => 'HTML',
			'rules' => 'required'
        )
    );
 
    /**
     * the $options param is passed by the core Widget class.  If you have
     * stored options in the database,  you must pass the paramater to access
     * them.
     */
    public function run($options)
    {
		if (empty($options['html']))
		{
			return array('output' => '');
		}

		// Store the feed items
		return array('output' => $this->parser->parse_string($options['html'], NULL, TRUE));
    }
 
    /**
     * form() is used to prepare/pass data to the widget admin form
     * data returned from this method will be available to views/form.php
     */
    /* public function form()
    {
        $stuff = $this->db->get_stuff();
        return array('stuff' => $stuff);
    } */
 
    /**
     * save() is used to alter submited data before their insertion in database
     */
    /* public function save($options)
    {
       if(isset($options['foo']) && !isset($options['bar'])) {
           $options['bar'] = $options['foo'];
       }
       return $options;
    } */
}