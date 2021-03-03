<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Styles -->
     <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="/css/custom.min.css">
     <link rel="stylesheet" href="/css/custom.css">
    <title>Kalkulator Konversi Energi</title>
    <style>
        .optiontext {
            position: absolute;
        bottom: 0.5em;
        color: #fff;
        left: 0.5em;
        pointer-events: none;
        z-index: 1;
        font-style: italic;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
        <a class="navbar-brand">KONVERSI ENERGI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Konversi Energi
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/calcsmwoodfuel">Konversi Staple Meter</a>
            </li>
          </ul>
        </div>
    </nav>

    <div class="container">
        <div class="page-header" id="banner">
          <div class="row">
            <div class="container">
                <h2>Kalkulator Konversi Rasio Energi</h2>
                <p class="lead">Energi Bahan Bakar Kayu pada Industri Biomassa</p>
            </div>
        </div>
    </div>
<div style="background-color: whitesmoke">
    <div class="bs-docs-section">
        <div class="form-group">
            <form name="inputdata" action="/calcresult" method="POST" onsubmit="return validateForm()" required>
                {{ csrf_field() }}
                <fieldset>
                    <table class="table table-hover">
                        <thead>
                            <div class="card-header bg-info text-white">KONVERSI RASIO ENERGI BESERTA VOLUME DAN MASSA</div>
                        </thead>
                        <tbody>
                            <tr class="">
                                <th scope="row" class="text-right">Jenis Kayu</th>
                                <td>
                                    <select name="jenis-pohon" class="custom-select">
                                        <option selected="" value="">Pilih Jenis Kayu</option>
                                        <option value="1"><i>Tectona grandis</i> (Jati)</option>
                                        <option value="2"><i>Switenia mahagoni</i> (Mahoni)</option>
                                        <option value="3"><i>Pinus merkusii</i> (Pinus)</option>
                                        <option value="4"><i>Acacia mangium</i> (Akasia)</option>
                                        <option value="5"><i>Gliricidia sepium</i> (Gamal)</option>
                                        <option value="6"><i>Calliandra Calothyrsus</i> (Kaliandra)</option>
                                    </select>
                                </td>
                                <th scope="row" class="text-right">Kadar Air (%)</th>
                                <td>
                                    <input type="number" name="persen-kadarair" step=".01" min="0" class="form-control" placeholder="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <div class="card-header bg-info text-white">DATA INPUT AWAL</div>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-right">Jenis Data</th>
                                <td>
                                        <select name="jenisdata-input" class="custom-select">
                                            <option selected="" value="">Pilih Jenis Data Input</option>
                                            <option value="1">Berat - Kayu Bersih (ton)</option>
                                            <option value="2">Berat - Kayu Kering (ton)</option>
                                            <option value="3">Volume - Kayu Bulat (Solid m<sup>3</sup>)</option>
                                            <option value="4">Volume - Wood Chip (Bulk m<sup>3</sup>)</option>
                                            <option value="5">Volume - Kayu Bakar (Stack m<sup>3</sup>)</option>
                                            <option value="6">Nilai Kalori Bersih (Giga Joule)</option>
                                            <option value="7">Nilai Kalori Bersih (MWh)</option>
                                            <option value="8">Ekuvalensi Energi - Heating Oil (liter)</option>
                                            <option value="9">Ekuvalensi Energi - Wood Pellets (ton)</option>
                                            <option value="10">Ekuvalensi Energi - Liquefied Petroleum Gas (liter)</option>
                                        </select>

                                </td>

                                <th scope="row" class="text-right">Nilai Data</th>
                                <td>
                                    <input type="number" name="nilaidata-input" class="form-control" placeholder="" min="0">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>

                    <table class="col text-center">
                        <tr>
                            <td>
                                <div class="container">
                                    <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" name="submit-hitung" class="btn btn-primary">Hitung</button>
                                    </div>
                                    </div>
                                </div>
                            </td>
                </fieldset>
            </form>

            <form action="/" method="GET">
                            <td>
                                <div class="container">
                                    <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-danger">Clear</button>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
            </form>

        </div>


<br>
<br>


    <div class="card-header bg-secondary text-white">Input Awal Konversi</div>
    {{-- <div class="container"> --}}

        {{-- <div style="background-color: burlywood"> --}}
        <div class="container">

            <table class="table table-hover">

                <thead>
                    {{-- <div class="card-header bg-secondary text-white">Volume</div> --}}
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label>Jenis Kayu</label>
                                <input type="text" value="{{ $namakayu }}" name="namakayu" class="form-control" placeholder="" readonly="">
                            </div>
                        </td>
                        <td></td>
                        <td>
                            <div class="form-group">
                                <label>Kadar Air (%)</label>
                                <input type="number" value="{{ $kadarair }}" name="kadarair" class="form-control" placeholder="" readonly="">
                            </div>
                        </td>
                        <td></td>
                        <td>
                            <div class="form-group">
                                <label><?php
                                    echo $namajenisdatainput;
                                    ?>
                                </label>
                                <input type="number" value="{{ $nilaidatainput }}" name="nilaidatainput" class="form-control" placeholder="" readonly="">
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>

    {{-- </div> --}}
    <div class="card-header bg-success text-white">Output Konversi</div>
    <br>

    <div class="container">

    <table class="table table-hover">

        <thead>
            <div class="card-header bg-success text-white">Data Kayu</div>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-group">
                        <label>Jenis Kayu</label>
                        <input type="text" value="{{ $namakayu }}" name="namakayu" class="form-control" placeholder="" readonly>
                    </div>
                </td>
                <td></td>
                <td>
                    <div class="form-group">
                        <label>Berat Jenis (t/m<sup>3</sup>)</label>
                        <input type="number" value="{{ $beratjenispohon }}" name="beratjenispohon" class="form-control" placeholder="" readonly>
                    </div>
                </td>
                <td></td>
                <td>
                    <div class="form-group">
                        <label>Nilai Kalori (GJ/t)</label>
                        <input type="number" value="{{ $nilaikaloripohon }}" name="nilaikaloripohon" class="form-control" placeholder="" readonly>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-hover">

        <thead>
            <div class="card-header bg-success text-white">Berat</div>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-group">
                        <label>Berat Kayu Bersih (ton)</label>
                        <input value="{{ $beratkayubasah }}" type="number" name="berat-kayubasah" class="form-control" readonly>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td>
                    <div class="form-group">
                        <label>Berat Kayu Kering (ton)</label>
                        <input value="{{ $beratkayukering }}" type="number" name="berat-kayukering" class="form-control" readonly>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <div class="card-header bg-success text-white">Volume</div>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-group">
                        <label>Kayu Bulat (Solid m<sup>3</sup>)</label>
                        <input value="{{ $kayubulat_solid }}" type="number" name="kayubulat-solid" class="form-control" readonly>
                    </div>
                </td>
                <td></td>
                <td>
                    <div class="form-group">
                        <label>Wood Chip (Bulk m<sup>3</sup>)</label>
                        <input value="{{ $woodchip_bulk }}" type="number" name="woodchip-bulk" class="form-control" readonly>
                    </div>
                </td>
                <td></td>
                <td>
                    <div class="form-group">
                        <label>Kayu Bakar (Stack m<sup>3</sup>)</label>
                        <input value="{{ $kayubakar_stack }}" type="number" name="kayubakar-stack" class="form-control" readonly>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <div class="card-header bg-success text-white">Nilai Kalor Bersih</div>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="form-group">
                        <label>Giga Joule</label>
                        <input value="{{ $ncv_gigajoule }}" type="number" name="ncv-gigajoule" class="form-control" readonly>
                    </div>
                </td>
                <td></td>
                <td></td>
                <td>
                    <div class="form-group">
                        <label>MWh</label>
                        <input value="{{ $ncv_mwh }}" type="number" name="ncv-kwh" class="form-control" readonly>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
            <div class="card-header bg-success text-white">Ekuvalensi Energi</div>
        </thead>
        <tbody>
            <tr class="">
                <td>
                    <div class="form-group">
                        <label>Heating Oil (liter)</label>
                        <input value="{{ $heatingoil_liter }}" type="number" name="heatingoil-liter" class="form-control" readonly>
                    </div>
                </td>
                <td></td>
                <td>
                    <div class="form-group">
                        <label>Wood Pellets (ton)</label>
                        <input value="{{ $woodpellets_ton }}" type="number" name="woodpellets-ton" class="form-control" readonly>
                    </div>
                </td>
                <td></td>
                <td>
                    <div class="form-group">
                        <label>Liquefied Petroleum Gas (liter)</label>
                        <input value="{{ $lpg_liter }}" type="number" name="lpg-liter" class="form-control" readonly>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    </div>

    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal" tabindex="-1">

    <div class="modal-dialog" role="document">
        <div class="modal-content border-warning">
          <div class="modal-header">
            <h5 class="modal-title">Peringatan!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="modal-text">
                Maaf, salah satu dari data dibawah ini yang belum diisi:
                <ul>
                    <li>Jenis Pohon</li>
                    <li>Kadar Air</li>
                    <li>Jenis Data (pada Data Input Awal)</li>
                    <li>Nilai data (pada Data Input Awal)</li>
                </ul>
                Mohon isi semua data diatas dengan lengkap.
            </p>
          </div>
        </div>
      </div>
</div>

    <script src="/js/custom.js"></script>
</body>
</html>
