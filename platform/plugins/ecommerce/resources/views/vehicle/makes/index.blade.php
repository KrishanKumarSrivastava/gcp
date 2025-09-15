@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h4>Makes</h4>
            <a href="{{ route('vehicle.makes.create') }}" class="btn btn-primary">+ Add Make</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($makes as $make)
                    <tr>
                        <td>{{ $make->id }}</td>
                        <td>{{ $make->name }}</td>
                        <td>{{ $make->slug }}</td>
                        <td>
                            <a href="{{ route('vehicle.makes.edit', $make->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('vehicle.makes.destroy', $make->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this make?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
