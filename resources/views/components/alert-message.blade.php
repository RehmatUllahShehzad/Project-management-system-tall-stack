@php

$class = null;
$title = null;
$message = null;
if (has_flash('success')):
    $class = 'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4';
    $title = 'Success';
    $message = flash('success');
endif;

if (has_flash('error')):
    $class = 'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4';
    $title = 'Error';
    $message = flash('error');
endif;

if (has_flash('warning')):
    $class = 'bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-4';
    $title = 'Warning';
    $message = flash('warning');
endif;

if (has_flash('info')):
    $class = 'bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4';
    $title = 'Info';
    $message = flash('info');
endif;

@endphp

@props(['role' => 'alert'])

@if ($message)
    <div {{ $attributes->merge(['class' => $class]) }}>
        <p class="font-bold">{{ $title }}</p>
        <p>{{ $message }}</p>
    </div>
@endif
