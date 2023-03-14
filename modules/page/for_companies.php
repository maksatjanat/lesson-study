<div class="gray">
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
	
					<h2>Для компаний</h2>
	
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs" class="dark">
						<ul>
							<li><a href="./">Главная</a></li>
							<li>Страницы</li>
							<li>Для компаний</li>
						</ul>
					</nav>
	
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
	
			<div class="col-xl-12">
				<div class="contact-location-info margin-bottom-50">
					<div class="contact-address">
						<ul>
							<li class="contact-address-headline">Если вы - владелец или представитель компании, и ваша компания оказалась в нашем списке, но вы с этим не согласны, дайте нам знать.</li>
							<li>Мы свяжемся с вами и рассмотрим ситуацию с вашей стороны.</li>
						</ul>
					</div>
				</div>
			</div>
	
			<div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2">
				<section id="contact" class="margin-bottom-60">
					<h3 class="headline margin-top-15 margin-bottom-35">Для связи с нами заполните короткую форму ниже</h3>
			
					<form method="post" action="?page=upload" id="contactform" autocomplete="on">
						<div class="row">
							<div class="col-md-6">
								<div class="input-with-icon-left">
									<input class="with-border" name="author_fio" type="text" id="name" placeholder="Ваше имя" required="required" />
									<input name="for_companies" type="hidden" value="for_companies">
									<i class="icon-material-outline-account-circle"></i>
								</div>
							</div>
			
							<div class="col-md-6">
								<div class="input-with-icon-left">
									<input class="with-border" name="author_phone" type="text" placeholder="Номер телефона*" data-inputmask="&quot;mask&quot;: &quot;9(999) 999-9999&quot;" data-mask="" required>
									<i class="icon-feather-smartphone"></i>
								</div>
							</div>
						</div>
			
						<div class="input-with-icon-left">
							<input class="with-border" name="company_information" type="text" id="subject" placeholder="Введите название компании" required="required" />
							<i class="icon-material-outline-assignment"></i>
						</div>
			
						<div>
							<textarea class="with-border" name="text_reviews" cols="40" rows="5" id="comments" placeholder="Ваш комментарий (при желании)" spellcheck="true" required="required"></textarea>
						</div>
			
						<input type="submit" class="submit button margin-top-15" id="submit" value="Отправить"/>
			
					</form>
				</section>
			</div>
	
		</div>
	</div>
</div>