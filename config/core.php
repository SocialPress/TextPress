<?php

/** DEFAULT ROUTES **/
return array(
	'routes' => array(
			// Site root
			'__root__'=> array(
					'route' => '/',
					'template'=>'index',
					'layout' => true
				),
			'article' => array(
					'route' => '/:year-:month-:date/:article',
					'template'=>'article',
					'conditions' => array(
                                                        'year' => '(19|20)\d\d'
                                                       ,'month'=>'([1-9]|[01][0-9])'
                                                       ,'date'=>'([1-9]|[0-3][0-9])'
                                                       )
				),
			'archives' => array(
					'route' => '/archives(/:year(-:month))',
					'template' => 'archives',
					'conditions' => array(
                                                        'year' => '(19|20)\d\d'
                                                       ,'month'=>'([1-9]|[01][0-9])'
                                                        )
				),
			'location' => array(
					'route' => '/location',
					'template' => 'location',
					'layout' => true
				),
                        
			'gallery' => array(
					'route' => '/gallery(/:year(-:month))',
					'template' => 'gallery',
					'layout' => true,
					'conditions' => array(
                                                        'year' => '(19|20)\d\d'
                                                       ,'month'=>'([1-9]|[01][0-9])'
                                                       )
				),
			'about' => array(
					'route' => '/about',
					'template' => 'page',
					'layout' => true
				),
			'rss' => array(
					'route' => '/feed/rss(.xml)',
					'template' => 'rss',
					'layout' => false,
				),
			'atom' => array(
					'route' => '/feed(/atom(.xml))',
					'template' => 'atom',
					'layout' => false,
				)
		),
        // additional global settings
        
);