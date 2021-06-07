<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', '1');

// download the file
include('../vendor/drewm/mailchimp-api/src/MailChimp.php');
include('../vendor/drewm/mailchimp-api/src/Webhook.php');

//mailchimp will send data by post method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$event_type     = $_POST['type'];
    $data           = $_POST['data'];

    $list_id        = $data['list_id'];
    $merges         = $_POST['data']['merges'];
    $email          = $merges['EMAIL'];
    $user_firstname = $merges['FNAME'];
    $user_lastname  = $merges['PHONE'];
    $user_phone     = $merges['PHONE'];
    $items          = $merges['ITMES'];

    switch ($event_type) :

		// If subscriber is added, 
        case 'subscribe':
            $db = new mysqli("yourhost", "id", "pw", "db name");
            $sql = "INSERT mailchimp_webhooks (sub_status, created_date, email) VALUES ('Y', NOW(), '" . $email . "','" . $user_firstname  ."')";
            $db->set_charset("utf8");
            $db->query($sql);
            break;
			
		// If subscriber is unsubscribed,
		case 'unsubscribe':
            $db = new mysqli("yourhost", "id", "pw", "db name");
            $sql = "UPDATE mailchimp_webhooks set sub_status='N', updated_date = NOW() where email = '" . $email ."'";
            $db->set_charset("utf8");
            $db->query($sql);
            break;
    endswitch;
}

?>
