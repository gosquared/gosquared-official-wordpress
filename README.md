# gosquared-official-wordpress-plugin
[![Build Status](https://travis-ci.org/gosquared/gosquared-official-wordpress.svg?branch=master)](https://travis-ci.org/gosquared/gosquared-official-wordpress.svg?branch=master)

# The GoSquared Official Wordpress plugin.

GoSquared is an all-in-one growth platform for your WordPress website.

Convert visitors into leads, close more sales, run nurture campaigns and measure your business' growth.

The GoSquared platform includes Website Analytics, Live Chat, Marketing Automation and CRM.

Discover what's happening on your WordPress site with GoSquared Analytics.
  - Get a simple but powerful overview of your website traffic, in real-time.
  - Understand each visitor's behaviour from the moment they land on your website. Quickly identify data such as:
    - What is your best performing content?
    - Which sites/campaigns are driving people to your website?
    - How engaged are your website visitors?

Capture more leads and start conversations with GoSquared Assistant.
  - Use intelligent prompts to deliver proactive messages to your visitors at the perfect time.
  - Use live chat to engage with visitors in the moment.
  - Gather feedback from website visitors that you'd never otherwise see.
  - Intelligently nudge visitors to specific pages based on their behaviour and activity.
  - Provide customer support with your team from a centralised Inbox.

Convert and nurture customers with GoSquared Automation.
  - Use email and in-app messages to build onboarding.
  - Automate messages and follow up based on each user's behaviour.
  - Engage with leads in-product, rather than via cold email or over the phone.
  - Drive upsells at the perfect time.
  - Provide relevant customer support.
  - Engage with customers to drive loyalty.
  - Connect your Gravity Forms to collect powerful lead analytics for every prospect.

Personalise your customer's experience and increase sales with GoSquared Customer Data Hub.
  - Find the actions people are taking in your app. Track every event triggered by every user, in real-time.
  - Segment users easily, save and build groups such as "Latest Signups", "New Customers", or "Users likely to Churn".
  - View a unified profile - single customer view, combining activity across all devices, and information from external tools.

# Installation

1. If you don't have one already, [sign up](http://www.gosquared.com/join/wordpress) for a GoSquared account.
2. Upload this plugin to Wordpress through the 'Plugins' tab in your Wordpress admin dashboard and activate it.
3. Add your GoSquared Project Token to the 'Project Token' field in the GoSquared section of your Wordpress settings.
4. If you would like to track the website behaviour of your logged in users, make sure the 'Enable user tracking' checkbox is checked.
5. If you have Gravity Forms installed and you would like to track the website behaviour of leads captured through Gravity Forms,  ensure the Enable 'Gravity Form integration' checkbox is checked.

# Changelog

 1.3.0

- Update GoSquared snippet Cloudfront file from tracker.js to gosquared.js to avoid being unintentionally blocked by generic tracking blocker filters.
- Tested on Wodpress version 5.7.2.

# Tests

```composer install```

```vendor/bin/phpunit tests```
