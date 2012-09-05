<?php
return array(
    // to add Globals see - setViewConfig        // Settings
	'prefix' => '/custom-demo-page',   // prefix to be added with all URLs. eg : '/blog'
	'date.format' => 'd M, Y',   // Date format to be used in article page (not for routes)
	'layout.file' => 'layout',    // Site layout file
	'file.extension' => '.json',   // file extension of articles
	'disqus.username' => '',   // Your disqus username or false (Global)
	//'markdown' => true, //Enable of disable markdown parsing. REMOVE
	'media.path'=> './config/custom-demo-page/media',      // Path to images
	'article.path'=> './config/custom-demo-page/articles',      // Path to articles
	'templates.path' => './config/custom-demo-page/templates',  // Path to custom templates
	'google.analytics' => false, // Google analytics code. set false to disable
        // Globals - Site
        'body.background' => '/assets/backgrounds/subtle-wood.gif',        
        'header.background' => '/assets/backgrounds/light-tile.gif',        
	'author.name' => 'J.R. Hull', // Global author name 
	'site.name'  => 'Custom Demo Page',   // Site name "Brand"(Global)
	'site.title' => 'Social Marketing for 5 Bucks',  // Site default title (Global)
	'site.description' => 'Social Marketing for the Local Business. Join today for 5 Bucks',  // Site default description (Global)
	'site.image' => '', // default image for opengraph
        'location.phonenumber'  => '888-000-0000',   // Phone (Global)
	'location.address'  => '195 Folsom Ave, Suite 600',   // Street Address (Global)
	'location.locality'  => 'San Francisco',   // Street Address (Global)
	'location.region'  => 'CA',   // Location (Global)
	'location.postalcode'  => '95xxx',   // Location (Global)
	'location.country'  => 'USA',   // Location (Global)
        // Globals - Social
        'channels' => array(
            'facebook'  => 'https://www.facebook.com/pages/Company-Gateways/204916997770',   // Facebook Page
            'twitter'  => 'https://twitter.com/companygateways',   // Twitter Page
            'linkedin'  => 'https://plus.google.com/u/0/b/106784259216640226293/106784259216640226293/about',   // LinkedIn Page
            'googleplus'  => 'https://plus.google.com/u/0/b/106784259216640226293/106784259216640226293/about',   // G+ Page
        ),
);
