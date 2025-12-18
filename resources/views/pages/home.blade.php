@extends('layouts.app')

@section('content')
<div class="page-home">
    <x-sidebar />

    <main class="main-content">
        <x-header />

        <section class="book-grid">
            @for ($i = 0; $i < 8; $i++)
                <x-book-card />
            @endfor
        </section>
    </main>
</div>
@endsection
