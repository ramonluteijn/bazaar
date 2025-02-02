@extends('layouts.layout')

@section('title', 'Custom Page')

@section('content')
    <div class="container">
        <div class="row">
            <x-profile-menu />
            <div class="col-md-12">
                <h1>Custom Page Creation</h1>
                <p>This is a custom page that you can create for your users.</p>
            </div>
            <form action="{{ route('custom-page.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control">
                    <input type="submit" value="Create" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
