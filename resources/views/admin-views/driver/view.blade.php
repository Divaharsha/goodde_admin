@extends('layouts.admin.app')

@section('title', translate('Driver Preview'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class=""> {{translate('Driver')}} {{translate('details')}}</h1>
                </div>
                <div class="col-sm mb-2 mb-sm-0">
                    <a href="{{url()->previous()}}" class="btn btn-primary float-right">
                        <i class="tio-back-ui"></i> {{translate('back')}}
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-md-6 col-12 mb-3 mb-lg-2">
                <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">ID</th>
                                <td>{{$driver['id']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Name</th>
                                <td>{{$driver['name']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">DOB</th>
                                <td>{{$driver['dob']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Mobile Number</th>
                                <td>{{$driver['mobile']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Email</th>
                                <td>{{$driver['email']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Image</th>
                                <td>
                                <img style="height: 50px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/driver').'/'.$driver['image']}}" alt="driver image"/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Address</th>
                                <td>{{$driver['address']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">District</th>
                                <td>{{$driver['district']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Pincode</th>
                                <td>{{$driver['pincode']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">State</th>
                                <td>{{$driver['state']}}</td>
                            </tr>
                </table>
            </div>
            <div class="col-md-6 col-12 mb-3 mb-lg-2">
                <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">Vehicle Number</th>
                                <td>{{$driver['vehicle_number']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">License Image</th>
                                <td>
                                <img style="height: 50px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/driver/driver-proof').'/'.$driver['license_image']}}" alt="driver image"/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Rc Book image</th>
                                <td>
                                <img style="height: 50px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/driver/driver-proof').'/'.$driver['rc_image']}}" alt="driver image"/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Vehicle Image</th>
                                <td>
                                @foreach(json_decode($driver['vehicle_image'],true) as $img)
                                <img style="height: 50px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/driver/driver-proof').'/'.$img}}" alt="driver image"/>  
                                @endforeach                  
                                </td>
                            </tr>
                </table>
                
            </div>
        </div>
    </div>
@endsection

@push('script_2')

@endpush
