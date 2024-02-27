<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="-8">
    <meta name="viewport" content="=device-width, initial-scale=1.0">
    <title>Form Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
           : 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .upload-button {
            background-color: #2196F3;
        }

        .upload-button:hover {
            background-color: #0d8ef1;
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
    </style>
</head>
<body>

    <div class="container">
        <h1>Form Add Mahasiswa</h1>
        <div>
            @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
        </div>
    
        <form method="post" action="{{Route('student.store')}}">
            @csrf
            @method('post')
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name">
    
            <label for="gender">Jenis Kelamin:</label>
            <label for="lakiLaki">
                <input type="radio" id="lakiLaki" name="gender" value="Laki-Laki">
                Laki-Laki
            </label>
            <label for="perempuan">
                <input type="radio" id="perempuan" name="gender" value="Perempuan">
                Perempuan
            </label>
    
            <label for="address">Alamat:</label>
            <textarea id="address" name="address" rows="4" cols="50"></textarea>
            <br>
            <br>
    
            <button type="button" onclick="tambahBaris()">Tambah</button>
    
            <table id="tabel-mahasiswa">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><input type="text" name="nama[]"></td>
                        <td><button type="button" onclick="hapusBaris(this)">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
    
            <div class="action-buttons">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>

<script>
    function tambahBaris() {
        var table = document.getElementById("tabel-mahasiswa").getElementsByTagName('tbody')[0];
        var row = table.insertRow(-1);
        var id = table.rows.length;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell1.innerHTML = id;
        cell2.innerHTML = '<input type="text" name="nama[]">';
        cell3.innerHTML = '<button type="button" onclick="hapusBaris(this)">Hapus</button>';
    }

    function hapusBaris(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>

</body>
</html>