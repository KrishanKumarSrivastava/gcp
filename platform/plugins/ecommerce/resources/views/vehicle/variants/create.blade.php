@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <h4>Add New Car Variant</h4>
        <form action="{{ route('vehicle.variants.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label>Year</label>
                <select name="year_id" class="form-control" required>
                    <option value="">Select Year</option>
                    @foreach($years as $id => $display)
                        <option value="{{ $id }}">{{ $display }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Variant Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g., Petrol 1.2L, Diesel 1.5L" required>
            </div>
            <button class="btn btn-success">Save</button>
            <a href="{{ route('vehicle.variants.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection