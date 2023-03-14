<!-- Footer -->
<div id="footer">

	<div class="footer-top-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">

					<div class="footer-rows-container">
						
						<div class="footer-rows-left">
							<div class="footer-row">
								<div class="footer-row-inner footer-logo">
									<img src="images/cplus2.png" alt="">
								</div>
							</div>
						</div>
						
						<div class="footer-rows-right">

							<div class="footer-row">
								<div class="footer-row-inner">
									<ul class="footer-social-links">
										<li><a href="?page=all_courses">Курсы</a></li>
										<li><a href="?page=all_books">Книги</a></li>
										<li><a href="?page=contact">Контакты</a></li>
									</ul>
									<div class="clearfix"></div>
								</div>
							</div>
							
							<div class="footer-row">
								<div class="footer-row-inner">
									<form action="#" method="get" class="newsletter" required>
										<input type="email" name="email_for_newsletter_subscription" placeholder="Подписаться на новости">
										<button href="#small-dialog-2" class="apply-now-button popup-with-zoom-anim" onclick="EmailForNewsletterSubscription();"><i class="icon-feather-arrow-right"></i></button>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="footer-bottom-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					© <?=date('Y')?> <strong>lesson-study.kz</strong>. Все права защищены.
				</div>
			</div>
		</div>
	</div>

</div>
<!-- Footer / End -->

<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs" style="max-width: 500px; max-height: 550px;">
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Подписка на рассылку</a></li>
		</ul>

		<div class="popup-tabs-container">
			<div class="popup-tab-content" id="tab">
				<div class="col-md-12">
					<div id="EmailNewsletterSubscriptionResult"></div>
				</div>
			</div>
		</div>

	</div>
</div>


<script>
	function EmailForNewsletterSubscription(){

		var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    var email = $('input[name="email_for_newsletter_subscription"]').val();
    var error_type = '';
    var valid = re.test(email);
    if (valid) error_type = 1;
    else error_type = 0;

    $.ajax({
      type: 'get',
      dataType: "html",
      url: 'scripts/ajax.php',
      data:{email_for_newsletter_subscription: email, error_type: error_type },
      success: function(result) {
        $('#EmailNewsletterSubscriptionResult').html(result);
      },
    });

	}
</script>