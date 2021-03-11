@extends('layouts.app')
@section('content')
    <section class="container-fluid updateUserForm">

        <div class=" container-fluid form-title">
            <h1>Atualização de cadastro</h1>
        </div>

       

        @if ($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <li>{{$error}}</li>
                </div>
             @endforeach
        </ul>
        @endif

        <div class="container">
            <form action="{{route('updateUserInfo')}}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Insira um nome.">
                </div>

                <div class="form-group">
                    <label for="telephone">Telefone</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" value="{{$user->telephone}}" placeholder="Insira um numero de telefone.">
                </div>

                <div class="form-group">
                    <label for="email">E-mail atual</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="Insira um endereço de e-mail.">
                </div>

                <div class="form-group">
                    <label for="newEmail">Novo e-mail</label>
                    <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="Insira um endereço de e-mail.">
                </div>

                <div class="form-group">
                    <label for="password">Senha atual</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Insira uma senha.">
                </div>

                <div class="form-group">
                    <label for="newPassword">Nova senha</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Insira uma nova senha.">
                </div>

                <div class="form-group">
                    <label for="newPassword-confirm">Confirme sua nova Senha</label>
                        <input id="newPassword-confirm" type="password" class="form-control" name="newPassword_confirmation" required autocomplete="newPassword-confirm">
                </div>
                
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </form>
        </div>   

    </section>
@endsection    