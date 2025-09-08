@extends('layouts.main')
@section('main-section')

<livewire:shop.spare-part-quote-submission :requestId="$requestId" :shopId="$shopId" />

@endsection
