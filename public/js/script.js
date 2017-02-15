/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("\r\n//Nav\r\n    $('a.menu_btn').on('click', function(){\r\n        $('ul.nav-group').toggleClass('show');\r\n        $(this).parent().addClass('active');\r\n    });\r\n    $('a.mypage').on('click', function(){\r\n        $(this).next().toggleClass('hidden');\r\n    });\r\n//confirm\r\n    $('a.rcm-delete, input.del-submit').click(function(){\r\n        if(confirm('정말 삭제하시겠습니까?') == true){\r\n            $(this).next().submit();\r\n        }else{\r\n            return;\r\n        }\r\n    });\r\n//NewProduct\r\n    $('nav.new_product a').on('click', function(e){\r\n        e.preventDefault();\r\n        var index = $('nav.new_product a').index(this);\r\n        $('div.mainPage div.slider').css('left', -100*index+'%');\r\n        $('nav.new_product a').removeClass('active').find('i').removeClass('fa-circle').addClass('fa-circle-o')\r\n        $(this).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-circle');\r\n    });\r\n//Validation\r\n    $(\"form.validate\").validate();\r\n    $(\"form.validate input\").on('keypress', function(){\r\n        if( $(this).next('span').hasClass('help-block') ){\r\n            $(this).next('span.help-block').remove();\r\n        }\r\n    });\r\n\r\n//originImg\r\n    var originImg = $('div.image-logo img').attr('src');\r\n    \r\n//ImagePreview\r\n    $('input.image').on('change', function(){\r\n        var image = $(this).val();\r\n        var imageonly = image.toLowerCase().split(\".\");\r\n        if( image != '' ){\r\n            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){\r\n                alert('이미지 파일만 업로드 가능합니다!');\r\n                $(this).val('');\r\n            }else{\r\n                if( $(this).next().hasClass('MyProduct') ){\r\n                    //상품관리\r\n                    var reader = new FileReader();\r\n                    reader.onload = function(e){\r\n                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:cover;');\r\n                    }\r\n                }else{\r\n                    var reader = new FileReader();\r\n                    reader.onload = function(e){\r\n                    if( !$('div.image-logo').children().is('img') ){\r\n                        $('div.image-logo').append('<img src=\"'+e.target.result+'\" alt=\"\">');\r\n                    }else{\r\n                        $('div.image-logo img').attr('src', e.target.result);\r\n                    }\r\n                }\r\n            }\r\n                    reader.readAsDataURL(this.files[0]);\r\n            }\r\n        }else{\r\n            if( !$('div.image-logo').is('img') ){\r\n                $('div.image-logo img').remove();\r\n            }else{\r\n                $('div.image-logo img').attr('src', originImg);\r\n            }\r\n        }\r\n    });\r\n    \r\n    $('form.user_edit').find('input[type=\"submit\"]').on('click',function(e){\r\n        if ( $('input[name=\"password\"]').val() != \"\" ){\r\n            if( $('input[name=\"password\"]').val() != $('input[name=\"password_confirmation\"]').val() ){\r\n                e.preventDefault();\r\n                if( $('input.password').next().hasClass('error') ){\r\n                    $('input.password').next().remove();\r\n                }\r\n                $('input.password').after('<label class=\"error\">비밀번호 확인값이 일치하지 않습니다!</label>');\r\n                $('input.password').val('');\r\n                $('input.password-confirm').val('');\r\n                return false;\r\n                \r\n            }\r\n        }\r\n    });\r\n//login-form\r\n    $('label.remember').on('click', function(){\r\n        $(this).find('i').toggleClass('active');\r\n        $('input.remember').click();\r\n    });\r\n//image-slide \r\n    $('nav.nav-slider').find('a').on('click', function(e){\r\n        //PreventDoubleClick\r\n        e.preventDefault();\r\n        if (!$(this).data('isClicked')) {\r\n            var link = $(this);\r\n            // successful click\r\n            Slide(this);\r\n            // Set the isClicked value and set a timer\r\n            link.data('isClicked', true);\r\n            setTimeout(function() {\r\n            link.removeData('isClicked')\r\n            }, 1200);\r\n        } else {\r\n            // Anything you want to say 'Bad user!'\r\n        };\r\n    });\r\n    function Slide(target){\r\n        var width = $(target).parent().next().find('li').outerWidth(true);\r\n        if( $(target).hasClass('left') ){\r\n                $(target).parent().next().css('left', '-'+width+'px').prepend( $(target).parent().next().find('li:last-child') );\r\n                $(target).parent().next().animate( {left : '+='+width+'px'}, 1000, function(){\r\n                } );\r\n            }else{\r\n                $(target).parent().next().find('li:first-child').clone().appendTo( $(target).parent().next() );\r\n                $(target).parent().next().animate( {left : '-='+width+'px'}, 1000, function(){\r\n                    $(target).parent().next().css('left', '0').find('li:first-child').remove();\r\n                } );\r\n            }\r\n    }\r\n    \r\n//Timer\r\n    function AutoSlide(){\r\n        var width = $('ul.slider.auto').find('li').outerWidth(true);\r\n        $('ul.slider.auto').find('li:first-child').clone().appendTo( $('ul.slider.auto') );\r\n        $('ul.slider.auto').animate( {left : '-='+width+'px'}, 1000, function(){\r\n            $('ul.slider.auto').css('left', '0').find('li:first-child').remove();\r\n        } );\r\n    }\r\n    var timer1 = setInterval( AutoSlide , 6000 );\r\n\r\n    function NewProduct(){\r\n        var index = $('nav.new_product a.active').parent('li').index()+1;\r\n        if( index == 4 ){\r\n            index = 0;\r\n        }\r\n        $('div.mainPage div.slider').css('left', -100*index+'%');\r\n        $('nav.new_product a').removeClass('active').find('i').removeClass('fa-circle').addClass('fa-circle-o')\r\n        $('nav.new_product a').eq(index).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-circle');\r\n    }\r\n    var timer2 = setInterval( NewProduct , 6000 );\r\n    \r\n    function SetTimer( $target1, $target2, $function, $timer, $time ){\r\n        $($target1).on( {\r\n            mouseenter : function(){\r\n            clearInterval( $timer );\r\n            }, \r\n            mouseleave : function(){\r\n            $timer = setInterval( $function, $time );\r\n            }\r\n        });\r\n        $($target2).on( {\r\n            mouseenter : function(){\r\n            clearInterval( $timer );\r\n            }, \r\n            mouseleave : function(){\r\n            $timer = setInterval( $function, $time );\r\n            }\r\n        });\r\n    }\r\n    SetTimer( 'ul.slider.auto', 'nav.nav-slider', AutoSlide, timer1, 6000 );\r\n    SetTimer( 'div.item', 'nav.new_product', NewProduct , timer2, 6000 );\r\n    \r\n\r\n//ShopApply\r\n\r\n    $('div.notice-group a').on('click',function(){\r\n        $('div.slide').removeClass('fadein');\r\n        $(this).parent().parent().next().toggleClass('fadein');\r\n    });\r\n\r\n//fav Ajax\r\n    $(\"a.bookmark\").on('click',function() {\r\n        bookmark( $(this), 'bookmark' , 'shop_id' );\r\n    });\r\n\r\n    $(\"a.fav\").on('click',function() {\r\n        bookmark( $(this), 'favorite' , 'product_id' );\r\n    });\r\n\r\n    $(\"a.fav-detail\").on('click',function() {\r\n        bookmark( $(this), '../favorite' , 'product_id' );\r\n    });\r\n\r\n    function bookmark(aTarget, route , urlTarget) {\r\n        var val = aTarget.parent().next().html();\r\n        var formData = { urlTarget : val};\r\n        \r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n\r\n        $.ajax({\r\n            url: route+\"/\"+val,\r\n            type: \"POST\",\r\n            data: formData,\r\n            success: function(data){\r\n                aTarget.find('i').toggleClass('hidden');\r\n                if( aTarget.find('em') ){\r\n                    aTarget.find('em').toggleClass('hidden');\r\n                }\r\n            },\r\n            error: function(responseData, textStatus){\r\n                console.log(textStatus);\r\n            }\r\n        });\r\n    }\r\n//filter-Info\r\n    $('div.info_group').find('a').on({ focus : function(e){\r\n        e.preventDefault();\r\n        var className = $(this).attr('class');\r\n        $('div.popup').addClass('hidden');\r\n        $('div.popup.'+className).removeClass('hidden');\r\n    }, focusout : function(e){\r\n        if( !$('div.popup').is(':focus') ){\r\n            var className = $(this).attr('class');\r\n            $('div.popup.'+className).addClass('hidden');\r\n        }\r\n    }});\r\n//Product sort\r\n    $('ul.sort-list li').on('click', function(e){\r\n        $(this).parent().find('li').removeClass('active');\r\n        $(this).addClass('active');\r\n        $('input#sortBy').val( $(this).attr('name') );\r\n        $('input#sortBy').parent().parent().submit();\r\n    });\r\n\r\n    $('div.filter-group label').on('click', function(){\r\n        if( $(this).next().hasClass('purpose') ){\r\n            $(this).toggleClass('active');\r\n        }else{\r\n            if( $(this).attr('class')=='active' ){\r\n                //radio버튼풀기\r\n                //$(this).removeClass('active');\r\n            }\r\n            else{\r\n                $(this).parent().find('label').removeClass('active');\r\n                $(this).addClass('active');\r\n            }\r\n        };\r\n    });\r\n    \r\n\r\n\r\n//Search\r\n    $('input[name=search]').on('keypress', function(e){\r\n        if( e.keyCode == 13 ){\r\n            $('form[name=searchForm]').submit();\r\n        }\r\n    });\r\n    $('input[name=search]').focus(function(){\r\n    $(this).parent('div').css('border', '1px solid rgba(43,222,115,1.0)').css('box-shadow', '0 0 15px rgba(43,222,115,0.3)');\r\n    }).blur(function(){\r\n        $(this).parent('div').css('border', '1px solid #ccc').css('box-shadow', 'none');\r\n    });\r\n//Detail Ajax\r\n    $('a.go_url').on('click',function() {\r\n        var productId = $('input.product-id').val();\r\n        var formData = { 'product_id' : productId };\r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n        $.ajax({\r\n            url: \"../viewcount/\"+productId,\r\n            type: \"POST\",\r\n            data: formData, \r\n            success: function(data){\r\n            },\r\n            error: function(responseData, textStatus){\r\n                alert(textStatus);\r\n            }\r\n        });\r\n    });\r\n//MyProduct\r\n    $('input[name=\"purpose\"]').on('click', function(){\r\n        if($(this).val() == '게임용'){\r\n            $('ul.for_game_check').css('opacity','1.0').find('input[type=\"checkbox\"]').removeAttr('disabled');\r\n        }else{\r\n            $('ul.for_game_check').css('opacity','0.7').find('input[type=\"checkbox\"]').attr('disabled', 'disabled');\r\n        }\r\n    });//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3NjcmlwdC5qcz85YTBlIl0sInNvdXJjZXNDb250ZW50IjpbIlxyXG4vL05hdlxyXG4gICAgJCgnYS5tZW51X2J0bicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJCgndWwubmF2LWdyb3VwJykudG9nZ2xlQ2xhc3MoJ3Nob3cnKTtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgIH0pO1xyXG4gICAgJCgnYS5teXBhZ2UnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICQodGhpcykubmV4dCgpLnRvZ2dsZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgIH0pO1xyXG4vL2NvbmZpcm1cclxuICAgICQoJ2EucmNtLWRlbGV0ZSwgaW5wdXQuZGVsLXN1Ym1pdCcpLmNsaWNrKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgaWYoY29uZmlybSgn7KCV66eQIOyCreygnO2VmOyLnOqyoOyKteuLiOq5jD8nKSA9PSB0cnVlKXtcclxuICAgICAgICAgICAgJCh0aGlzKS5uZXh0KCkuc3VibWl0KCk7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIHJldHVybjtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuLy9OZXdQcm9kdWN0XHJcbiAgICAkKCduYXYubmV3X3Byb2R1Y3QgYScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgaW5kZXggPSAkKCduYXYubmV3X3Byb2R1Y3QgYScpLmluZGV4KHRoaXMpO1xyXG4gICAgICAgICQoJ2Rpdi5tYWluUGFnZSBkaXYuc2xpZGVyJykuY3NzKCdsZWZ0JywgLTEwMCppbmRleCsnJScpO1xyXG4gICAgICAgICQoJ25hdi5uZXdfcHJvZHVjdCBhJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpLmZpbmQoJ2knKS5yZW1vdmVDbGFzcygnZmEtY2lyY2xlJykuYWRkQ2xhc3MoJ2ZhLWNpcmNsZS1vJylcclxuICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKS5maW5kKCdpJykucmVtb3ZlQ2xhc3MoJ2ZhLWNpcmNsZS1vJykuYWRkQ2xhc3MoJ2ZhLWNpcmNsZScpO1xyXG4gICAgfSk7XHJcbi8vVmFsaWRhdGlvblxyXG4gICAgJChcImZvcm0udmFsaWRhdGVcIikudmFsaWRhdGUoKTtcclxuICAgICQoXCJmb3JtLnZhbGlkYXRlIGlucHV0XCIpLm9uKCdrZXlwcmVzcycsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgaWYoICQodGhpcykubmV4dCgnc3BhbicpLmhhc0NsYXNzKCdoZWxwLWJsb2NrJykgKXtcclxuICAgICAgICAgICAgJCh0aGlzKS5uZXh0KCdzcGFuLmhlbHAtYmxvY2snKS5yZW1vdmUoKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuXHJcbi8vb3JpZ2luSW1nXHJcbiAgICB2YXIgb3JpZ2luSW1nID0gJCgnZGl2LmltYWdlLWxvZ28gaW1nJykuYXR0cignc3JjJyk7XHJcbiAgICBcclxuLy9JbWFnZVByZXZpZXdcclxuICAgICQoJ2lucHV0LmltYWdlJykub24oJ2NoYW5nZScsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgdmFyIGltYWdlID0gJCh0aGlzKS52YWwoKTtcclxuICAgICAgICB2YXIgaW1hZ2Vvbmx5ID0gaW1hZ2UudG9Mb3dlckNhc2UoKS5zcGxpdChcIi5cIik7XHJcbiAgICAgICAgaWYoIGltYWdlICE9ICcnICl7XHJcbiAgICAgICAgICAgIGlmKCBpbWFnZW9ubHlbMV0gIT0gJ2pwZycgJiYgaW1hZ2Vvbmx5WzFdICE9ICdwbmcnICYmIGltYWdlb25seVsxXSAhPSAnanBlZycgJiYgaW1hZ2Vvbmx5WzFdICE9ICdnaWYnICYmIGltYWdlb25seVsxXSAhPSAnYm1wJyl7XHJcbiAgICAgICAgICAgICAgICBhbGVydCgn7J2066+47KeAIO2MjOydvOunjCDsl4XroZzrk5wg6rCA64ql7ZWp64uI64ukIScpO1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS52YWwoJycpO1xyXG4gICAgICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgICAgIGlmKCAkKHRoaXMpLm5leHQoKS5oYXNDbGFzcygnTXlQcm9kdWN0JykgKXtcclxuICAgICAgICAgICAgICAgICAgICAvL+yDge2SiOq0gOumrFxyXG4gICAgICAgICAgICAgICAgICAgIHZhciByZWFkZXIgPSBuZXcgRmlsZVJlYWRlcigpO1xyXG4gICAgICAgICAgICAgICAgICAgIHJlYWRlci5vbmxvYWQgPSBmdW5jdGlvbihlKXtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJCgnZGl2LmltZy1ib3gnKS5hdHRyKCdzdHlsZScsICdiYWNrZ3JvdW5kOnVybCgnK2UudGFyZ2V0LnJlc3VsdCsnKSBjZW50ZXIgbm8tcmVwZWF0OyBiYWNrZ3JvdW5kLXNpemU6Y292ZXI7Jyk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyIHJlYWRlciA9IG5ldyBGaWxlUmVhZGVyKCk7XHJcbiAgICAgICAgICAgICAgICAgICAgcmVhZGVyLm9ubG9hZCA9IGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgICAgICAgICAgICAgIGlmKCAhJCgnZGl2LmltYWdlLWxvZ28nKS5jaGlsZHJlbigpLmlzKCdpbWcnKSApe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkKCdkaXYuaW1hZ2UtbG9nbycpLmFwcGVuZCgnPGltZyBzcmM9XCInK2UudGFyZ2V0LnJlc3VsdCsnXCIgYWx0PVwiXCI+Jyk7XHJcbiAgICAgICAgICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICQoJ2Rpdi5pbWFnZS1sb2dvIGltZycpLmF0dHIoJ3NyYycsIGUudGFyZ2V0LnJlc3VsdCk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwodGhpcy5maWxlc1swXSk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgaWYoICEkKCdkaXYuaW1hZ2UtbG9nbycpLmlzKCdpbWcnKSApe1xyXG4gICAgICAgICAgICAgICAgJCgnZGl2LmltYWdlLWxvZ28gaW1nJykucmVtb3ZlKCk7XHJcbiAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgJCgnZGl2LmltYWdlLWxvZ28gaW1nJykuYXR0cignc3JjJywgb3JpZ2luSW1nKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG4gICAgXHJcbiAgICAkKCdmb3JtLnVzZXJfZWRpdCcpLmZpbmQoJ2lucHV0W3R5cGU9XCJzdWJtaXRcIl0nKS5vbignY2xpY2snLGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGlmICggJCgnaW5wdXRbbmFtZT1cInBhc3N3b3JkXCJdJykudmFsKCkgIT0gXCJcIiApe1xyXG4gICAgICAgICAgICBpZiggJCgnaW5wdXRbbmFtZT1cInBhc3N3b3JkXCJdJykudmFsKCkgIT0gJCgnaW5wdXRbbmFtZT1cInBhc3N3b3JkX2NvbmZpcm1hdGlvblwiXScpLnZhbCgpICl7XHJcbiAgICAgICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgICAgICAgICBpZiggJCgnaW5wdXQucGFzc3dvcmQnKS5uZXh0KCkuaGFzQ2xhc3MoJ2Vycm9yJykgKXtcclxuICAgICAgICAgICAgICAgICAgICAkKCdpbnB1dC5wYXNzd29yZCcpLm5leHQoKS5yZW1vdmUoKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICQoJ2lucHV0LnBhc3N3b3JkJykuYWZ0ZXIoJzxsYWJlbCBjbGFzcz1cImVycm9yXCI+67mE67CA67KI7Zi4IO2ZleyduOqwkuydtCDsnbzsuZjtlZjsp4Ag7JWK7Iq164uI64ukITwvbGFiZWw+Jyk7XHJcbiAgICAgICAgICAgICAgICAkKCdpbnB1dC5wYXNzd29yZCcpLnZhbCgnJyk7XHJcbiAgICAgICAgICAgICAgICAkKCdpbnB1dC5wYXNzd29yZC1jb25maXJtJykudmFsKCcnKTtcclxuICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbi8vbG9naW4tZm9ybVxyXG4gICAgJCgnbGFiZWwucmVtZW1iZXInKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICQodGhpcykuZmluZCgnaScpLnRvZ2dsZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkKCdpbnB1dC5yZW1lbWJlcicpLmNsaWNrKCk7XHJcbiAgICB9KTtcclxuLy9pbWFnZS1zbGlkZSBcclxuICAgICQoJ25hdi5uYXYtc2xpZGVyJykuZmluZCgnYScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIC8vUHJldmVudERvdWJsZUNsaWNrXHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgIGlmICghJCh0aGlzKS5kYXRhKCdpc0NsaWNrZWQnKSkge1xyXG4gICAgICAgICAgICB2YXIgbGluayA9ICQodGhpcyk7XHJcbiAgICAgICAgICAgIC8vIHN1Y2Nlc3NmdWwgY2xpY2tcclxuICAgICAgICAgICAgU2xpZGUodGhpcyk7XHJcbiAgICAgICAgICAgIC8vIFNldCB0aGUgaXNDbGlja2VkIHZhbHVlIGFuZCBzZXQgYSB0aW1lclxyXG4gICAgICAgICAgICBsaW5rLmRhdGEoJ2lzQ2xpY2tlZCcsIHRydWUpO1xyXG4gICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICBsaW5rLnJlbW92ZURhdGEoJ2lzQ2xpY2tlZCcpXHJcbiAgICAgICAgICAgIH0sIDEyMDApO1xyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgIC8vIEFueXRoaW5nIHlvdSB3YW50IHRvIHNheSAnQmFkIHVzZXIhJ1xyXG4gICAgICAgIH07XHJcbiAgICB9KTtcclxuICAgIGZ1bmN0aW9uIFNsaWRlKHRhcmdldCl7XHJcbiAgICAgICAgdmFyIHdpZHRoID0gJCh0YXJnZXQpLnBhcmVudCgpLm5leHQoKS5maW5kKCdsaScpLm91dGVyV2lkdGgodHJ1ZSk7XHJcbiAgICAgICAgaWYoICQodGFyZ2V0KS5oYXNDbGFzcygnbGVmdCcpICl7XHJcbiAgICAgICAgICAgICAgICAkKHRhcmdldCkucGFyZW50KCkubmV4dCgpLmNzcygnbGVmdCcsICctJyt3aWR0aCsncHgnKS5wcmVwZW5kKCAkKHRhcmdldCkucGFyZW50KCkubmV4dCgpLmZpbmQoJ2xpOmxhc3QtY2hpbGQnKSApO1xyXG4gICAgICAgICAgICAgICAgJCh0YXJnZXQpLnBhcmVudCgpLm5leHQoKS5hbmltYXRlKCB7bGVmdCA6ICcrPScrd2lkdGgrJ3B4J30sIDEwMDAsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICAgICB9ICk7XHJcbiAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgJCh0YXJnZXQpLnBhcmVudCgpLm5leHQoKS5maW5kKCdsaTpmaXJzdC1jaGlsZCcpLmNsb25lKCkuYXBwZW5kVG8oICQodGFyZ2V0KS5wYXJlbnQoKS5uZXh0KCkgKTtcclxuICAgICAgICAgICAgICAgICQodGFyZ2V0KS5wYXJlbnQoKS5uZXh0KCkuYW5pbWF0ZSgge2xlZnQgOiAnLT0nK3dpZHRoKydweCd9LCAxMDAwLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgICAgICQodGFyZ2V0KS5wYXJlbnQoKS5uZXh0KCkuY3NzKCdsZWZ0JywgJzAnKS5maW5kKCdsaTpmaXJzdC1jaGlsZCcpLnJlbW92ZSgpO1xyXG4gICAgICAgICAgICAgICAgfSApO1xyXG4gICAgICAgICAgICB9XHJcbiAgICB9XHJcbiAgICBcclxuLy9UaW1lclxyXG4gICAgZnVuY3Rpb24gQXV0b1NsaWRlKCl7XHJcbiAgICAgICAgdmFyIHdpZHRoID0gJCgndWwuc2xpZGVyLmF1dG8nKS5maW5kKCdsaScpLm91dGVyV2lkdGgodHJ1ZSk7XHJcbiAgICAgICAgJCgndWwuc2xpZGVyLmF1dG8nKS5maW5kKCdsaTpmaXJzdC1jaGlsZCcpLmNsb25lKCkuYXBwZW5kVG8oICQoJ3VsLnNsaWRlci5hdXRvJykgKTtcclxuICAgICAgICAkKCd1bC5zbGlkZXIuYXV0bycpLmFuaW1hdGUoIHtsZWZ0IDogJy09Jyt3aWR0aCsncHgnfSwgMTAwMCwgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgJCgndWwuc2xpZGVyLmF1dG8nKS5jc3MoJ2xlZnQnLCAnMCcpLmZpbmQoJ2xpOmZpcnN0LWNoaWxkJykucmVtb3ZlKCk7XHJcbiAgICAgICAgfSApO1xyXG4gICAgfVxyXG4gICAgdmFyIHRpbWVyMSA9IHNldEludGVydmFsKCBBdXRvU2xpZGUgLCA2MDAwICk7XHJcblxyXG4gICAgZnVuY3Rpb24gTmV3UHJvZHVjdCgpe1xyXG4gICAgICAgIHZhciBpbmRleCA9ICQoJ25hdi5uZXdfcHJvZHVjdCBhLmFjdGl2ZScpLnBhcmVudCgnbGknKS5pbmRleCgpKzE7XHJcbiAgICAgICAgaWYoIGluZGV4ID09IDQgKXtcclxuICAgICAgICAgICAgaW5kZXggPSAwO1xyXG4gICAgICAgIH1cclxuICAgICAgICAkKCdkaXYubWFpblBhZ2UgZGl2LnNsaWRlcicpLmNzcygnbGVmdCcsIC0xMDAqaW5kZXgrJyUnKTtcclxuICAgICAgICAkKCduYXYubmV3X3Byb2R1Y3QgYScpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKS5maW5kKCdpJykucmVtb3ZlQ2xhc3MoJ2ZhLWNpcmNsZScpLmFkZENsYXNzKCdmYS1jaXJjbGUtbycpXHJcbiAgICAgICAgJCgnbmF2Lm5ld19wcm9kdWN0IGEnKS5lcShpbmRleCkuYWRkQ2xhc3MoJ2FjdGl2ZScpLmZpbmQoJ2knKS5yZW1vdmVDbGFzcygnZmEtY2lyY2xlLW8nKS5hZGRDbGFzcygnZmEtY2lyY2xlJyk7XHJcbiAgICB9XHJcbiAgICB2YXIgdGltZXIyID0gc2V0SW50ZXJ2YWwoIE5ld1Byb2R1Y3QgLCA2MDAwICk7XHJcbiAgICBcclxuICAgIGZ1bmN0aW9uIFNldFRpbWVyKCAkdGFyZ2V0MSwgJHRhcmdldDIsICRmdW5jdGlvbiwgJHRpbWVyLCAkdGltZSApe1xyXG4gICAgICAgICQoJHRhcmdldDEpLm9uKCB7XHJcbiAgICAgICAgICAgIG1vdXNlZW50ZXIgOiBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICBjbGVhckludGVydmFsKCAkdGltZXIgKTtcclxuICAgICAgICAgICAgfSwgXHJcbiAgICAgICAgICAgIG1vdXNlbGVhdmUgOiBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAkdGltZXIgPSBzZXRJbnRlcnZhbCggJGZ1bmN0aW9uLCAkdGltZSApO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgJCgkdGFyZ2V0Mikub24oIHtcclxuICAgICAgICAgICAgbW91c2VlbnRlciA6IGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgIGNsZWFySW50ZXJ2YWwoICR0aW1lciApO1xyXG4gICAgICAgICAgICB9LCBcclxuICAgICAgICAgICAgbW91c2VsZWF2ZSA6IGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICR0aW1lciA9IHNldEludGVydmFsKCAkZnVuY3Rpb24sICR0aW1lICk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxuICAgIFNldFRpbWVyKCAndWwuc2xpZGVyLmF1dG8nLCAnbmF2Lm5hdi1zbGlkZXInLCBBdXRvU2xpZGUsIHRpbWVyMSwgNjAwMCApO1xyXG4gICAgU2V0VGltZXIoICdkaXYuaXRlbScsICduYXYubmV3X3Byb2R1Y3QnLCBOZXdQcm9kdWN0ICwgdGltZXIyLCA2MDAwICk7XHJcbiAgICBcclxuXHJcbi8vU2hvcEFwcGx5XHJcblxyXG4gICAgJCgnZGl2Lm5vdGljZS1ncm91cCBhJykub24oJ2NsaWNrJyxmdW5jdGlvbigpe1xyXG4gICAgICAgICQoJ2Rpdi5zbGlkZScpLnJlbW92ZUNsYXNzKCdmYWRlaW4nKTtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpLm5leHQoKS50b2dnbGVDbGFzcygnZmFkZWluJyk7XHJcbiAgICB9KTtcclxuXHJcbi8vZmF2IEFqYXhcclxuICAgICQoXCJhLmJvb2ttYXJrXCIpLm9uKCdjbGljaycsZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgYm9va21hcmsoICQodGhpcyksICdib29rbWFyaycgLCAnc2hvcF9pZCcgKTtcclxuICAgIH0pO1xyXG5cclxuICAgICQoXCJhLmZhdlwiKS5vbignY2xpY2snLGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIGJvb2ttYXJrKCAkKHRoaXMpLCAnZmF2b3JpdGUnICwgJ3Byb2R1Y3RfaWQnICk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAkKFwiYS5mYXYtZGV0YWlsXCIpLm9uKCdjbGljaycsZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgYm9va21hcmsoICQodGhpcyksICcuLi9mYXZvcml0ZScgLCAncHJvZHVjdF9pZCcgKTtcclxuICAgIH0pO1xyXG5cclxuICAgIGZ1bmN0aW9uIGJvb2ttYXJrKGFUYXJnZXQsIHJvdXRlICwgdXJsVGFyZ2V0KSB7XHJcbiAgICAgICAgdmFyIHZhbCA9IGFUYXJnZXQucGFyZW50KCkubmV4dCgpLmh0bWwoKTtcclxuICAgICAgICB2YXIgZm9ybURhdGEgPSB7IHVybFRhcmdldCA6IHZhbH07XHJcbiAgICAgICAgXHJcbiAgICAgICAgJC5hamF4U2V0dXAoe1xyXG4gICAgICAgICAgICBoZWFkZXJzOiB7XHJcbiAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICQuYWpheCh7XHJcbiAgICAgICAgICAgIHVybDogcm91dGUrXCIvXCIrdmFsLFxyXG4gICAgICAgICAgICB0eXBlOiBcIlBPU1RcIixcclxuICAgICAgICAgICAgZGF0YTogZm9ybURhdGEsXHJcbiAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKGRhdGEpe1xyXG4gICAgICAgICAgICAgICAgYVRhcmdldC5maW5kKCdpJykudG9nZ2xlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAgICAgaWYoIGFUYXJnZXQuZmluZCgnZW0nKSApe1xyXG4gICAgICAgICAgICAgICAgICAgIGFUYXJnZXQuZmluZCgnZW0nKS50b2dnbGVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGVycm9yOiBmdW5jdGlvbihyZXNwb25zZURhdGEsIHRleHRTdGF0dXMpe1xyXG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2codGV4dFN0YXR1cyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxuLy9maWx0ZXItSW5mb1xyXG4gICAgJCgnZGl2LmluZm9fZ3JvdXAnKS5maW5kKCdhJykub24oeyBmb2N1cyA6IGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgY2xhc3NOYW1lID0gJCh0aGlzKS5hdHRyKCdjbGFzcycpO1xyXG4gICAgICAgICQoJ2Rpdi5wb3B1cCcpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAkKCdkaXYucG9wdXAuJytjbGFzc05hbWUpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgIH0sIGZvY3Vzb3V0IDogZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgaWYoICEkKCdkaXYucG9wdXAnKS5pcygnOmZvY3VzJykgKXtcclxuICAgICAgICAgICAgdmFyIGNsYXNzTmFtZSA9ICQodGhpcykuYXR0cignY2xhc3MnKTtcclxuICAgICAgICAgICAgJCgnZGl2LnBvcHVwLicrY2xhc3NOYW1lKS5hZGRDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgfVxyXG4gICAgfX0pO1xyXG4vL1Byb2R1Y3Qgc29ydFxyXG4gICAgJCgndWwuc29ydC1saXN0IGxpJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5maW5kKCdsaScpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkKCdpbnB1dCNzb3J0QnknKS52YWwoICQodGhpcykuYXR0cignbmFtZScpICk7XHJcbiAgICAgICAgJCgnaW5wdXQjc29ydEJ5JykucGFyZW50KCkucGFyZW50KCkuc3VibWl0KCk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAkKCdkaXYuZmlsdGVyLWdyb3VwIGxhYmVsJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICBpZiggJCh0aGlzKS5uZXh0KCkuaGFzQ2xhc3MoJ3B1cnBvc2UnKSApe1xyXG4gICAgICAgICAgICAkKHRoaXMpLnRvZ2dsZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgaWYoICQodGhpcykuYXR0cignY2xhc3MnKT09J2FjdGl2ZScgKXtcclxuICAgICAgICAgICAgICAgIC8vcmFkaW/rsoTtirztkoDquLBcclxuICAgICAgICAgICAgICAgIC8vJCh0aGlzKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgZWxzZXtcclxuICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkuZmluZCgnbGFiZWwnKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH07XHJcbiAgICB9KTtcclxuICAgIFxyXG5cclxuXHJcbi8vU2VhcmNoXHJcbiAgICAkKCdpbnB1dFtuYW1lPXNlYXJjaF0nKS5vbigna2V5cHJlc3MnLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBpZiggZS5rZXlDb2RlID09IDEzICl7XHJcbiAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1zZWFyY2hGb3JtXScpLnN1Ym1pdCgpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG4gICAgJCgnaW5wdXRbbmFtZT1zZWFyY2hdJykuZm9jdXMoZnVuY3Rpb24oKXtcclxuICAgICQodGhpcykucGFyZW50KCdkaXYnKS5jc3MoJ2JvcmRlcicsICcxcHggc29saWQgcmdiYSg0MywyMjIsMTE1LDEuMCknKS5jc3MoJ2JveC1zaGFkb3cnLCAnMCAwIDE1cHggcmdiYSg0MywyMjIsMTE1LDAuMyknKTtcclxuICAgIH0pLmJsdXIoZnVuY3Rpb24oKXtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgnZGl2JykuY3NzKCdib3JkZXInLCAnMXB4IHNvbGlkICNjY2MnKS5jc3MoJ2JveC1zaGFkb3cnLCAnbm9uZScpO1xyXG4gICAgfSk7XHJcbi8vRGV0YWlsIEFqYXhcclxuICAgICQoJ2EuZ29fdXJsJykub24oJ2NsaWNrJyxmdW5jdGlvbigpIHtcclxuICAgICAgICB2YXIgcHJvZHVjdElkID0gJCgnaW5wdXQucHJvZHVjdC1pZCcpLnZhbCgpO1xyXG4gICAgICAgIHZhciBmb3JtRGF0YSA9IHsgJ3Byb2R1Y3RfaWQnIDogcHJvZHVjdElkIH07XHJcbiAgICAgICAgJC5hamF4U2V0dXAoe1xyXG4gICAgICAgICAgICBoZWFkZXJzOiB7XHJcbiAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgJC5hamF4KHtcclxuICAgICAgICAgICAgdXJsOiBcIi4uL3ZpZXdjb3VudC9cIitwcm9kdWN0SWQsXHJcbiAgICAgICAgICAgIHR5cGU6IFwiUE9TVFwiLFxyXG4gICAgICAgICAgICBkYXRhOiBmb3JtRGF0YSwgXHJcbiAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uKGRhdGEpe1xyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBlcnJvcjogZnVuY3Rpb24ocmVzcG9uc2VEYXRhLCB0ZXh0U3RhdHVzKXtcclxuICAgICAgICAgICAgICAgIGFsZXJ0KHRleHRTdGF0dXMpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICB9KTtcclxuLy9NeVByb2R1Y3RcclxuICAgICQoJ2lucHV0W25hbWU9XCJwdXJwb3NlXCJdJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICBpZigkKHRoaXMpLnZhbCgpID09ICfqsozsnoTsmqknKXtcclxuICAgICAgICAgICAgJCgndWwuZm9yX2dhbWVfY2hlY2snKS5jc3MoJ29wYWNpdHknLCcxLjAnKS5maW5kKCdpbnB1dFt0eXBlPVwiY2hlY2tib3hcIl0nKS5yZW1vdmVBdHRyKCdkaXNhYmxlZCcpO1xyXG4gICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAkKCd1bC5mb3JfZ2FtZV9jaGVjaycpLmNzcygnb3BhY2l0eScsJzAuNycpLmZpbmQoJ2lucHV0W3R5cGU9XCJjaGVja2JveFwiXScpLmF0dHIoJ2Rpc2FibGVkJywgJ2Rpc2FibGVkJyk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvc2NyaXB0LmpzIl0sIm1hcHBpbmdzIjoiQUFBQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);