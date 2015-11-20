var now_url     = null;
var base_url    = null;
//standart load
$( document ).ready(function() {
    
    
    now_url     = $("#this_url").html();
    base_url    = $("#base_url").html();
    
    /*tooltip*/
    init_tooltip();
    /*tab*/
    init_tabs();
    /*link back to top animation*/
    init_back_to_top();
    /*google map Config*/
    //init_gmap3();
    /*backgroung Config*/
    init_bgswitch();
    /*light box Config*/
    init_color_box();
    /*Slider Config*/
    init_slider();
    /*Grid Config*/
    init_grid();
    
    form_login();
    
    init_form();
    var back_req = setTimeout("init_interface()",1000);
});

//custom

function init_interface(){
    //page counter //
    
    $.ajax({
        url      : base_url+"index.php/ajax/back_request",
        success  : function(msg){
            row     = msg.split("||");
            if(row[0] != $(".viscount").html()){ 
                $(".viscount").html(row[0]);
            }
            
        }
    });
    
    var req_time = setTimeout("init_interface()",1000);
}

function init_form(){
    //SHOW HIDE FORM
     $(".sign_form").click(function(){
        var id = null;
        
        if($(this).attr("id")!=""){
             id = $(this).attr("id");
        }else if($(this).attr("id2")!=""){
             id = $(this).attr("id2");
        }
        
        if($("#"+id+"_form").is(":visible")){
            $("#"+id+"_form").attr("style","display:none");
           
        }else{
            $("#"+id+"_form").attr("style","display:block");
        }
    });
    
    
    //END SHOW HIDE FORM
    
    // RETIEVE FIELD AJAX
    // "||" untuk row, "-" untuk col
    $(".ajax_select").change(function(){
            var id              = null;
            var ajax_function   = $(this).attr("f-w");
            var value           = $(this).val();
            
            if($(this).attr("id")!=""){
                 id = $(this).attr("id");
            }else if($(this).attr("id2")!=""){
                 id = $(this).attr("id2");
            }
            
            $(".link_"+id).empty();//DELETE DEFAULT  VALUE
            
           //AJAX PROCESS
            if(value!="all"){
                $(".link_"+id).attr("disabled","true");
		$(".link_"+id).prepend("<option value='all'>Mencari...</option");
                $(".btn-submit").attr("disabled","true");
                
                $.ajax({
                    url      : base_url+"index.php/ajax/"+ajax_function+"/"+value,
                    success  : function(msg){
                        row     = msg.split("||");
                        $(".link_"+id).html("");
                        for(var a = 0; a < (row.length-1); a++){
                            //value split//
                            col = row[a].split("-");
                            
                            $(".link_"+id).prepend("<option value='"+col[0]+"'>"+col[1]+"</option");//INSERT VALUE
                        }
                        $(".btn-submit").removeAttr("disabled");
                        $(".link_"+id).removeAttr("disabled");
                    },
                    error    : function(msg){
                        alert("Error while fetching data");
                    }
                });
            }else{
                $(".link_"+id).prepend("<option value='all'>All</option");
            }
            
            
    });
    
    //END RETIEVE FIELD AJAX
    
    $(".form_copy_from").click(function(){
        alert($(this).attr("link"));
    });
}

function form_login(){
   
}

//proper

function init_tooltip(){
    $('.tootip').tooltip();
}

function init_color_box(){
    $(".ajax-demo").colorbox({
        width: 290,
        scrolling:false,
        fixed:true,
        height: 200,
        opacity:0.1
    });
}

function init_bgswitch(){
    var bg_pattern = getCookie('bg_pattern');
    if (bg_pattern != null){
        $("body").css('background-image', 'url("'+bg_pattern+'")');
    }
}

function init_back_to_top(){
    $('#back-to-top a').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
}

//
//function init_gmap3(){
//    $(function(){
//        var icon_villa = "proper_theme/images/map/hostel_0star.png"
//        var icon_hotel = "proper_theme/images/map/villa.png"
//        var img_p = "proper_theme/images/properties/p1.jpg"
//        $("#googleMap").gmap3({
//            map:{
//                // CENTRAL MAP DEFAULT
//                address:"JAKARTA, INDONESIA",
//                options:{
//                    zoom:12,
//                    scaleControl: false,
//                    scrollwheel: false,
//                    mapTypeId: google.maps.MapTypeId.ROADMAP,
//                    mapTypeControl: true,
//                    mapTypeControlOptions: {
//                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
//                    }
//                }
//            },
//            marker:{
//                // DATA LOCATION
//                values:[
//                {
//                    latLng:[-6.202165,106.827965], 
//                    data:{
//                        img_preview: img_p, 
//                        properties_name:"023 Central Park [Rent]", 
//                        properties_desc:"Lorem Ipsum Go Green",
//                        properties_link:"#", 
//                        zip:001233, 
//                        city:"Jakarta"
//                    }, 
//                    options:{
//                        icon: icon_hotel
//                    }
//                },
//
//                {
//                    latLng:[-6.16206,106.82642], 
//                    data:{
//                        img_preview: img_p, 
//                        properties_name:"023 Central Park [Sell]", 
//                        properties_desc:"Lorem Ipsum Go Green",
//                        properties_link:"#", 
//                        zip:001233, 
//                        city:"Jakarta"
//                    }, 
//                    options:{
//                        icon: icon_villa
//                    }
//                },
//
//                {
//                    latLng:[-6.185099,106.847878], 
//                    data:{
//                        img_preview: img_p, 
//                        properties_name:"023 Central Park [Rent]", 
//                        properties_desc:"Lorem Ipsum Go Green",
//                        properties_link:"#", 
//                        zip:001233, 
//                        city:"Jakarta"
//                    }, 
//                    options:{
//                        icon: icon_hotel
//                    }
//                },
//
//                {
//                    latLng:[-6.281856,106.776123], 
//                    data:{
//                        img_preview: img_p, 
//                        properties_name:"023 Central Park [Sell]", 
//                        properties_desc:"Lorem Ipsum Go Green",
//                        properties_link:"#", 
//                        zip:001233, 
//                        city:"Jakarta"
//                    }, 
//                    options:{
//                        icon: icon_hotel
//                    }
//                },
//
//                {
//                    latLng:[-6.228617,106.874313], 
//                    data:{
//                        img_preview: img_p, 
//                        properties_name:"023 Central Park [Rent]", 
//                        properties_desc:"Lorem Ipsum Go Green",
//                        properties_link:"#", 
//                        zip:001233, 
//                        city:"Jakarta"
//                    }, 
//                    options:{
//                        icon: icon_villa
//                    }
//                },
//
//                {
//                    latLng:[-6.217695,106.801529], 
//                    data:{
//                        img_preview: img_p, 
//                        properties_name:"023 Central Park [Sell]", 
//                        properties_desc:"Lorem Ipsum Go Green",
//                        properties_link:"#", 
//                        zip:001233, 
//                        city:"Jakarta"
//                    }, 
//                    options:{
//                        icon: icon_villa
//                    }
//                },
//                {
//                    latLng:[-6.255919,106.965637], 
//                    data:{
//                        img_preview: img_p, 
//                        properties_name:"023 Central Park [Rent]", 
//                        properties_desc:"Lorem Ipsum Go Green",
//                        properties_link:"#", 
//                        zip:001233, 
//                        city:"Jakarta"
//                    }, 
//                    options:{
//                        icon: icon_hotel
//                    }
//                }
//                ],
//                events:{
//                    mouseover: function(marker, event, context){
//                        $(this).gmap3(
//                        {
//                            clear:"overlay"
//                        },
//
//                        {
//                            overlay:{
//                                latLng: marker.getPosition(),
//                                options:{
//                                    content:  "<div class='info-location'>" +
//                                    "<div class='text'><h4>" 
//                                    + context.data.properties_name +
//                                    "</h4>"+
//                                    "<img src='"+ context.data.img_preview +"' width=90> $300.999 <br/>"+
//                                    context.data.properties_desc +
//                                    "<br/><a href='"+context.data.properties_link +"'class='btn btn-proper btn-small'>See Detail</a></div>" +
//                                    "</div>" +
//                                    "<div class='arrow-location'></div>",
//                                    offset: {
//                                        x:-46,
//                                        y:-73
//                                    }
//                                }
//                            }
//                        });
//                    }
//                    
//                }
//            }
//			
//        });
//    });
//}


function init_slider(){
    //	Responsive layout, resizing the items
    if ($('#fluid-slider').length){
        $('#fluid-slider').carouFredSel({
            responsive: true,
            width: '100%',
            prev: '#fluid-slider-prev',
            next: '#fluid-slider-next',
            scroll: 1,
            mousewheel: true,
            swipe: {
                onMouse: true,
                onTouch: true
            },
            auto: {
                pauseOnHover: 'resume',
                timeoutDuration : 6000
            
            },
            items: {
                width: 100,
                //	height: '30%',	//	optionally resize item-height
                height: 292,
                visible: {
                    min: 2,
                    max: 6
                }
            }
        });
    }
    
    if ($('#news-carousel').length){
        var _scroll = {
            delay: 1000,
            easing: 'linear',
            items: 1,
            duration: 0.07,
            timeoutDuration: 0,
            pauseOnHover: 'immediate'
        };
        $('#news-carousel').carouFredSel({
            width: '100%',
        
            align: false,
            items: {
                width: 'variable',
                height: 55,
                visible: 1
            },
            scroll: _scroll
        });
    }
    if ($('#carousel').length){
        $('#carousel').carouFredSel({
            width: '100%',
            responsive: true,
            items: {
                width: 300,
                height: "23%",
                visible: {
                    min: 1,
                    max: 1
                }
            },
            scroll: {
                pauseOnHover: 'resume',
                fx: 'fade',
                easing: 'linear',
                items: 1,
                duration: 1000,
                timeoutDuration: 6000
            },
            mousewheel: true,
            swipe: {
                onMouse: true,
                onTouch: true
            },
            prev: '#prev',
            next: '#next',
            pagination: {
                container: '#pager',
                deviation: 1
            }
        });
    }
    
    
    if ($('#list_images_property').length){
        $('#list_images_property').carouFredSel({
            auto: false,
            responsive: true,
            width: '100%',
            prev: '#prev2',
            next: '#next2',
            mousewheel: true,
            swipe: {
                onMouse: true,
                onTouch: true
            },
            scroll: 2,
            items: {
                width: 200,
                //	height: '30%',	//	optionally resize item-height
                visible: {
                    min: 2,
                    max: 6
                }
            }
        });
        $('#list_images_property a').click(function(){
            $('.preloader').show(0).delay(4000).fadeOut("slow");
            var bigImage = $(this).data("bigimage");
            var bigTitle = $(this).data("title");
            var bigDesc = $(this).data("desc");
            $(".big-image .desc-image h3").text(bigTitle);
            $(".big-image .desc-image p").text(bigDesc);
            $("#big-image-preview").attr('src', bigImage) 
            console.log(bigTitle);
            return false; 
        });
    }
    
}


function init_grid(){
    $(".grid-item").gridalicious({
        width: 250,
        gutter: 10,
        animate: true,
        effect: 'fadeInOnAppear'
    }); 
    
    $(".grid-item2").gridalicious({
        width: 180,
        gutter: 10,
        animate: true,
        effect: 'fadeInOnAppear'
    }); 
    
    $(".grid-item3").gridalicious({
        width: 140,
        gutter: 10,
        animate: true,
        effect: 'fadeInOnAppear'
    });
    
    $(".grid-galeries").gridalicious({
        width: 240,
        gutter: 10,
        animate: true,
        effect: 'fadeInOnAppear'
    });
}



function init_tabs(){
    $('.bot-tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
}


//================================
//function SetCookie 
//================================
function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}

function getCookie(c_name)
{
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1)
    {
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1)
    {
        c_value = null;
    }
    else
    {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1)
        {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
}


