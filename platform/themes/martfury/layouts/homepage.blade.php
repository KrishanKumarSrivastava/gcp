{!! Theme::partial('header') !!}

@php
    // Fetch car makes for the search bar
    $carMakes = \Botble\Ecommerce\Models\Make::orderBy('name')->get(['id', 'name']);
@endphp

{!! Theme::partial('car-search-bar', compact('carMakes')) !!}

<div id="homepage-1">
    {!! Theme::content() !!}
</div>

{!! Theme::partial('footer') !!}
