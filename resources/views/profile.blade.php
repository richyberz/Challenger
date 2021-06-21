@extends('layouts.app')
@section('content')
<!DOCTYPE html>    
<html>  
    <head>    
        <title>User profile</title>         
    </head> 
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <h1>Challenger profile</h1>
                    @if(!is_null($profile))
                    <h4>Username: {{ $profile->username }}</h4>
                    <h4>First name: {{ $profile->firstname }}</h4>
                    <h4>Last name: {{ $profile->lastname }}</h4>
                    <h4>Email: {{ $profile->email }}</h4>
                    <h4>Birth date: {{ $profile->birthDate }}</h4>
                @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
