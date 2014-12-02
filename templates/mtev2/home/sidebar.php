		<div flex="30" id="sidebar">
			<div class="email-box">
				<h4><strong>Mantente informado</strong></h4>
				<form action="#">
					<input type="text">
					<input type="submit" value="Suscríbete" class="button-bordered">
					<a href="#">Aviso de privacidad</a>
				</form>
			</div>
			<div class="box box-orange">
				<div layout="row">
					<div flex="25" class="icon-container"></div>	
					<div flex="75" class="text-container"><p>Blog</p></div>
				</div>
			</div>
			<div class="box box-green">
				<div layout="row">
					<div flex="25" class="icon-container"></div>	
					<div flex="75" class="text-container"><p>Herramientas de mejora</p></div>
				</div>
			</div>
			<div class="box box-purple">
				<div layout="row">
					<div flex="25" class="icon-container"></div>	
					<div flex="75" class="text-container"><p>Programas de apoyo</p></div>
				</div>
			</div>
			<div class="box box-fb">
				<div layout="row">
					<div flex="25" class="icon-container"></div>	
					<div flex="75" class="text-container"><p>/MejoraTuEscuela</p></div>
				</div>
			</div>
			<div class="box box-tw">
				<div layout="row">
					<div flex="25" class="icon-container"></div>	
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
