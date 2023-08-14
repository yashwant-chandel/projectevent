<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectiontypeController extends Controller
{
    public function index(){
        echo 'done';
        return view('Admin.sectiontype.index');
    }
}
