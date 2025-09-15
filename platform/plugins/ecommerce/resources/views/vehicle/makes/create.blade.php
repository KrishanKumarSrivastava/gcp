@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <h4>Add New Make</h4>
        <form action="{{ route('vehicle.makes.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" required>
            </div>
            <button class="btn btn-success">Save</button>
            <a href="{{ route('vehicle.makes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
