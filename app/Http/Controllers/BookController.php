<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Barryvdh\DomPDF\PDF;
use App\Exports\BookExport;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
   

    public function plus($id){

        Book::find($id)->increment('download', 1);
        $book = Book::find($id);
        User::where('id', Auth::user()->id)->increment('downloaduser', 1);

        return redirect()->route('download.pdf', $book->id);
    }

    public function downloadpdf($id){

        $books = Book::where('id', '=', $id)->first();
        $filepath = public_path('pdf/' . $books->pdf);
        $filename = $books->title . '.pdf';
        return Response::download($filepath, $filename);
    }
    public function read(Request $request){
        
        $categories = Category::all();
        $books = Book::all();
      
        return view('page.userdashboard.galery', compact('categories', 'books'));
    }

    public function page(){

        $categories = Category::all();
        $booktop = Book::with('category')->orderBy('download', 'desc')->paginate(3);;

        return view('page.userdashboard.index', compact('categories','booktop'));
    }
    public function index(Request $request)
    {

        // dd($request->search);
        $keyword = $request->keyword;
        
        $books = Book::with('category')->where('title', 'LIKE', '%'.$keyword.'%')
                                        ->orWhere('writer', 'LIKE', '%'.$keyword.'%' )
                                        ->orWhere('publisher', 'LIKE', '%'.$keyword.'%')
                                        ->orWhere('isbn', 'LIKE', '%'.$keyword.'%')
                                        ->paginate(5);

        return view('dashboard.book.data', compact('books'));
    }

    public function search(Request $request){
 
         // dapatkan keyword dari querystring ?name=keyword
        $keyword = $request->get("search");
        // cari kategori where name == keyword dari querystring
        return Book::where("title", "LIKE", "%$keyword%")->get();
            
    }


    public function create()
    {
        $categories = Category::all();
        return view('dashboard.book.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $cover = $request->coverbook;
        $coverBook = $cover->getClientOriginalName();

        $pdf = $request->pdf;
        $pdfName = $pdf->getClientOriginalName();

        $dtCover = Book::create([
            "title" => $request->title,
            "writer" => $request->writer,
            "publisher" => $request->publisher,
            "isbn" => $request->isbn,
            "category_id" => $request->category_id,
            "synopsis" => $request->synopsis,
            "coverbook" => $coverBook,
            "pdf" => $pdfName
        ]);

        $cover->move(public_path() . '/img', $coverBook);
        $pdf->move(public_path() . './pdf', $pdfName);
        $dtCover->save();

        return redirect('/dashboard/books')->with('success', 'successfully added book list');
    }

    public function show($id)
    {
        $detailbook = Book::findOrFail($id);
        $categories = Category::all();
        return view('page.userdashboard.detail', compact('detailbook', 'categories'));
    }

    public function edit($id)
    {
        $book = Book::where('id', '=', $id)->first();
        $categories = Category::all();
        return view('dashboard.book.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {

        $ubah = Book::findorfail($id);
        $cover = $ubah->coverbook;
        $pdf = $ubah->pdf;

        $data = [
            "title" => $request->title,
            "writer" => $request->writer,
            "publisher" => $request->publisher,
            "isbn" => $request->isbn,
            "category_id" => $request->category_id,
            "synopsis" => $request->synopsis,

        ];

        $request->coverbook->move(public_path() . '/img', $cover);
        $request->pdf->move(public_path() . '/pdf', $pdf);
        $ubah->update($data);
        return redirect('/dashboard/books')->with('success', "berhasil update data buku");
        
    }
    public function destroy($id)
    {
        // dd($id);
        $hapus = Book::findorfail($id);

        $file = public_path('/img/') . $hapus->coverbook;
        $pdf = public_path('/pdf/') . $hapus->pdf;

        //cek jika ada gambar
        if(file_exists($file)){
            //maka hapus file di folder public/img
            @unlink($file);
        }

        if(file_exists($pdf)){
            @unlink($pdf);
        }

        $hapus->delete();
        return back()->with('success', "berhasil Hapus data buku");
    }


    public function bookexport(){
        return Excel::download(new BookExport, 'books.xlsx');
    }

    public function cetakpdf(){
        $books = Book::with('category')->get();
        return view('dashboard.book.cetakpdf', compact('books'));
    }

    public function showCategoryBook(Category $category){
      
        // return $data;
        $categories = Category::all();
        $books = $category->books()->get();
        // 'title' => "Kategori Prestasi: ".$category->name,
    
        return view('page.userdashboard.galery', compact('categories', 'books'));

    }
}

