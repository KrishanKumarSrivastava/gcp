# Vehicle Data Management

This guide explains how to manage vehicle data and link products to vehicle fitments through the admin interface.

## Overview

The vehicle management system allows administrators to:
- Manage car makes, models, years, and variants
- Link products to specific vehicle fitments
- Enable customers to search products by vehicle compatibility

## Managing Vehicle Data

### 1. Accessing Vehicle Management

Navigate to **Ecommerce > Vehicle Management** in the admin panel. You'll see four main sections:

- **Makes**: Car manufacturers (Toyota, Honda, Ford, etc.)
- **Models**: Car models linked to specific makes
- **Years**: Production years for each model
- **Variants**: Engine/trim variants for each year

### 2. Adding Vehicle Data

#### Adding Makes
1. Go to **Vehicle Management > Makes**
2. Click "Add Make"
3. Enter the manufacturer name (e.g., "Toyota")
4. Enter a URL-friendly slug (e.g., "toyota")
5. Click "Save"

#### Adding Models
1. Go to **Vehicle Management > Models**
2. Click "Add Model"
3. Select the manufacturer from the dropdown
4. Enter the model name (e.g., "Camry")
5. Enter a URL-friendly slug (e.g., "camry")
6. Click "Save"

#### Adding Years
1. Go to **Vehicle Management > Years**
2. Click "Add Year"
3. Select the model from the dropdown (shows as "Make - Model")
4. Enter the production year (e.g., 2020)
5. Click "Save"

#### Adding Variants
1. Go to **Vehicle Management > Variants**
2. Click "Add Variant"
3. Select the year from the dropdown (shows as "Make - Model (Year)")
4. Enter the variant name (e.g., "2.0L Petrol", "Hybrid", "V6")
5. Click "Save"

### 3. Data Hierarchy

The vehicle data follows this hierarchy:
```
Make (Toyota)
  └── Model (Camry)
      └── Year (2020)
          └── Variant (2.0L Petrol)
          └── Variant (Hybrid)
```

## Linking Products to Vehicles

### 1. Adding Vehicle Fitments to Products

When creating or editing a product:

1. Scroll down to the **Vehicle Fitments** section
2. Click "Add Fitment" to add a new vehicle compatibility
3. Select the appropriate values:
   - **Make**: Required - select the car manufacturer
   - **Model**: Optional - select specific model (leave empty for all models)
   - **Year**: Optional - select specific year (leave empty for all years)
   - **Variant**: Optional - select specific variant (leave empty for all variants)
4. Click "Add Fitment" again to add more compatibility options
5. Use the trash icon to remove unwanted fitments
6. Save the product

### 2. Fitment Examples

- **Universal fitment**: Select only Make, leave others empty
- **Model-specific**: Select Make and Model, leave Year and Variant empty
- **Year-specific**: Select Make, Model, and Year, leave Variant empty
- **Exact fitment**: Select all fields for precise compatibility

### 3. Multiple Fitments

Products can have multiple fitments. For example, brake pads might fit:
- Toyota Camry 2018-2020 (all variants)
- Honda Accord 2019-2021 (Petrol only)

Add each compatibility as a separate fitment.

## Customer Experience

### 1. Homepage Search

Customers can use the vehicle search bar on the homepage:

1. Select car make (required)
2. Select model (optional, narrows results)
3. Select year (optional, further narrows results)
4. Select variant (optional, most specific results)
5. Click "Search Parts"

### 2. Search Results

The search will show all products that are compatible with the selected vehicle criteria. Products with broader compatibility (e.g., universal or model-wide fitments) will also appear in specific searches.

## Best Practices

### 1. Data Entry
- Use consistent naming (e.g., always "Toyota" not "toyota" or "TOYOTA")
- Be descriptive with variant names (include engine size, fuel type, etc.)
- Add years incrementally as new model years are released

### 2. Product Fitments
- Start with broader fitments if uncertain about specific compatibility
- Add more specific fitments as you gather more detailed information
- Use manufacturer part numbers in product descriptions for reference

### 3. Maintenance
- Regularly review and update vehicle data for new models/years
- Check for duplicate entries and merge if necessary
- Remove obsolete variants that are no longer relevant

## Troubleshooting

### Common Issues

1. **Dropdown not loading**: Check that parent items are properly selected
2. **Products not appearing in search**: Verify fitments are correctly assigned
3. **Missing vehicle data**: Ensure all required parent items exist (Make > Model > Year > Variant)

### Data Import

For bulk data import, consider:
- Exporting existing data as a template
- Using CSV imports with proper hierarchy
- Testing with small batches before full import

## Support

For technical issues or additional features, contact the development team with:
- Specific error messages
- Steps to reproduce issues
- Screenshots of problems
- Browser and device information