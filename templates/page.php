<article class="post">
  <header>
    <h1><?php echo $article['meta']->title; ?></h1>
  </header>
  <section class="content">
    <?php echo $article['content']; ?>
  </section>
  <section class="comments">
    <?php if($this->data['global']['disqus.username']){?>
      <div id="disqus_thread"></div>
      <script type="text/javascript" src="http://disqus.com/forums/<?php echo $this->data['global']['disqus.username']; ?>/embed.js"> </script>
      <noscript><a href="http://<?php echo $this->data['global']['disqus.username']; ?>.disqus.com/?url=ref">View the discussion thread.</a></noscript>
      <a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
    <?php }?>
  </section>
</article>

