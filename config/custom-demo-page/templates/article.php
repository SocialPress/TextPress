
<article class="post">
  <header>
    <h1><?php echo $article['meta']->title; ?></h1>
  </header>
  <section class="content">
<div class="clearfix">
  <?php
	if(isset($article['media'])){
		echo ' <div class="pull-left">';
		foreach($article['media'] as $media){
			if($media->type === 'image'){
				echo '<img class="img-polaroid" style="width: 200px; margin-right:20px;" src="'.$media->src.'" />';
				break; //only one image at this time
			}
		}
		echo '</div>';
	}
  ?>
<div>
  
    <?php echo $article['content']; ?>

</div>
    <div class="date"><?php  echo date($this->data['global']['date.format'],strtotime($article['meta']->date));  ?></div>
     </div>
    <footer>
    <br/>
    <!-- Start Shareaholic Sexy Bookmark HTML-->
    <div class="post share">
    <div class="shr_class shareaholic-show-on-load">
    </div>
    </div>
    <!-- End Shareaholic Sexy Bookmark HTML -->
</footer>
  </section>
  <section class="comments">
    <?php if($this->data['global']['disqus.username']){?>
      <div id="disqus_thread"></div>
      <script type="text/javascript" src="http://disqus.com/forums/<?php echo $this->data['global']['disqus.username']; ?>/embed.js"> </script>
      <noscript><a href="http://<?php echo $this->data['global']['disqus.username']; ?>.disqus.com/?url=ref">View the discussion thread.</a></noscript>
      <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    <?php }?>
  </section>
</article>
<!-- Start Shareaholic Sexy Bookmark settings -->
<script type="text/javascript">
var SHRSB_Settings = {"shr_class":{"src":"<?php echo $this->data['global']['base.directory'];?>/assets/css","link":"","service":"304,7,5,219,88,38","apikey":"0747414f47c2b684cf5480c36b2478689","localize":true,"shortener":"bitly","shortener_key":"","designer_toolTips":true,"tip_bg_color":"black","tip_text_color":"white","twitter_template":"${title} - ${short_link} via @Shareaholic"}};
var SHRSB_Globals = {"perfoption":"1"};
</script>
<!-- End Shareaholic Sexy Bookmark settings -->
<!-- Start Shareaholic Sexy Bookmark script -->
<script type="text/javascript">
(function() {
var sb = document.createElement("script"); sb.type = "text/javascript";sb.async = true;
sb.src = ("https:" == document.location.protocol ? "https://dtym7iokkjlif.cloudfront.net" : "http://cdn.shareaholic.com") + "/media/js/jquery.shareaholic-publishers-sb.min.js";
var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(sb, s);
})();
</script>

<!-- End Shareaholic Sexy Bookmark script -->


