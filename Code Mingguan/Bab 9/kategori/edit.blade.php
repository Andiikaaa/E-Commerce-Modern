<!DOCTYPE html>
<html lang="id">

<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
</head>

<body>
    <h2>Edit Kategori</h2>
    <form action="{{ route('kategori.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $category->id }}">

        <label for="photo">Gambar</label>
        <input type="file" name="photo">

        <label for="categories">Kategori</label>
        <input type="text" name="categories" value="{{ $category->categories }}" required>

        <label for="description">Deskripsi</label>
        <textarea name="description" required>{{ $category->description }}</textarea>

        <label for="price">Harga</label>
        <input type="number" name="price" value="{{ $category->price }}" required>

        <button type="submit">Perbarui Kategori</button>
    </form>
</body>
</html>
