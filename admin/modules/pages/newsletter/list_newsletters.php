<div class="content-wrapper" style="margin-top: -20px;">
  <section class="content-header">
    <h1>
        Подписчики на сообщения
    </h1>
  </section>
  <section class="content">
    <div class="row">
	  <div class="col-md-3"></div>	
      <div class="col-md-6">

        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Список подписчиков на сообщения</h3>
          </div>
          <div class="box-body">
            <?=ListNewsletter();?>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<script>
function DeleteNewsletterId(id){

  var result = confirm("Вы точно хотите удалить");
  if (result == true){

    $.ajax({
      type: 'get',
      dataType: "html",
      url: 'plugins/php/ajax_scripts.php',
      data: {id_newsletter: id},
      success: function(result) {
        window.location.href = '?newsletter';
      },
    });
  }
}
</script>