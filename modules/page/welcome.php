<!-- <div class="container" style="padding: 0px;">
	<div class="fullscreen-bg">
	  <video loop="" muted="" autoplay="" poster="video/plane.jpg" class="fullscreen-bg__video">
	    <source src="141414.mp4" type="video/mp4">
	  </video>
	</div>
</div> -->
<div class="intro-banner">
	<div class="container">
		
		<div class="row">
			<div class="col-md-12" style="display: flex;justify-content: center;">
                <iframe width="800" height="480" src="https://www.youtube.com/embed/qSHP98i9mDU?list=PL0lO_mIqDDFXNfqIL9PHQM7Wg_kOtDZsW" title="Уроки C++ с нуля / Урок #1 - Основы" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
	  		  <source src="141414.mp4" type="video/mp4">
	  		</video>
			</div>
		</div>

	</div>
</div>

<!-- Еңлік Әбдіқадір кім? -->
<div class="section padding-bottom-65">
	<div class="container">
		<div class="row">

			<div class="col-md-7">
				<h2 style="font-size: 36px; margin-top: 120px;">Почему надо учить C++?</h2>
				<br>
				<br>
				<ul class="list-1" style="font-size: 18px;">
					<li>Дизайн ОС</li>
					<li>Разработка компиляторов</li>
					<li>Разработка видеоигр</li>
					<li>Дизайн браузеров</li>
					<li>Вычислительные платформы</li>
					<li>Дизайн баз данных</li>
					<li>Дизайн Корпоративное программное обеспечение</li>
					<li>Обработка фото, идео и звука</li>
				</ul>
			</div>
			
			<div class="col-md-5 margin-top-6">
				<p align="right">
					<img src="images/photo.webp" alt="">
				</p>
			</div>

		</div>
	</div>
</div>
<!-- Еңлік Әбдіқадір кім? / End -->

<!-- Как работает сервис? -->
<div class="section gray padding-top-65 padding-bottom-65">
	<div class="container">
		<div class="row">

			<div class="col-xl-12">
				<div class="section-headline centered margin-top-0 margin-bottom-5">
					<h2 style="font-size: 36px;">Возможности сервиса</h2>
					<br>
					<br>
				</div>
			</div>
			
			<div class="col-xl-6 col-md-6">
				<ul class="list-2" style="font-size: 18px;">
					<li> Предоставляет возможность слушать и читать книги в аудио и электронном вариантах </li>
					<li> Вы можете использовать платформу в любом месте и в любое время </li>
				</ul>
			</div>

			<div class="col-xl-6 col-md-6">
				<ul class="list-2" style="font-size: 18px;">
					<li> Вы можете оставить комментарий, задать вопрос и установить обратную связь с авторами курса и книги. </li>
				</ul>
			</div>

		</div>
	</div>
</div>
<!-- Как работает сервис? / End -->

<!-- Отзывы -->
<div class="section margin-top-45 padding-top-25 padding-bottom-75">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				
				<div class="section-headline margin-top-0 margin-bottom-35">
					<h3>Курсы</h3>
					<a href="?page=all_courses&search=" class="headline-link">Все курсы</a>
				</div>
				<?=list_course_for_welcome()?>
			</div>
		</div>
	</div>
</div>
<!-- Отзывы / End -->


<script>
	function ClickSearch(){

		var search = $('input[name="intro_keywords_search"]').val();
	  window.location.href = '?page=all_reviews&search='+search;
	}
</script>