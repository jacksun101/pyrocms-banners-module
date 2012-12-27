<?php //echo var_dump($banners); ?>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<script	src="{{ global:SHARED_ADDONPATH }}modules/banners/js/slides.min.jquery.js"></script>

<style type="text/css" media="screen">
	#slides_<?=$id;?> .slides_container {
		width: <?=$options['width'];?>px;
		height: <?=$options['height'];?>px;
		display: none;
	}
	
	#slides_<?=$id;?> .slides_container div {
		width: <?=$options['width'];?>px;
		height: <?=$options['height'];?>px;
		display: block;
	}
	
	<?php if($options['column'] != 1): ?>
		/*
			Each slide
			Important:
			Set the width of your slides
			If height not specified height will be set by the slide content
			Set to display block
		*/
		#slides_<?=$id;?> .slides_container div.slide {
			width:222px;
			height:99px;
			display:block;
		}
		
		/*
			Set the size of your carousel items
		*/
		#slides_<?=$id;?> .slides_container .slide .item {
			float:left;
			width:88px;
			height:99px;
			margin:0 3px 0 3px;
			background:#efefef;
		}
	<?php endif; ?>
	
</style>

<script>
$(function(){
	$('#slides_<?=$id;?>').slides({
			preload: true,
			preloadImage: '{{ global:SHARED_ADDONPATH }}modules/banners/img/loading.gif',
        	container: 'slides_container',
        	generateNextPrev: <?=$options['arrow'];?>,
			next: 'next',
        	prev: 'prev',
        	pagination: true,
        	generatePagination: false,
        	paginationClass: 'pagination',
        	currentClass: 'current',
        	fadeSpeed: 1000,
        	fadeEasing: "easeOutQuad",
        	slideSpeed: 1500,
        	slideEasing: "easeInExpo",
        	start: 1,
        	effect: 'fade, slide',
        	crossfade: true,
        	randomize: false,
        	play: <?=$options['delay'];?>,
        	pause: 2500,
        	hoverPause: false,
        	autoHeight: false,
        	autoHeightSpeed: 350,
        	bigTarget: false,
			animationStart: function() {
				// Do something awesome!
			},
		    animationComplete: function(current) {
		        // Get the "current" slide number
		        // console.log(current);
		    }		  
	});
});
</script>

<div id="slides_<?=$id;?>">
	<div class="slides_container">	

	<?php if ($options['column'] == 1): ?>
	
		<?php foreach ($banners as $banner): ?>
			<div>
				<a href="<?=$banner['url']; ?>" target="_top">
				<img alt="<?=$banner['title']; ?>" src="<?=$banner['image_file']['image'];?>">
				</a>
			</div>
		<?php endforeach; ?>
	
	<?php else: ?>
	
		<?php 
			$c = $options['column'];			// column number, for example: 2.
			$x = ceil(count($banners) / $c);	// 3/2 -> 2
			for ($i = 1; $i <= $x; $i++): 
		?>
	
		<div class="slide">		
		
			<?php 			
				$remainder = fmod(count($banners), $c);		// 3/2 -> 1
				$repeat = ($remainder && ($i==$x)) ? $remainder : $c;						
			?>
		
			<?php for ($j = 0; $j < $repeat; $j++): ?>
			<div class="item">
				<a href="<?=$banners[($i-1)*$c+$j]['url']; ?>" target="_top">
				<img alt="<?=$banners[($i-1)*$c+$j]['title']; ?>" src="<?=$banners[($i-1)*$c+$j]['image_file']['image'];?>">
				</a>
			</div>
			<?php endfor; ?>
			
		</div>
	
		<?php endfor; ?>
	
	<?php endif; ?>
	</div>
</div>
