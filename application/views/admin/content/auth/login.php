<body class="authentication-bg">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center">
                        <a href="#" class="logo">
                            <img src="<?= base_url('assets/') ?>images/logo-light.png" alt="" height="22" class="logo-light mx-auto">
                            <img src="<?= base_url('assets/') ?>images/logo-dark.png" alt="" height="22" class="logo-dark mx-auto">
                        </a>
                    </div>
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <?= $this->session->flashdata('message') ?>
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>

                            <form action="#" method="POST">

                                <div class="form-group mb-3">
                                    <label for="email">Email address</label>
                                    <input class="form-control" name="email" type="email" id="email" required="" placeholder="Masukkan Email">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Masukkan Password">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <!-- <p> <a href="#" class="text-muted ml-1"><i class="fa fa-lock mr-1"></i>Forgot your password?</a></p> -->
                            <!-- <p class="text-muted">Don't have an account? <a href="#" class="text-dark ml-1"><b>Sign Up</b></a></p> -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->