<x-header />
<div class="container mt-5">
    <div class="row bg-success rounded-2">

        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-1 mb-5 text-white">Edit Role</p>

        </div>
        <form method="POST" action="{{ url('role/' . $roles->id) }}" class="mb-3">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Change Role</label>
                <input type="text" class="form-control" name="name" value="{{$roles->name}}" aria-describedby="name">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</div>
