<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">ThriftLang</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="mr-auto navbar-nav">
        </ul>
        <ul class="ml-auto navbar-nav">
            @guest
                <li class="nav-item login">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLogin">Login</a>
                </li>
                <li class="nav-item register">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#modalRegister">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="#" id="logoutBtn" class="nav-link-item">
                        <i class='fas fa-sign-out-alt icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            @endguest
        </ul>
    </div>
</nav>

<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div id="flash-message" class="alert" style="display: none;"></div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="formLogin">
                    @csrf
                    <div class="form-group">
                        <label for="loginEmail">Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="formRegister" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="username" class="label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="first_name" class="label">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email Address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone_number" class="label">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="address" class="label">Address</label>
                        <input type="text" id="address" name="address" placeholder="Address" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="image_path" class="label">Profile Image</label>
                        <input type="file" id="image_path" name="image_path" class="form-control">
                    </div>

                    <div class="mt-6 form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
