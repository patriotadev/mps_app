@extends('layout.template')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <form action="/auth/mps/signup" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}">
                  @error('name')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror"" name="email" value="{{ old('email') }}">
                  @error('email')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                    @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror"" name="password" id="password" value="{{ old('password') }}">
                  @error('password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                    @enderror
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="seePassword" onclick="passwordToggle()">
                    <label class="form-check-label" for="flexCheckDefault">
                      See Password
                    </label>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Confirmation Password</label>
                  <input type="password" class="form-control @error('confirm-password') is-invalid @enderror"" name="confirm-password" value="{{ old('confirm-password') }}">
                  @error('confirm-password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
              </form>
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