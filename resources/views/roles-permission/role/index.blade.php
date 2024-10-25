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
            <p class="fs-1 mb-5 text-white">Role page</p>
            <a href="{{ url('role/create') }}" class="btn btn-primary">Create Role</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Add or Edit Permission</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <th scope="row">{{ $role->id }}</th>
                        <td>{{ $role->name }}</td>
                        <td><a href="{{url('role/' . $role->id . '/add-permission-role')}}" class="btn btn-warning">Add / Edit Permission to Role</a></td>
                        <td><a href="{{ url('role/' . $role->id . '/edit') }}"
                                class="btn btn-primary">Edit</a></td>
                        <td><a href="{{ url('role/' . $role->id . '/delete') }}"
                                class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
