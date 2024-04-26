<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data</title>
    <style>
        /* Tampilan cetak */
        @media print {
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }

            /* Sembunyikan elemen yang tidak perlu dicetak */
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <th>Nama</th>
            <th>Usia</th>
            <th>Kota</th>
        </tr>
        <tr>
            <td>John</td>
            <td>30</td>
            <td>New York</td>
        </tr>
        <tr>
            <td>Jane</td>
            <td>25</td>
            <td>Los Angeles</td>
        </tr>
        <tr>
            <td>Doe</td>
            <td>40</td>
            <td>Chicago</td>
        </tr>
    </table>

    <!-- Tombol untuk mencetak -->
    <button class="no-print" onclick="window.print()">Cetak Tabel</button>

</body>

</html>