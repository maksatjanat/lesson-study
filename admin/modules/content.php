<section class="content-bg"></section>
<?php
  if($_SESSION['level_user'] == '1'){

    if(isset($_GET['courses'])){
        if(isset($_GET['course_info_id'])) require("pages/courses/course_info.php");
        else require("pages/courses/list_courses.php");
    }
    else if(isset($_GET['books'])) require("pages/books/list_books.php");
    else if(isset($_GET['users'])){
    	if($_GET['users'] != '') require("pages/users/info_company.php");
    	else require("pages/users/list_companies.php");
    }
    else if(isset($_GET['reviews'])) require("pages/reviews/list_reviews.php");
    else if(isset($_GET['newsletter'])) require("pages/newsletter/list_newsletters.php");
    else if(isset($_GET['setting'])) require("pages/setting/setting.php");
    else echo "<script>location.href='./?courses';</script>";

  }

?>