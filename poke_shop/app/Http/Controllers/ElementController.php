<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Element;

class ElementController extends Controller
{
    public function index()
    {
        // dd('sampai boss');
        //$elements = Element::all();
        $elements = Element::paginate(5);
        
        return view('admin.element.index', compact('elements'));
    }

    public function create()
    {
        return view('admin.element.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required', 
        ]);

        /** Insert Image */
        $file = $request->file('element_img');
        $filename = $file->getClientOriginalName();
        $request->file('element_img')->move("image_element/", $filename);

        $element = Element::create([
            'name' => $request->name, 
            'image_path'=> $filename,
        ]);

        return redirect('/admin/element')->with('msg-success', 'Element Added');
    }

    public function edit($id)
    {
        $element = Element::findOrFail($id);
        return view('admin.element.edit', compact('element'));
    }

    public function update(Request $request, $id)
    {
        $element = Element::findOrFail($id);

        /** Insert Image */
        $file = $request->file('element_img');
        $filename = $file->getClientOriginalName();
        $request->file('element_img')->move("image_element/", $filename);
        
        $element->update([
            'name'=>$request->name, 
            'image_path'=> $filename,
        ]);       
 
        return redirect('/admin/element')->with('msg-success', 'Element Updated');
    }

    public function destroy($id)
    {
        $element = Element::findOrFail($id);
        $element->delete();

        return redirect('/admin/element')->with('msg-delete', 'Element Deleted');
    }
}
