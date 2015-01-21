		<div flex="30" flex-sm="100" id="sidebar">
			<div class="email-box">
				<h4><strong><i class="icon-mail-01"></i> Mantente informado</strong></h4>
				<form action="#">
					<input type="text">
					<input type="submit" value="Suscríbete" class="button-bordered">
					<md-checkbox aria-label="Checkbox 1"></md-checkbox><a href="#">Aviso de privacidad</a>
				</form>
			</div>
			<div class="box box-orange">
				<a href="#" class="full-size-link"></a>
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-blog-01"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>Blogjj</p></div>
				</div>
			</div>
			<div class="box box-green">
				<a href="#" class="full-size-link"></a>
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
				<a href="#" class="full-size-link"></a>				
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
				<a href="#" class="full-size-link"></a>
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
				<a href="#" class="full-size-link"></a>
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
