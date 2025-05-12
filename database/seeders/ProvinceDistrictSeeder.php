<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\District;

class ProvinceDistrictSeeder extends Seeder
{
    public function run()
    {
        $provinces = [
            [
                'name' => 'Province No. 1',
                'number' => '1',
                'districts' => [
                    ['name' => 'Bhojpur', 'headquarters' => 'Bhojpur'],
                    ['name' => 'Dhankuta', 'headquarters' => 'Dhankuta'],
                    ['name' => 'Ilam', 'headquarters' => 'Ilam'],
                    ['name' => 'Jhapa', 'headquarters' => 'Bhadrapur'],
                    ['name' => 'Khotang', 'headquarters' => 'Diktel'],
                    ['name' => 'Morang', 'headquarters' => 'Biratnagar'],
                    ['name' => 'Okhaldhunga', 'headquarters' => 'Siddhicharan'],
                    ['name' => 'Panchthar', 'headquarters' => 'Phidim'],
                    ['name' => 'Sankhuwasabha', 'headquarters' => 'Khandbari'],
                    ['name' => 'Solukhumbu', 'headquarters' => 'Salleri'],
                    ['name' => 'Sunsari', 'headquarters' => 'Inaruwa'],
                    ['name' => 'Taplejung', 'headquarters' => 'Taplejung'],
                    ['name' => 'Terhathum', 'headquarters' => 'Myanglung'],
                    ['name' => 'Udayapur', 'headquarters' => 'Gaighat'],
                ]
            ],
            [
                'name' => 'Province No. 2',
                'number' => '2',
                'districts' => [
                    ['name' => 'Saptari', 'headquarters' => 'Rajbiraj'],
                    ['name' => 'Siraha', 'headquarters' => 'Siraha'],
                    ['name' => 'Dhanusha', 'headquarters' => 'Janakpur'],
                    ['name' => 'Mahottari', 'headquarters' => 'Jaleshwar'],
                    ['name' => 'Sarlahi', 'headquarters' => 'Malangwa'],
                    ['name' => 'Bara', 'headquarters' => 'Kalaiya'],
                    ['name' => 'Parsa', 'headquarters' => 'Birganj'],
                    ['name' => 'Rautahat', 'headquarters' => 'Gaur'],
                ]
            ],
            [
                'name' => 'Bagmati Province',
                'number' => '3',
                'districts' => [
                    ['name' => 'Sindhuli', 'headquarters' => 'Kamalamai'],
                    ['name' => 'Ramechhap', 'headquarters' => 'Manthali'],
                    ['name' => 'Dolakha', 'headquarters' => 'Bhimeshwar'],
                    ['name' => 'Bhaktapur', 'headquarters' => 'Bhaktapur'],
                    ['name' => 'Dhading', 'headquarters' => 'Nilkantha'],
                    ['name' => 'Kathmandu', 'headquarters' => 'Kathmandu'],
                    ['name' => 'Kavrepalanchok', 'headquarters' => 'Dhulikhel'],
                    ['name' => 'Lalitpur', 'headquarters' => 'Lalitpur'],
                    ['name' => 'Nuwakot', 'headquarters' => 'Bidur'],
                    ['name' => 'Rasuwa', 'headquarters' => 'Dhunche'],
                    ['name' => 'Sindhupalchok', 'headquarters' => 'Chautara'],
                    ['name' => 'Chitwan', 'headquarters' => 'Bharatpur'],
                    ['name' => 'Makwanpur', 'headquarters' => 'Hetauda'],
                ]
            ],
            [
                'name' => 'Gandaki Province',
                'number' => '4',
                'districts' => [
                    ['name' => 'Baglung', 'headquarters' => 'Baglung'],
                    ['name' => 'Gorkha', 'headquarters' => 'Gorkha'],
                    ['name' => 'Kaski', 'headquarters' => 'Pokhara'],
                    ['name' => 'Lamjung', 'headquarters' => 'Besisahar'],
                    ['name' => 'Manang', 'headquarters' => 'Chame'],
                    ['name' => 'Mustang', 'headquarters' => 'Jomsom'],
                    ['name' => 'Myagdi', 'headquarters' => 'Beni'],
                    ['name' => 'Nawalpur', 'headquarters' => 'Kawasoti'],
                    ['name' => 'Parbat', 'headquarters' => 'Kusma'],
                    ['name' => 'Syangja', 'headquarters' => 'Putalibazar'],
                    ['name' => 'Tanahun', 'headquarters' => 'Damauli'],
                ]
            ],
            [
                'name' => 'Lumbini Province',
                'number' => '5',
                'districts' => [
                    ['name' => 'Kapilvastu', 'headquarters' => 'Taulihawa'],
                    ['name' => 'Parasi', 'headquarters' => 'Ramgram'],
                    ['name' => 'Rupandehi', 'headquarters' => 'Siddharthanagar'],
                    ['name' => 'Arghakhanchi', 'headquarters' => 'Sandhikharka'],
                    ['name' => 'Gulmi', 'headquarters' => 'Tamghas'],
                    ['name' => 'Palpa', 'headquarters' => 'Tansen'],
                    ['name' => 'Dang', 'headquarters' => 'Ghorahi'],
                    ['name' => 'Pyuthan', 'headquarters' => 'Pyuthan'],
                    ['name' => 'Rolpa', 'headquarters' => 'Liwang'],
                    ['name' => 'Eastern Rukum', 'headquarters' => 'Rukumkot'],
                    ['name' => 'Banke', 'headquarters' => 'Nepalganj'],
                    ['name' => 'Bardiya', 'headquarters' => 'Gulariya'],
                ]
            ],
            [
                'name' => 'Karnali Province',
                'number' => '6',
                'districts' => [
                    ['name' => 'Western Rukum', 'headquarters' => 'Musikot'],
                    ['name' => 'Salyan', 'headquarters' => 'Salyan'],
                    ['name' => 'Dolpa', 'headquarters' => 'Dunai'],
                    ['name' => 'Humla', 'headquarters' => 'Simikot'],
                    ['name' => 'Jumla', 'headquarters' => 'Chandannath'],
                    ['name' => 'Kalikot', 'headquarters' => 'Manma'],
                    ['name' => 'Mugu', 'headquarters' => 'Gamgadhi'],
                    ['name' => 'Surkhet', 'headquarters' => 'Birendranagar'],
                    ['name' => 'Dailekh', 'headquarters' => 'Narayan'],
                    ['name' => 'Jajarkot', 'headquarters' => 'Khalanga'],
                ]
            ],
            [
                'name' => 'Sudurpashchim Province',
                'number' => '7',
                'districts' => [
                    ['name' => 'Kailali', 'headquarters' => 'Dhangadhi'],
                    ['name' => 'Achham', 'headquarters' => 'Mangalsen'],
                    ['name' => 'Doti', 'headquarters' => 'Dipayal Silgadhi'],
                    ['name' => 'Bajhang', 'headquarters' => 'Jayaprithvi'],
                    ['name' => 'Bajura', 'headquarters' => 'Martadi'],
                    ['name' => 'Kanchanpur', 'headquarters' => 'Bhimdatta'],
                    ['name' => 'Dadeldhura', 'headquarters' => 'Amargadhi'],
                    ['name' => 'Baitadi', 'headquarters' => 'Dasharathchand'],
                    ['name' => 'Darchula', 'headquarters' => 'Darchula'],
                ]
            ]
        ];

        foreach ($provinces as $provinceData) {
            $province = Province::create([
                'name' => $provinceData['name'],
                'number' => $provinceData['number']
            ]);

            foreach ($provinceData['districts'] as $districtData) {
                District::create([
                    'province_id' => $province->id,
                    'name' => $districtData['name'],
                    'headquarters' => $districtData['headquarters']
                ]);
            }
        }
    }
}