# Mailchimp API Integration

Integrating Mailchimp APIs to send emails and handle webhooks using PHP

## Requirements

- PHP 7.0 or higher
- Mailchimp API Key
- Mailchimp Audience Group ID

## Installation

Install mailchimp-api on your server using composer:

```bash
composer require drewm/mailchimp-api
```

## Send Emails Using Mailchimp APIs

### Step 1: Create or Find an Audience Group
Create an audience group if you don't have one, or find an existing audience group ID.

### Step 2: Add Members to the Audience Group
```php
add_mailchimp_contact($params)
```
Required parameters:
- `email_address`
- `status`
- `merge_fields['FNAME', 'LNAME']`
- `mailchimp_group_id`
- `mailchimp_api_key`

### Step 3: Create a Campaign
```php
create_campaign($params)
```
Required parameters:
- `type`
- `recipients['list_id']`
- `settings['subject_line', 'title', 'from_name', 'reply_to', 'preview_text']`

### Step 4: Add Content to the Campaign
```php
set_content($params)
```
Required parameters:
- `campaign_id`
- `html` (your email template)

### Step 5: Send the Campaign
```php
send_campaign($params)
```
Required parameters:
- `campaign_id`

**Reference:** `mailchimp.php`

## Get Webhooks from Mailchimp

Webhooks are notifications from Mailchimp APIs when something you set up is changed.

### Step 1: Create Webhooks
Create your webhooks in your Mailchimp audience settings.

### Step 2: Set Up Webhook Handler
Establish your source to update your data once your server receives webhooks.

**Reference:** `mailchimp_webhooks.php`

### Webhook Events

The webhook handler processes the following events:

**Subscribe Event:**
- Triggered when a user subscribes
- Inserts subscriber data into database

**Unsubscribe Event:**
- Triggered when a user unsubscribes
- Updates subscriber status in database

### Database Configuration

Update database connection in `mailchimp_webhooks.php`:

```php
$db = new mysqli("yourhost", "id", "pw", "db name");
```

## Available Methods

### Get Audience List
```php
get_mailchimp_list($params)
```
Returns array of member IDs from the specified audience group.

### Add Contact
```php
add_mailchimp_contact($params)
```
Adds a new member to the audience group.

### Delete Contacts
```php
delete_mailchimp_list($params)
```
Removes members from the audience group.

### Create Campaign
```php
create_campaign($params)
```
Creates a new email campaign.

### Set Campaign Content
```php
set_content($params)
```
Adds HTML content to a campaign.

### Send Campaign
```php
send_campaign($params)
```
Sends the campaign to subscribers.

## Files

- `mailchimp.php` - Main API integration class
- `mailchimp_webhooks.php` - Webhook handler for subscribe/unsubscribe events
