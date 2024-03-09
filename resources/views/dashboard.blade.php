{{--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <h3>Hello world</h3>
    {{Auth::user()}}
    {{Auth::id()}}

    <?php
        $user = Auth::user();

        echo $user ;
        echo "<br/>";

        echo $user->id ."<br/>";
        echo $user->name ."<br/>";
        echo $user->email ."<br/>";
        echo $user->password ."<br/>";

    
    ?>

    {{--Auth::user() => log in ဝင်ထားသောကောင်၏ info အားလုံးထွက်လာမည် --}}
    {{--Auth::id() => log in ဝင်ထားသောကောင်၏ id ရလာမည်  --}}
    {{--Auth::name() => error တက်နေမည်ဖြစ်ပြီး name သည် custom လုပ်ထားသောကြောင့် ခေါ်မရပေ   --}}
</body>
</html>

