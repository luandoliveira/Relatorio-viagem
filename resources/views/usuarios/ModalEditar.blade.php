<!-- Modal -->
<div class="modal fade" id="EditarUser{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-controll" action="{{ route('usuarios.update', $user->id) }}" method="post" onsubmit="return validarSenha();">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="">Nome</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="col">
                            <label for="">Matrícula</label>
                            <input type="text" class="form-control" name="matricula" value="{{ $user->matricula }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">Senha</label>
                            <input type="password" class="form-control" name="password" id="NovaSenha">
                        </div>
                        <div class="col">
                            <label for="">Confirmar senha</label>
                            <input type="password" class="form-control" name="confirm_password" id="CNovaSenha">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="">CPF</label>
                            <input type="text" class="form-control" name="cpf" value="{{ $user->cpf }}">
                        </div>
                        <div class="col">
                            <label for="">Função</label>
                            <select type="text" class="form-control" name="funcao">
                                <option value="{{ $user->funcao }}">{{ $user->funcao ?? 'Selecione...' }}</option>
                                <option value="Técnico em informática">Técnico em informática</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <label for="">E-mail</label>
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>

        </div>
    </div>
</div>
