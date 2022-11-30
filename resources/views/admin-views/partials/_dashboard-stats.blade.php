
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{'admin/category/add'}}" style="background: #3E215D">
        <div class="card-body">
            <h6 class="card-subtitle"
                style="color: white!important;">{{translate('category')}}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                                    <span class="card-title h2" style="color: white!important;">
                                        {{$data['category']}}
                                    </span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-shopping-cart ml-6" style="font-size: 30px;color: white"></i>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </a>
    <!-- End Card -->
</div>


<!--Driver Count-->
<div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
    <!-- Card -->
    <a class="card card-hover-shadow h-100" href="{{'admin/driver/list'}}" style="background:#95c2b8">
        <div class="card-body">
            <h6 class="card-subtitle"
                style="color: white!important;">{{translate('driver')}}</h6>
            <div class="row align-items-center gx-2 mb-1">
                <div class="col-6">
                                    <span class="card-title h2" style="color: white!important;">
                                        {{$data['drivers']}}
                                    </span>
                </div>
                <div class="col-6 mt-2">
                    <i class="tio-car ml-6" style="font-size: 30px;color: white"></i>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </a>
    <!-- End Card -->
</div>
