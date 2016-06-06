<?php
  
  /*
	Plugin Name: Form Up Delta
	Description: Forms but not shitty
	Version: 0.1
	Author: Jordan Cauley
	License: GPL2
	*/
  
  class Form_Up_Delta {
    
    public function __construct(){
      
      add_action('init', array($this, 'form_up_add_origin_header'));
      add_action('init', array($this, 'form_up_forms'));
      
      add_action( 'rest_api_init', array($this, 'form_up_routes'));
      
    }
    
    function form_up_add_origin_header(){
      
      header("Access-Control-Allow-Origin: *");
      
    }
    
    function form_up_forms(){
      
      register_post_type('form_up_forms', array(
					'label'	=> 'Forms',
					'labels' => array(
						'name' => 'Forms',
						'singular_name' => 'Form',
						'not_found'	=> 'No Forms found',
						'add_new'	=> 'Add New Form',
						'add_new_item' => 'Add New Form',
						'edit_item'	=> 'Edit Form',
						'new_item' => 'New Form',
						'view_item'	=> 'View Form'
					),
					'public' => true,
					'has_archive'	=> true,
					'show_ui'	=> true,
					'show_in_rest' => true,
					'exclude_from_search'	=> false,
					'supports' => array('title', 'editor'),
				)
			);
			
    }
    
    function form_up_post( WP_REST_Request $request ){
      
      $form_id = $request->get_param( 'id' );
      
      return array(
        'form_id' => $form_id,
        'post_data' => $_POST
      );
      
    }
    
    function form_up_routes(){
      
      register_rest_route( 'form-up/v1', '/post/(?P<id>\d+)', array(
				'methods' => 'POST',
				'callback' => array( $this, 'form_up_post'),
			) );
      
    }

    
    
  }
  
  new Form_Up_Delta();
