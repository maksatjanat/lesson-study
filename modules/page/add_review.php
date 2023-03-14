<div class="gray">
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
	
					<h2>Добавить отзыв</h2>
	
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs" class="dark">
						<ul>
							<li><a href="./">Главная</a></li>
							<li>Страницы</li>
							<li>Добавить отзыв</li>
						</ul>
					</nav>
	
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
	
			<div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2">
				<section id="contact" class="margin-bottom-60">
					<h3 class="headline margin-top-15 margin-bottom-35">Заполните короткую форму ниже</h3>
			
					<form method="post" action="?page=upload" name="add_review" id="contactform" autocomplete="off" enctype="multipart/form-data" required>
						<div class="row">
							<div class="col-md-6">
								<div class="input-with-icon-left">
									<input class="with-border" name="author_fio" type="text" placeholder="Ваше имя*" required>
									<input name="add_review" type="hidden" value="add_review">
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
							<input class="with-border" name="company_information" type="text" id="subject" placeholder="Введите название компании (при наличии юридическое имя, сайт или БИН)*" required>
							<i class="icon-material-outline-business"></i>
						</div>
			
						<div>
							<textarea class="with-border" name="text_reviews" cols="40" rows="5" id="comments" placeholder="Добавьте ваш отзыв*" spellcheck="true" required></textarea>
						</div>

						<div class="uploadButton margin-top-30">
							<input class="uploadButton-input" type="file" name="myfile[]" accept="image/*, application/pdf" id="upload" multiple="">
							<label class="uploadButton-button ripple-effect" for="upload">Прикрепить подтверждающие документы при наличии</label>
							<span class="uploadButton-file-name">Изображения или документы, которые могут быть полезны при рассмотрений</span>
						</div>
						<br>
						<div>
							<div class="checkbox_style">
								<input name="I_agree" type="checkbox" id="checkbox1" value="да" required>
								<label for="checkbox1"><span class="checkbox-icon"></span> Я согласен на обработку и проверку информации перед ее публикацией и готов предоставить доказательную базу для отзыва* </label>
							</div>
						</div>
						<div>
							<div class="checkbox_style">
								<input name="legal_consultation" type="checkbox" id="chekcbox2" value="да">
								<label for="chekcbox2"><span class="checkbox-icon"></span> Мне требуется бесплатная юридическая консультация по вопросам возврата своих инвестиций </label>
							</div>
						</div>
			
						<input type="submit" class="submit button margin-top-15" id="submit" value="Отправить"/>
			
					</form>
				</section>
			</div>
	
		</div>
	</div>
</div>