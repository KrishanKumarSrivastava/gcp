@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h4>Car Variants</h4>
            <a href="{{ route('vehicle.variants.create') }}" class="btn btn-primary">+ Add Variant</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Variant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($variants as $variant)
                    <tr>
                        <td>{{ $variant->id }}</td>
                        <td>{{ $variant->year->model->make->name }}</td>
                        <td>{{ $variant->year->model->name }}</td>
                        <td>{{ $variant->year->year }}</td>
                        <td>{{ $variant->name }}</td>
                        <td>
                            <a href="{{ route('vehicle.variants.edit', $variant->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('vehicle.variants.destroy', $variant->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this variant?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection