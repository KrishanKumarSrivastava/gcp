@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <h4>Add New Car Year</h4>
        <form action="{{ route('vehicle.years.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Model</label>
                <select name="model_id" class="form-control" required>
                    <option value="">Select Model</option>
                    @foreach($models as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Year</label>
                <input type="number" name="year" class="form-control" min="1900" max="{{ date('Y') + 5 }}" required>
            </div>
            <button class="btn btn-success">Save</button>
            <a href="{{ route('vehicle.years.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection