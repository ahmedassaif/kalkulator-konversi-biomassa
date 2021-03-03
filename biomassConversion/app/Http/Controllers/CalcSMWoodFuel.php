<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcSMWoodFuel extends Controller
{
    public function index()
    {
        return view('calcsmwoodfuel');
    }

    public function maincalc(Request $request)
    {
        //ambil data dari POST setelah klik submit
        $kadarair = $request->input('persen-kadarair'); //'persen-kadarair' = nama input
        $namapohoninput = $request->input('jenis-pohon');
        $jenisdatainput = $request->input('jenisdata-input');
        $nilaidatainput = $request->input('nilaidata-input');

        $namajenisdatainput; $outputkadarair;
        $namakayu; $beratjenispohon; $nilaikaloripohon; //variabel data kayu
        $beratkayubersih; $beratkayukering; //variabel berat kayu
        $kayubulat_solid; $woodchip_bulk; $kayubakar_stack; //variable volume kayu
        $staplemeter_sm; $berat_staplemeter;

        $kadarair = $kadarair / 100; // kadar air % (0 - 1)

        if ($namapohoninput > 0) {

            $beratjenispohon = $this->cariberatjenis($namapohoninput);
            $nilaikaloripohon = $this->carinilaikalori($namapohoninput);
            $namakayu = $this->carinamakayu($namapohoninput);

            if ($jenisdatainput > 0) {

                $namajenisdatainput = $this->carijenisdatainput($jenisdatainput);

               if ($jenisdatainput == 1) {

                   $beratkayubersih = $nilaidatainput;
                   $beratkayukering = $this->beratkayukering2($beratkayubersih, $kadarair);
                   $kayubulat_solid = $this->volumekayubulat1($beratkayukering, $beratjenispohon);
                   $woodchip_bulk = $this->volumewoodchip($kayubulat_solid);
                   $kayubakar_stack = $this->volumekayubakar1($kayubulat_solid);
                   $staplemeter_sm = $this->staplemetersm1($kayubakar_stack);
                   $berat_staplemeter = $this->beratstaplemeter($staplemeter_sm);

                   $outputkadarair = $kadarair * 100;
                   return view('smwoodfuelresult',[
                        'kadarair' => $outputkadarair,
                        'namajenisdatainput' => $namajenisdatainput,
                        'nilaidatainput' => $nilaidatainput,

                        'namakayu' => $namakayu,
                        'beratjenispohon' => $beratjenispohon,
                        'nilaikaloripohon' => $nilaikaloripohon,

                        'beratkayubersih' => "",
                        'beratkayukering' => round($beratkayukering,2),

                        'kayubulat_solid' => round($kayubulat_solid,2),
                        'woodchip_bulk' => round($woodchip_bulk,2),
                        'kayubakar_stack' => round($kayubakar_stack,2),

                        'staplemeter_sm' => round($staplemeter_sm,2),
                        'berat_staplemeter' => round($berat_staplemeter,2)
                    ]);

               }elseif ($jenisdatainput == 2) {

                   $beratkayukering = $nilaidatainput;
                   $beratkayubersih = $this->beratkayubersih($beratkayukering, $kadarair);
                   $kayubulat_solid = $this->volumekayubulat1($beratkayukering, $beratjenispohon);
                   $woodchip_bulk = $this->volumewoodchip($kayubulat_solid);
                   $kayubakar_stack = $this->volumekayubakar1($kayubulat_solid);
                   $staplemeter_sm = $this->staplemetersm1($kayubakar_stack);
                   $berat_staplemeter = $this->beratstaplemeter($staplemeter_sm);

                   $outputkadarair = $kadarair * 100;
                   return view('smwoodfuelresult',[
                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'namakayu' => $namakayu,
                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'beratkayubersih' => round($beratkayubersih,2),
                    'beratkayukering' => "",

                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),

                    'staplemeter_sm' => round($staplemeter_sm,2),
                    'berat_staplemeter' => round($berat_staplemeter,2)
                ]);


               }elseif ($jenisdatainput == 3) {

                   $kayubulat_solid = $nilaidatainput;
                   $beratkayukering = $this->beratkayukering1($beratjenispohon, $kayubulat_solid);
                   $beratkayubersih = $this->beratkayubersih($beratkayukering, $kadarair);
                   $woodchip_bulk = $this->volumewoodchip($kayubulat_solid);
                   $kayubakar_stack = $this->volumekayubakar1($kayubulat_solid);
                   $staplemeter_sm = $this->staplemetersm1($kayubakar_stack);
                   $berat_staplemeter = $this->beratstaplemeter($staplemeter_sm);

                   $outputkadarair = $kadarair * 100;
                   return view('smwoodfuelresult',[
                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'namakayu' => $namakayu,
                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'beratkayubersih' => round($beratkayubersih,2),
                    'beratkayukering' => round($beratkayukering,2),

                    'kayubulat_solid' => "",
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),

                    'staplemeter_sm' => round($staplemeter_sm,2),
                    'berat_staplemeter' => round($berat_staplemeter,2)
                ]);

               }elseif ($jenisdatainput == 4) {

                   $woodchip_bulk = $nilaidatainput;
                   $kayubulat_solid = $this->volumekayubulat2($woodchip_bulk);
                   $kayubakar_stack = $this->volumekayubakar1($kayubulat_solid);
                   $beratkayukering = $this->beratkayukering1($beratjenispohon, $kayubulat_solid);
                   $beratkayubersih = $this->beratkayubersih($beratkayukering, $kadarair);
                   $staplemeter_sm = $this->staplemetersm1($kayubakar_stack);
                   $berat_staplemeter = $this->beratstaplemeter($staplemeter_sm);

                   $outputkadarair = $kadarair * 100;
                   return view('smwoodfuelresult',[
                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'namakayu' => $namakayu,
                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'beratkayubersih' => round($beratkayubersih,2),
                    'beratkayukering' => round($beratkayukering,2),

                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'woodchip_bulk' => "",
                    'kayubakar_stack' => round($kayubakar_stack,2),

                    'staplemeter_sm' => round($staplemeter_sm,2),
                    'berat_staplemeter' => round($berat_staplemeter,2)
                ]);

               }elseif ($jenisdatainput == 5) {

                   $kayubakar_stack = $nilaidatainput;
                   $kayubulat_solid = $this->volumekayubulat3($kayubakar_stack);
                   $woodchip_bulk = $this->volumewoodchip($kayubulat_solid);
                   $beratkayukering = $this->beratkayukering1($beratjenispohon, $kayubulat_solid);
                   $beratkayubersih = $this->beratkayubersih($beratkayukering, $kadarair);
                   $staplemeter_sm = $this->staplemetersm1($kayubakar_stack);
                   $berat_staplemeter = $this->beratstaplemeter($staplemeter_sm);

                   $outputkadarair = $kadarair * 100;
                   return view('smwoodfuelresult',[
                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'namakayu' => $namakayu,
                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'beratkayubersih' => round($beratkayubersih,2),
                    'beratkayukering' => round($beratkayukering,2),

                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => "",

                    'staplemeter_sm' => round($staplemeter_sm,2),
                    'berat_staplemeter' => round($berat_staplemeter,2)
                ]);

               }elseif ($jenisdatainput == 6) {

                   $staplemeter_sm = $nilaidatainput;
                   $berat_staplemeter = $this->beratstaplemeter($staplemeter_sm);
                   $kayubakar_stack = $this->volumekayubakar2($staplemeter_sm);
                   $kayubulat_solid = $this->volumekayubulat3($kayubakar_stack);
                   $woodchip_bulk = $this->volumewoodchip($kayubulat_solid);
                   $beratkayukering = $this->beratkayukering1($beratjenispohon, $kayubulat_solid);
                   $beratkayubersih = $this->beratkayubersih($beratkayukering, $kadarair);

                   $outputkadarair = $kadarair * 100;
                   return view('smwoodfuelresult',[
                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'namakayu' => $namakayu,
                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'beratkayubersih' => round($beratkayubersih,2),
                    'beratkayukering' => round($beratkayukering,2),

                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),

                    'staplemeter_sm' => "",
                    'berat_staplemeter' => round($berat_staplemeter,2)
                ]);

               }elseif ($jenisdatainput == 7) {

                   $berat_staplemeter = $nilaidatainput;
                   $staplemeter_sm = $this->staplemetersm2($berat_staplemeter);
                   $kayubakar_stack = $this->volumekayubakar2($staplemeter_sm);
                   $kayubulat_solid = $this->volumekayubulat3($kayubakar_stack);
                   $woodchip_bulk = $this->volumewoodchip($kayubulat_solid);
                   $beratkayukering = $this->beratkayukering1($beratjenispohon, $kayubulat_solid);
                   $beratkayubersih = $this->beratkayubersih($beratkayukering, $kadarair);

                   $outputkadarair = $kadarair * 100;
                   return view('smwoodfuelresult',[
                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'namakayu' => $namakayu,
                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'beratkayubersih' => round($beratkayubersih,2),
                    'beratkayukering' => round($beratkayukering,2),

                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),

                    'staplemeter_sm' => round($staplemeter_sm,2),
                    'berat_staplemeter' => ""
                ]);

               }
            }
        }
    }

//------------------------------------------START Cari Data Pohon-------------------------------------------------------
    function cariberatjenis($namapohoninput)
    {
        $beratjenispohon;

        switch ($namapohoninput) {
            case 1:
                $beratjenispohon = 0.36;
                break;
            case 2:
                $beratjenispohon = 0.63;
                break;
        }

        return $beratjenispohon;
    }

    function carinilaikalori($namapohoninput)
    {
        $nilaikaloripohon;

        switch ($namapohoninput) {
            case 1:
                $nilaikaloripohon = 16.74;
                break;
            case 2:
                $nilaikaloripohon = 19.25;
                break;
        }

        return $nilaikaloripohon;
    }

    function carinamakayu($namapohoninput)
    {
        $namakayu;

        switch ($namapohoninput) {
            case 1:
                $namakayu = "Gliricidia sepium (Gamal)";
                break;
            case 2:
                $namakayu = "Calliandra Calothyrsus (Kaliandra)";
                break;
        }

        return $namakayu;
    }
//------------------------------------------END Cari Data Pohon-------------------------------------------------------


    function carijenisdatainput($jenisdatainput)
    {
        $namajenisdatainput;

        switch ($jenisdatainput) {
            case 1:
                $namajenisdatainput = "Berat Kayu Bersih (ton)";
                break;
            case 2:
                $namajenisdatainput = "Berat Kayu Kering (ton)";
                break;
            case 3:
                $namajenisdatainput = "Volume Kayu Bulat (Solid m<sup>3</sup>)";
                break;
            case 4:
                $namajenisdatainput = "Volume Wood Chip (Bulk m<sup>3</sup>)";
                break;
            case 5:
                $namajenisdatainput = "Volume Kayu Bakar (Stack m<sup>3</sup>)";
                break;
            case 6:
                $namajenisdatainput = "Staple Meter Kayu Bakar (SM)";
                break;
            case 7:
                $namajenisdatainput = "Berat Staple Meter Kayu Bakar (ton)";
                break;
        }

        return $namajenisdatainput;
    }

    //------------------------------------------START Rumus-Rumus Konversi-------------------------------------------------------
    function beratkayubersih($beratkayukering, $kadarair)
    {
        $beratkayubersih = (1 + $kadarair) * $beratkayukering;
        return $beratkayubersih;
    }

    function beratkayukering1($beratjenispohon, $kayubulat_solid)
    {
        $beratkayukering = $beratjenispohon * $kayubulat_solid;
        return $beratkayukering;
    }

    function beratkayukering2($beratkayubersih, $kadarair)
    {
        $beratkayukering = $beratkayubersih * (1 - $kadarair);
        return $beratkayukering;
    }

    function volumekayubulat1($beratkayukering, $beratjenispohon)
    {
        $kayubulat_solid = $beratkayukering / $beratjenispohon;
        return $kayubulat_solid;
    }

    function volumekayubulat2($woodchip_bulk)
    {
        $kayubulat_solid = $woodchip_bulk / 2.8;
        return $kayubulat_solid;
    }

    function volumekayubulat3($kayubakar_stack)
    {
        $kayubulat_solid = $kayubakar_stack / 1.33;
        return $kayubulat_solid;
    }

    function volumewoodchip($kayubulat_solid)
    {
        $woodchip_bulk = $kayubulat_solid * 2.8;
        return $woodchip_bulk;
    }

    function volumekayubakar1($kayubulat_solid)
    {
        $kayubakar_stack = $kayubulat_solid * 1.33;
        return $kayubakar_stack;
    }

    function volumekayubakar2($staplemeter_sm)
    {
        $kayubakar_stack = $staplemeter_sm * 0.41;
        return $kayubakar_stack;
    }

    function staplemetersm1($kayubakar_stack)
    {
        $staplemeter_sm = $kayubakar_stack / 0.41;
        return $staplemeter_sm;
    }

    function staplemetersm2($berat_staplemeter)
    {
        $staplemeter_sm = $berat_staplemeter / 0.3317;
        return $staplemeter_sm;
    }

    function beratstaplemeter($staplemeter_sm)
    {
        $berat_staplemeter = $staplemeter_sm * 0.3317;
        return $berat_staplemeter;
    }

    //------------------------------------------END Rumus-Rumus Konversi-------------------------------------------------------


}
