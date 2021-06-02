<?php
namespace App\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\StorageFileController;
class Test extends Model 
{
    use HasFactory;
    protected $table = "tests";
    protected $fillable = ["name", "description", "file_path", "id_u"];
    protected $primaryKey = "id";
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = true;

    public function index()
    {

    }
    public function create()
    {

    }
    public function store(Request $request)
    {
    }
    public function TestsList()
    {

    }
}

