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
            <p class="fs-1 mb-5 text-white">User creation page</p>
            <a href="{{ url('users/create') }}" class="btn btn-primary">Create Users</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $userRole)
                                <span class="badge bg-primary">{{ $userRole }}</span>
                            @endforeach
                        </td>
                        <td><a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-primary">Edit</a></td>
                        <td><a href="{{ url('users/' . $user->id . '/delete') }}" class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
