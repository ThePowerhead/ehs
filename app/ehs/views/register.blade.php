@extends('layouts.ehs')

@section('title', 'Inscription')

@section('content')
    <form action="?action=doregister" method="post">
        <fieldset>
            <legend>Création du compte</legend><br>
            Username: <input type="text" name="name"><br>
            Email : <input type="email" name="mail"><br>
            Password : <input type="password" name="pass"><br>
            Repeat password : <input type="password" name="pass2"><br>
            Genre : <input type="radio" name="gender" value="male" checked> Male  
            <input type="radio" name="gender" value="female"> Female<br><br>
            <input type="submit" value="Valider"><br>
        </fieldset>
    </form>
    <br><br><br>
    <a href="/?action=default">Retour à la page principale</a>
@endsection
