<form method="GET" action="{{route('search')}}">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group" id="adv-search">

                <input type="text" name="q" class="form-control" placeholder="Поиск" value="{{$searchString ?? ''}}" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="submit" class="btn btn-default" aria-expanded="false">
                                Поиск</button>
                            <a href="{{route('history')}}" type="button" class="btn btn-default" aria-expanded="false">
                                История</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
