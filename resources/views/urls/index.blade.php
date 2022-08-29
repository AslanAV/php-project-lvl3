@extends('layouts.layout')

@section('content')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайты</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap"
                       style="line-height: 18px;">
                <thead style="font-weight: bold;">
                <tr>
                    <td>ID</td>
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
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    {{ $urls->links() }}
</div>
</div>
@endsection
