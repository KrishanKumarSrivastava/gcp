# Car Search Bar Feature

## Overview
A cascading dropdown search bar for car Make, Model, Year, and Modification that has been integrated into the Martfury Laravel theme homepage.

## Features
- ✅ Cascading dropdowns with AJAX loading
- ✅ Responsive design (mobile-friendly)
- ✅ Modern styling with purple gradient background
- ✅ Error handling and loading states
- ✅ Integration with existing Botble CMS structure

## Database Structure
The feature uses the existing database tables:
- `makes` - Car manufacturers (Toyota, Honda, Ford, etc.)
- `models` - Car models linked to makes
- `years` - Car years linked to models  
- `variants` - Car modifications/variants linked to years

## Files Added/Modified

### Controllers
- `platform/themes/martfury/src/Http/Controllers/CarSearchController.php` - AJAX endpoints for cascading data

### Routes
- `platform/themes/martfury/routes/web.php` - Added car search routes

### Views
- `platform/themes/martfury/partials/car-search-bar.blade.php` - The search bar component
- `platform/themes/martfury/layouts/homepage.blade.php` - Updated to include search bar

### Database
- `database/seeders/CarDataSeeder.php` - Sample data for testing

## API Endpoints
- `GET /ajax/car-search/models?make_id={id}` - Get models for a make
- `GET /ajax/car-search/years?model_id={id}` - Get years for a model  
- `GET /ajax/car-search/variants?year_id={id}` - Get variants for a year

## Usage

### For Developers
1. The search bar automatically appears on the homepage
2. Make sure to run the CarDataSeeder to populate sample data
3. The search form submits to the products page with car filter parameters

### For End Users
1. Select a car make from the first dropdown
2. The model dropdown will populate automatically
3. Select a model to populate the year dropdown
4. Select a year to populate the modification dropdown
5. Click "Search Parts" to find relevant products

## Customization

### Styling
The search bar styles are included in the partial file. Key CSS classes:
- `.car-search-bar` - Main container with gradient background
- `.search-fields-row` - Flex container for form fields
- `.car-search-select` - Dropdown styling
- `.car-search-btn` - Search button styling

### Adding More Data
1. Add more entries to the `makes` table
2. Link models to makes in the `models` table
3. Link years to models in the `years` table
4. Link variants to years in the `variants` table

### Modifying Search Behavior
Update the form action in `car-search-bar.blade.php` to point to your desired search results page.

## Testing
The feature has been tested with:
- Cascading dropdown functionality
- Mobile responsive design
- Error handling
- Loading states

## Screenshots
- Desktop view: ![Desktop](https://github.com/user-attachments/assets/4b0a2769-6296-4991-bf46-a87cbf97ba3c)
- Mobile view: ![Mobile](https://github.com/user-attachments/assets/f537552b-4904-44bb-a72f-22c1a7653596)
- Populated dropdowns: ![Populated](https://github.com/user-attachments/assets/5f941db7-705f-4634-8819-ad7dbffad622)