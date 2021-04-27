<?php
    $sql_count = $_SESSION['con'] -> query("SELECT * FROM `articles`");
    include('vendor/pagination.php'); 
?>
<!-- Content -->
<div class="container">
    <div class="row">
        <?php if(isset($_SESSION['success_stored']) && $_SESSION['success_stored'] == true){ ?>
            <div class="alert alert-success alert-dismissible fade show w-100 d-block my-5" role="alert">
                <strong>You are added article successfully !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-check"></i></button>
            </div>
        <?php unset($_SESSION['success_stored']); } ?>

        <?php if(isset($_SESSION['error_stored']) && $_SESSION['error_stored'] == true){ ?>
            <div class="alert alert-danger alert-dismissible fade show w-100 d-block my-5" role="alert">
                <strong>Error for added article :( Try again</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
        <?php unset($_SESSION['error_stored']); } ?>

        <?php 
        if(isset($_GET['field']) && $_GET['field'] != NULL && isset($_GET['order']) && $_GET['order'] != NULL){
            // Get sort field
            $field = $_GET['field'];
        
            // Get order type
            $order_type = $_GET['order'];
            
            // Get articles data
            $sql_articles = $_SESSION['con']->query("SELECT * FROM articles ORDER BY $field $order_type $limit");
        }else{
            // Get articles data
            $sql_articles = $_SESSION['con'] -> query("SELECT * FROM `articles` ORDER BY `id` DESC $limit");
        }

        while($article = mysqli_fetch_assoc($sql_articles)){ ?>
            <!-- Article -->
            <div class="card w-100 my-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="far fa-user"></i> <?= $article['user_name'] ?></h5>
                    <h5 class="card-title"><i  class="far fa-envelope"></i> <a class="text-dark" href="mailto: <?= $article['user_email'] ?>"><?= $article['user_email'] ?></a></h5>
                    <hr>
                    <p class="card-text"><?= $article['description'] ?></p>
                    <?php if($article['status'] == 1){ ?> <!-- Finished -->
                        <span class="bg-success text-light p-2 rounded"><i class="fa fa-check"></i> Finished</span>
                    <?php } else { ?> <!-- Pending -->
                        <span class="bg-warning text-dark p-2 rounded"><i class="fa fa-edit"></i> Pending</span>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <!-- Buttons -->
        <div class="buttons">
            <a href="/example/login" class="btn btn-info"><i class="far fa-user"></i> Log In</a>
            <a data-toggle="modal" data-target="#addNewArticle" class="btn btn-info"><i class="fa fa-plus"></i></a>
            <a data-toggle="modal" data-target="#filterModal" class="btn btn-info"><i class="fa fa-filter"></i></a>
        </div>

        <!-- Pagination -->
        <div class="pagination d-block w-100 text-center mb-3"><?= $pagination_ctrls ?></div>
    </div>
</div>

<!-- Add new article Modal -->
<div class="modal fade" id="addNewArticle" tabindex="-1" role="dialog" aria-labelledby="addNewArticleTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNewArticleLongTitle">Add new Article</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <input type="text" class="form-control" required min="1" max="255" name="user_name" form="addNewArticleForm" placeholder="Your Name">
        </div>

        <div class="form-group">
            <input type="email" class="form-control" required min="4" max="255" name="user_email" form="addNewArticleForm" placeholder="Your Email Address">
        </div>

        <div class="form-group">
            <textarea rows="5" class="form-control" required min="1" max="999999" name="description" form="addNewArticleForm" placeholder="Description..."></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form id="addNewArticleForm" action="/example/store" method="post">
            <button type="submit" form="addNewArticleForm" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Filter Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLongTitle">Sort By</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <!-- Filters -->
            <nav class="navbar">
                <ul class="navbar-nav w-100">
                    <li class="nav-item mb-2"><a href="/example/sort?field=user_name&order=asc" class="btn btn-info d-block w-100">Sort By User Name A - Z</a></li>
                    <li class="nav-item mb-2"><a href="/example/sort?field=user_name&order=desc" class="btn btn-info d-block w-100">Sort By User Name Z - A</a></li>
                    <li class="nav-item mb-2"><a href="/example/sort?field=user_email&order=asc" class="btn btn-info d-block w-100">Sort By User Email A - Z</a></li>
                    <li class="nav-item mb-2"><a href="/example/sort?field=user_email&order=desc" class="btn btn-info d-block w-100">Sort By User Email Z - A</a></li>
                    <li class="nav-item mb-2"><a href="/example/sort?field=id&order=asc" class="btn btn-info d-block w-100">Sort By Dete A - Z</a></li>
                    <li class="nav-item mb-2"><a href="/example/sort?field=id&order=desc" class="btn btn-info d-block w-100">Sort By Dete Z - A</a></li>
                    <li class="nav-item mb-2"><a href="/example/sort?field=status&order=asc" class="btn btn-info d-block w-100">Sort By Status Pending - Finished</a></li>
                    <li class="nav-item mb-2"><a href="/example/sort?field=status&order=desc" class="btn btn-info d-block w-100">Sort By Status Finished - Pending</a></li>
                </ul>
            </nav>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>