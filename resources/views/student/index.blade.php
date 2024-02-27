<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-buttons {
            text-align: center;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        .search-container {
            margin-bottom: 20px;
        }

        input[type=text] {
            width: 50%;
            padding: 6px;
            margin-top: 8px;
            margin-bottom: 8px;
            margin-left: 12px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }

        input[type=text]:focus {
            border: 3px solid #555;
        }
        a {
            text-decoration: none; 
            color: inherit; 
        }
    </style>
</head>
<body>

<h1>List Mahasiswa</h1>

<div class="search-container">
    <form method="GET" action="{{ route('search') }}">
        <label for="search">Kata Kunci:</label>
        <input type="text" id="search" name="search" placeholder="Cari berdasarkan nama, jenis kelamin, dan alamat">
        <button type="submit" class="add-button">Cari</button>
    </form>
</div>

<button class="add-button"><a href="{{route('student.create')}}">Tambah Data</a></button>


<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>JNS KELAMIN</th>
            <th>ALAMAT</th>
            <th>JUMLAH MATA KULIAH</th>
            <th>AKSI</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            
        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->gender}}</td>
            <td>{{$student->address}}</td>
            <td>{{count($student->subjects)}}</td>
            <td class="action-buttons">
                <button><a href="{{route('student.edit', ['student' => $student])}}">Ubah</a></button>
                <form method="post" action="{{route('student.destroy', ['student' => $student])}}">
                    @csrf
                    @method('delete')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


</body>
</html>