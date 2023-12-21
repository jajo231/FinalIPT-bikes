<p>
    Greetings!  {{$user->name}}.
</p>
<p>
    To verify account. CLICK HERE.
</p>
<p>
    <a href="{{url('/verification/' . $user->id. '/' . $user->remember_token) }}">Verification link!</a>
</p>
