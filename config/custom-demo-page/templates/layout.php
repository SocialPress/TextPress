<!DOCTYPE html>
<html lang="en">
  <head>
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <meta charset="utf-8">
    <title>
      <?php
        $title= (isset($this->data['global']['title'])) ? $this->data['global']['title'] : $this->data['global']['site.title'];
        echo $this->data['global']['site.name'] .' | '. $title;
        $description = (isset($this->data['global']['site.description'])) ? $this->data['global']['site.description'] : '';
        $aurthor = (isset($this->data['global']['author.name'])) ? $this->data['global']['author.name'] : '';
      ?>
    </title>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name='author' content="<?php echo $this->data['global']['author.name']; ?>"/>

    <!-- Open Graph Meta -->
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:site_name" content="<?php echo $this->data['global']['site.name']; ?>"/>
    <meta property="og:type" content="business"/>
    <meta property="og:latitude" content="40.707992194260186" />
    <meta property="og:longitude" content="-74.05560369801627" />
    <meta property="og:street-address" content="<?php echo $this->data['global']['location.address']; ?>" />
    <meta property="og:locality" content="<?php echo $this->data['global']['location.locality']; ?>" />
    <meta property="og:region" content="<?php echo $this->data['global']['location.region']; ?>" />
    <meta property="og:postal-code" content="<?php echo $this->data['global']['location.postalcode']; ?>" />
    <meta property="og:country-name" content="<?php echo $this->data['global']['location.country']; ?>" />
    <meta property="og:phone_number" content="<?php echo $this->data['global']['location.phonenumber']; ?>" />

    <?php if(isset($this->data['global']['site.image'])) : ?>
    	<meta property="og:image" content="<?php echo $this->data['global']['site.image']; ?>"/>
    <?php endif; ?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- styles -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/bootstrap-image-gallery.min.css">
    <!-- custom styles -->
    <style type="text/css">
    <?php if($this->data['global']['header.background']) : ?>
      .hero-unit{
      background: url("<?php echo $this->data['global']['header.background']?>")  scroll 0 0 transparent !important;
      }
    <?php endif; ?>
    <?php if($this->data['global']['body.background']) : ?>
      html, body {
        background: url("<?php echo $this->data['global']['body.background']?>")  scroll 0 0 transparent !important;
      }
    <?php endif; ?>
      .socials {
      padding: 10px;
      }
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
    <?php if($this->data['global']['google.analytics']){?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', '<?php echo $this->data['global']['google.analytics']; ?>']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
  </script>
  <?php }?>
  </head>

  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <h1><a class="brand" href="<?php echo $this->data['global']['prefix'];?>/"><?php echo $this->data['global']['site.name'];?></a></h1>
          <h1 class="pull-right"><a class="brand" href="tel:"><?php echo $this->data['global']['location.phonenumber'];?></a></h1>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="content">
        <div class="row">
          <div class="span12">
            <div class="subnav">
              <ul class="nav nav-pills">
                <li class="<?php echo ($this->data['path'] === '__root__') ? 'active' : '' ?>"><a href="<?php echo $this->data['global']['prefix'];?>/"><i class="icon-home"></i>Home</a></li>
                <li class="<?php echo ($this->data['path'] === 'gallery') ? 'active' : '' ?>"><a href="<?php echo $this->data['global']['prefix'];?>/gallery"><i class="icon-picture"></i>Gallery</a></li>
                <li class="<?php echo ($this->data['path'] === 'archives') ? 'active' : '' ?>"><a href="<?php echo $this->data['global']['prefix'];?>/archives"><i class="icon-folder-close"></i>Archives</a></li>
                <li class="<?php echo ($this->data['path'] === 'about') ? 'active' : '' ?>"><a class="" href="<?php echo $this->data['global']['prefix'];?>/about"><i class="icon-info-sign"></i>About</a></li>
                <li class="pull-right">
                </li>
              </ul>
            </div>

            <section class="hero-unit">
              <div class="inner">
              <p><?php echo $this->data['global']['site.title']; ?></p>
              <p class="small"><?php echo $description; ?></p>
              </div>
            </section>
          </div>
        </div>

        <div class="row">
          <div class="span8">
            <?php echo $content; ?>
          </div>
          <div class="span4">

            <div>
            <div class="widget social"><center><h2>Subscribe &amp; Follow</h2></center>

            <?php foreach ($this->data['global']['channels'] as $key => $value) { ?>
              <div class="social-box">
                <a href="<?php echo $value; ?>">
                  <img width="48" height="48" border="0" src="/assets/img/<?php echo $key; ?>_icon_48.png">
                </a>
                <div class="social-box-text">
                  <span class="social-arrow"></span>
                  <span class="social-box-descrip">Connect on <?php echo $key; ?></span>
                  <span class="social-box-count">Many <?php echo $key; ?> Fans</span>
                </div>
              </div>
            <?php } ?>
              <div class="social-box">
                <a href="#">
                  <img width="48" height="48" border="0" src="/assets/img/rss_icon_48.png">
                </a>
                <div class="social-box-text">
                  <span class="social-arrow"></span>
                  <span class="social-box-descrip">Subscribe to RSS Feed</span>
                  <span class="social-box-count">Always Keep Updated</span>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <footer>
        <p>Powered by Company Gateways &copy; <a href="http://theaustinconnergroup.com" target="_blank">The Austin Conner Group </a>2012</p>
      </footer>
    </div> <!-- /container -->
    <!-- Scripts -->
    <script type="text/javascript" src="/assets/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">

      (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>
    <?php if($this->data['path'] === 'gallery') : ?>
    <!-- Gallery Related -->
    <script type="text/javascript" src="/assets/js/load-image.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-image-gallery.min.js"></script>
    <script type="text/javascript">
    $(function () {

      'use strict';
      var url;
      var thumb;
      // Start slideshow button:
      $('#start-slideshow').button().click(function () {
          var options = $(this).data(),
              modal = $(options.target),
              data = modal.data('modal');
          if (data) {
              $.extend(data.options, options);
          } else {
              options = $.extend(modal.data(), options);
          }
          modal.find('.modal-slideshow').find('i')
              .removeClass('icon-play')
              .addClass('icon-pause');
          modal.modal(options);
      });

      // build img
      var gallery = $('#gallery');
      $.each(photos.images, function (index, photo){
            url = photos.domain+photo.uri;
            thumb = photos.domain+photo.thumb;
             $('<a rel="gallery"/>')
              .append($('<img>').prop('src', thumb))
              .prop('href', url)
              .prop('title', photo.title)
              .appendTo(gallery);
      });
  });
  </script>
    <?php endif; ?>
  </body>
</html>
