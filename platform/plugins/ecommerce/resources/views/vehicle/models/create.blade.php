@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <h4>Add New Car Model</h4>
        <form action="{{ route('vehicle.models.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Make</label>
                <select name="make_id" class="form-control" required>
                    <option value="">Select Make</option>
                    @foreach($makes as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" required>
            </div>
            <button class="btn btn-success">Save</button>
            <a href="{{ route('vehicle.models.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection