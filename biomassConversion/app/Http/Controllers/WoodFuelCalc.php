<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WoodFuelCalc extends Controller
{
    public function index(Type $var = null)
    {
        return view('calchome');
    }

    public function calcresult(Type $var = null)
    {
        return view('calcresult');
    }

    public function viewpetunjuk(Type $var = null)
    {
        return view('petunjuk');
    }

    public function mainconversioncalculator(Request $request)
    {

        $kadarair = $request->input('persen-kadarair');
        $namapohoninput = $request->input('jenis-pohon');
        $jenisdatainput = $request->input('jenisdata-input');
        $nilaidatainput = $request->input('nilaidata-input');

        $namajenisdatainput; $outputkadarair;
        $namakayu; $beratjenispohon; $nilaikaloripohon; //variabel data kayu
        $beratkayubasah; $beratkayukering; //variabel berat kayu
        $kayubulat_solid; $woodchip_bulk; $kayubakar_stack; //variable volume kayu
        $ncv_gigajoule; $ncv_mwh; //variabel nilai kalori kayu
        $heatingoil_liter; $woodpellets_ton; $lpg_liter; //variabel ekuvalensi energi kayu


        $kadarair = $kadarair / 100;

        if ($namapohoninput > 0) {

            $beratjenispohon = $this->cariberatjenis($namapohoninput);
            $nilaikaloripohon = $this->carinilaikalori($namapohoninput);
            $namakayu = $this->carinamakayu($namapohoninput);

            if ($jenisdatainput > 0) {

                $namajenisdatainput = $this->carijenisdatainput($jenisdatainput);

               if ($jenisdatainput == 1) {

                   $beratkayubasah = $nilaidatainput;
                   $kayubulat_solid = $this->kayubulat1($beratkayubasah, $kadarair, $beratjenispohon);
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $ncv_gigajoule = $this->ncvGJ1($nilaikaloripohon, $kadarair, $beratkayubasah);
                   $ncv_mwh = $this->ncvMWh1($ncv_gigajoule);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[

                        'namakayu' => $namakayu,

                        'kadarair' => $outputkadarair,
                        'namajenisdatainput' => $namajenisdatainput,
                        'nilaidatainput' => $nilaidatainput,

                        'beratjenispohon' => $beratjenispohon,
                        'nilaikaloripohon' => $nilaikaloripohon,

                        'kayubulat_solid' => round($kayubulat_solid,2),
                        'beratkayubasah' => "",
                        'beratkayukering' => round($beratkayukering,2),
                        'woodchip_bulk' => round($woodchip_bulk,2),
                        'kayubakar_stack' => round($kayubakar_stack,2),
                        'ncv_gigajoule' => round($ncv_gigajoule,2),
                        'ncv_mwh' => round($ncv_mwh,2),
                        'heatingoil_liter' => round($heatingoil_liter,2),
                        'woodpellets_ton' => round($woodpellets_ton,2),
                        'lpg_liter' => round($lpg_liter,2)

                    ]);

               }elseif ($jenisdatainput == 2) {

                   $beratkayukering = $nilaidatainput;
                   $kayubulat_solid = $this->kayubulat2($beratkayukering, $beratjenispohon);
                   $beratkayubasah = $this->kayubasah2($kayubulat_solid, $kadarair, $beratjenispohon);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $ncv_gigajoule = $this->ncvGJ1($nilaikaloripohon, $kadarair, $beratkayubasah);
                   $ncv_mwh = $this->ncvMWh1($ncv_gigajoule);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[

                    'namakayu' => $namakayu,

                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => "",
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),
                    'ncv_gigajoule' => round($ncv_gigajoule,2),
                    'ncv_mwh' => round($ncv_mwh,2),
                    'heatingoil_liter' => round($heatingoil_liter,2),
                    'woodpellets_ton' => round($woodpellets_ton,2),
                    'lpg_liter' => round($lpg_liter,2)

                ]);


               }elseif ($jenisdatainput == 3) {

                   $kayubulat_solid = $nilaidatainput;
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $beratkayubasah = $this->kayubasah2($kayubulat_solid, $kadarair, $beratjenispohon);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $ncv_gigajoule = $this->ncvGJ1($nilaikaloripohon, $kadarair, $beratkayubasah);
                   $ncv_mwh = $this->ncvMWh1($ncv_gigajoule);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[

                    'namakayu' => $namakayu,
                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'kayubulat_solid' => "",
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => round($beratkayukering,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),
                    'ncv_gigajoule' => round($ncv_gigajoule,2),
                    'ncv_mwh' => round($ncv_mwh,2),
                    'heatingoil_liter' => round($heatingoil_liter,2),
                    'woodpellets_ton' => round($woodpellets_ton,2),
                    'lpg_liter' => round($lpg_liter,2)

                ]);

               }elseif ($jenisdatainput == 4) {

                   $woodchip_bulk = $nilaidatainput;
                   $kayubulat_solid = $this->kayubulat3($woodchip_bulk);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $beratkayubasah = $this->kayubasah2($kayubulat_solid, $kadarair, $beratjenispohon);
                   $ncv_gigajoule = $this->ncvGJ1($nilaikaloripohon, $kadarair, $beratkayubasah);
                   $ncv_mwh = $this->ncvMWh1($ncv_gigajoule);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[

                    'namakayu' => $namakayu,

                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,

                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => round($beratkayukering,2),
                    'woodchip_bulk' => "",
                    'kayubakar_stack' => round($kayubakar_stack,2),
                    'ncv_gigajoule' => round($ncv_gigajoule,2),
                    'ncv_mwh' => round($ncv_mwh,2),
                    'heatingoil_liter' => round($heatingoil_liter,2),
                    'woodpellets_ton' => round($woodpellets_ton,2),
                    'lpg_liter' => round($lpg_liter,2)

                ]);

               }elseif ($jenisdatainput == 5) {

                   $kayubakar_stack = $nilaidatainput;
                   $kayubulat_solid = $this->kayubulat4($kayubakar_stack);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $beratkayubasah = $this->kayubasah2($kayubulat_solid, $kadarair, $beratjenispohon);
                   $ncv_gigajoule = $this->ncvGJ1($nilaikaloripohon, $kadarair, $beratkayubasah);
                   $ncv_mwh = $this->ncvMWh1($ncv_gigajoule);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[


                    'namakayu' => $namakayu,

                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,


                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => round($beratkayukering,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => "",
                    'ncv_gigajoule' => round($ncv_gigajoule,2),
                    'ncv_mwh' => round($ncv_mwh,2),
                    'heatingoil_liter' => round($heatingoil_liter,2),
                    'woodpellets_ton' => round($woodpellets_ton,2),
                    'lpg_liter' => round($lpg_liter,2)

                ]);

               }elseif ($jenisdatainput == 6) {

                   $ncv_gigajoule = $nilaidatainput;
                   $ncv_mwh = $this->ncvMWh1($ncv_gigajoule);
                   $beratkayubasah = $this->kayubasah3($ncv_gigajoule, $kadarair, $nilaikaloripohon);
                   $kayubulat_solid = $this->kayubulat1($beratkayubasah, $kadarair, $beratjenispohon);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[


                    'namakayu' => $namakayu,

                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,


                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => round($beratkayukering,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),
                    'ncv_gigajoule' => "",
                    'ncv_mwh' => round($ncv_mwh,2),
                    'heatingoil_liter' => round($heatingoil_liter,2),
                    'woodpellets_ton' => round($woodpellets_ton,2),
                    'lpg_liter' => round($lpg_liter,2)

                ]);

               }elseif ($jenisdatainput == 7) {

                   $ncv_mwh = $nilaidatainput;
                   $ncv_gigajoule = $this->ncvGJ2($ncv_mwh);
                   $beratkayubasah = $this->kayubasah3($ncv_gigajoule, $kadarair, $nilaikaloripohon);
                   $kayubulat_solid = $this->kayubulat1($beratkayubasah, $kadarair, $beratjenispohon);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[


                    'namakayu' => $namakayu,

                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,


                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => round($beratkayukering,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),
                    'ncv_gigajoule' => round($ncv_gigajoule,2),
                    'ncv_mwh' => "",
                    'heatingoil_liter' => round($heatingoil_liter,2),
                    'woodpellets_ton' => round($woodpellets_ton,2),
                    'lpg_liter' => round($lpg_liter,2)

                ]);

               }elseif ($jenisdatainput == 8) {

                   $heatingoil_liter = $nilaidatainput;
                   $ncv_mwh = $this->ncvMWh2($heatingoil_liter);
                   $ncv_gigajoule = $this->ncvGJ2($ncv_mwh);
                   $beratkayubasah = $this->kayubasah3($ncv_gigajoule, $kadarair, $nilaikaloripohon);
                   $kayubulat_solid = $this->kayubulat1($beratkayubasah, $kadarair, $beratjenispohon);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[


                    'namakayu' => $namakayu,

                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,


                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => round($beratkayukering,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),
                    'ncv_gigajoule' => round($ncv_gigajoule,2),
                    'ncv_mwh' => round($ncv_mwh,2),
                    'heatingoil_liter' => "",
                    'woodpellets_ton' => round($woodpellets_ton,2),
                    'lpg_liter' => round($lpg_liter,2)

                    ]);


               }elseif ($jenisdatainput == 9) {

                   $woodpellets_ton = $nilaidatainput;
                   $ncv_mwh = $this->ncvMWh4($woodpellets_ton);
                   $ncv_gigajoule = $this->ncvGJ2($ncv_mwh);
                   $beratkayubasah = $this->kayubasah3($ncv_gigajoule, $kadarair, $nilaikaloripohon);
                   $kayubulat_solid = $this->kayubulat1($beratkayubasah, $kadarair, $beratjenispohon);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $lpg_liter = $this->lpg1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[


                    'namakayu' => $namakayu,

                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,


                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => round($beratkayukering,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),
                    'ncv_gigajoule' => round($ncv_gigajoule,2),
                    'ncv_mwh' => round($ncv_mwh,2),
                    'heatingoil_liter' => round($heatingoil_liter,2),
                    'woodpellets_ton' => "",
                    'lpg_liter' => round($lpg_liter,2)

                ]);

               }elseif ($jenisdatainput == 10) {

                   $lpg_liter = $nilaidatainput;
                   $ncv_mwh = $this->ncvMWh3($lpg_liter);
                   $ncv_gigajoule = $this->ncvGJ2($ncv_mwh);
                   $beratkayubasah = $this->kayubasah3($ncv_gigajoule, $kadarair, $nilaikaloripohon);
                   $kayubulat_solid = $this->kayubulat1($beratkayubasah, $kadarair, $beratjenispohon);
                   $woodchip_bulk = $this->woodchip1($kayubulat_solid);
                   $kayubakar_stack = $this->kayubakar1($kayubulat_solid);
                   $beratkayukering = $this->kayukering1($beratjenispohon, $kayubulat_solid);
                   $heatingoil_liter = $this->heatingoil1($ncv_mwh);
                   $woodpellets_ton = $this->woodpellet1($ncv_mwh);

                   $outputkadarair = $kadarair * 100;
                   return view('calcresult',[


                    'namakayu' => $namakayu,

                    'kadarair' => $outputkadarair,
                    'namajenisdatainput' => $namajenisdatainput,
                    'nilaidatainput' => $nilaidatainput,

                    'beratjenispohon' => $beratjenispohon,
                    'nilaikaloripohon' => $nilaikaloripohon,


                    'kayubulat_solid' => round($kayubulat_solid,2),
                    'beratkayubasah' => round($beratkayubasah,2),
                    'beratkayukering' => round($beratkayukering,2),
                    'woodchip_bulk' => round($woodchip_bulk,2),
                    'kayubakar_stack' => round($kayubakar_stack,2),
                    'ncv_gigajoule' => round($ncv_gigajoule,2),
                    'ncv_mwh' => round($ncv_mwh,2),
                    'heatingoil_liter' => round($heatingoil_liter,2),
                    'woodpellets_ton' => round($woodpellets_ton,2),
                    'lpg_liter' => ""

                ]);

               }
            }
        }
    }

    function cariberatjenis($namapohoninput)
    {
        $beratjenispohon;

        switch ($namapohoninput) {
            case 1:
                $beratjenispohon = 0.75;
                break;
            case 2:
                $beratjenispohon = 0.72;
                break;
            case 3:
                $beratjenispohon = 0.75;
                break;
            case 4:
                $beratjenispohon = 0.52;
                break;
            case 5:
                $beratjenispohon = 0.36;
                break;
            case 6:
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
                $nilaikaloripohon = 21.26;
                break;
            case 2:
                $nilaikaloripohon = 19.31;
                break;
            case 3:
                $nilaikaloripohon = 19.5;
                break;
            case 4:
                $nilaikaloripohon = 17.87;
                break;
            case 5:
                $nilaikaloripohon = 16.74;
                break;
            case 6:
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
                $namakayu = "Tectona grandis (Jati)";
                break;
            case 2:
                $namakayu = "Switenia mahagoni (Mahoni)";
                break;
            case 3:
                $namakayu = "Pinus merkusii (Pinus)";
                break;
            case 4:
                $namakayu = "Acacia mangium (Akasia)";
                break;
            case 5:
                $namakayu = "Gliricidia sepium (Gamal)";
                break;
            case 6:
                $namakayu = "Calliandra Calothyrsus (Kaliandra)";
                break;

        }

        return $namakayu;
    }

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
                $namajenisdatainput = "Nilai Kalori Bersih (Giga Joule)";
                break;

            case 7:
                $namajenisdatainput = "Nilai Kalori Bersih (MWh)";
                break;

            case 8:
                $namajenisdatainput = "Heating Oil (liter)";
                break;

            case 9:
                $namajenisdatainput = "Wood Pellets (ton)";
                break;

            case 10:
                $namajenisdatainput = "Liquefied Petroleum Gas (liter)";
                break;
        }

        return $namajenisdatainput;
    }

    function kayubulat1($beratkayubasah, $kadarair, $beratjenispohon)
    {
        $kayubulat_solid = $beratkayubasah * ((1 - $kadarair)/$beratjenispohon);
        return $kayubulat_solid;
    }

    function kayubulat2($beratkayukering, $beratjenispohon)
    {
        $kayubulat_solid = $beratkayukering / $beratjenispohon;
        return $kayubulat_solid;
    }

    function kayubulat3($woodchip_bulk)
    {
        $kayubulat_solid = $woodchip_bulk * 0.35715;
        return $kayubulat_solid;
    }

    function kayubulat4($kayubakar_stack)
    {
        $kayubulat_solid = $kayubakar_stack * 0.7496;
        return $kayubulat_solid;
    }

    function kayubasah1($beratjenispohon, $kayubulat_solid)
    {
        $beratkayubasah = $beratjenispohon * $kayubulat_solid;
        return $beratkayubasah;
    }

    function kayubasah2($kayubulat_solid, $kadarair, $beratjenispohon)
    {
        $beratkayubasah = $kayubulat_solid * ($beratjenispohon / (1 - $kadarair));
        return $beratkayubasah;
    }

    function kayubasah3($ncv_gigajoule, $kadarair, $nilaikaloripohon)
    {
        $beratkayubasah = $ncv_gigajoule / (($nilaikaloripohon * (1 - $kadarair)) - (2.44 * $kadarair));
        return $beratkayubasah;
    }

    function kayukering1($beratjenispohon, $kayubulat_solid)
    {
        $beratkayubasah = $beratjenispohon * $kayubulat_solid;
        return $beratkayubasah;
    }

    function woodchip1($kayubulat_solid)
    {
        $woodchip_bulk = $kayubulat_solid * 2.8;
        return $woodchip_bulk;
    }

    function kayubakar1($kayubulat_solid)
    {
        $kayubakar_stack = $kayubulat_solid * 1.33;
        return $kayubakar_stack;
    }

    function ncvGJ1($nilaikaloripohon, $kadarair, $beratkayubasah)
    {
        $ncv_gigajoule = $beratkayubasah * (($nilaikaloripohon * (1 - $kadarair)) - (2.44 * $kadarair));
        return $ncv_gigajoule;
    }

    function ncvGJ2($ncv_mwh)
    {
        $ncv_gigajoule = $ncv_mwh / (5/18);
        return $ncv_gigajoule;
    }

    function ncvMWh1($ncv_gigajoule)
    {
        $ncv_mwh = $ncv_gigajoule * (5/18);
        return $ncv_mwh;
    }

    function ncvMWh2($heatingoil_liter)
    {
        $ncv_mwh = $heatingoil_liter * 0.0107;
        return $ncv_mwh;
    }

    function ncvMWh3($lpg_liter)
    {
        $ncv_mwh = $lpg_liter * 0.00682;
        return $ncv_mwh;
    }

    function ncvMWh4($woodpellets_ton)
    {
        $ncv_mwh = $woodpellets_ton * 4.6;
        return $ncv_mwh;
    }

    function heatingoil1($ncv_mwh)
    {
        $heatingoil_liter = $ncv_mwh / 0.0107;
        return $heatingoil_liter;
    }

    function woodpellet1($ncv_mwh)
    {
        $woodpellets_ton = $ncv_mwh / 4.6;
        return $woodpellets_ton;
    }

    function lpg1($ncv_mwh)
    {
        $lpg_liter = $ncv_mwh / 0.00682;
        return $lpg_liter;
    }

}
