{{--@extends('components.layout')--}}
{{--@section('content')--}}
{{--    <?php $numbers = 10; ?>--}}
{{--    @for($i = 0; $i <= $numbers; $i++)--}}
{{--        <p>The number is {{ $i }}</p>--}}
{{--    @endfor--}}
{{--@endsection--}}

<x-layout>
    <x-slot name="title">
        <p>Hello again</p>
    </x-slot>
    <x-slot name="content">
        <h1>Wellcum</h1>
        <h2>Wellcum</h2>
        <p>Wellcum</p>
    </x-slot>
</x-layout>
