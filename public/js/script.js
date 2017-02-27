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

eval("\r\n//Nav\r\n    $('a.menu_btn').on('click', function(){\r\n        $('ul.nav-group').toggleClass('show');\r\n        $(this).parent().addClass('active');\r\n    });\r\n    $('a.mypage').on('click', function(){\r\n        $(this).next().toggleClass('hidden');\r\n    });\r\n//confirm\r\n    $('a.rcm-delete, a.user-delete , input.del-submit').click(function(e){\r\n        e.preventDefault();\r\n        var confirmMent = '정말 삭제하시겠습니까?';\r\n        if( $(this).hasClass('user-delete') ){\r\n            confirmMent = '정말 탈퇴하시겠습니까?\\n회원님의 정보는 전부 사라집니다.';\r\n        }\r\n        if(confirm(confirmMent) == true){\r\n            $(this).next().submit();\r\n        }else{\r\n            return;\r\n        }\r\n    });\r\n//NewProduct\r\n    $('nav.new_product a').on('click', function(e){\r\n        e.preventDefault();\r\n        var index = $('nav.new_product a').index(this);\r\n        $('div.mainPage div.slider').css('left', -100*index+'%');\r\n        $('nav.new_product a').removeClass('active').find('i').removeClass('fa-circle').addClass('fa-circle-o')\r\n        $(this).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-circle');\r\n    });\r\n\r\n//Guide\r\n    $('ul.guide li').on('click', function(){\r\n        $name = $(this).attr('name'); \r\n        $('div[name=\"'+ $name +'\"]').removeClass('hidden').siblings('div').addClass('hidden');\r\n});\r\n//Validation\r\n    $(\"form.validate\").validate();\r\n    $(\"form.validate input\").on('keypress', function(){\r\n        if( $(this).next('span').hasClass('help-block') ){\r\n            $(this).next('span.help-block').remove();\r\n        }\r\n    });\r\n    $('ul.for_game_check input').on('click',function(){\r\n        if( $('ul.for_game_check input[type=\"checkbox\"]:checked').length > 7 ){\r\n            alert('세부 카테고리는 7개까지만 선택이 가능합니다!');\r\n            $(this).prop('checked', false);\r\n        };\r\n    });\r\n    $('input[type=\"submit\"].modify').click(function(){\r\n        $type = $(this).val().substr(0,2);\r\n        if(confirm($type+'하시겠습니까?') == false){\r\n            return false;\r\n        }\r\n    });\r\n//Agree in registerForm\r\n    $('form.agree-form input.agree').on('click',function(){\r\n        if( $(this).is(':checked') == true ){\r\n            $('form.register-form').find('[name=\"'+ $(this).attr('name') +'\"]').prop('checked', true);\r\n        }else{\r\n            $('form.register-form').find('[name=\"'+ $(this).attr('name') +'\"]').prop('checked', false);\r\n        }\r\n        if( $('input.agree').eq(0).is(':checked') == true && $('input.agree').eq(1).is(':checked') == true ){\r\n            $('form.register-form input[type=\"submit\"]').removeAttr('disabled');\r\n            $('form.register-form input[type=\"submit\"]').attr('value','가입하기');\r\n        }else{\r\n            $('form.register-form input[type=\"submit\"]').attr('disabled', 'disabled');\r\n            $('form.register-form input[type=\"submit\"]').attr('value','이용약관 및 개인정보 취급방침에 동의해주세요.');\r\n        }\r\n    });\r\n\r\n//originImg\r\n    $origin = $('div.img-box').attr('style');\r\n    \r\n//ImagePreview\r\n    $('input.image').on('change', function(){\r\n        var image = $(this).val();\r\n        var imageonly = image.toLowerCase().split(\".\");\r\n        if( image != '' ){\r\n            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){\r\n                alert('이미지 파일만 업로드 가능합니다!');\r\n                $(this).val('');\r\n            }else{\r\n                if( $(this).next().hasClass('MyProduct') ){\r\n                    //상품관리\r\n                    var reader = new FileReader();\r\n                    reader.onload = function(e){\r\n                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:auto 100%;').parent().removeClass('hidden');\r\n                    }\r\n                }else{\r\n                    //Shop정보수정\r\n                    var reader = new FileReader();\r\n                    reader.onload = function(e){\r\n                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:auto 100%;').parent().removeClass('hidden');\r\n                }\r\n            }\r\n                    reader.readAsDataURL(this.files[0]);\r\n            }\r\n        }else{\r\n            if( !$origin ){\r\n                $('div.img-box').attr('style', '').parent().addClass('hidden');\r\n            }else{\r\n                $('div.img-box').attr('style', $origin);\r\n            }\r\n        }\r\n    });\r\n    \r\n    $('form.user_edit').find('input[type=\"submit\"]').on('click',function(e){\r\n        if ( $('input[name=\"password\"]').val() != \"\" ){\r\n            if( $('input[name=\"password\"]').val() != $('input[name=\"password_confirmation\"]').val() ){\r\n                e.preventDefault();\r\n                if( $('input.password').next().hasClass('error') ){\r\n                    $('input.password').next().remove();\r\n                }\r\n                $('input.password').after('<label class=\"error\">비밀번호 확인값이 일치하지 않습니다!</label>');\r\n                $('input.password').val('');\r\n                $('input.password-confirm').val('');\r\n                return false;\r\n                \r\n            }\r\n        }\r\n    });\r\n//login-form\r\n    $('label.remember').on('click', function(){\r\n        $(this).find('i').toggleClass('active');\r\n        $('input.remember').click();\r\n    });\r\n//image-slide \r\n    $('nav.nav-slider').find('a').on('click', function(e){\r\n        //PreventDoubleClick\r\n        e.preventDefault();\r\n        if (!$(this).data('isClicked')) {\r\n            var link = $(this);\r\n            // successful click\r\n            Slide(this);\r\n            // Set the isClicked value and set a timer\r\n            link.data('isClicked', true);\r\n            setTimeout(function() {\r\n            link.removeData('isClicked')\r\n            }, 1200);\r\n        } else {\r\n            // Anything you want to say 'Bad user!'\r\n        };\r\n    });\r\n    function Slide(target){\r\n        var width = $(target).parent().next().find('li').outerWidth(true);\r\n        if( $(target).hasClass('left') ){\r\n                $(target).parent().next().css('left', '-'+width+'px').prepend( $(target).parent().next().find('li:last-child') );\r\n                $(target).parent().next().animate( {left : '+='+width+'px'}, 1000, function(){\r\n                } );\r\n            }else{\r\n                $(target).parent().next().find('li:first-child').clone().appendTo( $(target).parent().next() );\r\n                $(target).parent().next().animate( {left : '-='+width+'px'}, 1000, function(){\r\n                    $(target).parent().next().css('left', '0').find('li:first-child').remove();\r\n                } );\r\n            }\r\n    }\r\n    \r\n//Timer\r\n    function AutoSlide(){\r\n        var width = $('ul.slider.auto').find('li').outerWidth(true);\r\n        $('ul.slider.auto').find('li:first-child').clone().appendTo( $('ul.slider.auto') );\r\n        $('ul.slider.auto').animate( {left : '-='+width+'px'}, 1000, function(){\r\n            $('ul.slider.auto').css('left', '0').find('li:first-child').remove();\r\n        } );\r\n    }\r\n    var timer1 = setInterval( AutoSlide , 6000 );\r\n\r\n    function NewProduct(){\r\n        var index = $('nav.new_product a.active').parent('li').index()+1;\r\n        if( index == 4 ){\r\n            index = 0;\r\n        }\r\n        $('div.mainPage div.slider').css('left', -100*index+'%');\r\n        $('nav.new_product a').removeClass('active').find('i').removeClass('fa-circle').addClass('fa-circle-o')\r\n        $('nav.new_product a').eq(index).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-circle');\r\n    }\r\n    var timer2 = setInterval( NewProduct , 6000 );\r\n    \r\n    function SetTimer( $target1, $target2, $function, $timer, $time ){\r\n        $($target1).on( {\r\n            mouseenter : function(){\r\n            clearInterval( $timer );\r\n            }, \r\n            mouseleave : function(){\r\n            $timer = setInterval( $function, $time );\r\n            }\r\n        });\r\n        $($target2).on( {\r\n            mouseenter : function(){\r\n            clearInterval( $timer );\r\n            }, \r\n            mouseleave : function(){\r\n            $timer = setInterval( $function, $time );\r\n            }\r\n        });\r\n    }\r\n    SetTimer( 'ul.slider.auto', 'nav.nav-slider', AutoSlide, timer1, 6000 );\r\n    SetTimer( 'div.item', 'nav.new_product', NewProduct , timer2, 6000 );\r\n    \r\n\r\n//ShopApply\r\n\r\n    $('div.notice-group a').on('click',function(){\r\n        $('div.slide').removeClass('fadein');\r\n        $(this).parent().parent().next().toggleClass('fadein');\r\n    });\r\n\r\n//fav Ajax\r\n    $(\"a.bookmark\").on('click',function() {\r\n        bookmark( $(this), 'bookmark' , 'shop_id' );\r\n    });\r\n\r\n    $(\"a.fav\").on('click',function() {\r\n        bookmark( $(this), 'favorite' , 'product_id' );\r\n    });\r\n\r\n    $(\"a.fav-detail\").on('click',function() {\r\n        bookmark( $(this), '../favorite' , 'product_id' );\r\n    });\r\n\r\n    function bookmark(aTarget, route , urlTarget) {\r\n        var val = aTarget.parent().next().html();\r\n        var formData = { urlTarget : val};\r\n        \r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n\r\n        $.ajax({\r\n            url: route+\"/\"+val,\r\n            type: \"POST\",\r\n            data: formData,\r\n            success: function(data){\r\n                aTarget.find('i').toggleClass('hidden');\r\n                if( aTarget.find('em') ){\r\n                    aTarget.find('em').toggleClass('hidden');\r\n                }\r\n            },\r\n            error: function(responseData, textStatus){\r\n                console.log(textStatus);\r\n            }\r\n        });\r\n    }\r\n//filter-Info\r\n    $('div.info_group').find('a').on({ focus : function(e){\r\n        e.preventDefault();\r\n        var className = $(this).attr('class');\r\n        $('div.popup').addClass('hidden');\r\n        $('div.popup.'+className).removeClass('hidden');\r\n    }, focusout : function(e){\r\n        if( !$('div.popup').is(':focus') ){\r\n            var className = $(this).attr('class');\r\n            $('div.popup.'+className).addClass('hidden');\r\n        }\r\n    }});\r\n//Product sort\r\n    $('ul.sort-list li').on('click', function(e){\r\n        $(this).parent().find('li').removeClass('active');\r\n        $(this).addClass('active');\r\n        $('input#sortBy').val( $(this).attr('name') ).removeAttr('disabled');\r\n        $('input#sortBy').parent().parent().submit();\r\n    });\r\n\r\n    $('div.filter-group label').on('click', function(){\r\n        if( $(this).next().hasClass('purpose') || $(this).next().is('input[type=\"checkbox\"]') ){\r\n            $(this).toggleClass('active');\r\n        }else{\r\n            if( $(this).attr('class')=='active' ){\r\n                var id = $(this).next('input').attr('id');\r\n                document.getElementById(id).disabled = true;\r\n                $(this).removeClass('active');\r\n            }\r\n            else{\r\n                var id = $(this).next('input').attr('id');\r\n                document.getElementById(id).disabled = false;\r\n                $(this).parent().find('label').removeClass('active');\r\n                $(this).addClass('active');\r\n            }\r\n        };\r\n    });\r\n\r\n    $('label.uncheck').on('click',function(){\r\n        var id = $(this).next('input').attr('id');\r\n        document.getElementById(id).checked = true;\r\n        document.getElementById(id).disabled = true;\r\n    });\r\n\r\n//Search\r\n    $('input[name=search]').on('keypress', function(e){\r\n        if( e.keyCode == 13 ){\r\n            $('form[name=searchForm]').submit();\r\n        }\r\n    });\r\n    $('input[name=search]').focus(function(){\r\n    $(this).parent('div').css('border', '1px solid rgba(43,222,115,1.0)').css('box-shadow', '0 0 15px rgba(43,222,115,0.3)');\r\n    }).blur(function(){\r\n        $(this).parent('div').css('border', '1px solid #ccc').css('box-shadow', 'none');\r\n    });\r\n//Detail Ajax\r\n    $('a.go_url').on('click',function() {\r\n        var productId = $('input.product-id').val();\r\n        var formData = { 'product_id' : productId };\r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n        $.ajax({\r\n            url: \"../viewcount/\"+productId,\r\n            type: \"POST\",\r\n            data: formData, \r\n            success: function(data){\r\n            },\r\n            error: function(responseData, textStatus){\r\n                alert(textStatus);\r\n            }\r\n        });\r\n    });\r\n//MyProduct\r\n\r\n    $('input[name=\"purpose\"]').on('click', function(){\r\n        if($(this).val() == '게임용'){\r\n            $('ul.for_game_check').css('opacity','1.0').find('input[type=\"checkbox\"]').removeAttr('disabled');\r\n        }else{\r\n            $('ul.for_game_check').css('opacity','0.7').find('input[type=\"checkbox\"]').attr('disabled', 'disabled');\r\n        }\r\n    });\r\n    $('input#no-monitor').on('click', function(){\r\n        if( $(this).is(':checked') ){\r\n            $('input[name=\"monitor\"]').attr('disabled', 'disabled').val('');\r\n        }else{\r\n            $('input[name=\"monitor\"]').removeAttr('disabled');\r\n        }\r\n    });\r\n\r\n//Cookie \r\n    function setCookie(value) {\r\n        $.cookie('recent-product', value);\r\n        var recent_products = $.cookie('recent-product');\r\n        console.log(\"..\");\r\n    }\r\n        \r\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3NjcmlwdC5qcz85YTBlIl0sInNvdXJjZXNDb250ZW50IjpbIlxyXG4vL05hdlxyXG4gICAgJCgnYS5tZW51X2J0bicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJCgndWwubmF2LWdyb3VwJykudG9nZ2xlQ2xhc3MoJ3Nob3cnKTtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgIH0pO1xyXG4gICAgJCgnYS5teXBhZ2UnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICQodGhpcykubmV4dCgpLnRvZ2dsZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgIH0pO1xyXG4vL2NvbmZpcm1cclxuICAgICQoJ2EucmNtLWRlbGV0ZSwgYS51c2VyLWRlbGV0ZSAsIGlucHV0LmRlbC1zdWJtaXQnKS5jbGljayhmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgdmFyIGNvbmZpcm1NZW50ID0gJ+ygleunkCDsgq3soJztlZjsi5zqsqDsirXri4jquYw/JztcclxuICAgICAgICBpZiggJCh0aGlzKS5oYXNDbGFzcygndXNlci1kZWxldGUnKSApe1xyXG4gICAgICAgICAgICBjb25maXJtTWVudCA9ICfsoJXrp5Ag7YOI7Ye07ZWY7Iuc6rKg7Iq164uI6rmMP1xcbu2ajOybkOuLmOydmCDsoJXrs7TripQg7KCE67aAIOyCrOudvOynkeuLiOuLpC4nO1xyXG4gICAgICAgIH1cclxuICAgICAgICBpZihjb25maXJtKGNvbmZpcm1NZW50KSA9PSB0cnVlKXtcclxuICAgICAgICAgICAgJCh0aGlzKS5uZXh0KCkuc3VibWl0KCk7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIHJldHVybjtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuLy9OZXdQcm9kdWN0XHJcbiAgICAkKCduYXYubmV3X3Byb2R1Y3QgYScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgaW5kZXggPSAkKCduYXYubmV3X3Byb2R1Y3QgYScpLmluZGV4KHRoaXMpO1xyXG4gICAgICAgICQoJ2Rpdi5tYWluUGFnZSBkaXYuc2xpZGVyJykuY3NzKCdsZWZ0JywgLTEwMCppbmRleCsnJScpO1xyXG4gICAgICAgICQoJ25hdi5uZXdfcHJvZHVjdCBhJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpLmZpbmQoJ2knKS5yZW1vdmVDbGFzcygnZmEtY2lyY2xlJykuYWRkQ2xhc3MoJ2ZhLWNpcmNsZS1vJylcclxuICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKS5maW5kKCdpJykucmVtb3ZlQ2xhc3MoJ2ZhLWNpcmNsZS1vJykuYWRkQ2xhc3MoJ2ZhLWNpcmNsZScpO1xyXG4gICAgfSk7XHJcblxyXG4vL0d1aWRlXHJcbiAgICAkKCd1bC5ndWlkZSBsaScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJG5hbWUgPSAkKHRoaXMpLmF0dHIoJ25hbWUnKTsgXHJcbiAgICAgICAgJCgnZGl2W25hbWU9XCInKyAkbmFtZSArJ1wiXScpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKS5zaWJsaW5ncygnZGl2JykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG59KTtcclxuLy9WYWxpZGF0aW9uXHJcbiAgICAkKFwiZm9ybS52YWxpZGF0ZVwiKS52YWxpZGF0ZSgpO1xyXG4gICAgJChcImZvcm0udmFsaWRhdGUgaW5wdXRcIikub24oJ2tleXByZXNzJywgZnVuY3Rpb24oKXtcclxuICAgICAgICBpZiggJCh0aGlzKS5uZXh0KCdzcGFuJykuaGFzQ2xhc3MoJ2hlbHAtYmxvY2snKSApe1xyXG4gICAgICAgICAgICAkKHRoaXMpLm5leHQoJ3NwYW4uaGVscC1ibG9jaycpLnJlbW92ZSgpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG4gICAgJCgndWwuZm9yX2dhbWVfY2hlY2sgaW5wdXQnKS5vbignY2xpY2snLGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgaWYoICQoJ3VsLmZvcl9nYW1lX2NoZWNrIGlucHV0W3R5cGU9XCJjaGVja2JveFwiXTpjaGVja2VkJykubGVuZ3RoID4gNyApe1xyXG4gICAgICAgICAgICBhbGVydCgn7IS467aAIOy5tO2FjOqzoOumrOuKlCA36rCc6rmM7KeA66eMIOyEoO2DneydtCDqsIDriqXtlanri4jri6QhJyk7XHJcbiAgICAgICAgICAgICQodGhpcykucHJvcCgnY2hlY2tlZCcsIGZhbHNlKTtcclxuICAgICAgICB9O1xyXG4gICAgfSk7XHJcbiAgICAkKCdpbnB1dFt0eXBlPVwic3VibWl0XCJdLm1vZGlmeScpLmNsaWNrKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJHR5cGUgPSAkKHRoaXMpLnZhbCgpLnN1YnN0cigwLDIpO1xyXG4gICAgICAgIGlmKGNvbmZpcm0oJHR5cGUrJ+2VmOyLnOqyoOyKteuLiOq5jD8nKSA9PSBmYWxzZSl7XHJcbiAgICAgICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuLy9BZ3JlZSBpbiByZWdpc3RlckZvcm1cclxuICAgICQoJ2Zvcm0uYWdyZWUtZm9ybSBpbnB1dC5hZ3JlZScpLm9uKCdjbGljaycsZnVuY3Rpb24oKXtcclxuICAgICAgICBpZiggJCh0aGlzKS5pcygnOmNoZWNrZWQnKSA9PSB0cnVlICl7XHJcbiAgICAgICAgICAgICQoJ2Zvcm0ucmVnaXN0ZXItZm9ybScpLmZpbmQoJ1tuYW1lPVwiJysgJCh0aGlzKS5hdHRyKCduYW1lJykgKydcIl0nKS5wcm9wKCdjaGVja2VkJywgdHJ1ZSk7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICQoJ2Zvcm0ucmVnaXN0ZXItZm9ybScpLmZpbmQoJ1tuYW1lPVwiJysgJCh0aGlzKS5hdHRyKCduYW1lJykgKydcIl0nKS5wcm9wKCdjaGVja2VkJywgZmFsc2UpO1xyXG4gICAgICAgIH1cclxuICAgICAgICBpZiggJCgnaW5wdXQuYWdyZWUnKS5lcSgwKS5pcygnOmNoZWNrZWQnKSA9PSB0cnVlICYmICQoJ2lucHV0LmFncmVlJykuZXEoMSkuaXMoJzpjaGVja2VkJykgPT0gdHJ1ZSApe1xyXG4gICAgICAgICAgICAkKCdmb3JtLnJlZ2lzdGVyLWZvcm0gaW5wdXRbdHlwZT1cInN1Ym1pdFwiXScpLnJlbW92ZUF0dHIoJ2Rpc2FibGVkJyk7XHJcbiAgICAgICAgICAgICQoJ2Zvcm0ucmVnaXN0ZXItZm9ybSBpbnB1dFt0eXBlPVwic3VibWl0XCJdJykuYXR0cigndmFsdWUnLCfqsIDsnoXtlZjquLAnKTtcclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgJCgnZm9ybS5yZWdpc3Rlci1mb3JtIGlucHV0W3R5cGU9XCJzdWJtaXRcIl0nKS5hdHRyKCdkaXNhYmxlZCcsICdkaXNhYmxlZCcpO1xyXG4gICAgICAgICAgICAkKCdmb3JtLnJlZ2lzdGVyLWZvcm0gaW5wdXRbdHlwZT1cInN1Ym1pdFwiXScpLmF0dHIoJ3ZhbHVlJywn7J207Jqp7JW96rSAIOuwjyDqsJzsnbjsoJXrs7Qg7Leo6riJ67Cp7Lmo7JeQIOuPmeydmO2VtOyjvOyEuOyalC4nKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuXHJcbi8vb3JpZ2luSW1nXHJcbiAgICAkb3JpZ2luID0gJCgnZGl2LmltZy1ib3gnKS5hdHRyKCdzdHlsZScpO1xyXG4gICAgXHJcbi8vSW1hZ2VQcmV2aWV3XHJcbiAgICAkKCdpbnB1dC5pbWFnZScpLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbigpe1xyXG4gICAgICAgIHZhciBpbWFnZSA9ICQodGhpcykudmFsKCk7XHJcbiAgICAgICAgdmFyIGltYWdlb25seSA9IGltYWdlLnRvTG93ZXJDYXNlKCkuc3BsaXQoXCIuXCIpO1xyXG4gICAgICAgIGlmKCBpbWFnZSAhPSAnJyApe1xyXG4gICAgICAgICAgICBpZiggaW1hZ2Vvbmx5WzFdICE9ICdqcGcnICYmIGltYWdlb25seVsxXSAhPSAncG5nJyAmJiBpbWFnZW9ubHlbMV0gIT0gJ2pwZWcnICYmIGltYWdlb25seVsxXSAhPSAnZ2lmJyAmJiBpbWFnZW9ubHlbMV0gIT0gJ2JtcCcpe1xyXG4gICAgICAgICAgICAgICAgYWxlcnQoJ+ydtOuvuOyngCDtjIzsnbzrp4wg7JeF66Gc65OcIOqwgOuKpe2VqeuLiOuLpCEnKTtcclxuICAgICAgICAgICAgICAgICQodGhpcykudmFsKCcnKTtcclxuICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICBpZiggJCh0aGlzKS5uZXh0KCkuaGFzQ2xhc3MoJ015UHJvZHVjdCcpICl7XHJcbiAgICAgICAgICAgICAgICAgICAgLy/sg4HtkojqtIDrpqxcclxuICAgICAgICAgICAgICAgICAgICB2YXIgcmVhZGVyID0gbmV3IEZpbGVSZWFkZXIoKTtcclxuICAgICAgICAgICAgICAgICAgICByZWFkZXIub25sb2FkID0gZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICQoJ2Rpdi5pbWctYm94JykuYXR0cignc3R5bGUnLCAnYmFja2dyb3VuZDp1cmwoJytlLnRhcmdldC5yZXN1bHQrJykgY2VudGVyIG5vLXJlcGVhdDsgYmFja2dyb3VuZC1zaXplOmF1dG8gMTAwJTsnKS5wYXJlbnQoKS5yZW1vdmVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAgICAgLy9TaG9w7KCV67O07IiY7KCVXHJcbiAgICAgICAgICAgICAgICAgICAgdmFyIHJlYWRlciA9IG5ldyBGaWxlUmVhZGVyKCk7XHJcbiAgICAgICAgICAgICAgICAgICAgcmVhZGVyLm9ubG9hZCA9IGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkKCdkaXYuaW1nLWJveCcpLmF0dHIoJ3N0eWxlJywgJ2JhY2tncm91bmQ6dXJsKCcrZS50YXJnZXQucmVzdWx0KycpIGNlbnRlciBuby1yZXBlYXQ7IGJhY2tncm91bmQtc2l6ZTphdXRvIDEwMCU7JykucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwodGhpcy5maWxlc1swXSk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgaWYoICEkb3JpZ2luICl7XHJcbiAgICAgICAgICAgICAgICAkKCdkaXYuaW1nLWJveCcpLmF0dHIoJ3N0eWxlJywgJycpLnBhcmVudCgpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAkKCdkaXYuaW1nLWJveCcpLmF0dHIoJ3N0eWxlJywgJG9yaWdpbik7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuICAgIFxyXG4gICAgJCgnZm9ybS51c2VyX2VkaXQnKS5maW5kKCdpbnB1dFt0eXBlPVwic3VibWl0XCJdJykub24oJ2NsaWNrJyxmdW5jdGlvbihlKXtcclxuICAgICAgICBpZiAoICQoJ2lucHV0W25hbWU9XCJwYXNzd29yZFwiXScpLnZhbCgpICE9IFwiXCIgKXtcclxuICAgICAgICAgICAgaWYoICQoJ2lucHV0W25hbWU9XCJwYXNzd29yZFwiXScpLnZhbCgpICE9ICQoJ2lucHV0W25hbWU9XCJwYXNzd29yZF9jb25maXJtYXRpb25cIl0nKS52YWwoKSApe1xyXG4gICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICAgICAgaWYoICQoJ2lucHV0LnBhc3N3b3JkJykubmV4dCgpLmhhc0NsYXNzKCdlcnJvcicpICl7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnaW5wdXQucGFzc3dvcmQnKS5uZXh0KCkucmVtb3ZlKCk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAkKCdpbnB1dC5wYXNzd29yZCcpLmFmdGVyKCc8bGFiZWwgY2xhc3M9XCJlcnJvclwiPuu5hOuwgOuyiO2YuCDtmZXsnbjqsJLsnbQg7J287LmY7ZWY7KeAIOyViuyKteuLiOuLpCE8L2xhYmVsPicpO1xyXG4gICAgICAgICAgICAgICAgJCgnaW5wdXQucGFzc3dvcmQnKS52YWwoJycpO1xyXG4gICAgICAgICAgICAgICAgJCgnaW5wdXQucGFzc3dvcmQtY29uZmlybScpLnZhbCgnJyk7XHJcbiAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG4vL2xvZ2luLWZvcm1cclxuICAgICQoJ2xhYmVsLnJlbWVtYmVyJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICAkKHRoaXMpLmZpbmQoJ2knKS50b2dnbGVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCgnaW5wdXQucmVtZW1iZXInKS5jbGljaygpO1xyXG4gICAgfSk7XHJcbi8vaW1hZ2Utc2xpZGUgXHJcbiAgICAkKCduYXYubmF2LXNsaWRlcicpLmZpbmQoJ2EnKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcclxuICAgICAgICAvL1ByZXZlbnREb3VibGVDbGlja1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICBpZiAoISQodGhpcykuZGF0YSgnaXNDbGlja2VkJykpIHtcclxuICAgICAgICAgICAgdmFyIGxpbmsgPSAkKHRoaXMpO1xyXG4gICAgICAgICAgICAvLyBzdWNjZXNzZnVsIGNsaWNrXHJcbiAgICAgICAgICAgIFNsaWRlKHRoaXMpO1xyXG4gICAgICAgICAgICAvLyBTZXQgdGhlIGlzQ2xpY2tlZCB2YWx1ZSBhbmQgc2V0IGEgdGltZXJcclxuICAgICAgICAgICAgbGluay5kYXRhKCdpc0NsaWNrZWQnLCB0cnVlKTtcclxuICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgbGluay5yZW1vdmVEYXRhKCdpc0NsaWNrZWQnKVxyXG4gICAgICAgICAgICB9LCAxMjAwKTtcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAvLyBBbnl0aGluZyB5b3Ugd2FudCB0byBzYXkgJ0JhZCB1c2VyISdcclxuICAgICAgICB9O1xyXG4gICAgfSk7XHJcbiAgICBmdW5jdGlvbiBTbGlkZSh0YXJnZXQpe1xyXG4gICAgICAgIHZhciB3aWR0aCA9ICQodGFyZ2V0KS5wYXJlbnQoKS5uZXh0KCkuZmluZCgnbGknKS5vdXRlcldpZHRoKHRydWUpO1xyXG4gICAgICAgIGlmKCAkKHRhcmdldCkuaGFzQ2xhc3MoJ2xlZnQnKSApe1xyXG4gICAgICAgICAgICAgICAgJCh0YXJnZXQpLnBhcmVudCgpLm5leHQoKS5jc3MoJ2xlZnQnLCAnLScrd2lkdGgrJ3B4JykucHJlcGVuZCggJCh0YXJnZXQpLnBhcmVudCgpLm5leHQoKS5maW5kKCdsaTpsYXN0LWNoaWxkJykgKTtcclxuICAgICAgICAgICAgICAgICQodGFyZ2V0KS5wYXJlbnQoKS5uZXh0KCkuYW5pbWF0ZSgge2xlZnQgOiAnKz0nK3dpZHRoKydweCd9LCAxMDAwLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgfSApO1xyXG4gICAgICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgICAgICQodGFyZ2V0KS5wYXJlbnQoKS5uZXh0KCkuZmluZCgnbGk6Zmlyc3QtY2hpbGQnKS5jbG9uZSgpLmFwcGVuZFRvKCAkKHRhcmdldCkucGFyZW50KCkubmV4dCgpICk7XHJcbiAgICAgICAgICAgICAgICAkKHRhcmdldCkucGFyZW50KCkubmV4dCgpLmFuaW1hdGUoIHtsZWZ0IDogJy09Jyt3aWR0aCsncHgnfSwgMTAwMCwgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgICAgICAkKHRhcmdldCkucGFyZW50KCkubmV4dCgpLmNzcygnbGVmdCcsICcwJykuZmluZCgnbGk6Zmlyc3QtY2hpbGQnKS5yZW1vdmUoKTtcclxuICAgICAgICAgICAgICAgIH0gKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgXHJcbi8vVGltZXJcclxuICAgIGZ1bmN0aW9uIEF1dG9TbGlkZSgpe1xyXG4gICAgICAgIHZhciB3aWR0aCA9ICQoJ3VsLnNsaWRlci5hdXRvJykuZmluZCgnbGknKS5vdXRlcldpZHRoKHRydWUpO1xyXG4gICAgICAgICQoJ3VsLnNsaWRlci5hdXRvJykuZmluZCgnbGk6Zmlyc3QtY2hpbGQnKS5jbG9uZSgpLmFwcGVuZFRvKCAkKCd1bC5zbGlkZXIuYXV0bycpICk7XHJcbiAgICAgICAgJCgndWwuc2xpZGVyLmF1dG8nKS5hbmltYXRlKCB7bGVmdCA6ICctPScrd2lkdGgrJ3B4J30sIDEwMDAsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICQoJ3VsLnNsaWRlci5hdXRvJykuY3NzKCdsZWZ0JywgJzAnKS5maW5kKCdsaTpmaXJzdC1jaGlsZCcpLnJlbW92ZSgpO1xyXG4gICAgICAgIH0gKTtcclxuICAgIH1cclxuICAgIHZhciB0aW1lcjEgPSBzZXRJbnRlcnZhbCggQXV0b1NsaWRlICwgNjAwMCApO1xyXG5cclxuICAgIGZ1bmN0aW9uIE5ld1Byb2R1Y3QoKXtcclxuICAgICAgICB2YXIgaW5kZXggPSAkKCduYXYubmV3X3Byb2R1Y3QgYS5hY3RpdmUnKS5wYXJlbnQoJ2xpJykuaW5kZXgoKSsxO1xyXG4gICAgICAgIGlmKCBpbmRleCA9PSA0ICl7XHJcbiAgICAgICAgICAgIGluZGV4ID0gMDtcclxuICAgICAgICB9XHJcbiAgICAgICAgJCgnZGl2Lm1haW5QYWdlIGRpdi5zbGlkZXInKS5jc3MoJ2xlZnQnLCAtMTAwKmluZGV4KyclJyk7XHJcbiAgICAgICAgJCgnbmF2Lm5ld19wcm9kdWN0IGEnKS5yZW1vdmVDbGFzcygnYWN0aXZlJykuZmluZCgnaScpLnJlbW92ZUNsYXNzKCdmYS1jaXJjbGUnKS5hZGRDbGFzcygnZmEtY2lyY2xlLW8nKVxyXG4gICAgICAgICQoJ25hdi5uZXdfcHJvZHVjdCBhJykuZXEoaW5kZXgpLmFkZENsYXNzKCdhY3RpdmUnKS5maW5kKCdpJykucmVtb3ZlQ2xhc3MoJ2ZhLWNpcmNsZS1vJykuYWRkQ2xhc3MoJ2ZhLWNpcmNsZScpO1xyXG4gICAgfVxyXG4gICAgdmFyIHRpbWVyMiA9IHNldEludGVydmFsKCBOZXdQcm9kdWN0ICwgNjAwMCApO1xyXG4gICAgXHJcbiAgICBmdW5jdGlvbiBTZXRUaW1lciggJHRhcmdldDEsICR0YXJnZXQyLCAkZnVuY3Rpb24sICR0aW1lciwgJHRpbWUgKXtcclxuICAgICAgICAkKCR0YXJnZXQxKS5vbigge1xyXG4gICAgICAgICAgICBtb3VzZWVudGVyIDogZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgY2xlYXJJbnRlcnZhbCggJHRpbWVyICk7XHJcbiAgICAgICAgICAgIH0sIFxyXG4gICAgICAgICAgICBtb3VzZWxlYXZlIDogZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgJHRpbWVyID0gc2V0SW50ZXJ2YWwoICRmdW5jdGlvbiwgJHRpbWUgKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgICAgICQoJHRhcmdldDIpLm9uKCB7XHJcbiAgICAgICAgICAgIG1vdXNlZW50ZXIgOiBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICBjbGVhckludGVydmFsKCAkdGltZXIgKTtcclxuICAgICAgICAgICAgfSwgXHJcbiAgICAgICAgICAgIG1vdXNlbGVhdmUgOiBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAkdGltZXIgPSBzZXRJbnRlcnZhbCggJGZ1bmN0aW9uLCAkdGltZSApO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcbiAgICBTZXRUaW1lciggJ3VsLnNsaWRlci5hdXRvJywgJ25hdi5uYXYtc2xpZGVyJywgQXV0b1NsaWRlLCB0aW1lcjEsIDYwMDAgKTtcclxuICAgIFNldFRpbWVyKCAnZGl2Lml0ZW0nLCAnbmF2Lm5ld19wcm9kdWN0JywgTmV3UHJvZHVjdCAsIHRpbWVyMiwgNjAwMCApO1xyXG4gICAgXHJcblxyXG4vL1Nob3BBcHBseVxyXG5cclxuICAgICQoJ2Rpdi5ub3RpY2UtZ3JvdXAgYScpLm9uKCdjbGljaycsZnVuY3Rpb24oKXtcclxuICAgICAgICAkKCdkaXYuc2xpZGUnKS5yZW1vdmVDbGFzcygnZmFkZWluJyk7XHJcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5wYXJlbnQoKS5uZXh0KCkudG9nZ2xlQ2xhc3MoJ2ZhZGVpbicpO1xyXG4gICAgfSk7XHJcblxyXG4vL2ZhdiBBamF4XHJcbiAgICAkKFwiYS5ib29rbWFya1wiKS5vbignY2xpY2snLGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIGJvb2ttYXJrKCAkKHRoaXMpLCAnYm9va21hcmsnICwgJ3Nob3BfaWQnICk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAkKFwiYS5mYXZcIikub24oJ2NsaWNrJyxmdW5jdGlvbigpIHtcclxuICAgICAgICBib29rbWFyayggJCh0aGlzKSwgJ2Zhdm9yaXRlJyAsICdwcm9kdWN0X2lkJyApO1xyXG4gICAgfSk7XHJcblxyXG4gICAgJChcImEuZmF2LWRldGFpbFwiKS5vbignY2xpY2snLGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIGJvb2ttYXJrKCAkKHRoaXMpLCAnLi4vZmF2b3JpdGUnICwgJ3Byb2R1Y3RfaWQnICk7XHJcbiAgICB9KTtcclxuXHJcbiAgICBmdW5jdGlvbiBib29rbWFyayhhVGFyZ2V0LCByb3V0ZSAsIHVybFRhcmdldCkge1xyXG4gICAgICAgIHZhciB2YWwgPSBhVGFyZ2V0LnBhcmVudCgpLm5leHQoKS5odG1sKCk7XHJcbiAgICAgICAgdmFyIGZvcm1EYXRhID0geyB1cmxUYXJnZXQgOiB2YWx9O1xyXG4gICAgICAgIFxyXG4gICAgICAgICQuYWpheFNldHVwKHtcclxuICAgICAgICAgICAgaGVhZGVyczoge1xyXG4gICAgICAgICAgICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICAkLmFqYXgoe1xyXG4gICAgICAgICAgICB1cmw6IHJvdXRlK1wiL1wiK3ZhbCxcclxuICAgICAgICAgICAgdHlwZTogXCJQT1NUXCIsXHJcbiAgICAgICAgICAgIGRhdGE6IGZvcm1EYXRhLFxyXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcclxuICAgICAgICAgICAgICAgIGFUYXJnZXQuZmluZCgnaScpLnRvZ2dsZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgICAgIGlmKCBhVGFyZ2V0LmZpbmQoJ2VtJykgKXtcclxuICAgICAgICAgICAgICAgICAgICBhVGFyZ2V0LmZpbmQoJ2VtJykudG9nZ2xlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBlcnJvcjogZnVuY3Rpb24ocmVzcG9uc2VEYXRhLCB0ZXh0U3RhdHVzKXtcclxuICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKHRleHRTdGF0dXMpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcbi8vZmlsdGVyLUluZm9cclxuICAgICQoJ2Rpdi5pbmZvX2dyb3VwJykuZmluZCgnYScpLm9uKHsgZm9jdXMgOiBmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgdmFyIGNsYXNzTmFtZSA9ICQodGhpcykuYXR0cignY2xhc3MnKTtcclxuICAgICAgICAkKCdkaXYucG9wdXAnKS5hZGRDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgJCgnZGl2LnBvcHVwLicrY2xhc3NOYW1lKS5yZW1vdmVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICB9LCBmb2N1c291dCA6IGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGlmKCAhJCgnZGl2LnBvcHVwJykuaXMoJzpmb2N1cycpICl7XHJcbiAgICAgICAgICAgIHZhciBjbGFzc05hbWUgPSAkKHRoaXMpLmF0dHIoJ2NsYXNzJyk7XHJcbiAgICAgICAgICAgICQoJ2Rpdi5wb3B1cC4nK2NsYXNzTmFtZSkuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgIH1cclxuICAgIH19KTtcclxuLy9Qcm9kdWN0IHNvcnRcclxuICAgICQoJ3VsLnNvcnQtbGlzdCBsaScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgICQodGhpcykucGFyZW50KCkuZmluZCgnbGknKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCgnaW5wdXQjc29ydEJ5JykudmFsKCAkKHRoaXMpLmF0dHIoJ25hbWUnKSApLnJlbW92ZUF0dHIoJ2Rpc2FibGVkJyk7XHJcbiAgICAgICAgJCgnaW5wdXQjc29ydEJ5JykucGFyZW50KCkucGFyZW50KCkuc3VibWl0KCk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAkKCdkaXYuZmlsdGVyLWdyb3VwIGxhYmVsJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICBpZiggJCh0aGlzKS5uZXh0KCkuaGFzQ2xhc3MoJ3B1cnBvc2UnKSB8fCAkKHRoaXMpLm5leHQoKS5pcygnaW5wdXRbdHlwZT1cImNoZWNrYm94XCJdJykgKXtcclxuICAgICAgICAgICAgJCh0aGlzKS50b2dnbGVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIGlmKCAkKHRoaXMpLmF0dHIoJ2NsYXNzJyk9PSdhY3RpdmUnICl7XHJcbiAgICAgICAgICAgICAgICB2YXIgaWQgPSAkKHRoaXMpLm5leHQoJ2lucHV0JykuYXR0cignaWQnKTtcclxuICAgICAgICAgICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKGlkKS5kaXNhYmxlZCA9IHRydWU7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBlbHNle1xyXG4gICAgICAgICAgICAgICAgdmFyIGlkID0gJCh0aGlzKS5uZXh0KCdpbnB1dCcpLmF0dHIoJ2lkJyk7XHJcbiAgICAgICAgICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChpZCkuZGlzYWJsZWQgPSBmYWxzZTtcclxuICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkuZmluZCgnbGFiZWwnKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH07XHJcbiAgICB9KTtcclxuXHJcbiAgICAkKCdsYWJlbC51bmNoZWNrJykub24oJ2NsaWNrJyxmdW5jdGlvbigpe1xyXG4gICAgICAgIHZhciBpZCA9ICQodGhpcykubmV4dCgnaW5wdXQnKS5hdHRyKCdpZCcpO1xyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKGlkKS5jaGVja2VkID0gdHJ1ZTtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChpZCkuZGlzYWJsZWQgPSB0cnVlO1xyXG4gICAgfSk7XHJcblxyXG4vL1NlYXJjaFxyXG4gICAgJCgnaW5wdXRbbmFtZT1zZWFyY2hdJykub24oJ2tleXByZXNzJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgaWYoIGUua2V5Q29kZSA9PSAxMyApe1xyXG4gICAgICAgICAgICAkKCdmb3JtW25hbWU9c2VhcmNoRm9ybV0nKS5zdWJtaXQoKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuICAgICQoJ2lucHV0W25hbWU9c2VhcmNoXScpLmZvY3VzKGZ1bmN0aW9uKCl7XHJcbiAgICAkKHRoaXMpLnBhcmVudCgnZGl2JykuY3NzKCdib3JkZXInLCAnMXB4IHNvbGlkIHJnYmEoNDMsMjIyLDExNSwxLjApJykuY3NzKCdib3gtc2hhZG93JywgJzAgMCAxNXB4IHJnYmEoNDMsMjIyLDExNSwwLjMpJyk7XHJcbiAgICB9KS5ibHVyKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoJ2RpdicpLmNzcygnYm9yZGVyJywgJzFweCBzb2xpZCAjY2NjJykuY3NzKCdib3gtc2hhZG93JywgJ25vbmUnKTtcclxuICAgIH0pO1xyXG4vL0RldGFpbCBBamF4XHJcbiAgICAkKCdhLmdvX3VybCcpLm9uKCdjbGljaycsZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIHByb2R1Y3RJZCA9ICQoJ2lucHV0LnByb2R1Y3QtaWQnKS52YWwoKTtcclxuICAgICAgICB2YXIgZm9ybURhdGEgPSB7ICdwcm9kdWN0X2lkJyA6IHByb2R1Y3RJZCB9O1xyXG4gICAgICAgICQuYWpheFNldHVwKHtcclxuICAgICAgICAgICAgaGVhZGVyczoge1xyXG4gICAgICAgICAgICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgICAgICQuYWpheCh7XHJcbiAgICAgICAgICAgIHVybDogXCIuLi92aWV3Y291bnQvXCIrcHJvZHVjdElkLFxyXG4gICAgICAgICAgICB0eXBlOiBcIlBPU1RcIixcclxuICAgICAgICAgICAgZGF0YTogZm9ybURhdGEsIFxyXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKXtcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgZXJyb3I6IGZ1bmN0aW9uKHJlc3BvbnNlRGF0YSwgdGV4dFN0YXR1cyl7XHJcbiAgICAgICAgICAgICAgICBhbGVydCh0ZXh0U3RhdHVzKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcbi8vTXlQcm9kdWN0XHJcblxyXG4gICAgJCgnaW5wdXRbbmFtZT1cInB1cnBvc2VcIl0nKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgIGlmKCQodGhpcykudmFsKCkgPT0gJ+qyjOyehOyaqScpe1xyXG4gICAgICAgICAgICAkKCd1bC5mb3JfZ2FtZV9jaGVjaycpLmNzcygnb3BhY2l0eScsJzEuMCcpLmZpbmQoJ2lucHV0W3R5cGU9XCJjaGVja2JveFwiXScpLnJlbW92ZUF0dHIoJ2Rpc2FibGVkJyk7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICQoJ3VsLmZvcl9nYW1lX2NoZWNrJykuY3NzKCdvcGFjaXR5JywnMC43JykuZmluZCgnaW5wdXRbdHlwZT1cImNoZWNrYm94XCJdJykuYXR0cignZGlzYWJsZWQnLCAnZGlzYWJsZWQnKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuICAgICQoJ2lucHV0I25vLW1vbml0b3InKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgIGlmKCAkKHRoaXMpLmlzKCc6Y2hlY2tlZCcpICl7XHJcbiAgICAgICAgICAgICQoJ2lucHV0W25hbWU9XCJtb25pdG9yXCJdJykuYXR0cignZGlzYWJsZWQnLCAnZGlzYWJsZWQnKS52YWwoJycpO1xyXG4gICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAkKCdpbnB1dFtuYW1lPVwibW9uaXRvclwiXScpLnJlbW92ZUF0dHIoJ2Rpc2FibGVkJyk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcblxyXG4vL0Nvb2tpZSBcclxuICAgIGZ1bmN0aW9uIHNldENvb2tpZSh2YWx1ZSkge1xyXG4gICAgICAgICQuY29va2llKCdyZWNlbnQtcHJvZHVjdCcsIHZhbHVlKTtcclxuICAgICAgICB2YXIgcmVjZW50X3Byb2R1Y3RzID0gJC5jb29raWUoJ3JlY2VudC1wcm9kdWN0Jyk7XHJcbiAgICAgICAgY29uc29sZS5sb2coXCIuLlwiKTtcclxuICAgIH1cclxuICAgICAgICBcclxuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvc2NyaXB0LmpzIl0sIm1hcHBpbmdzIjoiQUFBQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7O0FBRUE7QUFDQTtBQUNBOztBQUVBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);