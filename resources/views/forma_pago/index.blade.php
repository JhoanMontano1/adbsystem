@include('componentes.header')
<h1 style="text-align: center;">Formas de pago</h1>

<div class="container">
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert_dismissible" role="alert">

        {{Session::get('mensaje')}}

    </div>
    @endif
    @if(Session::has('mensaje2'))
    <div class="alert alert-danger alert_dismissible" role="alert">

        {{Session::get('mensaje2')}}

    </div>
    @endif
    @if (Auth::user()->type==1)
     <form action="{{url('/report')}}" method="get" class="btn btn-primary">
        <input type="hidden" name="context" value="forma_pago">
        <input type="submit" value="     Reporte" class="btn-primary" id="reporte">
    </form>   
    @endif

    <a href="{{url('forma_pago/create')}}" class="btn btn-success">Nueva forma de pago</a>
    <br>
    <br>
    <form action="{{url('/searchForPag')}}" method="get">
        <div class="input-group">
            <input type="search" class="form-control rounded" name="search" required placeholder="Buscar"
                aria-label="Search" aria-describedby="search-addon" />
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </div>
    </form>
    <br />
    <br />
    <div class="table-responsive">
        <table class="table">
            <thead class="">
                <tr>
                    <th>#</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forma_pago as $formas)
                <tr>
                    <td>{{ $formas->id}}</td>
                    <td>{{ $formas->tipo}}</td>
                    @if (Auth::user()->type==1)
                    <td>
                        <div class="d-flex">
                        <button class="btn btn-warning btn-sm mb-1">
                            <a href="{{url('/forma_pago/'.$formas->id.'/edit')}}">
                                <img class="icon" src="{{asset('img/nuevoEditar.svg')}}" alt="" srcset="">
                            </a>
                        </button>
                        <p></p>
                        <form action="{{ url('/forma_pago/'.$formas->id) }}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('Seguro,¿Qué quieres eliminar está forma de pago?')"
                                class="btn btn-danger btn-sm">
                                <img class="icon" src="{{asset('img/nuevoEliminar.svg')}}" alt="" srcset="">
                            </button>
                        </form>
                        </div>

                    </td>
                    @endif

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>
{{$forma_pago->links()}}
@include('componentes.footer')