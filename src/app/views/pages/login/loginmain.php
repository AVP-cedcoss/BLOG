  <body class="text-center">
    <main class="form-signin">
        <form action="<?php echo URLROOT?>/public/userController/login" method="POST">
            <h1 class="h3 mb-3 fw-normal">Sign In</h1>
            <input type="hidden" name="action" value="signin">
            <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" 
            placeholder="name@example.com" name="email" required>
            <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" 
            placeholder="Password" name="password" required>
            <label for="floatingPassword">Password</label>
            </div>
    
            <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        </form>
        <!-- <button class="mt-2 w-100 btn-sm btn-primary rounded"> -->
        <a class="mt-2 w-100 btn-sm btn btn-primary rounded text-light text-decoration-none"
        href="<?php echo URLROOT?>/public/Pages/register">
            Register
        </a>
        <!-- </button> -->
        <a href="../app/views/pages/home.php" class="btn btn-secondary my-2">Back To Home</a>
        <?php
        $html='';
        if (isset($_GET['signup'])) {
            if ($_GET['signup'] == 'error') {
                $html.='
                    <div class="row">
                      <div class="col-12 text-danger fw-bold bg-info">
                        Some Error Occured
                      </div>
                    </div>
                ';
            }
        }
        if (isset($_GET['falseconfirm'])) {
            $html.='
                <div class="row">
                    <div class="col-12 text-danger fw-bold bg-info">
                    Your Account is pending approval from Admin. Wait for confirmation to Proceed.
                    </div>
                </div>
            ';
        }
        echo $html;
        ?>
        <p class="mt-5 mb-3 text-muted">&copy; CEDCOSS Technologies</p>
    </main>
    