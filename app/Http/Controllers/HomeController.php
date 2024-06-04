<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RandomUser;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function getRandomUser()
    {
        function generateRandomProfession()
        {
            $characters = 'ABCDE';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 1; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $user = new RandomUser();
        $response = $user->getData();
        $temp = $response->results[0];

        $name = $temp->name->first . " " . $temp->name->last;
        $location = $temp->location->street->name . "," . $temp->location->city . "," . $temp->location->state . "," . $temp->location->country;
        $email = $temp->email;
        $gender = $temp->gender == "male" ? 1 : 2;
        $lessNumber = 0;
        $moreNumber = 0;
        $profession = generateRandomProfession();
        $plainJson = json_encode($temp);

        foreach (str_split($temp->login->md5) as $char) {
            $num = (int) $char;
            if ($num < 7) {
                $lessNumber += $num;
            }
            if ($num > 7) {
                $moreNumber += $num;
            }
        }

        $query = "
        INSERT INTO tabel_hasil_response (nama, nama_jalan, email, angka_kurang, angka_lebih, plain_json, profesi, jenis_kelamin, id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NULL);
        ";

        DB::insert($query, [$name, $location, $email, $lessNumber, $moreNumber, $plainJson, $profession, $gender]);
        echo '1';
    }

    public function index()
    {
        $query = "SELECT j.jenis_kelamin, h.nama, h.nama_jalan, h.email, p.nama_profesi FROM tabel_hasil_response h
        JOIN tabel_jenis_kelamin j ON j.kode = h.jenis_kelamin
        JOIN tabel_profesi p ON p.kode = h.profesi";

        $db = DB::select($query);
        return view('user', compact('db'));
    }

    public function getProfesi()
    {
        $query = "SELECT p.nama_profesi, COUNT(p.kode) jumlah FROM tabel_profesi p
        JOIN tabel_hasil_response h ON p.kode = h.profesi GROUP BY p.kode";

        $db = DB::select($query);
        return view('profesi', compact('db'));
    }
}
