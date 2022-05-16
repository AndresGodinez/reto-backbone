@extends('layouts.app')
@section('content')
    <form action="{{route('process-file')}}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file"/>
        <button type="submit">Import Data</button>
    </form>

@endsection
