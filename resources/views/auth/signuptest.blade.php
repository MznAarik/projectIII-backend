<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign Up</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- App CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body>
    <div id="signupModal" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered justify-content-center">
            <div class="signup-modal-content bg-white p-4 rounded shadow position-relative">

                <span class="login-modal-close" onclick="window.location='{{ url()->previous() }}'">&times;</span>

                <h2 class="text-center mb-4">Sign Up</h2>

                @if (session('message'))
                    <div class="alert alert-{{ session('status') ?: 'info' }}">
                        {{ session('message') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="phoneno" class="form-label">Phone Number</label>
                        <input class="form-control" type="text" name="phoneno" id="phoneno" value="{{ old('phoneno') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address" rows="3" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="district_id" class="form-label">District ID</label>
                        <input class="form-control" type="number" name="district_id" id="district_id" value="{{ old('district_id') }}">
                    </div>

                    <div class="mb-3">
                        <label for="province_id" class="form-label">Province ID</label>
                        <input class="form-control" type="number" name="province_id" id="province_id" value="{{ old('province_id') }}">
                    </div>

                    <input type="hidden" name="role" value="user" />

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input class="form-control" type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                </form>

                <p class="text-center mt-3">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
