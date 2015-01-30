<script>
	window.blogAddress = '<?php echo $this->config->blog_address ?>';
</script>			
<div class='container mejora' ng-controller="mejoraCTL">
	<div class="breadcrumb">
		<a class="start start2-2" href="#">
			<i class="icon-escuela-01"></i>
		</a>
		<a href="#">Mejora</a>
	</div>
	<div layout="row" layout-sm="column" class="space-between">
		<div flex="65" flex-sm="100" id="mejora-content">
			<div class="menu-top">
				<div class="tabs">
				    <md-tabs md-selected="selectedIndex">
				    	<md-tab id="tool-tab" aria-controls="tab1-content">
				    		<i class="icon-matutino"></i>
				    		<p><strong>Herramientas de mejora</strong></p>
				      	</md-tab>
				      	<md-tab id="programs-tab" aria-controls="tab2-content">
				      		<i class="icon-programaapoyo-01"></i>
				      		<p><strong>Programas de apoyo</strong></p>
				      	</md-tab>
				    </md-tabs>				
				</div>
			</div>
    		<ng-switch on="selectedIndex" class="tabpanel-container">
        		<div role="tabpanel" class="tab-content tools-content" aria-labelledby="tab1" ng-switch-when="0" md-swipe-left="next()" md-swipe-right="previous()" >
					<div class="space-between" id="blog-posts">
						<div masonry='{gutter:5,isInitLayout: false}' >
							<div class="post masonry-brick" flex-sm="100" column-width="100" ng-if="posts" ng-repeat="post in posts">
								<div class="post-image">
									<a ng-href="{{post.url}}" ng-if="post.thumbnail_images.large.url">
										<img ng-src="{{post.thumbnail_images.large.url}}" alt="{{post.thumbnail_images.description}}">
									</a>
									<a ng-href="{{post.url}}" ng-if="!post.thumbnail_images.large.url">
										<img ng-src="{{post.attachments[0].url | replaceWithCdnUrl:cdnUrl:blogAddress}}" alt="{{post.attachments[0].description}}">
									</a>
									<div class="clear"></div>
								</div>
								<div class="description">
									<h3><a ng-href="{{post.url}}">{{post.title}}</a></h3>
								</div>
								<div class="more" layout="row">
									<a href="{{post.url}}" flex>Leer más</a>
									<a ng-href="{{post.thumbnail_images.large.url}}" target="_blank" flex ng-if="post.thumbnail_images.large.url"><i class="icon-descargas-01"></i></a>
									<a ng-href="{{post.attachments[0].url | replaceWithCdnUrl:cdnUrl:blogAddress}}" target="_blank" flex ng-if="!post.thumbnail_images.large.url"><i class="icon-descargas-01"></i></a>
								</div>
							</div>
						</div>
						<a ng-show="showMoreBtn" ng-click="getPosts()" class="button-bordered">Consulta más información</a>
					</div>
				</div>
        		<div role="tabpanel" class="tab-content programs-content" aria-labelledby="tab1" ng-switch-when="1" md-swipe-left="next()" md-swipe-right="previous()" >
					<p>Para más información, escríbenos a: <a href="#">contacto@mejoratuescuela.org</a></p>
				</div>
			</ng-switch> 
		</div>
		<?php $this->include_template('sidebar','mejora');  ?>
	</div>
</div>
