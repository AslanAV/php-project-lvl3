@extends('layouts.layout')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайты</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Имя</td>
                    <td>Последняя проверка</td>
                    <td>Код ответа</td>
                </tr>
                </thead>
                <tbody>
                @foreach($urls as $url)
                    <tr>
                        <td>{{$url->id}}</td>
                        <td>{{$url->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
    </div>
@endsection
