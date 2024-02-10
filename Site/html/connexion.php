<?php 

include 'header.php';

use MeteoCube\Config;

require_once('config.php');
require_once('database.php');

if(isset($_GET['error']) && $_GET['error'] == 'emailExists'){
    echo "<p class='container mb-4 alert alert-danger my-5' role='alert'>L'email existe déjà</p>";
}

?>

<div class="container">
<section>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-8">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body my-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-8 col-xl-6 order-2 order-lg-1">

                                <p class="text-primary text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Connexion</p>

                                <form method="post" action="index.php" class="register-form">

                                    <div>
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="mb-3">
                                            <input type="text" name ="login" required class="form-control" />
                                            <label class="form-label">Identifiant</label>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="mb-3">
                                            <input type="password" name ="password" required class="form-control" />
                                            <label class="form-label" >Mot de passe</label>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Connexion</button>
                                    </div>
                                    <p class="text-center mt-3">Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous</a></p>
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

<?php 
include 'footer.php'
?>
