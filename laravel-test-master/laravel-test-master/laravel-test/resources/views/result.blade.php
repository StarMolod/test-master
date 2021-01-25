@extends('layout.base')

@section('content')
    <div class="container">
        @include('partial.search', [
            'searchString'=>$searchString
        ])

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Порядковый номер</th>
                        <th scope="col">Ссылка на страницу сайта, на которой найдено поисковое слово</th>
                        <th scope="col">Найденное поисковое слово</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                      $n = 1;
                    @endphp

                    @foreach($items as $item)
                        <tr>
                            <th scope="row">{{$n}}</th>
                            <td><a href="{{$item['link']}}">{{$item['link']}}</a></td>
                            <td>{{implode(', ' , $item['words'])}}</td>

                            @php
                                $n++;
                            @endphp
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
