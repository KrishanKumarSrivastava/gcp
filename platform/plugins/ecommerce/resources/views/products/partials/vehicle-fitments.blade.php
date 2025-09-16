<div class="vehicle-fitments-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Vehicle Fitments</h6>
        <button type="button" class="btn btn-sm btn-success" id="add-vehicle-fitment">
            <i class="fa fa-plus"></i> Add Fitment
        </button>
    </div>
    
    <div id="vehicle-fitments-list">
        @if($existingFitments && $existingFitments->count() > 0)
            @foreach($existingFitments as $index => $fitment)
                <div class="vehicle-fitment-row mb-3 p-3 border rounded" data-index="{{ $index }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Make</label>
                            <select name="vehicle_fitments[{{ $index }}][make_id]" class="form-control vehicle-make-select" data-index="{{ $index }}" required>
                                <option value="">Select Make</option>
                                @foreach($makes as $id => $name)
                                    <option value="{{ $id }}" {{ $fitment->make_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Model</label>
                            <select name="vehicle_fitments[{{ $index }}][model_id]" class="form-control vehicle-model-select" data-index="{{ $index }}">
                                <option value="">Select Model</option>
                                @if($fitment->model)
                                    <option value="{{ $fitment->model->id }}" selected>{{ $fitment->model->name }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Year</label>
                            <select name="vehicle_fitments[{{ $index }}][year_id]" class="form-control vehicle-year-select" data-index="{{ $index }}">
                                <option value="">Select Year</option>
                                @if($fitment->year)
                                    <option value="{{ $fitment->year->id }}" selected>{{ $fitment->year->year }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Variant</label>
                            <select name="vehicle_fitments[{{ $index }}][variant_id]" class="form-control vehicle-variant-select" data-index="{{ $index }}">
                                <option value="">Select Variant</option>
                                @if($fitment->variant)
                                    <option value="{{ $fitment->variant->id }}" selected>{{ $fitment->variant->name }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-sm btn-danger d-block remove-vehicle-fitment">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">
                No vehicle fitments added yet. Click "Add Fitment" to add vehicle compatibility for this product.
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let fitmentIndex = {{ $existingFitments ? $existingFitments->count() : 0 }};
    
    // Add new fitment row
    document.getElementById('add-vehicle-fitment').addEventListener('click', function() {
        const container = document.getElementById('vehicle-fitments-list');
        
        // Remove the "no fitments" alert if present
        const alert = container.querySelector('.alert-info');
        if (alert) {
            alert.remove();
        }
        
        const newRow = document.createElement('div');
        newRow.className = 'vehicle-fitment-row mb-3 p-3 border rounded';
        newRow.setAttribute('data-index', fitmentIndex);
        newRow.innerHTML = `
            <div class="row">
                <div class="col-md-3">
                    <label>Make</label>
                    <select name="vehicle_fitments[${fitmentIndex}][make_id]" class="form-control vehicle-make-select" data-index="${fitmentIndex}" required>
                        <option value="">Select Make</option>
                        @foreach($makes as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Model</label>
                    <select name="vehicle_fitments[${fitmentIndex}][model_id]" class="form-control vehicle-model-select" data-index="${fitmentIndex}">
                        <option value="">Select Model</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Year</label>
                    <select name="vehicle_fitments[${fitmentIndex}][year_id]" class="form-control vehicle-year-select" data-index="${fitmentIndex}">
                        <option value="">Select Year</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Variant</label>
                    <select name="vehicle_fitments[${fitmentIndex}][variant_id]" class="form-control vehicle-variant-select" data-index="${fitmentIndex}">
                        <option value="">Select Variant</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-sm btn-danger d-block remove-vehicle-fitment">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        
        container.appendChild(newRow);
        fitmentIndex++;
        
        // Attach event listeners to the new elements
        attachFitmentListeners(newRow);
    });
    
    // Remove fitment row
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-vehicle-fitment') || e.target.parentNode.classList.contains('remove-vehicle-fitment')) {
            e.preventDefault();
            const row = e.target.closest('.vehicle-fitment-row');
            row.remove();
            
            // If no rows left, show the info message
            const container = document.getElementById('vehicle-fitments-list');
            if (container.children.length === 0) {
                container.innerHTML = '<div class="alert alert-info">No vehicle fitments added yet. Click "Add Fitment" to add vehicle compatibility for this product.</div>';
            }
        }
    });
    
    // Attach listeners to existing rows
    document.querySelectorAll('.vehicle-fitment-row').forEach(row => {
        attachFitmentListeners(row);
    });
    
    function attachFitmentListeners(row) {
        const makeSelect = row.querySelector('.vehicle-make-select');
        const modelSelect = row.querySelector('.vehicle-model-select');
        const yearSelect = row.querySelector('.vehicle-year-select');
        const variantSelect = row.querySelector('.vehicle-variant-select');
        
        // Make change event
        makeSelect.addEventListener('change', function() {
            const makeId = this.value;
            modelSelect.innerHTML = '<option value="">Select Model</option>';
            yearSelect.innerHTML = '<option value="">Select Year</option>';
            variantSelect.innerHTML = '<option value="">Select Variant</option>';
            
            if (makeId) {
                fetch(`/admin/ajax/vehicle/models?make_id=${makeId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            data.data.forEach(model => {
                                const option = document.createElement('option');
                                option.value = model.id;
                                option.textContent = model.name;
                                modelSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error loading models:', error));
            }
        });
        
        // Model change event
        modelSelect.addEventListener('change', function() {
            const modelId = this.value;
            yearSelect.innerHTML = '<option value="">Select Year</option>';
            variantSelect.innerHTML = '<option value="">Select Variant</option>';
            
            if (modelId) {
                fetch(`/admin/ajax/vehicle/years?model_id=${modelId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            data.data.forEach(year => {
                                const option = document.createElement('option');
                                option.value = year.id;
                                option.textContent = year.year;
                                yearSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error loading years:', error));
            }
        });
        
        // Year change event  
        yearSelect.addEventListener('change', function() {
            const yearId = this.value;
            variantSelect.innerHTML = '<option value="">Select Variant</option>';
            
            if (yearId) {
                fetch(`/admin/ajax/vehicle/variants?year_id=${yearId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data) {
                            data.data.forEach(variant => {
                                const option = document.createElement('option');
                                option.value = variant.id;
                                option.textContent = variant.name;
                                variantSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error loading variants:', error));
            }
        });
    }
});
</script>