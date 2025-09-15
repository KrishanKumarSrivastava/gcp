<div class="car-search-bar">
    <div class="container">
        <div class="car-search-wrapper">
            <h3 class="search-title">{{ __('Find Your Perfect Car Parts') }}</h3>
            <form class="car-search-form" action="{{ route('public.products') }}" method="get">
                <div class="search-fields-row">
                    <div class="search-field">
                        <label for="car_make">{{ __('Make') }}</label>
                        <select id="car_make" name="car_make" class="form-control car-search-select" data-placeholder="{{ __('Select Make') }}">
                            <option value="">{{ __('Select Make') }}</option>
                            @if(isset($carMakes) && $carMakes->count())
                                @foreach($carMakes as $make)
                                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="search-field">
                        <label for="car_model">{{ __('Model') }}</label>
                        <select id="car_model" name="car_model" class="form-control car-search-select" data-placeholder="{{ __('Select Model') }}" disabled>
                            <option value="">{{ __('Select Model') }}</option>
                        </select>
                    </div>
                    
                    <div class="search-field">
                        <label for="car_year">{{ __('Year') }}</label>
                        <select id="car_year" name="car_year" class="form-control car-search-select" data-placeholder="{{ __('Select Year') }}" disabled>
                            <option value="">{{ __('Select Year') }}</option>
                        </select>
                    </div>
                    
                    <div class="search-field">
                        <label for="car_variant">{{ __('Modification') }}</label>
                        <select id="car_variant" name="car_variant" class="form-control car-search-select" data-placeholder="{{ __('Select Modification') }}" disabled>
                            <option value="">{{ __('Select Modification') }}</option>
                        </select>
                    </div>
                    
                    <div class="search-field search-button-field">
                        <button type="submit" class="btn btn-primary car-search-btn">
                            <i class="icon-search"></i>
                            {{ __('Search Parts') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.car-search-bar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 30px 0;
    margin-bottom: 30px;
}

.car-search-wrapper {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.search-title {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
    font-weight: 600;
    font-size: 24px;
}

.search-fields-row {
    display: flex;
    gap: 15px;
    align-items: end;
    flex-wrap: wrap;
}

.search-field {
    flex: 1;
    min-width: 180px;
}

.search-field label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #555;
    font-size: 14px;
}

.car-search-select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e1e5e9;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #fff;
}

.car-search-select:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.car-search-select:disabled {
    background-color: #f8f9fa;
    cursor: not-allowed;
    color: #999;
}

.search-button-field {
    flex: 0 0 auto;
}

.car-search-btn {
    padding: 12px 25px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 6px;
    color: white;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 46px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.car-search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

@media (max-width: 768px) {
    .search-fields-row {
        flex-direction: column;
    }
    
    .search-field {
        min-width: 100%;
    }
    
    .search-title {
        font-size: 20px;
    }
    
    .car-search-wrapper {
        padding: 20px;
        margin: 0 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const makeSelect = document.getElementById('car_make');
    const modelSelect = document.getElementById('car_model');
    const yearSelect = document.getElementById('car_year');
    const variantSelect = document.getElementById('car_variant');
    
    // Base URL for AJAX requests
    const baseUrl = '{{ url('/') }}';
    
    function resetSelect(select, placeholder) {
        select.innerHTML = `<option value="">${placeholder}</option>`;
        select.disabled = true;
    }
    
    function enableSelect(select) {
        select.disabled = false;
    }
    
    function showLoading(select) {
        const originalHTML = select.innerHTML;
        select.innerHTML = '<option value="">Loading...</option>';
        return originalHTML;
    }
    
    function hideLoading(select, originalHTML) {
        select.innerHTML = originalHTML;
    }
    
    // Make selection change
    makeSelect.addEventListener('change', function() {
        const makeId = this.value;
        
        // Reset dependent dropdowns
        resetSelect(modelSelect, '{{ __("Select Model") }}');
        resetSelect(yearSelect, '{{ __("Select Year") }}');
        resetSelect(variantSelect, '{{ __("Select Modification") }}');
        
        if (!makeId) return;
        
        // Show loading state
        const originalHTML = showLoading(modelSelect);
        
        // Fetch models
        fetch(`${baseUrl}/ajax/car-search/models?make_id=${makeId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideLoading(modelSelect, originalHTML);
            
            if (data.error) {
                console.error('Server error:', data.message);
                return;
            }
            
            if (data.data && data.data.length > 0) {
                modelSelect.innerHTML = '<option value="">{{ __("Select Model") }}</option>';
                data.data.forEach(model => {
                    modelSelect.innerHTML += `<option value="${model.id}">${model.name}</option>`;
                });
                enableSelect(modelSelect);
            }
        })
        .catch(error => {
            console.error('Error fetching models:', error);
            hideLoading(modelSelect, originalHTML);
        });
    });
    
    // Model selection change
    modelSelect.addEventListener('change', function() {
        const modelId = this.value;
        
        // Reset dependent dropdowns
        resetSelect(yearSelect, '{{ __("Select Year") }}');
        resetSelect(variantSelect, '{{ __("Select Modification") }}');
        
        if (!modelId) return;
        
        // Show loading state
        const originalHTML = showLoading(yearSelect);
        
        // Fetch years
        fetch(`${baseUrl}/ajax/car-search/years?model_id=${modelId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideLoading(yearSelect, originalHTML);
            
            if (data.error) {
                console.error('Server error:', data.message);
                return;
            }
            
            if (data.data && data.data.length > 0) {
                yearSelect.innerHTML = '<option value="">{{ __("Select Year") }}</option>';
                data.data.forEach(year => {
                    yearSelect.innerHTML += `<option value="${year.id}">${year.year}</option>`;
                });
                enableSelect(yearSelect);
            }
        })
        .catch(error => {
            console.error('Error fetching years:', error);
            hideLoading(yearSelect, originalHTML);
        });
    });
    
    // Year selection change
    yearSelect.addEventListener('change', function() {
        const yearId = this.value;
        
        // Reset dependent dropdown
        resetSelect(variantSelect, '{{ __("Select Modification") }}');
        
        if (!yearId) return;
        
        // Show loading state
        const originalHTML = showLoading(variantSelect);
        
        // Fetch variants
        fetch(`${baseUrl}/ajax/car-search/variants?year_id=${yearId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideLoading(variantSelect, originalHTML);
            
            if (data.error) {
                console.error('Server error:', data.message);
                return;
            }
            
            if (data.data && data.data.length > 0) {
                variantSelect.innerHTML = '<option value="">{{ __("Select Modification") }}</option>';
                data.data.forEach(variant => {
                    variantSelect.innerHTML += `<option value="${variant.id}">${variant.name}</option>`;
                });
                enableSelect(variantSelect);
            }
        })
        .catch(error => {
            console.error('Error fetching variants:', error);
            hideLoading(variantSelect, originalHTML);
        });
    });
});
</script>