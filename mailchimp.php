<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', '1');
defined('BASEPATH') OR exit('No direct script access allowed');

class mailchimp_email extends REST_Controller{

    public function __construct() {
        parent::__construct();
		$this->mail_chimp_url = "https://us16.api.mailchimp.com/3.0";
		$this->mail_api_key = "myApiKey-us16";
		$this->test_audience_group_id = "test12345678";
    }


	//Get the audiences from the group
	//parameters = mailchimp_group_id, mailchimp_api_key
	public function get_mailchimp_list($params){   

        $result = json_decode($this->call("GET",MAILCHIMP_API_URL.'lists/'.$params['mailchimp_group_id'].'/members',$params),true);

        $member_list = array();

        foreach ($result['members'] as $member) {

            $member_list[] = $member['id'];

        }
        return $member_list;
    }


    // Add member into the audience group you want to add
    // Request data: email_address, status, merges_fields['FNAME','LNAME'], mailchimp_group_id, mailchimp_api_key
    public function add_mailchimp_contact($params){ //

        $result = $this->call("POST",MAILCHIMP_API_URL.'lists/'.$params['mailchimp_group_id'].'/members/',$params);

        return $result;
	}
	

	//Delete an audience from the group
	//parameters = member_list you want to delete, mailchimp_group_id, mailchimp_api_key
	public function delete_mailchimp_list($params){ 

        foreach ($params['member_list'] as $item){

            $this->call("DELETE",MAILCHIMP_API_URL.'lists/'.$params['mailchimp_group_id'].'/members/'.$item, $params);

        }

        return true;
    }


    // Create campaigns for the audience group id
    // parameters = type, recipients['list_id'], setting['subject_line','title', 'from_name', 'reply_to', 'preview_text'] 
    public function create_campaign($params){

        $result = json_decode($this->call("POST",MAILCHIMP_API_URL.'campaigns/',$params),true);

        return $result;

    }


    // Add content in the campaign
    // parameters = campaign_id, html(if you have your own html template)
    public function set_content($params){

        $result = json_decode($this->call("PUT",MAILCHIMP_API_URL.'campaigns/'. $params['campaign_id'] . '/content/',$params),true);

        return $result;
    }


	// Send email about the campaign
	// parameters = campaign_id
    public function send_campaign($params){

        $result = json_decode($this->call("POST",MAILCHIMP_API_URL.'campaigns/'. $params['campaign_id'] . '/actions/send/',$params),true);

        return $result;
    }


}