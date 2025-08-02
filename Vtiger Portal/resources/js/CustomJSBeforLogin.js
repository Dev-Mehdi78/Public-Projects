class CustomOperationBeforLogin {

    GetSettingsURL(){
        $("#RegisterURLSettings").click(function (){
            var LinkURL      = $('#LinkURL').val();
            var SitUrlPortal = $('#URLSitePortalInSettingsURL').val();
            var ShowURLPopup = $('#ContentsShowURL').val()
            var PathFile     = SitUrlPortal.replace('index.php' , 'WebserviceJS.php');
            var formData     = new FormData();
            formData.append('SendType' , 'SettingsURL');
            formData.append('CrmURL' , LinkURL);
            $.ajax({
                type: "post",
                url: PathFile,
                data: formData,
                processData: false,
                contentType: false,
                crossDomain: false,
                success: function (data) {
                    let Response0 = jQuery.parseJSON(data);
                    if (Response0.status == 'Success' && Response0.return == 'true') {
                        let ShowURL      = ShowURLPopup.replace('$Variable$' , LinkURL) ;
                        //$("#RegisterURLSettings").attr('href', '#popup1S');
                        $('#ShowURLPopup').text(ShowURL);
                        $('#GoToLoginSettings').addClass("disabled");
                        $('#popup1').css("display" , "block");
                        setTimeout(function() {
                            $('#GoToLoginSettings').removeClass("disabled");
                            $('#LoaderBTNPopup').fadeOut('slow');
                        }, 3000);
                    }else if (Response0.status == 'Error' && Response0.return == 'False') {
                        $("#MainPannel").css("display" , "none");
                        $("#DangerTest").css("display" , "block");
                    }
                }
            })

        })
    }

    GoSettingsAndReset(){
        $("#GoSettingsAnsReset").click(function (){
            var ResetUrl = "http://example.com";
            var SitUrlPortal = $('#URLSitePortalInSettingsURL').val();
            var ShowURLPopup = $('#ContentsShowURL').val()
            var PathFile     = SitUrlPortal.replace('index.php' , 'WebserviceJS.php');
            var CallBack = new FormData();
            CallBack.append("SendType" , "ResetSettingsURL");
            CallBack.append("ResetURL" , ResetUrl);

            $.ajax({
                type: "post",
                url: PathFile,
                data: CallBack,
                processData: false,
                contentType: false,
                crossDomain: false,
                success: function (data){
                    let Res = jQuery.parseJSON(data);
                    if (Res.status == 'Success' && Res.return == 'true'){
                        $('#LoaderClose').addClass("disabled");
                        setTimeout(function() {
                            $('#LoaderClose').removeClass("disabled");
                            $('#LoaderBTNPopupClose').fadeOut('slow');
                        }, 3000);
                        $('#CloseReset').css("display" , "block");
                    }
                }
            })

        })
    }

}

jQuery(document).ready(function () {
    let instance = new CustomOperationBeforLogin();
    instance.GetSettingsURL();
    instance.GoSettingsAndReset();
});