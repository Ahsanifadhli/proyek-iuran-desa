<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="text-center">Kirim Email</h3>

    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('post-email') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nama" value="{{ old('name') }}">
        </div>
        <div class="form-group my-3">
            <label for="email">Email Tujuan</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email Tujuan" value="{{ old('email') }}">
        </div>
        <div class="form-group my-3">
            <label for="subject">Subjek</label>
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subjek" value="{{ old('subject') }}">
        </div>
        <div class="form-group my-3">
            <label for="body">Body Deskripsi</label>
            <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{ old('body') }}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Kirim Email</button>
        </div>
    </form>
</div>
</body>
</html>
