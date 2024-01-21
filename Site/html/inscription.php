<?php include 'header.php'?>

<div class="container">
<section>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body my-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-8 col-xl-6 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Inscription</p>

                                <form method="post" action="index.php" class="register-form">

                                    <div>
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="mb-3">
                                            <input type="text" id="form3Example1c" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Identifiant</label>
                                        </div>
                                    </div>

                                    <div>
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" />
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>

                                    <div>
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="mb-3">
                                            <input type="password" id="form3Example4c" class="form-control" />
                                            <label class="form-label" for="form3Example4c">Mot de passe</label>
                                        </div>
                                    </div>

                                    <div>
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div>
                                            <input type="password" id="form3Example4cd" class="form-control" />
                                            <label class="form-label" for="form3Example4cd">Répéter votre mot de passe</label>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary btn-lg mt-3">Inscription</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    
</div>

<?php include 'footer.php'?>