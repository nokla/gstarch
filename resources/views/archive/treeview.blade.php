@extends('layouts.psd')

@section('title')
    {{ __('Multiple uploads') }}
@endsection
@section('main')
<ul>
    @foreach ($tree as $key => $value)
        <li>
            {{ $key }}
            @if (count($value))
                @include('archive.treeview', ['tree' => $value])
            @endif
        </li>
    @endforeach
    </ul>

@endsection
