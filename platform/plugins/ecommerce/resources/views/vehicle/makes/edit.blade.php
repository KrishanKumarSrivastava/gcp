@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <h4>Edit Make</h4>
        <form action="{{ route('vehicle.makes.update', $make->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" value="{{ $make->name }}" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Slug</label>
                <input type="text" name="slug" value="{{ $make->slug }}" class="form-control" required>
            </div>
            <button class="btn btn-success">Update</button>
            <a href="{{ route('vehicle.makes.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
