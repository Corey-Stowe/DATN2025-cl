<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $message = [
            'order_id'=> rand(1,10),
            'user_id'=> rand(1,10),
            'full_name'=> 'Nguyễn Trung Xuyên',
            'message'=> 'nội dung thông báo mới',
                ];
        for ($i = 1; $i <= 59; $i++) {
            DB::table('notifications')->insert([
                'user_id' => null,  
                'title' => 'Notification Title ' . $i,  
                'message' =>  json_encode($message),  
                'is_read' => (bool)rand(0, 1),  
                'read_at' => (rand(0, 1) ? Carbon::now() : null),  
                'created_at' => Carbon::now(),  
            ]);
        }
    }
}
