@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <span class="float-left"><strong>{{ $note -> title }}</strong> </span>
        <span class="float-right">
            {{ date('d. m. Y. H:i', strtotime($note -> created_at)) }}&nbsp;&nbsp;&nbsp;
            <a href="{{ route('edit', $note -> id)}}">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-down-right" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8.636 12.5a.5.5 0 0 1-.5.5H1.5A1.5 1.5 0 0 1 0 11.5v-10A1.5 1.5 0 0 1 1.5 0h10A1.5 1.5 0 0 1 13 1.5v6.636a.5.5 0 0 1-1 0V1.5a.5.5 0 0 0-.5-.5h-10a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h6.636a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M16 15.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h3.793L6.146 6.854a.5.5 0 1 1 .708-.708L15 14.293V10.5a.5.5 0 0 1 1 0v5z"/>
            </svg>
            </a>
        </span>
    </div>
    {{-- <div class="card-body"><span class="flex-nowrap"{!! $note -> note !!}</span></div> --}}
    <div class="card-body"><text area rows=8>{!! $note -> note !!}</textarea>
    <div class="card-footer bg-primary text-white">
        <div class="row">
            <div class="col">
                <small>{{ $note -> category -> description }}</small>
            </div>
            <div class="col text-right text-white">
                @foreach($versions as $version)
                <a href="{{ route('version', $version -> id) }}" class="btn btn-sm btn-dark" title="{{ date('d. m. Y. H:i', strtotime($version -> created_at)) }}">
                    {{$version -> version}}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
