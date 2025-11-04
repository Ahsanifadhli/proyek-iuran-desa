<h1>Halaman Dashboard RT/RW</h1>
<p>Login sebagai RT/RW berhasil.</p>

<br>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>
