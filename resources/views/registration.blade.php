<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('Company/registration.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Registration</title>
</head>
<body>
<section class="vh-100 bg-image"
    style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                             @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif

               @if (session('error'))
                  <div class="alert alert-success">
                      {{ session('error') }}
                  </div>
              @endif
                            <form method="POST" action="{{ url('registration_save') }}">
                                @csrf
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" name="name" id="form3Example1cg" class="form-control form-control-lg" value="{{ old('name') }}" />
                                    <label class="form-label" for="form3Example1cg">Your Name</label>
                                    @error('name')<font color="red">{{ $message }}</font>@enderror
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg" value="{{ old('email') }}" />
                                    <label class="form-label" for="form3Example3cg">Your Email</label>
                                    @error('email')<font color="red">{{ $message }}</font>@enderror
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cg">Password</label>
                                    @error('password')<font color="red">{{ $message }}</font>@enderror
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" name="password_confirmation" id="form3Example4cdg" class="form-control form-control-lg" />
                                    <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                    @error('password_confirmation')<font color="red">{{ $message }}</font>@enderror
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" data-mdb-button-init
                                            data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                        Register
                                    </button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Have already an account?
                                    <a href="{{ url('/') }}" class="fw-bold text-body"><u>Login here</u></a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
