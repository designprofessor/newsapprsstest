<?php
// Include the SimplePie library
// For 1.0-1.2:
#require_once('simplepie.inc');
// For 1.3+:
require_once('simplepie/autoloader.php');
 
// Create a new SimplePie object
$feed = new SimplePie();
 
// Instead of only passing in one feed url, we'll pass in an array of three
$feed->set_feed_url(array(
	'http://www.huffingtonpost.com/feeds/verticals/arts/index.xml',
	'http://rss.nytimes.com/services/xml/rss/nyt/Technology.xml'
));
 
// We'll use favicon caching here (Optional)
$feed->set_favicon_handler('handler_image.php');
 
// Initialize the feed object
$feed->init();
 
// This will work if all of the feeds accept the same settings.
$feed->handle_content_type();
 
// Begin our XHTML markup
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">	
<head>
	<title>Awesome feeds</title>
	<link rel="stylesheet" href="../demo/for_the_demo/simplepie.css" type="text/css" media="screen" charset="utf-8" />
 
	<style type="text/css">
	h4.title {
		/* We're going to add some space next to the titles so we can fit the 16x16 favicon image. */
		background-color:transparent;
		background-repeat:no-repeat;
		background-position:0 1px;
		padding-left:20px;
	}
	</style>
</head>
<body>
	<div id="site">
 
		<?php if ($feed->error): ?>
		<p><?php echo $feed->error; ?></p>
		<?php endif; ?>
 
		<h1>Awesome feeds</h1>

 
		<?php foreach ($feed->get_items() as $item): ?>
 		
		<div class="chunk" style="background:#ccc; padding:15px">
 
			<?php /* Here, we'll use the $item->get_feed() method to gain access to the parent feed-level data for the specified item. */ ?>
			<h4>
				<a href="<?php echo $item->get_permalink(); ?>">
					<?php echo $item->get_title(); ?>
				</a>
			</h4>
 
			<?php echo $item->get_content(); ?>
 
			<small class="footnote">Source: <a href="<?php $feed = $item->get_feed(); echo $feed->get_permalink(); ?>"><?php $feed = $item->get_feed(); echo $feed->get_title(); ?></a> | <?php echo $item->get_date('j M Y | g:i a T'); ?></small>
 			<div style="background:#ccc; padding:10px;">
 				<h4>CATEGORIES</h4>
 				<?php 
			 		foreach ($item->get_categories() as $category)
					{
						echo $category->get_label();
						echo ', ';
					}
					
			 	?>
 			</div>
		</div>
 		<hr />
		<?php endforeach; ?>
 
	</div>
</body>
</html>