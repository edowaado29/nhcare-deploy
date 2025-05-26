<?php

  

namespace App\Exports;

  

use App\Models\Anakasuh;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

  

class AnakExport implements FromCollection, WithHeadings

{

    /**

    * @return \Illuminate\Support\Collection

    */

    public function collection()

    {

        return Anakasuh::select("id_anakasuh",
        "nik",
        "nama",
        "jenis_kelamin",
        "tempat_lahir",
        "tanggal_lahir",
        "alamat",
        "keterangan",
        "asrama",
        "no_akta",
        "no_kk",
        "no_skko",
        "nama_sekolah",
        "tingkat",
        "kelas",
        "cabang",
        "nama_ayah",
        "nik_ayah",
        "nama_ibu",
        "nik_ibu",
        "nama_wali",
        "nik_wali",
        "status_anak")->get();

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function headings(): array

    {

        return ["ID", "NIK", "Nama", "Jenis Kelamin", "Tempat Lahir", "Tanggal Lahir", "Alamat", "Keterangan", "Asrama", "Nomor Akta", "Nomor KK", "Nomor SKKO", "Nama Sekolah", "Tingkat Sekolah", "Kelas", "Cabang", "Nama Ayah", "NIK Ayah", "Nama Ibu", "NIK Ibu", "Nama Wali", "NIK Wali", "Status Anak"];

    }

}