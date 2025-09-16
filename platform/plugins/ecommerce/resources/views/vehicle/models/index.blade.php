@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h4>Car Models</h4>
            <a href="{{ route('vehicle.models.create') }}" class="btn btn-primary">+ Add Model</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->make->name }}</td>
                        <td>{{ $model->name }}</td>
                        <td>{{ $model->slug }}</td>
                        <td>
                            <a href="{{ route('vehicle.models.edit', $model->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('vehicle.models.destroy', $model->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this model?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection