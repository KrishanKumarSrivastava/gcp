@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <h4>Edit Car Variant</h4>
        <form action="{{ route('vehicle.variants.update', $variant->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label>Year</label>
                <select name="year_id" class="form-control" required>
                    <option value="">Select Year</option>
                    @foreach($years as $id => $display)
                        <option value="{{ $id }}" {{ $variant->year_id == $id ? 'selected' : '' }}>{{ $display }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Variant Name</label>
                <input type="text" name="name" value="{{ $variant->name }}" class="form-control" placeholder="e.g., Petrol 1.2L, Diesel 1.5L" required>
            </div>
            <button class="btn btn-success">Update</button>
            <a href="{{ route('vehicle.variants.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection