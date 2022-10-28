<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIS-Suporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
        <h1>Usuários</h1>
        <hr>

        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#NovoUser">
            <i class="bi bi-person-plus-fill"></i> Novo usuário
        </button>
        @include('usuarios.ModalNovo')
        <hr>

        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>MATRICULA</th>
                    <th>CPF</th>
                    <th>FUNÇÃO</th>
                    <th>E-MAIL</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($usuarios as $user)
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->matricula ?? 'Não informado' }}</td>
                        <td>{{ $user->cpf ?? 'Não informado' }}</td>
                        <td>{{ $user->funcao ?? 'Não informado' }}</td>
                        <td>{{ $user->email ?? 'Não informado' }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                data-bs-target="#EditarUser{{ $user->id }}">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            @include('usuarios.ModalEditar')

                        </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                 "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
             }
        });
    });
</script>

<script>
    function validarSenha() {
        NovaSenha = document.getElementById('NovaSenha').value;
        CNovaSenha = document.getElementById('CNovaSenha').value;
        if (NovaSenha != CNovaSenha) {
            alert("AS SENHAS NÃO SÃO IGUAIS");
            return false;
        }
        return true;
    }
</script>
<script>
    function ConfirmarSenha() {
        NovaSenha1 = document.getElementById('senha').value;
        CNovaSenha1 = document.getElementById('confirmarsenha').value;
        if (NovaSenha1 != CNovaSenha1) {
            alert("AS SENHAS NÃO SÃO IGUAIS");
            return false;
        }
        return true;
    }
</script>

</html>
