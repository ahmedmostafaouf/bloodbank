<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=\App\Models\Setting::create([
            'notification_setting_text'=>'هذا تطبيق بنك الدم يساعد علي اضافه حالات تحتاج الي تبرع بالدم وعلي الاعضاء الذهاب الي التبرع',
            'about_app' =>'هذا تطبيق بنك الدم يساعد علي اضافه حالات تحتاج الي تبرع بالدم وعلي الاعضاء الذهاب الي التبرع',
            'long_desc'     =>'هذا تطبيق بنك الدم يساعد علي اضافه حالات تحتاج الي تبرع بالدم وعلي الاعضاء الذهاب الي التبرع',
            'small_desc'  =>'هذا تطبيق بنك الدم يساعد علي اضافه حالات تحتاج الي تبرع بالدم وعلي الاعضاء الذهاب الي التبرع',
            'phone'  =>'+20-1066273085',
            'email'  =>'a7med.mostafa9900@gmail.com',
            'fb_url'  =>'https://www.facebook.com/profile.php?id=100004246381723',
            'tw_url'  =>'https://www.facebook.com/profile.php?id=100004246381723',
            'insta_url'  =>'https://www.facebook.com/profile.php?id=100004246381723',
            'youtube_url'  =>'https://www.facebook.com/profile.php?id=100004246381723',
        ]);
    }
}
