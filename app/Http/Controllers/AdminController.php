<?php
namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\VisitorBook;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use App\Models\BlogPostsCategory;
class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Pass counts to the view
        return view('admin.index');
    }
}