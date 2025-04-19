@extends('layouts.app')

@section('content')
<h2>Fasilitas Hotel</h2>
<ul>
    @foreach ($facilities as $facility)
        <li><strong>{{ $facility->facility_name }}</strong> - {{ $facility->description }}</li>
    @endforeach
</ul>
@endsection
