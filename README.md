# Requirement

Install mailchimp-api on your server using composer

`composer require drewm/mailchimp-api`

# Send emails using Mailchimp APIs

1. Create an audience group if you do not have

   or Find an audience group id if you have

2. Add members to the audience group

3. Create a Campaign for the audience group

4. Add contents(body) you want to put

5. Send email by calling campaign

- Reference : mailchimp.php

# Get webhooks from Mailchimp

webhooks : a notification from Mailchimp APIs once something you set up is changed.

1. Create your webhooks on your audience setting

2. Establish your source to update your data once your server gets webhooks

- Reference : mailchimp_webhooks.php
