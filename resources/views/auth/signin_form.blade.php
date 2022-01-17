@extends('layout.template')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <form action="/auth/mps/signin" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" required>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="seePassword" onclick="passwordToggle()">
                    <label class="form-check-label" for="flexCheckDefault">
                      See Password
                    </label>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary">Sign In</button>
              </form>
              <div>
                  <a href="/auth/mps/signup">
                      <small>Sign up</small>
                  </a>
              </div>
        </div>
    </div>


<script>
// Variable
let password = document.getElementById('password');

// Function
passwordToggle = () => {
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
}

</script>
@endsection