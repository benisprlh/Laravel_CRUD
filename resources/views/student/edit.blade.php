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
        <h1>Form Edit Mahasiswa</h1>
        <div>
            @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
        </div>
    
        <form method="post" action="{{route('student.update', ['student' => $student])}}">
            @csrf
            @method('put')
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{$student->name}}">
    
            <label for="gender">Jenis Kelamin:</label>
            <label for="lakiLaki">
                <input type="radio" id="lakiLaki" name="gender" value="Laki-Laki"  {{$student->gender == 'Laki-Laki' ? 'checked' : ''}}>
                Laki-Laki
            </label>
            <label for="perempuan">
                <input type="radio" id="perempuan" name="gender" value="Perempuan" {{$student->gender == 'Perempuan' ? 'checked' : ''}}>
                Perempuan
            </label>
    
            <label for="address">Alamat:</label>
            <textarea id="address" name="address" rows="4" cols="50">{{$student->address}}</textarea>
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
                    @foreach($student->subjects as $index => $subject)
                        <tr>
                            <td>{{$index + 1}}</td>
                            
                            <td>
                                <input type="text" name="nama[]" value="{{$subject->name}}" disabled>
                                <input type="hidden" name="nama[]" value="{{$subject->name}}">
                            </td>
                            <td><button type="button" onclick="hapusBaris(this)">Hapus</button></td>
                        </tr>
                     @endforeach
                </tbody>
            </table>
    
            <div class="action-buttons">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>

<script>
    function tambahBaris() {
        let table = document.getElementById("tabel-mahasiswa").getElementsByTagName('tbody')[0];
        let row = table.insertRow(-1);
        let id = table.rows.length;
        let cell1 = row.insertCell(0);
        let cell2 = row.insertCell(1);
        let cell3 = row.insertCell(2);
        cell1.innerHTML = id;
        cell2.innerHTML = '<input type="text" name="nama[]">';
        cell3.innerHTML = '<button type="button" onclick="hapusBaris(this)">Hapus</button>';
    }

    function hapusBaris(button) {
        let row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>

</body>
</html>