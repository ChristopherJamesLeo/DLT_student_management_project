<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Stage;
use App\Models\Status;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();

        User::create([
            "name" => "admin",
            "email" => "ninthprogramming.9p.hotmail@gmail.com",
            "password" => Hash::make("12345678")
        ]);

        Status::truncate();

        $statuses = [
            [
                "name" => "Active",
                "slug" => Str::slug("Active"),
                "user_id" => 1
            ],[
                "name" => "Inactive",
                "slug" => Str::slug("Inactive"),
                "user_id" => 1
            ],[
                "name" => "On",
                "slug" => Str::slug("On"),
                "user_id" => 1
            ],[
                "name" => "Off",
                "slug" => Str::slug("Off"),
                "user_id" => 1
            ],[
                "name" => "Online",
                "slug" => Str::slug("Online"),
                "user_id" => 1
            ],[
                "name" => "Offline",
                "slug" => Str::slug("Offline"),
                "user_id" => 1
            ],[
                "name" => "Public",
                "slug" => Str::slug("Public"),
                "user_id" => 1
            ],[
                "name" => "Private",
                "slug" => Str::slug("Private"),
                "user_id" => 1
            ],[
                "name" => "Friend Only",
                "slug" => Str::slug("Friend Only"),
                "user_id" => 1
            ],[
                "name" => "Member Only",
                "slug" => Str::slug("Member Only"),
                "user_id" => 1
            ],[
                "name" => "Only Me",
                "slug" => Str::slug("Only Me"),
                "user_id" => 1
            ],[
                "name" => "Enable",
                "slug" => Str::slug("Enable"),
                "user_id" => 1
            ],[
                "name" => "Disable",
                "slug" => Str::slug("Disable"),
                "user_id" => 1
            ],[
                "name" => "Ban",
                "slug" => Str::slug("Ban"),
                "user_id" => 1
            ],[
                "name" => "Unban",
                "slug" => Str::slug("Unban"),
                "user_id" => 1
            ],[
                "name" => "Block",
                "slug" => Str::slug("Block"),
                "user_id" => 1
            ],[
                "name" => "Unblock",
                "slug" => Str::slug("Unblock"),
                "user_id" => 1
            ],[
                "name" => "Terminate",
                "slug" => Str::slug("Terminate"),
                "user_id" => 1
            ],
        ];

        Status::insert($statuses);

        Stage::truncate();

        $stages = [
            [
                "name" => "Approved",
                "slug" => Str::slug("Approved"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Pending",
                "slug" => Str::slug("Pending"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Reject",
                "slug" => Str::slug("Reject"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Complete",
                "slug" => Str::slug("Complete"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Incomplete",
                "slug" => Str::slug("Incomplete"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Loading",
                "slug" => Str::slug("Loading"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Processing",
                "slug" => Str::slug("Processing"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Passed",
                "slug" => Str::slug("Passed"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Request",
                "slug" => Str::slug("Request"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Waiting",
                "slug" => Str::slug("Waiting"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Verifying",
                "slug" => Str::slug("Verifying"),
                "user_id" => 1,
                "status_id" => 3,
            ],[
                "name" => "Verified",
                "slug" => Str::slug("Verified"),
                "user_id" => 1,
                "status_id" => 3,
            ]
        ];

        Stage::insert($stages);

        
    }
}
