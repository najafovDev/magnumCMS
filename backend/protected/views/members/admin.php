<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.bootstrap.min.css"/>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

<style>
/*.dataTables_length {
    float: left;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    font-size: 20px;
    margin-top: 7px;
}
.dataTables_filter {
    float: right;
    text-align: right;
    margin-bottom: 10px;
    width: 70%;
}

.dataTables_filter label {
    width: 100%;
}
.dataTables_filter input {
    width: 85%;
}*/

@keyframes dtb-spinner{100%{transform:rotate(360deg)}}@-o-keyframes dtb-spinner{100%{-o-transform:rotate(360deg);transform:rotate(360deg)}}@-ms-keyframes dtb-spinner{100%{-ms-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes dtb-spinner{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-moz-keyframes dtb-spinner{100%{-moz-transform:rotate(360deg);transform:rotate(360deg)}}div.dataTables_wrapper{position:relative}div.dt-buttons{position:initial}div.dt-button-info{position:fixed;top:50%;left:50%;width:400px;margin-top:-100px;margin-left:-200px;background-color:white;border:2px solid #111;box-shadow:3px 4px 10px 1px rgba(0, 0, 0, 0.3);border-radius:3px;text-align:center;z-index:21}div.dt-button-info h2{padding:.5em;margin:0;font-weight:normal;border-bottom:1px solid #ddd;background-color:#f3f3f3}div.dt-button-info>div{padding:1em}div.dtb-popover-close{position:absolute;top:10px;right:10px;width:22px;height:22px;border:1px solid #eaeaea;background-color:#f9f9f9;text-align:center;border-radius:3px;cursor:pointer;z-index:12}button.dtb-hide-drop{display:none !important}div.dt-button-collection-title{text-align:center;padding:.3em 0 .5em;margin-left:.5em;margin-right:.5em;font-size:.9em}div.dt-button-collection-title:empty{display:none}span.dt-button-spacer{display:inline-block;margin:.5em;white-space:nowrap}span.dt-button-spacer.bar{border-left:1px solid rgba(0, 0, 0, 0.3);vertical-align:middle;padding-left:.5em}span.dt-button-spacer.bar:empty{height:1em;width:1px;padding-left:0}div.dt-button-collection span.dt-button-spacer{width:100%;font-size:.9em;text-align:center;margin:.5em 0}div.dt-button-collection span.dt-button-spacer:empty{height:0;width:100%}div.dt-button-collection span.dt-button-spacer.bar{border-left:none;border-bottom:1px solid rgba(0, 0, 0, 0.3);padding-left:0}button.dt-button,div.dt-button,a.dt-button,input.dt-button{position:relative;display:inline-block;box-sizing:border-box;margin-left:.167em;margin-right:.167em;margin-bottom:.333em;padding:.5em 1em;border:1px solid rgba(0, 0, 0, 0.3);border-radius:2px;cursor:pointer;font-size:.88em;line-height:1.6em;color:black;white-space:nowrap;overflow:hidden;background-color:rgba(0, 0, 0, 0.1);background:-webkit-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-moz-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-ms-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-o-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:linear-gradient(to bottom, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="rgba(230, 230, 230, 0.1)", EndColorStr="rgba(0, 0, 0, 0.1)");-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;text-decoration:none;outline:none;text-overflow:ellipsis}button.dt-button:first-child,div.dt-button:first-child,a.dt-button:first-child,input.dt-button:first-child{margin-left:0}button.dt-button.disabled,div.dt-button.disabled,a.dt-button.disabled,input.dt-button.disabled{cursor:default;opacity:.4}button.dt-button:active:not(.disabled),button.dt-button.active:not(.disabled),div.dt-button:active:not(.disabled),div.dt-button.active:not(.disabled),a.dt-button:active:not(.disabled),a.dt-button.active:not(.disabled),input.dt-button:active:not(.disabled),input.dt-button.active:not(.disabled){background-color:rgba(0, 0, 0, 0.1);background:-webkit-linear-gradient(top, rgba(179, 179, 179, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-moz-linear-gradient(top, rgba(179, 179, 179, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-ms-linear-gradient(top, rgba(179, 179, 179, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-o-linear-gradient(top, rgba(179, 179, 179, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:linear-gradient(to bottom, rgba(179, 179, 179, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="rgba(179, 179, 179, 0.1)", EndColorStr="rgba(0, 0, 0, 0.1)");box-shadow:inset 1px 1px 3px #999}button.dt-button:active:not(.disabled):hover:not(.disabled),button.dt-button.active:not(.disabled):hover:not(.disabled),div.dt-button:active:not(.disabled):hover:not(.disabled),div.dt-button.active:not(.disabled):hover:not(.disabled),a.dt-button:active:not(.disabled):hover:not(.disabled),a.dt-button.active:not(.disabled):hover:not(.disabled),input.dt-button:active:not(.disabled):hover:not(.disabled),input.dt-button.active:not(.disabled):hover:not(.disabled){box-shadow:inset 1px 1px 3px #999;background-color:rgba(0, 0, 0, 0.1);background:-webkit-linear-gradient(top, rgba(128, 128, 128, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-moz-linear-gradient(top, rgba(128, 128, 128, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-ms-linear-gradient(top, rgba(128, 128, 128, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-o-linear-gradient(top, rgba(128, 128, 128, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:linear-gradient(to bottom, rgba(128, 128, 128, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="rgba(128, 128, 128, 0.1)", EndColorStr="rgba(0, 0, 0, 0.1)")}button.dt-button:hover,div.dt-button:hover,a.dt-button:hover,input.dt-button:hover{text-decoration:none}button.dt-button:hover:not(.disabled),div.dt-button:hover:not(.disabled),a.dt-button:hover:not(.disabled),input.dt-button:hover:not(.disabled){border:1px solid #666;background-color:rgba(0, 0, 0, 0.1);background:-webkit-linear-gradient(top, rgba(153, 153, 153, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-moz-linear-gradient(top, rgba(153, 153, 153, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-ms-linear-gradient(top, rgba(153, 153, 153, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:-o-linear-gradient(top, rgba(153, 153, 153, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);background:linear-gradient(to bottom, rgba(153, 153, 153, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="rgba(153, 153, 153, 0.1)", EndColorStr="rgba(0, 0, 0, 0.1)")}button.dt-button:focus:not(.disabled),div.dt-button:focus:not(.disabled),a.dt-button:focus:not(.disabled),input.dt-button:focus:not(.disabled){border:1px solid #426c9e;text-shadow:0 1px 0 #c4def1;outline:none;background-color:#79ace9;background:-webkit-linear-gradient(top, #d1e2f7 0%, #79ace9 100%);background:-moz-linear-gradient(top, #d1e2f7 0%, #79ace9 100%);background:-ms-linear-gradient(top, #d1e2f7 0%, #79ace9 100%);background:-o-linear-gradient(top, #d1e2f7 0%, #79ace9 100%);background:linear-gradient(to bottom, #d1e2f7 0%, #79ace9 100%);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="#d1e2f7", EndColorStr="#79ace9")}button.dt-button span.dt-down-arrow,div.dt-button span.dt-down-arrow,a.dt-button span.dt-down-arrow,input.dt-button span.dt-down-arrow{position:relative;top:-2px;color:rgba(70, 70, 70, 0.75);font-size:8px;padding-left:10px;line-height:1em}.dt-button embed{outline:none}div.dt-buttons{float:left}div.dt-buttons.buttons-right{float:right}div.dataTables_layout_cell div.dt-buttons{float:none}div.dataTables_layout_cell div.dt-buttons.buttons-right{float:none}div.dt-btn-split-wrapper{display:inline-block}div.dt-button-collection{position:absolute;top:0;left:0;width:200px;margin-top:3px;margin-bottom:3px;padding:4px 4px 2px 4px;border:1px solid #ccc;border:1px solid rgba(0, 0, 0, 0.4);background-color:white;overflow:hidden;z-index:2002;border-radius:5px;box-shadow:3px 4px 10px 1px rgba(0, 0, 0, 0.3);box-sizing:border-box}div.dt-button-collection button.dt-button,div.dt-button-collection div.dt-button,div.dt-button-collection a.dt-button{position:relative;left:0;right:0;width:100%;display:block;float:none;margin:4px 0 2px 0}div.dt-button-collection button.dt-button:active:not(.disabled),div.dt-button-collection button.dt-button.active:not(.disabled),div.dt-button-collection div.dt-button:active:not(.disabled),div.dt-button-collection div.dt-button.active:not(.disabled),div.dt-button-collection a.dt-button:active:not(.disabled),div.dt-button-collection a.dt-button.active:not(.disabled){background-color:#dadada;background:-webkit-linear-gradient(top, #f0f0f0 0%, #dadada 100%);background:-moz-linear-gradient(top, #f0f0f0 0%, #dadada 100%);background:-ms-linear-gradient(top, #f0f0f0 0%, #dadada 100%);background:-o-linear-gradient(top, #f0f0f0 0%, #dadada 100%);background:linear-gradient(to bottom, #f0f0f0 0%, #dadada 100%);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="#f0f0f0", EndColorStr="#dadada");box-shadow:inset 1px 1px 3px #666}div.dt-button-collection button.dt-button:first-child,div.dt-button-collection div.dt-button:first-child,div.dt-button-collection a.dt-button:first-child{margin-top:0;border-top-left-radius:3px;border-top-right-radius:3px}div.dt-button-collection button.dt-button:last-child,div.dt-button-collection div.dt-button:last-child,div.dt-button-collection a.dt-button:last-child{border-bottom-left-radius:3px;border-bottom-right-radius:3px}div.dt-button-collection div.dt-btn-split-wrapper{display:flex;flex-direction:row;flex-wrap:wrap;justify-content:flex-start;align-content:flex-start;align-items:stretch;margin:4px 0 2px 0}div.dt-button-collection div.dt-btn-split-wrapper button.dt-button{margin:0;display:inline-block;width:0;flex-grow:1;flex-shrink:0;flex-basis:50px;border-radius:0}div.dt-button-collection div.dt-btn-split-wrapper button.dt-btn-split-drop{min-width:20px;flex-grow:0;flex-shrink:0;flex-basis:0}div.dt-button-collection div.dt-btn-split-wrapper:first-child{margin-top:0}div.dt-button-collection div.dt-btn-split-wrapper:first-child button.dt-button{border-top-left-radius:3px}div.dt-button-collection div.dt-btn-split-wrapper:first-child button.dt-btn-split-drop{border-top-right-radius:3px}div.dt-button-collection div.dt-btn-split-wrapper:last-child button.dt-button{border-bottom-left-radius:3px}div.dt-button-collection div.dt-btn-split-wrapper:last-child button.dt-btn-split-drop{border-bottom-right-radius:3px}div.dt-button-collection div.dt-btn-split-wrapper:active:not(.disabled) button.dt-button,div.dt-button-collection div.dt-btn-split-wrapper.active:not(.disabled) button.dt-button{background-color:#dadada;background:-webkit-linear-gradient(top, #f0f0f0 0%, #dadada 100%);background:-moz-linear-gradient(top, #f0f0f0 0%, #dadada 100%);background:-ms-linear-gradient(top, #f0f0f0 0%, #dadada 100%);background:-o-linear-gradient(top, #f0f0f0 0%, #dadada 100%);background:linear-gradient(to bottom, #f0f0f0 0%, #dadada 100%);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="#f0f0f0", EndColorStr="#dadada");box-shadow:inset 0px 0px 4px #666}div.dt-button-collection div.dt-btn-split-wrapper:active:not(.disabled) button.dt-btn-split-drop,div.dt-button-collection div.dt-btn-split-wrapper.active:not(.disabled) button.dt-btn-split-drop{box-shadow:none}div.dt-button-collection.fixed .dt-button:first-child{margin-top:0;border-top-left-radius:0;border-top-right-radius:0}div.dt-button-collection.fixed .dt-button:last-child{border-bottom-left-radius:0;border-bottom-right-radius:0}div.dt-button-collection.fixed{position:fixed;display:block;top:50%;left:50%;margin-left:-75px;border-radius:5px;background-color:white}div.dt-button-collection.fixed.two-column{margin-left:-200px}div.dt-button-collection.fixed.three-column{margin-left:-225px}div.dt-button-collection.fixed.four-column{margin-left:-300px}div.dt-button-collection.fixed.columns{margin-left:-409px}@media screen and (max-width: 1024px){div.dt-button-collection.fixed.columns{margin-left:-308px}}@media screen and (max-width: 640px){div.dt-button-collection.fixed.columns{margin-left:-203px}}@media screen and (max-width: 460px){div.dt-button-collection.fixed.columns{margin-left:-100px}}div.dt-button-collection.fixed>:last-child{max-height:100vh;overflow:auto}div.dt-button-collection.two-column>:last-child,div.dt-button-collection.three-column>:last-child,div.dt-button-collection.four-column>:last-child{display:block !important;-webkit-column-gap:8px;-moz-column-gap:8px;-ms-column-gap:8px;-o-column-gap:8px;column-gap:8px}div.dt-button-collection.two-column>:last-child>*,div.dt-button-collection.three-column>:last-child>*,div.dt-button-collection.four-column>:last-child>*{-webkit-column-break-inside:avoid;break-inside:avoid}div.dt-button-collection.two-column{width:400px}div.dt-button-collection.two-column>:last-child{padding-bottom:1px;column-count:2}div.dt-button-collection.three-column{width:450px}div.dt-button-collection.three-column>:last-child{padding-bottom:1px;column-count:3}div.dt-button-collection.four-column{width:600px}div.dt-button-collection.four-column>:last-child{padding-bottom:1px;column-count:4}div.dt-button-collection .dt-button{border-radius:0}div.dt-button-collection.columns{width:auto}div.dt-button-collection.columns>:last-child{display:flex;flex-wrap:wrap;justify-content:flex-start;align-items:center;gap:6px;width:818px;padding-bottom:1px}div.dt-button-collection.columns>:last-child .dt-button{min-width:200px;flex:0 1;margin:0}div.dt-button-collection.columns.dtb-b3>:last-child,div.dt-button-collection.columns.dtb-b2>:last-child,div.dt-button-collection.columns.dtb-b1>:last-child{justify-content:space-between}div.dt-button-collection.columns.dtb-b3 .dt-button{flex:1 1 32%}div.dt-button-collection.columns.dtb-b2 .dt-button{flex:1 1 48%}div.dt-button-collection.columns.dtb-b1 .dt-button{flex:1 1 100%}@media screen and (max-width: 1024px){div.dt-button-collection.columns>:last-child{width:612px}}@media screen and (max-width: 640px){div.dt-button-collection.columns>:last-child{width:406px}div.dt-button-collection.columns.dtb-b3 .dt-button{flex:0 1 32%}}@media screen and (max-width: 460px){div.dt-button-collection.columns>:last-child{width:200px}}div.dt-button-background{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);background:-ms-radial-gradient(center, ellipse farthest-corner, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);background:-moz-radial-gradient(center, ellipse farthest-corner, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);background:-o-radial-gradient(center, ellipse farthest-corner, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);background:-webkit-gradient(radial, center center, 0, center center, 497, color-stop(0, rgba(0, 0, 0, 0.3)), color-stop(1, rgba(0, 0, 0, 0.7)));background:-webkit-radial-gradient(center, ellipse farthest-corner, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);background:radial-gradient(ellipse farthest-corner at center, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 100%);z-index:2001}@media screen and (max-width: 640px){div.dt-buttons{float:none !important;text-align:center}}button.dt-button.processing,div.dt-button.processing,a.dt-button.processing{color:rgba(0, 0, 0, 0.2)}button.dt-button.processing:after,div.dt-button.processing:after,a.dt-button.processing:after{position:absolute;top:50%;left:50%;width:16px;height:16px;margin:-8px 0 0 -8px;box-sizing:border-box;display:block;content:" ";border:2px solid #282828;border-radius:50%;border-left-color:transparent;border-right-color:transparent;animation:dtb-spinner 1500ms infinite linear;-o-animation:dtb-spinner 1500ms infinite linear;-ms-animation:dtb-spinner 1500ms infinite linear;-webkit-animation:dtb-spinner 1500ms infinite linear;-moz-animation:dtb-spinner 1500ms infinite linear}button.dt-btn-split-drop{margin-left:calc(-1px - .333em);padding-bottom:calc(.5em - 1px);border-radius:0px 1px 1px 0px;color:rgba(70, 70, 70, 0.9);border-left:none}button.dt-btn-split-drop span.dt-btn-split-drop-arrow{position:relative;top:-1px;left:-2px;font-size:8px}button.dt-btn-split-drop:hover{z-index:2}button.buttons-split{border-right:1px solid rgba(70, 70, 70, 0);border-radius:1px 0px 0px 1px}button.dt-btn-split-drop-button{background-color:white}button.dt-btn-split-drop-button:hover{background-color:white}


</style>

<h1>Manage Members</h1>

<table id="members" class="table table-striped table-bordered table-hover" style="width:100%" style="width:100%">
        <thead>
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Ata adı</th>
                <th>Cins</th>
                <th>Klub</th>
                <th>Şəxs seriya no.</th>
                <th>Fin code</th>
                <th>Təvəllüd</th>
                <th>Doğulduğu yer</th>
                <th>Faktiki yaşayış yeri</th>
                <th>Ev nömrəsi</th>
                <th>Mobil nömrə</th>
                <th>Email</th>
                <th>Universitet</th>
                <th>Fakulte</th>
                <th>İxtisas</th>
                <th>Tehsil muddeti</th>
                <th>Tehsil formasi</th>
                <th>Tehsil derecesi</th>
                <th>Dil</th>
                <th>Tecrube</th>
                <th>Bacariqlar</th>
                <th>Facebook</th>
                <th>Instagram</th>
                <th>Twitter</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

<script>
    $(document).ready(function() {
        const datatable  = $("#members");
        const datatableColumns = [
            {
                "data":"first_name"
            },
            {
                "data":"last_name"
            },
            {
                "data":"father_name"
            },
            {
                "data":"sex"
            },
            {
                "data":"club"
            },
            {
                "data":"id_serial_number"
            },
            {
                "data":"fin_code"
            },
            {
                "data":"birthday"
            },
            {
                "data":"birth_place"
            },
            {
                "data":"current_address"
            },
            {
                "data":"home_number"
            },
            {
                "data":"mobile_number"
            },
            {
                "data":"email"
            },
        
            {
                "data":"univercity"
            },
            {
                "data":"faculty"
            },
            {
                "data":"ixtisas"
            },
            {
                "data":"edu_time"
            },
            {
                "data":"edu_form"
            },
            {
                "data":"degree"
            },
            
            { "data": function (data, type, dataToSet) {
                    return data.language + "-" + data.lang_level + "<br/>" + data.language2 + "-" + data.lang_level2 + "<br/>" + data.language3 + "-" + data.lang_level3 + "<br/>" + data.language4 + "-" + data.lang_level4 + "<br/>" + data.language5 + "-" + data.lang_level5;
            }
            },
            {
                "data":"experience"
            },
            {
                "data":"skill"
            },
            {
                "data":"facebook"
            },
            {
                "data":"instagram"
            },
            {
                "data":"twitter"
            },
        ]
        $.ajax({
        type: "GET",
        url: 'https://davam.org.az/mfe/json.php',
        dataType: "json",
        success: function (response, status, xhr) {
        if (xhr.status === 200) {
        datatable.children("tbody").empty()
        let result = JSON.parse(JSON.stringify(response));
        datatable.DataTable({
        data: result,
        columns: datatableColumns,
        deferRender: true,
        buttons: [
           'csv', 'excel'
        ],
        dom: 'Bfrtip', 
        "targets": 'no-sort',
        "bSort": false,
        "scrollX": true
        });
        }

        },
        error: function (jqXHR, exception) {
        console.log(jqXHR);
        }
    });  

} );
</script>
