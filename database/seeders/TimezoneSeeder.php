<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Timezone;

class TimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timezone::create(['value' => 'Pacific/Midway', 'title' => '(UTC-11:00) Midway Island, American Samoa']);
        Timezone::create(['value' => 'Pacific/Honolulu', 'title' => '(UTC-10:00) Hawaii']);
        Timezone::create(['value' => 'America/Anchorage', 'title' => '(UTC-08:00) Alaska']);
        Timezone::create(['value' => 'America/Tijuana', 'title' => '(UTC-07:00) Baja California']);
        Timezone::create(['value' => 'America/Los_Angeles', 'title' => '(UTC-07:00) Pacific Time (US and Canada)']);
        Timezone::create(['value' => 'America/Phoenix', 'title' => '(UTC-07:00) Arizona']);
        Timezone::create(['value' => 'America/Chihuahua', 'title' => '(UTC-06:00) Chihuahua, La Paz, Mazatlan']);
        Timezone::create(['value' => 'America/Denver', 'title' => '(UTC-06:00) Mountain Time (US and Canada)']);
        Timezone::create(['value' => 'America/Belize', 'title' => '(UTC-06:00) Central America']);
        Timezone::create(['value' => 'America/Chicago', 'title' => '(UTC-05:00) Central Time (US and Canada)	']);
        Timezone::create(['value' => 'America/Mexico_City', 'title' => '(UTC-05:00) Guadalajara, Mexico City, Monterrey']);
        Timezone::create(['value' => 'America/Regina', 'title' => '(UTC-06:00) Saskatchewan']);
        Timezone::create(['value' => 'America/Bogota', 'title' => '(UTC-05:00) Bogota, Lima, Quito']);
        Timezone::create(['value' => 'America/Jamaica', 'title' => '(UTC-05:00) Kingston, George Town']);
        Timezone::create(['value' => 'America/New_York', 'title' => '(UTC-04:00) Eastern Time (US and Canada)']);
        Timezone::create(['value' => 'America/Indiana/Indianapolis', 'title' => '(UTC-04:00) Indiana (East)']);
        Timezone::create(['value' => 'America/Caracas', 'title' => '(UTC-04:30) Caracas']);
        Timezone::create(['value' => 'America/Asuncion', 'title' => '(UTC-03:00) Asuncion']);
        Timezone::create(['value' => 'America/Halifax', 'title' => '(UTC-03:00) Atlantic Time (Canada)']);
        Timezone::create(['value' => 'America/Cuiaba', 'title' => '(UTC-04:00) Cuiaba']);
        Timezone::create(['value' => 'America/Manaus', 'title' => '(UTC-04:00) Georgetown, La Paz, Manaus, San Juan']);
        Timezone::create(['value' => 'America/St_Johns', 'title' => '(UTC-02:30) Newfoundland and Labrador']);
        Timezone::create(['value' => 'America/Sao_Paulo', 'title' => '(UTC-03:00) Brasilia']);
        Timezone::create(['value' => 'America/Buenos_Aires', 'title' => '(UTC-03:00) Buenos Aires']);
        Timezone::create(['value' => 'America/Cayenne', 'title' => '(UTC-03:00) Cayenne, Fortaleza']);
        Timezone::create(['value' => 'America/Godthab', 'title' => '(UTC-02:00) Greenland']);
        Timezone::create(['value' => 'America/Montevideo', 'title' => '(UTC-03:00) Montevideo']);
        Timezone::create(['value' => 'America/Bahia', 'title' => '(UTC-03:00) Salvador']);
        Timezone::create(['value' => 'America/Santiago', 'title' => '(UTC-03:00) Santiago']);
        Timezone::create(['value' => 'America/Noronha', 'title' => '(UTC-02:00) Mid-Atlantic']);
        Timezone::create(['value' => 'Atlantic/Azores', 'title' => '(UTC+00:00) Azores']);
        Timezone::create(['value' => 'Atlantic/Cape_Verde', 'title' => '(UTC-01:00) Cape Verde Islands']);
        Timezone::create(['value' => 'Europe/London', 'title' => '(UTC+01:00) Dublin, Edinburgh, Lisbon, London']);
        Timezone::create(['value' => 'Africa/Casablanca', 'title' => '(UTC+01:00) Casablanca']);
        Timezone::create(['value' => 'Africa/Monrovia', 'title' => '(UTC+00:00) Monrovia, Reykjavik']);
        Timezone::create(['value' => 'Europe/Amsterdam', 'title' => '(UTC+02:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna']);
        Timezone::create(['value' => 'Europe/Belgrade', 'title' => '(UTC+02:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague']);
        Timezone::create(['value' => 'Europe/Brussels', 'title' => '(UTC+02:00) Brussels, Copenhagen, Madrid, Paris']);
        Timezone::create(['value' => 'Europe/Warsaw', 'title' => '(UTC+02:00) Sarajevo, Skopje, Warsaw, Zagreb']);
        Timezone::create(['value' => 'Africa/Algiers', 'title' => '(UTC+01:00) West Central Africa']);
        Timezone::create(['value' => 'Africa/Windhoek', 'title' => '(UTC+02:00) Windhoek']);
        Timezone::create(['value' => 'Europe/Athens', 'title' => '(UTC+03:00) Athens, Bucharest']);
        Timezone::create(['value' => 'Asia/Beirut', 'title' => '(UTC+03:00) Beirut']);
        Timezone::create(['value' => 'Africa/Cairo', 'title' => '(UTC+02:00) Cairo']);
        Timezone::create(['value' => 'Asia/Damascus', 'title' => '(UTC+03:00) Damascus']);
        Timezone::create(['value' => 'EET', 'title' => '(UTC+03:00) Eastern Europe']);
        Timezone::create(['value' => 'Africa/Harare', 'title' => '(UTC+02:00) Harare, Pretoria']);
        Timezone::create(['value' => 'Europe/Helsinki', 'title' => '(UTC+03:00) Helsinki, Kiev, Riga, Sofia, Tallinn, Vilnius']);
        Timezone::create(['value' => 'Asia/Istanbul', 'title' => '(UTC+03:00) Istanbul']);
        Timezone::create(['value' => 'Asia/Jerusalem', 'title' => '(UTC+03:00) Jerusalem']);
        Timezone::create(['value' => 'Europe/Kaliningrad', 'title' => '(UTC+02:00) Kaliningrad']);
        Timezone::create(['value' => 'Africa/Tripoli', 'title' => '(UTC+02:00) Tripoli']);
        Timezone::create(['value' => 'Asia/Amman', 'title' => '(UTC+03:00) Amman']);
        Timezone::create(['value' => 'Asia/Baghdad', 'title' => '(UTC+03:00) Baghdad']);
        Timezone::create(['value' => 'Asia/Kuwait', 'title' => '(UTC+03:00) Kuwait, Riyadh']);
        Timezone::create(['value' => 'Europe/Minsk', 'title' => '(UTC+03:00) Minsk']);
        Timezone::create(['value' => 'Europe/Moscow', 'title' => '(UTC+03:00) Moscow, St. Petersburg, Volgograd']);
        Timezone::create(['value' => 'Africa/Nairobi', 'title' => '(UTC+03:00) Nairobi']);
        Timezone::create(['value' => 'Asia/Tehran', 'title' => '(UTC+03:30) Tehran']);
        Timezone::create(['value' => 'Asia/Muscat', 'title' => '(UTC+04:00) Abu Dhabi, Muscat']);
        Timezone::create(['value' => 'Asia/Baku', 'title' => '(UTC+05:00) Baku']);
        Timezone::create(['value' => 'Europe/Samara', 'title' => '(UTC+04:00) Izhevsk, Samara']);
        Timezone::create(['value' => 'Indian/Mauritius', 'title' => '(UTC+04:00) Port Louis']);
        Timezone::create(['value' => 'Asia/Tbilisi', 'title' => '(UTC+04:00) Tbilisi']);
        Timezone::create(['value' => 'Asia/Yerevan', 'title' => '(UTC+04:00) Yerevan']);
        Timezone::create(['value' => 'Asia/Kabul', 'title' => '(UTC+04:30) Kabul']);
        Timezone::create(['value' => 'Asia/Tashkent', 'title' => '(UTC+05:00) Tashkent, Ashgabat']);
        Timezone::create(['value' => 'Asia/Yekaterinburg', 'title' => '(UTC+05:00) Ekaterinburg']);
        Timezone::create(['value' => 'Asia/Karachi', 'title' => '(UTC+05:00) Islamabad, Karachi']);
        Timezone::create(['value' => 'Asia/Kolkata', 'title' => '(UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi']);
        Timezone::create(['value' => 'Asia/Colombo', 'title' => '(UTC+05:30) Sri Jayawardenepura']);
        Timezone::create(['value' => 'Asia/Katmandu', 'title' => '(UTC+05:45) Kathmandu']);
        Timezone::create(['value' => 'Asia/Almaty', 'title' => '(UTC+06:00) Astana']);
        Timezone::create(['value' => 'Asia/Dhaka', 'title' => '(UTC+06:00) Dhaka']);
        Timezone::create(['value' => 'Asia/Novosibirsk', 'title' => '(UTC+06:00) Novosibirsk']);
        Timezone::create(['value' => 'Asia/Rangoon', 'title' => '(UTC+06:30) Yangon (Rangoon)']);
        Timezone::create(['value' => 'Asia/Bangkok', 'title' => '(UTC+07:00) Bangkok, Hanoi, Jakarta']);
        Timezone::create(['value' => 'Asia/Krasnoyarsk', 'title' => '(UTC+07:00) Krasnoyarsk']);
        Timezone::create(['value' => 'Asia/Chongqing', 'title' => '(UTC+08:00) Beijing, Chongqing, Hong Kong SAR, Urumqi']);
        Timezone::create(['value' => 'Asia/Irkutsk', 'title' => '(UTC+08:00) Irkutsk']);
        Timezone::create(['value' => 'Asia/Kuala_Lumpur', 'title' => '(UTC+08:00) Kuala Lumpur, Singapore']);
        Timezone::create(['value' => 'Australia/Perth', 'title' => '(UTC+08:00) Perth']);
        Timezone::create(['value' => 'Asia/Taipei', 'title' => '(UTC+08:00) Taipei']);
        Timezone::create(['value' => 'Asia/Ulaanbaatar', 'title' => '(UTC+08:00) Ulaanbaatar']);
        Timezone::create(['value' => 'Asia/Tokyo', 'title' => '(UTC+09:00) Osaka, Sapporo, Tokyo']);
        Timezone::create(['value' => 'Asia/Seoul', 'title' => '(UTC+09:00) Seoul']);
        Timezone::create(['value' => 'Asia/Yakutsk', 'title' => '(UTC+09:00) Yakutsk']);
        Timezone::create(['value' => 'Australia/Adelaide', 'title' => '(UTC+10:30) Adelaide']);
        Timezone::create(['value' => 'Australia/Darwin', 'title' => '(UTC+09:30) Darwin']);
        Timezone::create(['value' => 'Australia/Brisbane', 'title' => '(UTC+10:00) Brisbane']);
        Timezone::create(['value' => 'Australia/Canberra', 'title' => '(UTC+11:00) Canberra, Melbourne, Sydney']);
        Timezone::create(['value' => 'Pacific/Guam', 'title' => '(UTC+10:00) Guam, Port Moresby']);
        Timezone::create(['value' => 'Australia/Hobart', 'title' => '(UTC+11:00) Hobart']);
        Timezone::create(['value' => 'Asia/Magadan', 'title' => '(UTC+10:00) Magadan']);
        Timezone::create(['value' => 'Asia/Vladivostok', 'title' => '(UTC+10:00) Vladivostok, Magadan']);
        Timezone::create(['value' => 'Asia/Srednekolymsk', 'title' => '(UTC+11:00) Chokirdakh']);
        Timezone::create(['value' => 'Pacific/Guadalcanal', 'title' => '(UTC+11:00) Solomon Islands, New Caledonia']);
        Timezone::create(['value' => 'Asia/Anadyr', 'title' => '(UTC+12:00) Anadyr, Petropavlovsk-Kamchatsky']);
        Timezone::create(['value' => 'Pacific/Auckland', 'title' => '(UTC+13:00) Auckland, Wellington']);
        Timezone::create(['value' => 'Pacific/Fiji', 'title' => '(UTC+12:00) Fiji Islands, Kamchatka, Marshall Islands']);
        Timezone::create(['value' => 'Pacific/Tongatapu', 'title' => "(UTC+13:00) Nuku'alofa"]);
        Timezone::create(['value' => 'Pacific/Apia', 'title' => "(UTC+14:00) Samoa"]);
    }
}
