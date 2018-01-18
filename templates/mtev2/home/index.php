<div class='container home container-ads'>
<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Home</a>
	</div>
	<div layout="row" layout-sm="column" class="space-between">
		<div flex="65" flex-sm="100" id="home-content">
			<div class="video-container">
				<div id="home-video"></div>
				<!--
				<iframe ga="'send', 'event', 'press_button', 'reproducción del video'" width="595" height="335" src="//www.youtube.com/embed/G4FOZyoB74Y" frameborder="0" allowfullscreen="" id="home-video"></iframe>
				-->
			</div>
			<script>
				window.blogAddress = '<?php echo $this->config->blog_address ?>';

				var tag = document.createElement('script');
				tag.src = "http://www.youtube.com/player_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
				function onYouTubePlayerAPIReady() {
					var player = new YT.Player('home-video', {
					height: '335',
					width: '595',
					videoId: 'G4FOZyoB74Y',
					events: {
						'onReady': onPlayerReady,
						'onStateChange': onPlayerStateChange
						}
					});
				}
				function onPlayerReady() {}
				function onPlayerStateChange(event) {
					if (event.data === YT.PlayerState.PLAYING) {
						ga('send', 'event', 'home', 'reproducción', 'video');
					}else if (event.data === YT.PlayerState.ENDED) {
						ga('send', 'event', 'home', 'terminación', 'video');
					}else if (event.data === YT.PlayerState.PAUSED) {
						ga('send', 'event', 'home', 'pause', 'video');
					}
				}

			</script>
			<a ga="'send', 'event', 'home', 'click', 'donativo'" href="/donativos" class="donation" layout="row" layout-align="space-between center" layout-wrap>
				<div class="text-content">
				<img class="donation-svg" src="/templates/mtev2/img/donativo.svg" alt="">
					<p class="text">¿Quieres ayudarnos a seguir mejorando la educación?
                    <br>
                    
					<span>¡Realiza un donativo!</span></p>
				</div>
			</a>
			<div ng-controller="blogCTL" class="space-between" id="blog-posts">
				<div masonry='{gutter:5,isInitLayout: false}'>
					<div class="post masonry-brick" flex-sm="100" column-width="100" ng-repeat="post in posts">
						<div class="post-image">
							<a ga="'send', 'event', 'infografía', 'click', post.title" ng-href="{{post.url}}">
								<img  ng-src="{{post.image}}" alt="{{post.image.description}}">
							</a>
							<div class="clear"></div>
						</div>
						<div class="description">
							<h3><a ng-href="{{post.url}}">{{post.title}}</a></h3>
							<p>{{post.excerpt | htmlToPlaintext}}</p>
						</div>
					</div>
				</div>
				<div layout='row' ng-show='loading' flex flex-sm="100" layout-align='center center'>
					<md-progress-circular md-mode="indeterminate"></md-progress-circular>
				</div>
				<a ng-show="showMoreBtn" href="<?php echo $this->config->blog_address ?>" class="button-bordered">Consulta más información en nuestro blog</a>
			</div>
		</div>
		<?php $this->include_template('sidebar','home');  ?>
	</div>
</div>
