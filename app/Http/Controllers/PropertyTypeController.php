<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use App\Models\PropertyType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    //
    public function AllType()
    {
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    }
    public function AllAmenities()
    {
        $amenities = Amenities::latest()->get();
        return view('backend.amenities.all_amenities', compact('amenities'));
    }
    public function AddType()
    {
        return view('backend.type.add_type');
    }
    public function AddAmenities()
    {
        return view('backend.amenities.add_amenities');
    }
    public function EditType(Request $request)
    {
        $types = PropertyType::findOrFail($request->id);
        return view('backend.type.edit_type', compact('types'));
    }
    public function EditAmenity(Request $request)
    {
        $amenities = Amenities::findOrFail($request->id);
        return view('backend.amenities.edit_amenities', compact('amenities'));
    }

    public function StoreType(Request $request)
    {
        $request->validate(['type_name' => 'required|unique:property_types|max:200', 'type_icon' => 'required']);

        $notification = array('message' => 'store type successfully', 'alert-type' => "success");

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        return redirect()->route('all.type')->with($notification);
    }
    public function StoreAmenity(Request $request)
    {
        $request->validate(['amenities_name' => 'required']);


        Amenities::insert([
            'amenities_name' => $request->amenities_name,
        ]);

        $notification = array('message' => 'store amenity successfully', 'alert-type' => "success");
        return redirect()->route('all.amenities')->with($notification);
    }

    public function UpdateType(Request $request)
    {
        $pid = $request->id;

        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);

        $notification = array('message' => 'store type update successfully', 'alert-type' => "success");


        return redirect()->route('all.type')->with($notification);
    }
    public function UpdateAmenity(Request $request)
    {
        $ame_id = $request->id;

        Amenities::findOrFail($ame_id)->update([
            'amenities_name' => $request->amenities_name,
        ]);

        $notification = array('message' => 'store amenties update successfully', 'alert-type' => "success");


        return redirect()->route('all.amenities')->with($notification);
    }
    public function DeleteType($id)
    {
        PropertyType::findOrFail($id)->delete();
        $notification = array('meswesage' => 'delete successfully', 'alert-type' => "success");

        return redirect()->back()->with($notification);
    }
    // Air conditioning 

}