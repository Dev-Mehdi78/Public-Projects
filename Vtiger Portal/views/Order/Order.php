<?php

$View  = '<div class="main-content app-content mt-0">';
$View .= '<div class="side-app">';
$View .= '<div class="main-container container-fluid">';

//Header Label
$View .= '<div class="page-header">';
$View .= ' <h1 class="page-title">'.$Portal_Translate->Translate('MN_Order_Register').'</h1>';
$View .= '<div>';
$View .= '<ol class="breadcrumb">';
$View .= '<li class="breadcrumb-item"><a href="javascript:void(0)">'. $Portal_Translate->Translate('MN_Order_Register').'</a></li>';
$View .= '<li class="breadcrumb-item active" aria-current="page">'.$Portal_Translate->Translate('SHOPPING').'</li>';
$View .= '</ol>';

$View .= '</div>';
$View .= '</div>';

//Error In Webservice
if (isset($Parameters['ErrorModuleWebSide'])) {
    $View .= '<div class="main-container container-fluid">';
    $View .= '<div class="page-header">';
    $View .= '<h1 class="page-title"><a href="index.php?page=Dashboard">'.$Portal_Translate->Translate('HEADER_ERROR_PAGE').'</a></h1>';
    $View .= '</div>';
    $View .= '<div class="text-wrap">';
    $View .= '<div class="alert alert-danger">';
    $View .= '<span class=""><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 24 24"><path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"></path><circle cx="12" cy="17" r="1" fill="#e62a45"></circle><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"></path></svg></span>';
    $View .= '<strong>'.$Portal_Translate->Translate('HEADER_ERROR_TYPE_MESSAGE').'</strong>';
    $View .= '<hr class="message-inner-separator">';
    $View .= '<p>'.$Portal_Translate->Translate('HEADER_ERROR_CONTENT_PAGE').'</p>';

    //ErrorCode And Error Message
    if (isset($Parameters['ErrorCode']) && isset($Parameters['ErrorMessage'])){
        $View .= '<div style="text-align: left" class="">';
        $View .= '<b>ErrorCode: </b><span id="">'.$Parameters['ErrorCode'].'</span><br>';
        $View .= '<b>ErrorMessage: </b><span id="">'.$Parameters['ErrorMessage'].'</span>';
        $View .= '</div>';
    }

    $View .= '</div>';
    $View .= '</div>';
    $View .= '</div>';

}else{

    $Params      = $Parameters['Data'];
    $RecordsData = $Params['records'];
    $AccessField = $Params['describe']['fields'];
    /*echo "<pre>";
    print_r($RecordsData);
    echo "</pre>";*/
    // start Toole Pro
    $View .= '<div class="row row-cards">';
    $View .= '<div class="col-xl-3 col-lg-4">';
    $View .= '<div class="row">';
    $View .= '<div class="col-md-12 col-lg-12">';

    //Categories Products
    $Category_Pro = array();
    foreach ($AccessField as $Field){
        if ($Field['name'] == 'productcategory'){
            $PickListValue = $Field['type']['picklistValues'];
            $i = 0 ;
            foreach ($PickListValue as $item) {
                array_push($Category_Pro , $PickListValue[$i]);
                $i++;
            }
        }
    }
    if (!empty($Category_Pro)) {
        $View .= '<div class="card">';
        $View .= '<div class="card-header">';
        $View .= '<div class="card-title">' . $Portal_Translate->Translate('Shopping_PR_Category') . '</div>';
        $View .= '</div>';
        $View .= '<div class="card-body">';
        $View .= '<ul class="list-group">';
        foreach ($Category_Pro as $Category) {
            $View .= '<li style="margin-bottom: 10px;" class="list-group-item border-0 p-0"> <a href="#"><i class="fe fe-chevron-right"></i>' . $Category['label'] . '</a> </li>';
        }
        $View .= '</ul>';
        $View .= ' </div>';
        $View .= ' </div>';
    }

    $View .= '</div>';
    $View .= '</div>';
    $View .= '</div>';
    //End ToolsPro

    //start Products List
    $View .= '<div class="col-xl-9 col-lg-8">';

    //sidebar Top Pro
    $View .= '<div class="row">
                <div class="col-xl-12">
                    <div class="card p-0">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-xl-5 col-lg-8 col-md-8 col-sm-8">
                                    <div class="input-group d-flex w-100 float-start">
                                        <input type="text" class="form-control border-end-0 my-2" placeholder="جستجو ...">
                                        <button class="btn input-group-text bg-transparent border-start-0 text-muted my-2">
                                            <i class="fe fe-search text-muted" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                    <ul class="nav item2-gl-menu float-end my-2">
                                        <li class="border-end"><a href="#tab-11" class="show active" data-bs-toggle="tab" title="List style"><i class="fa fa-th"></i></a></li>
                                        <li><a href="#tab-12" data-bs-toggle="tab" class="" title="Grid"><i class="fa fa-list"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-xl-3 col-lg-12">
                                    <a href="add-product.html" class="btn btn-primary btn-block float-end my-2"><i class="fa fa-plus-square me-2"></i>محصولات جدید</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>';

    $View .= '<div class="tab-content">';
    $View .= '<div class="tab-pane active" id="tab-11">';
    $View .= '<div class="row">';
    
    //Products List
    foreach ($RecordsData as $Pro){
        $ProName     = $Pro['productname'];
        $ProIsActive = $Pro['discontinued'];
        if ($ProIsActive == 1){
            $View .= '<div class="col-md-6 col-xl-4 col-sm-6">';
            $View .= '<div class="card">';
            $View .= '<div class="product-grid6">';

            //Start Products Image And Icon
            $View .= '<div class="product-image6 p-5">';
            $View .= '<ul class="icons">';
            $View .= '<li><a href="shop-description.html" class="btn btn-primary"> <i class="fe fe-eye">  </i> </a></li>';
            $View .= '<li><a href="add-product.html" class="btn btn-success"><i class="fe fe-edit"></i></a></li>';
            $View .= '<li><a href="javascript:void(0)" class="btn btn-danger"><i class="fe fe-x"></i></a></li>';
            $View .= '</ul>';
            //Shoe Image
            $View .= '<a href="shop-description.html">
                          <img class="img-fluid br-7 w-100" src="resources/images/pngs/10.jpg" alt="img">
                      </a>';
            $View .= '</div>';

            //Name Pro
            $View .= '<div class="card-body pt-0">';
            $View .= '<div class="product-content text-center">';
            $View .= '<h1 class="title fw-bold fs-20"><a href="shop-description.html">'.$ProName.'</a></h1>';
            $View .= '<div class="mb-2 text-warning">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star-half-o text-warning"></i>
                        <i class="fa fa-star-o text-warning"></i>
                      </div>';
            // Price Pro
            if (isset($Pro['unit_price'])){
                $View .= '<div class="price">'.str_replace('.00000000' , '' , $Pro['unit_price']).'<span class="ms-4"></span></div>';
            }

            $View .= '</div>';
            $View .= '</div>';

            //Footer Pro
            $View .= '<div class="card-footer text-center">
                            <a href="cart.html" class="btn btn-primary mb-1"><i class="fe fe-shopping-cart mx-2"></i>افزودن به سبد خرید</a>
                            <a href="wishlist.html" class="btn btn-outline-primary mb-1"><i class="fe fe-heart mx-2 wishlist-icon"></i>افزودن به علاقه مندی</a>
                        </div>
                      </div>';

            $View .= '</div>';
            $View .= '</div>';
        }
    }


    //Pagination Pro n
    $View .= '<div class="mb-5">
                <div class="float-end">
                    <ul class="pagination ">
                        <li class="page-item page-prev disabled">
                            <a class="page-link" href="javascript:void(0)" tabindex="-1">قبلی</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">5</a></li>
                        <li class="page-item page-next">
                            <a class="page-link" href="javascript:void(0)">بعدی</a>
                        </li>
                    </ul>
                </div>
              </div>';

    $View .= '</div>';
    $View .= '</div>';



    $View .= '</div>';
    $View .= '</div>';
    $View .= '</div>';

    echo $View;
     /*echo "<pre>";
     print_r($AccessField);
     print_r($Params['records']);
     echo "</pre>";*/
}





