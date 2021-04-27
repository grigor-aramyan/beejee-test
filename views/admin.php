<!-- Content -->
<div class="container">
    <div class="row">
        <form action="/example/logout" method="get" class="w-100 mb-3">
          <button type="submit" class="btn btn-danger w-100 btn-lg"><i class="fa fa-power-off"></i></button>
        </form>

        <?php if(isset($_SESSION['logged_in_first']) && $_SESSION['logged_in_first'] == true){ ?>
            <div class="alert alert-success alert-dismissible fade show w-100 d-block my-5" role="alert">
                <strong>You are loged in successfully: Good Day :)</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-check"></i></button>
            </div>
        <?php unset($_SESSION['logged_in_first']); } ?>

        <?php if(isset($_SESSION['success_deleted']) && $_SESSION['success_deleted'] == true){ ?>
            <div class="alert alert-success alert-dismissible fade show w-100 d-block my-5" role="alert">
                <strong>You are deleted article successfully !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-check"></i></button>
            </div>
        <?php unset($_SESSION['success_deleted']); } ?>

        <?php if(isset($_SESSION['error_deleted']) && $_SESSION['error_deleted'] == true){ ?>
            <div class="alert alert-danger alert-dismissible fade show w-100 d-block my-5" role="alert">
                <strong>Error for deleting article :( Try again</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
        <?php unset($_SESSION['error_deleted']); } ?>

        <?php if(isset($_SESSION['success_updated']) && $_SESSION['success_updated'] == true){ ?>
            <div class="alert alert-success alert-dismissible fade show w-100 d-block my-5" role="alert">
                <strong>You are updated article successfully !</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-check"></i></button>
            </div>
        <?php unset($_SESSION['success_updated']); } ?>

        <?php if(isset($_SESSION['error_updated']) && $_SESSION['error_updated'] == true){ ?>
            <div class="alert alert-danger alert-dismissible fade show w-100 d-block my-5" role="alert">
                <strong>Error for updating article :( Try again</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
        <?php unset($_SESSION['error_updated']); } ?>

        <h1 class="mb-5">Articles</h1>    

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Description</th>
                    <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($article = mysqli_fetch_assoc($_SESSION['articles'])){ ?>
                      <tr>
                          <th scope="row"><?= $article['id'] ?></th>
                          <td><?= $article['user_name'] ?></td>
                          <td><?= $article['user_email'] ?></td>
                          <?php if($article['status'] == 1){ ?> <!-- Finished -->
                            <td><span class="p-2 rounded text-light bg-success"><i class="fa fa-check"></i> Finished</span></td>
                          <?php } else { ?> <!-- Pending -->
                            <td><span class="p-2 rounded text-dark bg-warning"><i class="fa fa-edit"></i> Pending</span></td>
                          <?php } ?>
                          <td><button class="btn btn-info" data-toggle="modal" data-target="#editArticle<?= $article['id'] ?>">View More</button></td>
                          <td><a href="example/destroy?id=<?= $article['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                      </tr>

                      <!-- Modal -->
                      <div class="modal fade" id="editArticle<?= $article['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editArticle<?= $article['id'] ?>Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editArticle<?= $article['id'] ?>LongTitle">Edit Article</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                  <label class="w-100 d-block">Status</label>
                                  <select class="form-control" required name="status" form="editArticle<?= $article['id'] ?>Form"><?= $article['description'] ?>
                                    <option value="0" class="bg-warning" <?php if($article['status'] == 0) { echo 'selected'; } ?>>Pending</option>
                                    <option value="1" class="bg-success" <?php if($article['status'] == 1) { echo 'selected'; } ?>>Finished</option>
                                  </select>
                              </div>

                              <div class="form-group">
                                  <label class="w-100 d-block">Description</label>
                                  <textarea rows="10" class="form-control" required min="1" max="999999" name="description" form="editArticle<?= $article['id'] ?>Form" placeholder="Description..."><?= $article['description'] ?></textarea>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <form id="editArticle<?= $article['id'] ?>Form" type="submit" action="/example/update" method="post">
                                  <input type="text" class="d-none" name="id" value="<?= $article['id'] ?>">
                                  <button type="submit" form="editArticle<?= $article['id'] ?>Form" class="btn btn-primary">Save</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


