<?php
use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('petugas.kategori', compact('categories'));
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'Kategori ditambahkan!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Kategori dihapus!');
    }
}

