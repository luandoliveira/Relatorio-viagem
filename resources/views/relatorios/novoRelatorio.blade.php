<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIS-Suporte</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <!-- select com busca -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- select com busca -->
    {{-- MultiSelect Configuração --}}
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/pt-BR.min.js"
        integrity="sha512-H1yBoUnrE7X+NeWpeZvBuy2RvrbvLEAEjX/Mu8L2ggUBja62g1z49fAboGidE5YEQyIVMCWJC9krY4/KEqkgag=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIS-Suporte</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('usuarios.index') }}">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('relatorios.index') }}">Relatórios</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        Sair
                                    </x-dropdown-link>
                                </form>
                            </ul>
                        </li>
                    </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <h1 class="text-center">Novo Relatório</h1>
        <hr>

        <form class="form-controll" action="{{ route('relatorios.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h3>IDENTIFICAÇÃO</h3>
            <hr>
            <div class="row g-3">
                <div class="col">
                    <label for="">Responsável</label>
                    <input type="text" class="form-control" name="responsavel" value="{{ auth()->user()->name }}"
                        readonly>
                        <input type="number" value="{{auth()->user()->id}}" name="id_user" hidden>
                </div>
                <div class="col">
                    <label for="">Função</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->funcao }}" readonly>
                </div>
            </div>
            <div class="row g-3">
                <div class="col">
                    <label for="">Data da ida</label>
                    <input type="date" class="form-control" name="ida">
                </div>
                <div class="col">
                    <label for="">Data da volta</label>
                    <input type="date" class="form-control" name="volta">
                </div>
            </div>
            <div class="">
                <div class="">
                    <label for="">Escolas</label>
                    <select id="escolas" class="form-control" name="escolas[]" multiple="multiple">
                        @foreach ($escolas as $escola)
                        <option value="{{$escola->cod_escola}}">{{$escola->escola}} - ({{$escola->municipio}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label for="">Municipios</label>
                    <select name="municipios[]" id="municipios" multiple="multiple" class="form-control">
                        @foreach ($municipios as $municipio)
                            <option value="{{ $municipio->municipio }}">{{ $municipio->municipio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>
            <h3>DEMANDA/MOTIVAÇÃO DA VIAGEM</h3>
            <hr>
            <div class="row g-3">
                <div class="col">
                    <label for="">Tipo de Demanda</label>
                    <select id="opcao" name="tipo_demanda" class="form-control" onchange="selecao()">
                        <option value="0">Selecione...</option>
                        <option value="PEDIDO">A PEDIDO</option>
                        <option value="OFICIO">DE OFÍCIO</option>
                    </select>
                </div>
                {{-- PARA A PEDIDO --}}
                <div class="col" id="pedido" style="display: none;">
                    <label for="">Motivação</label>
                    <select name="pedido" id="" class="form-control">
                        <option value="">Selecione...</option>
                        <option value="DETERMINAÇÃO JUDICIAL">DETERMINAÇÃO JUDICIAL</option>
                        <option value="ÓRGÃO DE CONTROLE">ÓRGÃO DE CONTROLE</option>
                        <option value="DENÚNCIA INFORMAL">DENÚNCIA INFORMAL</option>
                        <option value="DENÚNCIA FORMAL">DENÚNCIA FORMAL</option>
                        <option value="OUTRO">OUTRO</option>
                    </select>
                </div>
                {{-- PARA A PEDIDO --}}
                {{-- PARA DE OFICIO --}}
                <div class="col" id="oficio" style="display: none;">
                    <label for="">Motivação</label>
                    <select name="oficio" id="" class="form-control">
                        <option value="">Selecione...</option>
                        <option value="INAUGURAÇÃO DE ESCOLA">INAUGURAÇÃO DE ESCOLA</option>
                        <option value="INSTALAÇÃO DE NOVOS EQUIPAMENTOS">INSTALAÇÃO DE NOVOS EQUIPAMENTOS</option>
                        <option value="MANUTENÇÃO">MANUTENÇÃO</option>
                        <option value="OUTRO">OUTRO</option>
                    </select>
                </div>
                {{-- PARA DE OFICIO --}}
                <hr>
                <h3>OBJETIVO</h3>
                <hr>
                <div class="col">
                    <label for="">Descreva o objetivo da viagem:</label>
                    <textarea class="form-control" name="objetivo" id="" cols="30" rows="10"></textarea>
                </div>

                <hr>

                <h3>COMPROVANTE DE EMBARQUE</h3>
                <hr>
                <div class="col">
                    <label for="">Comprovante de embarque</label>
                    <input type="file" name="embarque" class="form-control">
                </div>

                <hr>
                <h3>RELATÓRIO DA VISITA TÉCNICA</h3>
                <hr>
                <div class="col">
                    <label for="">Descreva a visita técnica:</label>
                    <textarea class="form-control" name="relatorio" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Evidência 1</label>
                        <input type="file" class="form-control" name="evidencia1">
                    </div>
                    <div class="col">
                        <label for="">Evidência 2</label>
                        <input type="file" class="form-control" name="evidencia2">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Evidência 3</label>
                        <input type="file" class="form-control" name="evidencia3">
                    </div>
                    <div class="col">
                        <label for="">Evidência 4</label>
                        <input type="file" class="form-control" name="evidencia4">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Evidência 5</label>
                        <input type="file" class="form-control" name="evidencia5">
                    </div>
                    <div class="col">
                        <label for="">Evidência 6</label>
                        <input type="file" class="form-control" name="evidencia6">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Evidência 7</label>
                        <input type="file" class="form-control" name="evidencia7">
                    </div>
                    <div class="col">
                        <label for="">Evidência 8</label>
                        <input type="file" class="form-control" name="evidencia8">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Evidência 9</label>
                        <input type="file" class="form-control" name="evidencia9">
                    </div>
                    <div class="col">
                        <label for="">Evidência 10</label>
                        <input type="file" class="form-control" name="evidencia10">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label for="">Evidência 11</label>
                        <input type="file" class="form-control" name="evidencia11">
                    </div>
                    <div class="col">
                        <label for="">Evidência 12</label>
                        <input type="file" class="form-control"name="evidencia12">
                    </div>
                </div>
                <div class="col">
                    <label for="">Observações:</label>
                    <textarea class="form-control" name="observacao" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <hr>
            <div class="">
                <button type="submit" class="btn btn-outline-dark">Salvar</button>
            </div>


        </form>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('#escolas').select2({
            placeholder: 'Selecione...',
            language: "pt-BR",
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#municipios').select2({
            placeholder: 'Selecione...',
            language: "pt-BR",
        });
    });
</script>

<script>
    function selecao() {
        var select = document.getElementById("opcao");
        var pedido = document.getElementById("pedido");
        var oficio = document.getElementById("oficio");
        var opcao = select.options[select.selectedIndex].value;
        console.log(opcao);
        if (opcao == "PEDIDO") {
            pedido.style.display = 'block';
            oficio.style.display = 'none';
        } else {
            pedido.style.display = 'none';
            oficio.style.display = 'block';
        }
    }
</script>


</html>
