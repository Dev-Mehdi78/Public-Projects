class CustomOperation {

    CloseSideSettings (){
        $(".page").click(function(){
            //$(".switcher-wrapper").removeClass('active');
            //$(".demo_changer").css("display" , "none");
        })
    }

    ClosedStatusSupported(){
        $(".CustomClose").click(function (){
            $(".CustomViewStatusSupport").css("display" , "none");
        })
    }

    SupportStatusCustomer(){
        $(".StatusSupport_CU").click(function (){
            var Username             = $("#UsernamrAuth").val();
            var Password             = $("#PsswordAuth").val();
            var TypeDate             = $("#TypeDate").val();
            var ContentEndDate       = $("#ContentEndDate").val();
            var ContentRemainingDate = $("#ContentRemainingDate").val();
            var path                 = $("#URLSitePO").val();
            var mainPath             = path.replace('index.php', 'WebserviceJS.php');

            var formData = new FormData();
            formData.append('UsernameAuth', Username);
            formData.append('PasswordAuth', Password);
            formData.append('SendType',"GetStatusSupport");
            formData.append('TypeDate',TypeDate);

            $.ajax({
                type: "POST",
                url: mainPath,
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                crossDomain: false,
                success: function (data) {
                    let Response = jQuery.parseJSON(data);
                    if (Response.status == 'Success' && Response.return == 'true') {
                        let TimeNotification       = Response.CallBack.support_notification_days;
                        let Remaining_Days         = Response.CallBack.support_remaining_days;
                        let EndDate                = Response.CallBack.support_end_date;
                        let ContentsEndDateFi      = ContentEndDate.replace('$Variable$' , EndDate) ;
                        let ContentRemainingDateFi = ContentRemainingDate.replace('$Variable$' , Remaining_Days) ;
                        $('#Get_EndDateSupported').text(ContentsEndDateFi);
                        $('#Get_ContentRemainingDate').text(ContentRemainingDateFi);
                        $("#Notif_Status_Support").css("display", "block");

                        //alert(EndDate);
                        console.log(Response.CallBack);
                    } else {
                        console.log("NOOOOOOOOOOOO");
                    }
                },
            })
        })
    }

    DownloadImageJS(){
        $('#DownloadIMGClick').click(function (){
            var Get_Value            = $('#DownloadIMG').val();
            var Username             = $("#UsernameAuth").val();
            var Password             = $("#PsswordAuth").val();
            var path                 = $("#URLSitePO").val();
            var mainPath             = path.replace('index.php', 'WebserviceJS.php');

            var MainDataDownload     = new FormData();
            MainDataDownload.append("UName" , Username);
            MainDataDownload.append("Pass" , Password);
            MainDataDownload.append("DataImage" , Get_Value);
            MainDataDownload.append('SendType',"DownloadImage");

            $.ajax({
                type: "POST",
                url: mainPath,
                data: MainDataDownload,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                crossDomain: false,
                success: function (data) {
                    let Response = jQuery.parseJSON(data);
                    if (Response.status == 'Success' && Response.return == 'true') {
                        const FileBase64 = Response.BaseEnData;
                        const FileName    = Response.CallBack.filename;
                        const FileType    = Response.CallBack.filetype;
                        var a = document.createElement("a"); //Create <a>
                        a.href = "data:"+FileType+";base64," + FileBase64; //Image Base64 Goes here
                        a.download = FileType; //File name Here
                        a.click(); //Downloaded file
                        console.log("Yes");
                    } else {
                        console.log("NOOOOOOOOOOOO");
                    }
                },
            })

        })
    }

    DownloadImageJSMULT(){
        $('.DownloadIMGClickMulti').click(function (){
            var Get_imgNU            = $(this).attr("data-value");
            var Get_Value            = $('#DownloadIMGMulti_'+Get_imgNU).val();
            var Username             = $("#UsernameAuth").val();
            var Password             = $("#PsswordAuth").val();
            var path                 = $("#URLSitePO").val();
            var mainPath             = path.replace('index.php', 'WebserviceJS.php');

            var MainDataDownload     = new FormData();
            MainDataDownload.append("UName" , Username);
            MainDataDownload.append("Pass" , Password);
            MainDataDownload.append("DataImage" , Get_Value);
            MainDataDownload.append('SendType',"DownloadImage");

            $.ajax({
                type: "POST",
                url: mainPath,
                data: MainDataDownload,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                crossDomain: false,
                success: function (data) {
                    let Response = jQuery.parseJSON(data);
                    if (Response.status == 'Success' && Response.return == 'true') {
                        const FileBase64 = Response.BaseEnData;
                        const FileName    = Response.CallBack.filename;

                        const FileType    = Response.CallBack.filetype;
                        var a = document.createElement("a"); //Create <a>
                        a.href = "data:"+FileType+";base64," + FileBase64; //Image Base64 Goes here
                        a.download = FileName; //File name Here
                        a.click(); //Downloaded file
                        console.log("Yes");
                    } else {
                        console.log("NOOOOOOOOOOOO");
                    }
                },
            })

        })
    }

    DownloadImageJSMULTTickets(){
        $('.DownloadIMGClickMultiTi').click(function (){
            var Get_imgNU            = $(this).attr("data-value");
            var Get_Value            = $('#DownloadIMGMultiTi_'+Get_imgNU).val();
            var Username             = $("#UsernameAuth").val();
            var Password             = $("#PsswordAuth").val();
            var path                 = $("#URLSitePO").val();
            var mainPath             = path.replace('index.php', 'WebserviceJS.php');

            var MainDataDownload     = new FormData();
            MainDataDownload.append("UName" , Username);
            MainDataDownload.append("Pass" , Password);
            MainDataDownload.append("DataImage" , Get_Value);
            MainDataDownload.append('SendType',"DownloadImage");

            $.ajax({
                type: "POST",
                url: mainPath,
                data: MainDataDownload,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                crossDomain: false,
                success: function (data) {
                    let Response = jQuery.parseJSON(data);
                    if (Response.status == 'Success' && Response.return == 'true') {
                        const FileBase64 = Response.BaseEnData;
                        const FileName    = Response.CallBack.filename;

                        const FileType    = Response.CallBack.filetype;
                        var a = document.createElement("a"); //Create <a>
                        a.href = "data:"+FileType+";base64," + FileBase64; //Image Base64 Goes here
                        a.download = FileName; //File name Here
                        a.click(); //Downloaded file
                        console.log("Yes");
                    } else {
                        console.log("NOOOOOOOOOOOO");
                    }
                },
            })

        })
    }

    DownloadImageJSMULTTicketsRe(){
        $('.DownloadIMGClickMultiTiRe').click(function (){
            var Get_imgNU            = $(this).attr("data-value");
            var Get_Value            = $('#DownloadIMGMultiTiRe_'+Get_imgNU).val();
            var Username             = $("#UsernameAuth").val();
            var Password             = $("#PsswordAuth").val();
            var path                 = $("#URLSitePO").val();
            var mainPath             = path.replace('index.php', 'WebserviceJS.php');

            var MainDataDownload     = new FormData();
            MainDataDownload.append("UName" , Username);
            MainDataDownload.append("Pass" , Password);
            MainDataDownload.append("DataImage" , Get_Value);
            MainDataDownload.append('SendType',"DownloadImage");

            $.ajax({
                type: "POST",
                url: mainPath,
                data: MainDataDownload,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                crossDomain: false,
                success: function (data) {
                    let Response = jQuery.parseJSON(data);
                    if (Response.status == 'Success' && Response.return == 'true') {
                        const FileBase64 = Response.BaseEnData;
                        const FileName    = Response.CallBack.filename;

                        const FileType    = Response.CallBack.filetype;
                        var a = document.createElement("a"); //Create <a>
                        a.href = "data:"+FileType+";base64," + FileBase64; //Image Base64 Goes here
                        a.download = FileName; //File name Here
                        a.click(); //Downloaded file
                        console.log("Yes");
                    } else {
                        console.log("NOOOOOOOOOOOO");
                    }
                },
            })

        })
    }

}

jQuery(document).ready(function () {
    let instance = new CustomOperation();
    instance.ClosedStatusSupported();
    instance.SupportStatusCustomer();
    instance.DownloadImageJS();
    instance.DownloadImageJSMULT();
    instance.DownloadImageJSMULTTickets();
    instance.DownloadImageJSMULTTicketsRe();
    instance.CloseSideSettings();
});




/*$(document).ready(function (){
    let LanguageType = $("#GetLanguage_RTL_OR_LTR").val();
    if (LanguageType == 'fa_ir'){
        $('body').addClass('rtl');

        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        $("html[lang=en]").attr("dir", "rtl");
        $('body').removeClass('ltr');
        $("head link#style").attr("href", $(this));
        (document.getElementById("style").setAttribute("href", "resources/plugins/bootstrap/css/bootstrap.rtl.min.css"));
        var carousel = $('.owl-carousel');
        $.each(carousel, function (index, element) {
            // element == this
            var carouselData = $(element).data('owl.carousel');
            carouselData.settings.rtl = true; //don't know if both are necessary
            carouselData.options.rtl = true;
            $(element).trigger('refresh.owl.carousel');
        });
        localStorage.setItem('sashrtl', true)
        localStorage.removeItem('sashltr')
        console.log(LanguageType);
    }
    else if (LanguageType == 'en_us'){
        $('body').addClass('ltr');

        $('#slide-left').removeClass('d-none');
        $('#slide-right').removeClass('d-none');
        $("html[lang=en]").attr("dir", "ltr");
        $('body').removeClass('rtl');
        $("head link#style").attr("href", $(this));
        (document.getElementById("style").setAttribute("href", "resources/plugins/bootstrap/css/bootstrap.min.css"));
        var carousel = $('.owl-carousel');
        $.each(carousel, function (index, element) {
            // element == this
            var carouselData = $(element).data('owl.carousel');
            carouselData.settings.rtl = false; //don't know if both are necessary
            carouselData.options.rtl = false;
            $(element).trigger('refresh.owl.carousel');
        });
        localStorage.setItem('sashltr', true)
        localStorage.removeItem('sashrtl')
        console.log(LanguageType);
    }
})*/
//$(document).ready(function (){
   /* $('.SettingsURL').click(function(){
        var URL = window.location.href;
        //window.location.replace = URL + 'index.php?page=Login' ;

        var Data = $(this).data('DataForm');

        $.get(URL + "/views/SettingsURL/SettingsURL.php" , function (data , status){
            var val = $('#LinkURL') .val();
            alert("Data: " + data + "\nStatus: " + status + "\n" + val);
        })

        //alert(Data);
        $('#ShowMessageSuccess').css('display' , 'block');
        $('#PageRegistrationURL').css('display', 'none');

    })*/
//})
//$('.RegisterLanguage').click(function(){
    //const path = 'views/SettingsURL/SettingsURL.php';
    //var value    = $('.RegisterLanguage').value();
    //var dataForm = new dataForm(value);
    // $.ajax({
    //     type        : 'POST',
    //     url         : path,
    //     data        : {'Success' : 'true'},
    //     dataType    : "array",
    //     crossDomain : true,
    //     success : function (res){
    //             alert({'Success' : 'true'});
    //     },
    //     error: function(jqXHR, textStatus, ex) {
    //         alert(textStatus + "," + ex + "," + jqXHR.responseText);
    //     }
    // });
//})