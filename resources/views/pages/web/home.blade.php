@extends('layouts.main')

@section('title', 'KiboAuto - Tanzania\'s Premier Vehicle Marketplace | Buy & Sell Cars Online')
@section('description', 'Find your perfect vehicle on KiboAuto, Tanzania\'s leading car marketplace. Browse thousands of quality cars, SUVs, and trucks from verified dealers. Secure transactions, expert support, and the best deals guaranteed.')
@section('keywords', 'cars Tanzania, vehicles Tanzania, car marketplace, buy cars online, sell cars, Toyota Tanzania, Honda Tanzania, SUVs Tanzania, car dealers Tanzania, automotive Tanzania, used cars Tanzania, new cars Tanzania')

@section('og_title', 'KiboAuto - Tanzania\'s Premier Vehicle Marketplace')
@section('og_description', 'Find your perfect vehicle on KiboAuto, Tanzania\'s leading car marketplace. Browse thousands of quality cars, SUVs, and trucks from verified dealers.')
@section('og_image', asset('cars/66815.jpg'))

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "KiboAuto",
  "url": "https://kiboauto.co.tz",
  "description": "Tanzania's premier vehicle marketplace for buying and selling cars, SUVs, and trucks",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://kiboauto.co.tz/vehicle/list?search={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "KiboAuto",
  "url": "https://kiboauto.co.tz",
  "logo": "https://kiboauto.co.tz/InstitutionLogo/carLogo.png",
  "description": "Tanzania's leading online vehicle marketplace connecting buyers with verified car dealers",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "TZ",
    "addressRegion": "Dar es Salaam"
  },
  "sameAs": [
    "https://kiboauto.co.tz"
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Featured Vehicles in Tanzania",
  "description": "Handpicked selection of premium cars, SUVs, and trucks available on KiboAuto",
  "url": "https://kiboauto.co.tz/welcome"
}
</script>
@endsection

@section('main-section')
  <livewire:web.home-page />
@endsection