<!-- Content -->
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">Sign In</h5>
               
                <?php if(isset($_SESSION['login_error']) && $_SESSION['login_error'] == true){ ?>
                    <div class="alert alert-danger alert-dismissible fade w-100 d-blcok show" role="alert">
                        <strong>Wrong Email Or (and) Password. Try again :)</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php unset($_SESSION['login_error']); } ?>

                <form method="post" action="/example/send" class="form-signin">
                    <div class="form-label-group mb-3">
                        <input type="text" id="username" class="form-control" name="username" placeholder="Username" required minlength="6" maxlength="255">
                        <label for="username">Email address</label>
                    </div>

                    <div class="form-label-group mb-3">
                        <input type="password" id="password" class="form-control" name="password" placeholder="Password" required min="3">
                        <label for="password">Password</label>
                    </div>
                    <button class="btn d-block mx-auto btn-info" type="submit">Log In</button>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>