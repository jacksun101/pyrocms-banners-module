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
			'field' => 'group',
			'label' => 'Group',
			'rules' => 'required'
        ),
        array(
			'field' => 'column',
			'label' => 'Column',
			'rules' => 'required'
        ),
        array(
			'field' => 'delay',
			'label' => 'Delay',
			'rules' => 'numeric|required'
        ),
        array(
			'field' => 'arrow',
			'label' => 'Arrow',
			'rules' => 'required'
        ),
        array(
			'field' => 'width',
			'label' => 'Width',
			'rules' => 'numeric|required'
        ),
        array(
			'field' => 'height',
			'label' => 'Height',
			'rules' => 'numeric|required'
        )
    );
    
	/**	
	 * Constructor method
	 */	
	public function __construct()	
	{
		// Load the navigation model from the navigation module.	
		//$this->load->model('banners/banners_m');
        $this->load->driver('Streams');
	}
 
    /**
     * the $options param is passed by the core Widget class.  If you have
     * stored options in the database,  you must pass the paramater to access
     * them.
     */
    public function run($options)
    {
    	$params = array(
    				'stream'	=> 'banners',
    				'namespace'	=> 'banner',
    				'order_by'	=> 'ordering_count',
    				'sort'		=> 'asc',
    				'where'		=> array(
    						'`group` = ' . $options['group'],
    						'`status` = 1', 
    						'`start_date` < ' . time(), 
    						'`end_date` > ' . time()
    				)
    			);
    	
        $entries = $this->streams->entries->get_entries($params);
        
        
        //TODO need use cache
        
		/* if (empty($options['html']))
		{
			return array('output' => '');
		}

		// Store the feed items
		return array('output' => $this->parser->parse_string($options['html'], NULL, TRUE)); */
        
        //var_dump($options); 
        //var_dump($entries['entries']); exit;
        
        return array( 
        		'banners'	=> $entries['entries'],
        		'id'		=> $options['widget']['instance_id'],
        		'options'	=> $options,
        );
    }
 
    /**
     * form() is used to prepare/pass data to the widget admin form
     * data returned from this method will be available to views/form.php
     */
    public function form()
    {
    	$params = array(
    				'stream'	=> 'groups',
    				'namespace'	=> 'banner',
    				'order_by'	=> 'id',
    				'sort'		=> 'asc'
    			);
    	
        $entries = $this->streams->entries->get_entries($params);
        
        $groups = array();
        
        foreach ($entries['entries'] as $entry) 
        {
        	$groups[$entry['id']] = $entry['group_title'];
        }
        
        return array('groups' => $groups);
    }
 
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