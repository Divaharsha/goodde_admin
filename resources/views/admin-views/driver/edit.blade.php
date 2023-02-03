@extends('layouts.admin.app')

@section('title', translate('Update Driver'))
<style>
    .password-container{
        position: relative;
    }

    .togglePassword{
        position: absolute;
        top: 14px;
        right: 16px;
    }
</style>
@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{translate('update Driver')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.driver.update',[$driver['id']])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('name')}}</label>
                                <input type="text" value="{{$driver['name']}}" name="name"
                                       class="form-control" placeholder="New delivery-man"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('date of birth')}}</label>
                                <input type="date" value="{{$driver['dob']}}" name="dob"
                                       class="form-control" placeholder="DOB"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('mobile number')}}</label>
                                <input type="number" value="{{$driver['mobile']}}" name="mobile"
                                       class="form-control" placeholder="Mobile Number"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('email')}}</label>
                                <input type="email" value="{{$driver['email']}}" name="email" class="form-control"
                                       placeholder="Ex : ex@example.com"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('password')}}</label>
                                <div class="password-container">
                                    <input type="password" name="password" class="form-control pr-7" id="password"
                                        placeholder="{{translate('Password')}}" required>
                                    <i class="tio-hidden-outlined togglePassword"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('address')}}</label>
                                <input type="text" value="{{$driver['address']}}" name="address"
                                       class="form-control" placeholder="Address"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('district')}}</label>
                                <input type="text" value="{{$driver['district']}}" name="district" class="form-control"
                                       placeholder="district name"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('pincode')}}</label>
                                <input type="number" value="{{$driver['pincode']}}" name="pincode" class="form-control"
                                       placeholder="pincode number"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('state')}}</label>
                                <input type="text" value="{{$driver['state']}}" name="state"
                                       class="form-control" placeholder="state"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('vehicle number')}}</label>
                                <input type="text" value="{{$driver['vehicle_number']}}" name="vehicle_number"
                                       class="form-control" placeholder="vehicle_number"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('vehicle type')}}</label>
                                <select name="vehicle_type" class="form-control">
                                    <option value="0" {{$driver['vehicle_type']==0?'selected':''}}>{{translate('all')}}</option>
                                    @foreach(\App\Model\Category::all() as $category)
                                        <option value="{{$category['id']}}" {{$driver['vehicle_type']==$category['name']?'selected':''}}>{{$category['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{translate('license')}} {{translate('image')}}</label><small style="color: red">* ( {{translate('ratio')}} 1:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label" for="customFileEg1">{{translate('choose')}} {{translate('file')}}</label>
                                </div>
                                <center>
                                    <img style="height: 200px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/driver/driver-proof').'/'.$driver['license_image']}}" alt="driver image"/>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{translate('rc book')}} {{translate('image')}}</label><small style="color: red">* ( {{translate('ratio')}} 1:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg2" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label" for="customFileEg2">{{translate('choose')}} {{translate('file')}}</label>
                                </div>
                                <center>
                                    <img style="height: 200px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer2"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/driver/driver-proof').'/'.$driver['rc_image']}}" alt="driver image"/>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('vehicle')}} {{translate('image')}}</label>
                                <div>
                                    <div class="row" id="coba"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('vehicle')}} {{translate('images')}} : </label>
                            </div>
                        </div>
                        <br>

                        @foreach(json_decode($driver['vehicle_image'],true) as $img)
                            <div class="col-md-4 col-12 mb-2">
                                <img height="150"
                                     onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'"
                                     src="{{asset('storage/app/public/driver/driver-proof').'/'.$img}}">
                            </div>
                        @endforeach
                        <hr>
                    </div>
                    <hr>
                    <div class="form-group">
                                <label>{{translate('Profile')}} {{translate('image')}}</label><small style="color: red">* ( {{translate('ratio')}} 1:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg3" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label" for="customFileEg3">{{translate('choose')}} {{translate('file')}}</label>
                                </div>
                                <center>
                                    <img style="height: 200px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer3"
                                        src="{{asset('storage/app/public/driver').'/'.$driver['image']}}" alt="profile image"/>
                                </center>
                   </div>
                   <div class="row">
                        <div class="form-group">
                            <div class='col-md-4'>
                                    <label class="control-label">Stock</label> <i class="text-danger asterik">*</i>
                                    <div id="status" class="btn-group">
                                        <label class="btn btn-danger" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="0" <?= ($driver['status']== 0) ? 'checked' : ''; ?>> Not-Available
                                        </label>
                                        <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="status" value="1" <?= ($driver['status'] == 1) ? 'checked' : ''; ?>> Available
                                        </label>
                                    </div>
                            </div>
                        </div>
                   </div>
                
                    <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        function readURL(input, viewer_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+viewer_id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this, 'viewer');
        });
        $("#customFileEg2").change(function () {
            readURL(this, 'viewer2');
        });
        $("#customFileEg3").change(function () {
            readURL(this, 'viewer3');
        });
    </script>

    <script src="{{asset('public/assets/admin/js/spartan-multi-image-picker.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'vehicle_image[]',
                maxCount: 5,
                rowHeight: '120px',
                groupClassName: 'col-2',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('public/assets/admin/img/400x400/img2.jpg')}}',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('Please only input png or jpg type file', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('File size too big', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        /*==================================
       togglePassword
      ====================================*/
        $('.togglePassword').on('click', function (e) {
            console.log("fired")
            const password = $(this).siblings('input');
            password.attr('type') === 'password' ? $(this).addClass('tio-visible-outlined').removeClass('tio-hidden-outlined') :$(this).addClass('tio-hidden-outlined').removeClass('tio-visible-outlined');
            const type = password.attr('type') === 'password' ? 'text' : 'password';
            password.attr('type', type);
        });
    </script>
@endpush
