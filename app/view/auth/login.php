<div class="row">
    <div class="col-4">
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Admin Login</h2>
                    <p>Please enter your email and password</p>
                </div>
                <form id="Login" method="post" action="/index.php?controller=auth&action=login">
                    <div class="form-group">
                        <input type="email" name="username"  class="form-control" placeholder="Email Address">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8"></div>
</div>