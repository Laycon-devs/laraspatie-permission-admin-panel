<x-header />
<div class="container mt-5">
    <div class="row bg-success rounded-2">

        @if (@session('status'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <strong>{{ session('status') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-1 mb-5 text-white">Add permission to Role 👉 </p>

            <strong class="text-warning display-4 fw-bold">{{ $roles->name }}</strong>

        </div>
        <form method="POST" action="{{ url('role/' . $roles->id . '/add-permission-role') }}" class="mb-3">
            @csrf
            @method('PUT')
            @foreach ($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" 
                            type="checkbox" 
                            value="{{ $permission->name }}" 
                            name="permission[]"
                            {{ in_array($permission->id, $permissionsDB) ? 'checked' : '' }}
                            >
                    <label class="form-check-label" for="permission">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Add</button>
        </form>

    </div>
</div>
