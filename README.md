# gosquared-official-wordpress-plugin
[![Build Status](https://travis-ci.org/gosquared/gosquared-official-wordpress.svg?branch=master)](https://travis-ci.org/gosquared/gosquared-official-wordpress.svg?branch=master)

# The GoSquared Official Wordpress plugin.

GoSquared is the behavioural marketing platform for growing your Wordpress website.

Discover what's happening on your Wordpress site with GoSquared Analytics.
  - Get a simple but powerful overview of your website traffic, in real-time
  - Understand each visitors behaviour from the moment they land your website.  Quickly identify data such as:
    - What is your best performing content.
    - Which sites/campaigns are driving traffic to your website.
    - How engaged your website visitors are.

Capture more leads with the GoSquared Assistant
  - Use intelligent prompts to deliver proactive messages to your users at the right time.
  - Use live chat to engage visitors to give feedback or learn more about your website.

Convert more customers with GoSquared Automation
  - Connect your Gravity Forms to collect important lead analytics for every prospect.
  - Automate messages and follow up based on each users behaviour.

# Installation

1. If you don't have one already, [sign up](http://www.gosquared.com/join/wordpress) for a GoSquared account.
2. Upload this plugin to Wordpress through the 'Plugins' tab in your Wordpress admin dashboard and activate it.
3. Add your GoSquared Project Token to the 'Project Token' field in the GoSquared section of your Wordpress settings.
4. If you would like to track the website behaviour of your logged in users, make sure the 'Enable user tracking' checkbox is checked.
5. If you have Gravity Forms installed and you would like to track the website behaviour of leads captured through Gravity Forms,  ensure the Enable 'Gravity Form integration' checkbox is checked.

# Tests

```composer install```

```vendor/bin/phpunit tests```
