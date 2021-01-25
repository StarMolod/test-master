@extends('layout.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group" id="adv-search">
                    <a href="{{route('index')}}">Назад к поиску</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <ul class="list-group">
                    @php
                      $n = 1;
                    @endphp

                    @foreach($items as $item)
                            <li class="list-group-item">
                                <a href="{{route('history-row', ['id'=>$item->id])}}">
                                    {{$n}}. {{$item->key}} {{$item->created_at->format('d.m.Y')}} {{$item->created_at->format('H:i:s')}}
                                </a>
                            </li>

                        @php
                            $n++;
                        @endphp
                        </tr>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
