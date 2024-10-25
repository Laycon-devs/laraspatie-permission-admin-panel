<x-header />
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (@session('status'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <strong>{{ session('status') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <div class="card">
                <div class="card-header text-center">
                    <h4>Update <span class="text-warning">{{ $user->name }}</span> account</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('users/' . $user->id ) }}">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}"
                                name="name" placeholder="Enter your name">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                name="email" readonly placeholder="Enter your email">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Select Option -->
                        @foreach ($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    name="role[]" value="{{ $role }}"
                                    {{ in_array($role, $userCurrentRoles) ? 'checked' : '' }}>
                                <label class="form-check-label" for="">
                                    {{ $role }}
                                </label>
                            </div>
                        @endforeach

                        @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
