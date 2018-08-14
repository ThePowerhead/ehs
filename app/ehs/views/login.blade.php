@extends('layouts.ehs')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>
    <form action="?action=dologin" method="post">
        <fieldset>
            <legend>Connexion au compte</legend><br>
            Email : <input type="email" name="mail"><br>
            Password : <input type="password" name="pass"><br><br>
            <input type="submit" value="Valider"><br>
        </fieldset>
    </form>
    <br><br><br>
    <a href="/?action=default">Retour à la page principale</a>
@endsection
