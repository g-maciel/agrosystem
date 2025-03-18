@extends('layouts.app')

@section('title', 'Fazenda')

@section('content')
    <h2 class="mb-4">Fazenda</h2>
    <div class="mb-3">
        <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="kml_file" accept=".kml" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Upload Novo Arquivo KML</button>
        </form>
    </div>
    <div id="map" style="height: 500px; width: 100%; border: 1px solid #ccc;"></div>
    <select class="form-select mt-3" id="kmlSelect">
        @foreach ($kmlFiles as $file)
            <option value="{{ asset('kml_files/' . $file->file_name) }}">{{ $file->file_name }}</option>
        @endforeach
    </select>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-kml@1.0.1/dist/leaflet-kml.min.js"></script>
    
@endsection