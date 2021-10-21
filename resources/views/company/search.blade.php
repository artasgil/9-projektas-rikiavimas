@extends('layouts.app')


@section('content')
<div class="container">
    <form action="{{route('company.search')}}" method="GET">
        @csrf
        <input type="text" name="search" placeholder="Enter search key"/>
        <button type="submit">Search</button>
    </form>
    <table class="table table-striped">
        <tr>
            <th>@sortablelink('id', 'ID')</th>
            <th>@sortablelink('title', 'Title')</th>
            <th>@sortablelink('description', 'Description')</th>
            <th>@sortablelink('type_id', 'Type')</th>
        </tr>
        @foreach ($companies as $company)
            <tr>
                <td> {{$company->id }}</td>
                <td> {{$company->title }}</td>
                <td> {!!$company->description !!}</td>
                <td> {{$company->companyType->title }}</td>
            </tr>
        @endforeach
    </table>

    {!! $companies->appends(Request::except('page'))->render() !!}
</div>
@endsection
