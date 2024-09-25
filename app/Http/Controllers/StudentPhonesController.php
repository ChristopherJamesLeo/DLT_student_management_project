<?php

namespace App\Http\Controllers;

use App\Models\StudentPhone;
use Illuminate\Http\Request;

class StudentPhonesController extends Controller
{
    public function destory(string $id){
        $studentphone = StudentPhone::find($id);

        $studentphone->delete();
        session()->flash('delete', 'Student phone deleted successfully');
        return redirect()->back();
    }
}
