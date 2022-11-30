<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Driver;
use App\Model\DMReview;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class DriverController extends Controller
{
    public function index()
    {
        return view('admin-views.driver.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $driver = Driver::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('mobile', 'like', "%{$value}%")
                        ->orWhere('pincode', 'like', "%{$value}%")
                        ->orWhere('vehicle_type', 'like', "%{$value}%")
                        ->orWhere('vehicle_number', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $driver = new Driver();
        }

        $drivers = $driver->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.driver.list', compact('drivers', 'search'));
    }

    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $driver = Driver::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%")
                    ->orWhere('mobile', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhere('vehicle_number', 'like', "%{$value}%")
                    ->orWhere('pincode', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.driver.partials._table', compact('drivers'))->render()
        ]);
    }

    // public function reviews_list(Request $request)
    // {
    //     $query_param = [];
    //     $search = $request['search'];
    //     if ($request->has('search')) {
    //         $key = explode(' ', $request['search']);
    //         $delivery_men = DeliveryMan::where(function ($q) use ($key) {
    //             foreach ($key as $value) {
    //                 $q->orWhere('f_name', 'like', "%{$value}%")
    //                     ->orWhere('l_name', 'like', "%{$value}%");
    //             }
    //         })->pluck('id')->toArray();
    //         $reviews = DMReview::whereIn('delivery_man_id', $delivery_men);
    //         $query_param = ['search' => $request['search']];
    //     }else{
    //         $reviews = new DMReview();
    //     }

    //     $reviews = $reviews->with(['delivery_man', 'customer'])->latest()->paginate(Helpers::getPagination())->appends($query_param);
    //     return view('admin-views.delivery-man.reviews-list', compact('reviews', 'search'));
    // }

    public function preview($id)
    {
        $driver = Driver::where(['id' => $id])->first();
        return view('admin-views.driver.view', compact('driver'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'dob' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:drivers',
            'mobile' => 'required|unique:drivers',
            'dob' => 'required',
            'password' => 'required',
            'address' => 'required',
            'district' => 'required',
            'state' => 'required',
            'pincode' => 'required',


        ], [
            'name.required' => translate('Name is required!')
        ]);

        $id_img_names = [];
        if (!empty($request->file('vehicle_image'))) {
            foreach ($request->vehicle_image as $img) {
                array_push($id_img_names, Helpers::upload('driver/driver-proof/', 'png', $img));
            }
            $vehicle_image = json_encode($id_img_names);
        } else {
            $vehicle_image = json_encode([]);
        }

        $driver = new Driver();
        $driver->name = $request->name;
        $driver->dob = $request->dob;
        $driver->email = $request->email;
        $driver->mobile = $request->mobile;
        $driver->password = bcrypt($request->password);
        $driver->address = $request->address;
        $driver->district = $request->district;
        $driver->pincode = $request->pincode;
        $driver->state = $request->state;
        $driver->vehicle_type = $request->vehicle_type;
        $driver->vehicle_number = $request->vehicle_number;
        $driver->vehicle_image = $vehicle_image;
        $driver->image = Helpers::upload('driver/', 'png', $request->file('image'));
        $driver->license_image = Helpers::upload('driver/driver-proof/', 'png', $request->file('license_image'));
        $driver->rc_image = Helpers::upload('driver/driver-proof/', 'png', $request->file('rc_image'));

        $driver->save();

        Toastr::success(translate('Driver added successfully!'));
        return redirect('admin/driver/list');
    }

    public function edit($id)
    {
        $driver = Driver::find($id);
        return view('admin-views.driver.edit', compact('driver'));
    }

    public function status(Request $request)
    {
        $driver = Driver::find($request->id);
        $driver->status = $request->status;
        $driver->save();
        Toastr::success(translate('Driver status updated!'));
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
        ], [
            'name.required' => translate('First name is required!'),
            'mobile.required' => translate('Mobile Number is required!'),
            'vehicle_number.required' => translate('Vehicle Number is required!')
        ]);

        $driver = Driver::find($id);

        if ($driver['email'] != $request['email']) {
            $request->validate([
                'email' => 'required|unique:drivers',
            ]);
        }

        if ($driver['mobile'] != $request['mobile']) {
            $request->validate([
                'mobile' => 'required|unique:drivers',
            ]);
        }

        if (!empty($request->file('vehicle_image'))) {
            foreach (json_decode($driver['vehicle_image'], true) as $img) {
                if (Storage::disk('public')->exists('driver/driver-proof' . $img)) {
                    Storage::disk('public')->delete('driver/driver-proof' . $img);
                }
            }
            $img_keeper = [];
            foreach ($request->vehicle_image as $img) {
                array_push($img_keeper, Helpers::upload('driver/driver-proof/', 'png', $img));
            }
            $vehicle_image = json_encode($img_keeper);
        } else {
            $vehicle_image = $driver['vehicle_image'];
        }
        $driver->name = $request->name;
        $driver->dob = $request->dob;
        $driver->email = $request->email;
        $driver->mobile = $request->mobile;
        $driver->address = $request->address;
        $driver->district = $request->district;
        $driver->pincode = $request->pincode;
        $driver->state = $request->state;
        $driver->vehicle_type = $request->vehicle_type;
        $driver->vehicle_number = $request->vehicle_number;
        $driver->vehicle_image = $vehicle_image;
        $driver->image = $request->has('image') ? Helpers::update('driver/', $driver->image, 'png', $request->file('image')) : $driver->image;
        $driver->rc_image = $request->has('rc_image') ? Helpers::update('driver/driver-proof/', $driver->image, 'png', $request->file('rc_image')) : $driver->rc_image;
        $driver->license_image = $request->has('license_image') ? Helpers::update('driver/driver-proof/', $driver->license_image, 'png', $request->file('license_image')) : $driver->license_image;
        $driver->password = strlen($request->password) > 1 ? bcrypt($request->password) : $driver['password'];
        $driver->save();

        Toastr::success(translate('Driver updated successfully!'));
        return redirect('admin/driver/list');
    }

    public function delete(Request $request)
    {
        $driver = Driver::find($request->id);
        if (Storage::disk('public')->exists('driver/' . $driver['image'])) {
            Storage::disk('public')->delete('driver/' . $driver['image']);
        }
        if (Storage::disk('public')->exists('driver/driver-proof/' . $driver['rc_image'])) {
            Storage::disk('public')->delete('driver/driver-proof/' . $driver['rc_image']);
        } 
         if (Storage::disk('public')->exists('driver/driver-proof/' . $driver['license_image'])) {
            Storage::disk('public')->delete('driver/driver-proof/' . $driver['license_image']);
        }
        foreach (json_decode($driver['vehicle_image'], true) as $img) {
            if (Storage::disk('public')->exists('driver/driver-proof/' . $img)) {
                Storage::disk('public')->delete('driver/driver-proof/' . $img);
            }
        }

        $driver->delete();
        Toastr::success(translate('Driver removed Successfully!'));
        return back();
    }
}
