@extends('layouts.main')
@section('main-section')

  <livewire:web.loan-application  :vehicleId="$vehicleId" :lenderId="$lenderId" />

@endsection