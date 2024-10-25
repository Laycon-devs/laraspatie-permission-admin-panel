<x-header />
<div class="container mt-5">
    <div class="row bg-success rounded-2">

        <div class="d-flex justify-content-between align-items-center">
            <p class="fs-1 mb-5 text-white">Create Permission</p>

        </div>
        <form method="POST" action="{{ url('permission') }}" class="mb-3">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Input Permission</label>
                <input type="text" class="form-control" name="name" aria-describedby="name">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </div>
</div>
