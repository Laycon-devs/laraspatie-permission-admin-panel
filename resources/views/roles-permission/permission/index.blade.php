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
            <p class="fs-1 mb-5 text-white">Permission page</p>
            <a href="{{ url('permission/create') }}" class="btn btn-primary">Create Permission</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Permissions</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <th scope="row">{{ $permission->id }}</th>
                        <td>{{ $permission->name }}</td>
                        <td><a href="{{ url('permission/' . $permission->id . '/edit') }}"
                                class="btn btn-primary">Edit</a></td>
                        <td><a href="{{ url('permission/' . $permission->id . '/delete') }}"
                                class="btn btn-danger">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
