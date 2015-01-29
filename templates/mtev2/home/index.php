<div class='container home'>
<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Home</a>
	</div>
	<div layout="row" layout-sm="column" class="space-between">
		<div flex="65" flex-sm="100" id="home-content">
			<div class="video-container">
				<iframe width="595" height="335" src="//www.youtube.com/embed/G4FOZyoB74Y" frameborder="0" allowfullscreen="" id="home-video"></iframe>
			</div>
			<div ng-controller="blogCTL" class="space-between" id="blog-posts" layout="row">
				<script>
					window.blogAddress = '<?php echo $this->config->blog_address ?>';
				</script>
				<div class="post" ng-repeat="post in posts">
					<div class="post-image">
						<a href="#" ng-if="post.thumbnail_images.large.url">
							<img src="{{post.thumbnail_images.large.url}}" alt="{{post.thumbnail_images.description}}">
						</a>
						<a href="#" ng-if="!post.thumbnail_images.large.url">
							<img src="{{post.attachments[0].url | replaceWithCdnUrl:cdnUrl:blogAddress}}" alt="{{post.attachments[0].description}}">
						</a>
						<div class="clear"></div>
					</div>
					<div class="description">
						<h3><a href="#">{{post.title}}</a></h3>
						<p>{{post.excerpt | htmlToPlaintext}}</p>
					</div>
				</div>
				<a href="#" class="button-bordered">Consulta más información en nuestro blog</a>
			</div>
		</div>
		<?php $this->include_template('sidebar','home');  ?>
	</div>
</div>
