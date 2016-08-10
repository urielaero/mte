<script type="text/ng-template" id="mteSuscribe.html">
	<?php $this->include_template('mteSuscribe','directives'); ?>
</script>
		<div flex="30" flex-sm="100" id="sidebar">
			<a layout-fill href='http://convocatoriaeducaccion.mejoratuescuela.org/' hide-sm>
				<img style='width:100%'src='/templates/mtev2/img/educaccion.jpg'>
			</a>
			<div mte-suscribe></div>
            
			<div class="adsbygoogle-content">
			<!-- Home Page Right Side 300 x 250 -->
				<ins class="adsbygoogle"
					style="display:inline-block;width:300px;height:250px"
					data-ad-client="ca-pub-5016039473129201"
					<?php if ( !isset($this->config->ad_mode_test) || $this->config->ad_mode_test ) {?>
						data-ad-test="on"
					<?php } ?>
					data-ad-slot="2582850577">
				</ins>
	
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
            
			</div>

			<a href="https://spaceship-labs.github.io/tuberia-de-denuncias/#/" class="ventanilla">
				<p>Ventanilla <span class="blue">Escolar</span></p>
				<p class="sub">
					<span class="de">de</span>
					<img src="/templates/mtev2/img/ventanilla.png" alt="">		
				</p>

			</a>

			<div class="box box-orange">
				<a href="<?=$this->config->blog_address?>" class="full-size-link"></a>
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-blog-01"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>Blog</p></div>
				</div>
			</div>
			<div class="box box-green">
				<a href="/mejora" class="full-size-link"></a>
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-mejora"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>Herramientas de mejora</p></div>
				</div>
			</div>
			<div class="box box-purple">
				<a href="/mejora/programas" class="full-size-link"></a>				
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-programaapoyo-01"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>Programas de apoyo</p></div>
				</div>
			</div>
			<div class="box box-fb">
				<a target="_blank" href="http://www.facebook.com/MejoraTuEscuela" class="full-size-link"></a>
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-fb-01"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>/MejoraTuEscuela</p></div>
				</div>
			</div>
			<div class="box box-tw">
				<a target="_blank" href="http://www.twitter.com/MejoraTuEscuela" class="full-size-link"></a>
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-twitter-01-01"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>@MejoraTuEscuela</p></div>
				</div>
			</div>
			<div id="tweets" ng-controller="twitterCTL">
				<perfect-scrollbar class="scroller">
					<ul>
						<li class="tweet" ng-repeat="tweet in tweets">
							<div layout="row">
								<div class="avatar" flex="25" >
									<a href="https://twitter.com/{{tweet.user.screen_name}}" target="_blank" ><img src="{{tweet.user.profile_image_url}}" alt="{{tweet.user.screen_name}}" /></a>
								</div>
								<div class="tweet-content" flex="75">
									<p><strong><a href="https://twitter.com/{{tweet.user.screen_name}}" target="_blank" >@{{tweet.user.screen_name}}</a></strong> {{tweet.text}}</p>
								</div>
							</div>
						</li>
					</ul>
				</perfect-scrollbar>
			</div>
		</div>
