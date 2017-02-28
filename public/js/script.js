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

eval("//RecentItems\r\n    for(var $i=0; $i<cookieList.items().length; $i++){\r\n        $('ul.recent-product').prepend('<li><a href=\"'+ cookieList.items()[$i].url +'\" title=\"'+ cookieList.items()[$i].name +'\"><div style=\"background:url('+ cookieList.items()[$i].img +') center no-repeat;background-size:cover;\"></div></a></li>');\r\n        $('ul.recent-product').find('li:last-child').remove();\r\n    };\r\n    $('ul.recent-product').prev('p').before('<span class=\"new\">'+cookieList.items().length+'</span>');\r\n//Nav\r\n    $('a.menu_btn').on('click', function(){\r\n        $('ul.nav-group').toggleClass('show');\r\n        $(this).parent().addClass('active');\r\n    });\r\n    $('a.mypage').on('click', function(){\r\n        $(this).next().toggleClass('hidden');\r\n    });\r\n    $('nav.tabmenu-wrap a.button').on('click',function(e){\r\n        e.preventDefault();\r\n        $(this).parent('nav').toggleClass('active');\r\n        if( $(this).parent('nav').hasClass('active') ){\r\n            $(this).children('i').removeClass('fa-angle-left').addClass('fa-angle-right');\r\n        }else{\r\n            $(this).children('i').removeClass('fa-angle-right').addClass('fa-angle-left');\r\n        };\r\n    });\r\n\r\n//confirm\r\n    $('a.rcm-delete, a.user-delete , input.del-submit').click(function(e){\r\n        e.preventDefault();\r\n        var confirmMent = '정말 삭제하시겠습니까?';\r\n        if( $(this).hasClass('user-delete') ){\r\n            confirmMent = '정말 탈퇴하시겠습니까?\\n회원님의 정보는 전부 사라집니다.';\r\n        }\r\n        if(confirm(confirmMent) == true){\r\n            $(this).next().submit();\r\n        }else{\r\n            return;\r\n        }\r\n    });\r\n//NewProduct\r\n    $('nav.new_product a').on('click', function(e){\r\n        e.preventDefault();\r\n        var index = $('nav.new_product a').index(this);\r\n        $('div.mainPage div.slider').css('left', -100*index+'%');\r\n        $('nav.new_product a').removeClass('active').find('i').removeClass('fa-circle').addClass('fa-circle-o')\r\n        $(this).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-circle');\r\n    });\r\n\r\n//Guide\r\n    $('ul.guide li').on('click', function(){\r\n        $name = $(this).attr('name'); \r\n        $('div[name=\"'+ $name +'\"]').removeClass('hidden').siblings('div').addClass('hidden');\r\n    });\r\n//Validation\r\n    $(\"form.validate\").validate();\r\n    $(\"form.validate input\").on('keypress', function(){\r\n        if( $(this).next('span').hasClass('help-block') ){\r\n            $(this).next('span.help-block').remove();\r\n        }\r\n    });\r\n    $('ul.for_game_check input').on('click',function(){\r\n        if( $('ul.for_game_check input[type=\"checkbox\"]:checked').length > 7 ){\r\n            alert('세부 카테고리는 7개까지만 선택이 가능합니다!');\r\n            $(this).prop('checked', false);\r\n        };\r\n    });\r\n    $('input[type=\"submit\"].modify').click(function(){\r\n        $type = $(this).val().substr(0,2);\r\n        if(confirm($type+'하시겠습니까?') == false){\r\n            return false;\r\n        }\r\n    });\r\n//Agree in registerForm\r\n    $('form.agree-form input.agree').on('click',function(){\r\n        if( $(this).is(':checked') == true ){\r\n            $('form.register-form').find('[name=\"'+ $(this).attr('name') +'\"]').prop('checked', true);\r\n        }else{\r\n            $('form.register-form').find('[name=\"'+ $(this).attr('name') +'\"]').prop('checked', false);\r\n        }\r\n        if( $('input.agree').eq(0).is(':checked') == true && $('input.agree').eq(1).is(':checked') == true ){\r\n            $('form.register-form input[type=\"submit\"]').removeAttr('disabled');\r\n            $('form.register-form input[type=\"submit\"]').attr('value','가입하기');\r\n        }else{\r\n            $('form.register-form input[type=\"submit\"]').attr('disabled', 'disabled');\r\n            $('form.register-form input[type=\"submit\"]').attr('value','이용약관 및 개인정보 취급방침에 동의해주세요.');\r\n        }\r\n    });\r\n\r\n//originImg\r\n    $origin = $('div.img-box').attr('style');\r\n    \r\n//ImagePreview\r\n    $('input.image').on('change', function(){\r\n        var image = $(this).val();\r\n        var imageonly = image.toLowerCase().split(\".\");\r\n        if( image != '' ){\r\n            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){\r\n                alert('이미지 파일만 업로드 가능합니다!');\r\n                $(this).val('');\r\n            }else{\r\n                if( $(this).next().hasClass('MyProduct') ){\r\n                    //상품관리\r\n                    var reader = new FileReader();\r\n                    reader.onload = function(e){\r\n                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:auto 100%;').parent().removeClass('hidden');\r\n                    }\r\n                }else{\r\n                    //Shop정보수정\r\n                    var reader = new FileReader();\r\n                    reader.onload = function(e){\r\n                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:auto 100%;').parent().removeClass('hidden');\r\n                }\r\n            }\r\n                    reader.readAsDataURL(this.files[0]);\r\n            }\r\n        }else{\r\n            if( !$origin ){\r\n                $('div.img-box').attr('style', '').parent().addClass('hidden');\r\n            }else{\r\n                $('div.img-box').attr('style', $origin);\r\n            }\r\n        }\r\n    });\r\n    \r\n    $('form.user_edit').find('input[type=\"submit\"]').on('click',function(e){\r\n        if ( $('input[name=\"password\"]').val() != \"\" ){\r\n            if( $('input[name=\"password\"]').val() != $('input[name=\"password_confirmation\"]').val() ){\r\n                e.preventDefault();\r\n                if( $('input.password').next().hasClass('error') ){\r\n                    $('input.password').next().remove();\r\n                }\r\n                $('input.password').after('<label class=\"error\">비밀번호 확인값이 일치하지 않습니다!</label>');\r\n                $('input.password').val('');\r\n                $('input.password-confirm').val('');\r\n                return false;\r\n                \r\n            }\r\n        }\r\n    });\r\n//login-form\r\n    $('label.remember').on('click', function(){\r\n        $(this).find('i').toggleClass('active');\r\n        $('input.remember').click();\r\n    });\r\n//image-slide \r\n    $('nav.nav-slider').find('a').on('click', function(e){\r\n        //PreventDoubleClick\r\n        e.preventDefault();\r\n        if (!$(this).data('isClicked')) {\r\n            var link = $(this);\r\n            // successful click\r\n            Slide(this);\r\n            // Set the isClicked value and set a timer\r\n            link.data('isClicked', true);\r\n            setTimeout(function() {\r\n            link.removeData('isClicked')\r\n            }, 1200);\r\n        } else {\r\n            // Anything you want to say 'Bad user!'\r\n        };\r\n    });\r\n    function Slide(target){\r\n        var width = $(target).parent().next().find('li').outerWidth(true);\r\n        if( $(target).hasClass('left') ){\r\n                $(target).parent().next().css('left', '-'+width+'px').prepend( $(target).parent().next().find('li:last-child') );\r\n                $(target).parent().next().animate( {left : '+='+width+'px'}, 1000, function(){\r\n                } );\r\n            }else{\r\n                $(target).parent().next().find('li:first-child').clone().appendTo( $(target).parent().next() );\r\n                $(target).parent().next().animate( {left : '-='+width+'px'}, 1000, function(){\r\n                    $(target).parent().next().css('left', '0').find('li:first-child').remove();\r\n                } );\r\n            }\r\n    }\r\n    \r\n//Timer\r\n    function AutoSlide(){\r\n        var width = $('ul.slider.auto').find('li').outerWidth(true);\r\n        $('ul.slider.auto').find('li:first-child').clone().appendTo( $('ul.slider.auto') );\r\n        $('ul.slider.auto').animate( {left : '-='+width+'px'}, 1000, function(){\r\n            $('ul.slider.auto').css('left', '0').find('li:first-child').remove();\r\n        } );\r\n    }\r\n    var timer1 = setInterval( AutoSlide , 6000 );\r\n\r\n    function NewProduct(){\r\n        var index = $('nav.new_product a.active').parent('li').index()+1;\r\n        if( index == 4 ){\r\n            index = 0;\r\n        }\r\n        $('div.mainPage div.slider').css('left', -100*index+'%');\r\n        $('nav.new_product a').removeClass('active').find('i').removeClass('fa-circle').addClass('fa-circle-o')\r\n        $('nav.new_product a').eq(index).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-circle');\r\n    }\r\n    var timer2 = setInterval( NewProduct , 6000 );\r\n    \r\n    function SetTimer( $target1, $target2, $function, $timer, $time ){\r\n        $($target1).on( {\r\n            mouseenter : function(){\r\n            clearInterval( $timer );\r\n            }, \r\n            mouseleave : function(){\r\n            $timer = setInterval( $function, $time );\r\n            }\r\n        });\r\n        $($target2).on( {\r\n            mouseenter : function(){\r\n            clearInterval( $timer );\r\n            }, \r\n            mouseleave : function(){\r\n            $timer = setInterval( $function, $time );\r\n            }\r\n        });\r\n    }\r\n    SetTimer( 'ul.slider.auto', 'nav.nav-slider', AutoSlide, timer1, 6000 );\r\n    SetTimer( 'div.item', 'nav.new_product', NewProduct , timer2, 6000 );\r\n    \r\n\r\n//ShopApply\r\n\r\n    $('div.notice-group a').on('click',function(){\r\n        $('div.slide').removeClass('fadein');\r\n        $(this).parent().parent().next().toggleClass('fadein');\r\n    });\r\n\r\n//fav Ajax\r\n    $(\"a.bookmark\").on('click',function() {\r\n        bookmark( $(this), 'bookmark' , 'shop_id' );\r\n    });\r\n\r\n    $(\"a.fav\").on('click',function() {\r\n        bookmark( $(this), 'favorite' , 'product_id' );\r\n    });\r\n\r\n    $(\"a.fav-detail\").on('click',function() {\r\n        bookmark( $(this), '../favorite' , 'product_id' );\r\n    });\r\n\r\n    function bookmark(aTarget, route , urlTarget) {\r\n        var val = aTarget.parent().next().html();\r\n        var formData = { urlTarget : val};\r\n        \r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n\r\n        $.ajax({\r\n            url: route+\"/\"+val,\r\n            type: \"POST\",\r\n            data: formData,\r\n            success: function(data){\r\n                aTarget.find('i').toggleClass('hidden');\r\n                if( aTarget.find('em') ){\r\n                    aTarget.find('em').toggleClass('hidden');\r\n                }\r\n            },\r\n            error: function(responseData, textStatus){\r\n                console.log(textStatus);\r\n            }\r\n        });\r\n    }\r\n//filter-Info\r\n    $('div.info_group').find('a').on({ focus : function(e){\r\n        e.preventDefault();\r\n        var className = $(this).attr('class');\r\n        $('div.popup').addClass('hidden');\r\n        $('div.popup.'+className).removeClass('hidden');\r\n    }, focusout : function(e){\r\n        if( !$('div.popup').is(':focus') ){\r\n            var className = $(this).attr('class');\r\n            $('div.popup.'+className).addClass('hidden');\r\n        }\r\n    }});\r\n//Product sort\r\n    $('ul.sort-list li').on('click', function(e){\r\n        $(this).parent().find('li').removeClass('active');\r\n        $(this).addClass('active');\r\n        $('input#sortBy').val( $(this).attr('name') ).removeAttr('disabled');\r\n        $('input#sortBy').parent().parent().submit();\r\n    });\r\n\r\n    $('div.filter-group label').on('click', function(){\r\n        if( $(this).next().hasClass('purpose') || $(this).next().is('input[type=\"checkbox\"]') ){\r\n            $(this).toggleClass('active');\r\n        }else{\r\n            if( $(this).attr('class')=='active' ){\r\n                var id = $(this).next('input').attr('id');\r\n                document.getElementById(id).disabled = true;\r\n                $(this).removeClass('active');\r\n            }\r\n            else{\r\n                var id = $(this).next('input').attr('id');\r\n                document.getElementById(id).disabled = false;\r\n                $(this).parent().find('label').removeClass('active');\r\n                $(this).addClass('active');\r\n            }\r\n        };\r\n    });\r\n\r\n    $('label.uncheck').on('click',function(){\r\n        var id = $(this).next('input').attr('id');\r\n        document.getElementById(id).checked = true;\r\n        document.getElementById(id).disabled = true;\r\n    });\r\n\r\n//Search\r\n    $('input[name=search]').on('keypress', function(e){\r\n        if( e.keyCode == 13 ){\r\n            $('form[name=searchForm]').submit();\r\n        }\r\n    });\r\n    $('input[name=search]').focus(function(){\r\n    $(this).parent('div').css('border', '1px solid rgba(43,222,115,1.0)').css('box-shadow', '0 0 15px rgba(43,222,115,0.3)');\r\n    }).blur(function(){\r\n        $(this).parent('div').css('border', '1px solid #ccc').css('box-shadow', 'none');\r\n    });\r\n//Detail Ajax\r\n    $('a.go_url').on('click',function() {\r\n        var productId = $('input.product-id').val();\r\n        var formData = { 'product_id' : productId };\r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n        $.ajax({\r\n            url: \"../viewcount/\"+productId,\r\n            type: \"POST\",\r\n            data: formData, \r\n            success: function(data){\r\n            },\r\n            error: function(responseData, textStatus){\r\n                alert(textStatus);\r\n            }\r\n        });\r\n    });\r\n//MyProduct\r\n\r\n    $('input[name=\"purpose\"]').on('click', function(){\r\n        if($(this).val() == '게임용'){\r\n            $('ul.for_game_check').css('opacity','1.0').find('input[type=\"checkbox\"]').removeAttr('disabled');\r\n        }else{\r\n            $('ul.for_game_check').css('opacity','0.7').find('input[type=\"checkbox\"]').attr('disabled', 'disabled');\r\n        }\r\n    });\r\n    $('input#no-monitor').on('click', function(){\r\n        if( $(this).is(':checked') ){\r\n            $('input[name=\"monitor\"]').attr('disabled', 'disabled').val('');\r\n        }else{\r\n            $('input[name=\"monitor\"]').removeAttr('disabled');\r\n        }\r\n    });\r\n\r\n\r\n\r\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3NjcmlwdC5qcz85YTBlIl0sInNvdXJjZXNDb250ZW50IjpbIi8vUmVjZW50SXRlbXNcclxuICAgIGZvcih2YXIgJGk9MDsgJGk8Y29va2llTGlzdC5pdGVtcygpLmxlbmd0aDsgJGkrKyl7XHJcbiAgICAgICAgJCgndWwucmVjZW50LXByb2R1Y3QnKS5wcmVwZW5kKCc8bGk+PGEgaHJlZj1cIicrIGNvb2tpZUxpc3QuaXRlbXMoKVskaV0udXJsICsnXCIgdGl0bGU9XCInKyBjb29raWVMaXN0Lml0ZW1zKClbJGldLm5hbWUgKydcIj48ZGl2IHN0eWxlPVwiYmFja2dyb3VuZDp1cmwoJysgY29va2llTGlzdC5pdGVtcygpWyRpXS5pbWcgKycpIGNlbnRlciBuby1yZXBlYXQ7YmFja2dyb3VuZC1zaXplOmNvdmVyO1wiPjwvZGl2PjwvYT48L2xpPicpO1xyXG4gICAgICAgICQoJ3VsLnJlY2VudC1wcm9kdWN0JykuZmluZCgnbGk6bGFzdC1jaGlsZCcpLnJlbW92ZSgpO1xyXG4gICAgfTtcclxuICAgICQoJ3VsLnJlY2VudC1wcm9kdWN0JykucHJldigncCcpLmJlZm9yZSgnPHNwYW4gY2xhc3M9XCJuZXdcIj4nK2Nvb2tpZUxpc3QuaXRlbXMoKS5sZW5ndGgrJzwvc3Bhbj4nKTtcclxuLy9OYXZcclxuICAgICQoJ2EubWVudV9idG4nKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICQoJ3VsLm5hdi1ncm91cCcpLnRvZ2dsZUNsYXNzKCdzaG93Jyk7XHJcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcbiAgICB9KTtcclxuICAgICQoJ2EubXlwYWdlJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICAkKHRoaXMpLm5leHQoKS50b2dnbGVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICB9KTtcclxuICAgICQoJ25hdi50YWJtZW51LXdyYXAgYS5idXR0b24nKS5vbignY2xpY2snLGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgnbmF2JykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgIGlmKCAkKHRoaXMpLnBhcmVudCgnbmF2JykuaGFzQ2xhc3MoJ2FjdGl2ZScpICl7XHJcbiAgICAgICAgICAgICQodGhpcykuY2hpbGRyZW4oJ2knKS5yZW1vdmVDbGFzcygnZmEtYW5nbGUtbGVmdCcpLmFkZENsYXNzKCdmYS1hbmdsZS1yaWdodCcpO1xyXG4gICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAkKHRoaXMpLmNoaWxkcmVuKCdpJykucmVtb3ZlQ2xhc3MoJ2ZhLWFuZ2xlLXJpZ2h0JykuYWRkQ2xhc3MoJ2ZhLWFuZ2xlLWxlZnQnKTtcclxuICAgICAgICB9O1xyXG4gICAgfSk7XHJcblxyXG4vL2NvbmZpcm1cclxuICAgICQoJ2EucmNtLWRlbGV0ZSwgYS51c2VyLWRlbGV0ZSAsIGlucHV0LmRlbC1zdWJtaXQnKS5jbGljayhmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgdmFyIGNvbmZpcm1NZW50ID0gJ+ygleunkCDsgq3soJztlZjsi5zqsqDsirXri4jquYw/JztcclxuICAgICAgICBpZiggJCh0aGlzKS5oYXNDbGFzcygndXNlci1kZWxldGUnKSApe1xyXG4gICAgICAgICAgICBjb25maXJtTWVudCA9ICfsoJXrp5Ag7YOI7Ye07ZWY7Iuc6rKg7Iq164uI6rmMP1xcbu2ajOybkOuLmOydmCDsoJXrs7TripQg7KCE67aAIOyCrOudvOynkeuLiOuLpC4nO1xyXG4gICAgICAgIH1cclxuICAgICAgICBpZihjb25maXJtKGNvbmZpcm1NZW50KSA9PSB0cnVlKXtcclxuICAgICAgICAgICAgJCh0aGlzKS5uZXh0KCkuc3VibWl0KCk7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIHJldHVybjtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuLy9OZXdQcm9kdWN0XHJcbiAgICAkKCduYXYubmV3X3Byb2R1Y3QgYScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICB2YXIgaW5kZXggPSAkKCduYXYubmV3X3Byb2R1Y3QgYScpLmluZGV4KHRoaXMpO1xyXG4gICAgICAgICQoJ2Rpdi5tYWluUGFnZSBkaXYuc2xpZGVyJykuY3NzKCdsZWZ0JywgLTEwMCppbmRleCsnJScpO1xyXG4gICAgICAgICQoJ25hdi5uZXdfcHJvZHVjdCBhJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpLmZpbmQoJ2knKS5yZW1vdmVDbGFzcygnZmEtY2lyY2xlJykuYWRkQ2xhc3MoJ2ZhLWNpcmNsZS1vJylcclxuICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKS5maW5kKCdpJykucmVtb3ZlQ2xhc3MoJ2ZhLWNpcmNsZS1vJykuYWRkQ2xhc3MoJ2ZhLWNpcmNsZScpO1xyXG4gICAgfSk7XHJcblxyXG4vL0d1aWRlXHJcbiAgICAkKCd1bC5ndWlkZSBsaScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJG5hbWUgPSAkKHRoaXMpLmF0dHIoJ25hbWUnKTsgXHJcbiAgICAgICAgJCgnZGl2W25hbWU9XCInKyAkbmFtZSArJ1wiXScpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKS5zaWJsaW5ncygnZGl2JykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgfSk7XHJcbi8vVmFsaWRhdGlvblxyXG4gICAgJChcImZvcm0udmFsaWRhdGVcIikudmFsaWRhdGUoKTtcclxuICAgICQoXCJmb3JtLnZhbGlkYXRlIGlucHV0XCIpLm9uKCdrZXlwcmVzcycsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgaWYoICQodGhpcykubmV4dCgnc3BhbicpLmhhc0NsYXNzKCdoZWxwLWJsb2NrJykgKXtcclxuICAgICAgICAgICAgJCh0aGlzKS5uZXh0KCdzcGFuLmhlbHAtYmxvY2snKS5yZW1vdmUoKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuICAgICQoJ3VsLmZvcl9nYW1lX2NoZWNrIGlucHV0Jykub24oJ2NsaWNrJyxmdW5jdGlvbigpe1xyXG4gICAgICAgIGlmKCAkKCd1bC5mb3JfZ2FtZV9jaGVjayBpbnB1dFt0eXBlPVwiY2hlY2tib3hcIl06Y2hlY2tlZCcpLmxlbmd0aCA+IDcgKXtcclxuICAgICAgICAgICAgYWxlcnQoJ+yEuOu2gCDsubTthYzqs6DrpqzripQgN+qwnOq5jOyngOunjCDshKDtg53snbQg6rCA64ql7ZWp64uI64ukIScpO1xyXG4gICAgICAgICAgICAkKHRoaXMpLnByb3AoJ2NoZWNrZWQnLCBmYWxzZSk7XHJcbiAgICAgICAgfTtcclxuICAgIH0pO1xyXG4gICAgJCgnaW5wdXRbdHlwZT1cInN1Ym1pdFwiXS5tb2RpZnknKS5jbGljayhmdW5jdGlvbigpe1xyXG4gICAgICAgICR0eXBlID0gJCh0aGlzKS52YWwoKS5zdWJzdHIoMCwyKTtcclxuICAgICAgICBpZihjb25maXJtKCR0eXBlKyftlZjsi5zqsqDsirXri4jquYw/JykgPT0gZmFsc2Upe1xyXG4gICAgICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbi8vQWdyZWUgaW4gcmVnaXN0ZXJGb3JtXHJcbiAgICAkKCdmb3JtLmFncmVlLWZvcm0gaW5wdXQuYWdyZWUnKS5vbignY2xpY2snLGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgaWYoICQodGhpcykuaXMoJzpjaGVja2VkJykgPT0gdHJ1ZSApe1xyXG4gICAgICAgICAgICAkKCdmb3JtLnJlZ2lzdGVyLWZvcm0nKS5maW5kKCdbbmFtZT1cIicrICQodGhpcykuYXR0cignbmFtZScpICsnXCJdJykucHJvcCgnY2hlY2tlZCcsIHRydWUpO1xyXG4gICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAkKCdmb3JtLnJlZ2lzdGVyLWZvcm0nKS5maW5kKCdbbmFtZT1cIicrICQodGhpcykuYXR0cignbmFtZScpICsnXCJdJykucHJvcCgnY2hlY2tlZCcsIGZhbHNlKTtcclxuICAgICAgICB9XHJcbiAgICAgICAgaWYoICQoJ2lucHV0LmFncmVlJykuZXEoMCkuaXMoJzpjaGVja2VkJykgPT0gdHJ1ZSAmJiAkKCdpbnB1dC5hZ3JlZScpLmVxKDEpLmlzKCc6Y2hlY2tlZCcpID09IHRydWUgKXtcclxuICAgICAgICAgICAgJCgnZm9ybS5yZWdpc3Rlci1mb3JtIGlucHV0W3R5cGU9XCJzdWJtaXRcIl0nKS5yZW1vdmVBdHRyKCdkaXNhYmxlZCcpO1xyXG4gICAgICAgICAgICAkKCdmb3JtLnJlZ2lzdGVyLWZvcm0gaW5wdXRbdHlwZT1cInN1Ym1pdFwiXScpLmF0dHIoJ3ZhbHVlJywn6rCA7J6F7ZWY6riwJyk7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICQoJ2Zvcm0ucmVnaXN0ZXItZm9ybSBpbnB1dFt0eXBlPVwic3VibWl0XCJdJykuYXR0cignZGlzYWJsZWQnLCAnZGlzYWJsZWQnKTtcclxuICAgICAgICAgICAgJCgnZm9ybS5yZWdpc3Rlci1mb3JtIGlucHV0W3R5cGU9XCJzdWJtaXRcIl0nKS5hdHRyKCd2YWx1ZScsJ+ydtOyaqeyVveq0gCDrsI8g6rCc7J247KCV67O0IOy3qOq4ieuwqey5qOyXkCDrj5nsnZjtlbTso7zshLjsmpQuJyk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcblxyXG4vL29yaWdpbkltZ1xyXG4gICAgJG9yaWdpbiA9ICQoJ2Rpdi5pbWctYm94JykuYXR0cignc3R5bGUnKTtcclxuICAgIFxyXG4vL0ltYWdlUHJldmlld1xyXG4gICAgJCgnaW5wdXQuaW1hZ2UnKS5vbignY2hhbmdlJywgZnVuY3Rpb24oKXtcclxuICAgICAgICB2YXIgaW1hZ2UgPSAkKHRoaXMpLnZhbCgpO1xyXG4gICAgICAgIHZhciBpbWFnZW9ubHkgPSBpbWFnZS50b0xvd2VyQ2FzZSgpLnNwbGl0KFwiLlwiKTtcclxuICAgICAgICBpZiggaW1hZ2UgIT0gJycgKXtcclxuICAgICAgICAgICAgaWYoIGltYWdlb25seVsxXSAhPSAnanBnJyAmJiBpbWFnZW9ubHlbMV0gIT0gJ3BuZycgJiYgaW1hZ2Vvbmx5WzFdICE9ICdqcGVnJyAmJiBpbWFnZW9ubHlbMV0gIT0gJ2dpZicgJiYgaW1hZ2Vvbmx5WzFdICE9ICdibXAnKXtcclxuICAgICAgICAgICAgICAgIGFsZXJ0KCfsnbTrr7jsp4Ag7YyM7J2866eMIOyXheuhnOuTnCDqsIDriqXtlanri4jri6QhJyk7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLnZhbCgnJyk7XHJcbiAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgaWYoICQodGhpcykubmV4dCgpLmhhc0NsYXNzKCdNeVByb2R1Y3QnKSApe1xyXG4gICAgICAgICAgICAgICAgICAgIC8v7IOB7ZKI6rSA66asXHJcbiAgICAgICAgICAgICAgICAgICAgdmFyIHJlYWRlciA9IG5ldyBGaWxlUmVhZGVyKCk7XHJcbiAgICAgICAgICAgICAgICAgICAgcmVhZGVyLm9ubG9hZCA9IGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAkKCdkaXYuaW1nLWJveCcpLmF0dHIoJ3N0eWxlJywgJ2JhY2tncm91bmQ6dXJsKCcrZS50YXJnZXQucmVzdWx0KycpIGNlbnRlciBuby1yZXBlYXQ7IGJhY2tncm91bmQtc2l6ZTphdXRvIDEwMCU7JykucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgICAgIC8vU2hvcOygleuztOyImOyglVxyXG4gICAgICAgICAgICAgICAgICAgIHZhciByZWFkZXIgPSBuZXcgRmlsZVJlYWRlcigpO1xyXG4gICAgICAgICAgICAgICAgICAgIHJlYWRlci5vbmxvYWQgPSBmdW5jdGlvbihlKXtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJCgnZGl2LmltZy1ib3gnKS5hdHRyKCdzdHlsZScsICdiYWNrZ3JvdW5kOnVybCgnK2UudGFyZ2V0LnJlc3VsdCsnKSBjZW50ZXIgbm8tcmVwZWF0OyBiYWNrZ3JvdW5kLXNpemU6YXV0byAxMDAlOycpLnBhcmVudCgpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIHJlYWRlci5yZWFkQXNEYXRhVVJMKHRoaXMuZmlsZXNbMF0pO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIGlmKCAhJG9yaWdpbiApe1xyXG4gICAgICAgICAgICAgICAgJCgnZGl2LmltZy1ib3gnKS5hdHRyKCdzdHlsZScsICcnKS5wYXJlbnQoKS5hZGRDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgJCgnZGl2LmltZy1ib3gnKS5hdHRyKCdzdHlsZScsICRvcmlnaW4pO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbiAgICBcclxuICAgICQoJ2Zvcm0udXNlcl9lZGl0JykuZmluZCgnaW5wdXRbdHlwZT1cInN1Ym1pdFwiXScpLm9uKCdjbGljaycsZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgaWYgKCAkKCdpbnB1dFtuYW1lPVwicGFzc3dvcmRcIl0nKS52YWwoKSAhPSBcIlwiICl7XHJcbiAgICAgICAgICAgIGlmKCAkKCdpbnB1dFtuYW1lPVwicGFzc3dvcmRcIl0nKS52YWwoKSAhPSAkKCdpbnB1dFtuYW1lPVwicGFzc3dvcmRfY29uZmlybWF0aW9uXCJdJykudmFsKCkgKXtcclxuICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgICAgIGlmKCAkKCdpbnB1dC5wYXNzd29yZCcpLm5leHQoKS5oYXNDbGFzcygnZXJyb3InKSApe1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2lucHV0LnBhc3N3b3JkJykubmV4dCgpLnJlbW92ZSgpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgJCgnaW5wdXQucGFzc3dvcmQnKS5hZnRlcignPGxhYmVsIGNsYXNzPVwiZXJyb3JcIj7ruYTrsIDrsojtmLgg7ZmV7J246rCS7J20IOydvOy5mO2VmOyngCDslYrsirXri4jri6QhPC9sYWJlbD4nKTtcclxuICAgICAgICAgICAgICAgICQoJ2lucHV0LnBhc3N3b3JkJykudmFsKCcnKTtcclxuICAgICAgICAgICAgICAgICQoJ2lucHV0LnBhc3N3b3JkLWNvbmZpcm0nKS52YWwoJycpO1xyXG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuLy9sb2dpbi1mb3JtXHJcbiAgICAkKCdsYWJlbC5yZW1lbWJlcicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJCh0aGlzKS5maW5kKCdpJykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQoJ2lucHV0LnJlbWVtYmVyJykuY2xpY2soKTtcclxuICAgIH0pO1xyXG4vL2ltYWdlLXNsaWRlIFxyXG4gICAgJCgnbmF2Lm5hdi1zbGlkZXInKS5maW5kKCdhJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgLy9QcmV2ZW50RG91YmxlQ2xpY2tcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgaWYgKCEkKHRoaXMpLmRhdGEoJ2lzQ2xpY2tlZCcpKSB7XHJcbiAgICAgICAgICAgIHZhciBsaW5rID0gJCh0aGlzKTtcclxuICAgICAgICAgICAgLy8gc3VjY2Vzc2Z1bCBjbGlja1xyXG4gICAgICAgICAgICBTbGlkZSh0aGlzKTtcclxuICAgICAgICAgICAgLy8gU2V0IHRoZSBpc0NsaWNrZWQgdmFsdWUgYW5kIHNldCBhIHRpbWVyXHJcbiAgICAgICAgICAgIGxpbmsuZGF0YSgnaXNDbGlja2VkJywgdHJ1ZSk7XHJcbiAgICAgICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGxpbmsucmVtb3ZlRGF0YSgnaXNDbGlja2VkJylcclxuICAgICAgICAgICAgfSwgMTIwMCk7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgLy8gQW55dGhpbmcgeW91IHdhbnQgdG8gc2F5ICdCYWQgdXNlciEnXHJcbiAgICAgICAgfTtcclxuICAgIH0pO1xyXG4gICAgZnVuY3Rpb24gU2xpZGUodGFyZ2V0KXtcclxuICAgICAgICB2YXIgd2lkdGggPSAkKHRhcmdldCkucGFyZW50KCkubmV4dCgpLmZpbmQoJ2xpJykub3V0ZXJXaWR0aCh0cnVlKTtcclxuICAgICAgICBpZiggJCh0YXJnZXQpLmhhc0NsYXNzKCdsZWZ0JykgKXtcclxuICAgICAgICAgICAgICAgICQodGFyZ2V0KS5wYXJlbnQoKS5uZXh0KCkuY3NzKCdsZWZ0JywgJy0nK3dpZHRoKydweCcpLnByZXBlbmQoICQodGFyZ2V0KS5wYXJlbnQoKS5uZXh0KCkuZmluZCgnbGk6bGFzdC1jaGlsZCcpICk7XHJcbiAgICAgICAgICAgICAgICAkKHRhcmdldCkucGFyZW50KCkubmV4dCgpLmFuaW1hdGUoIHtsZWZ0IDogJys9Jyt3aWR0aCsncHgnfSwgMTAwMCwgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgIH0gKTtcclxuICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAkKHRhcmdldCkucGFyZW50KCkubmV4dCgpLmZpbmQoJ2xpOmZpcnN0LWNoaWxkJykuY2xvbmUoKS5hcHBlbmRUbyggJCh0YXJnZXQpLnBhcmVudCgpLm5leHQoKSApO1xyXG4gICAgICAgICAgICAgICAgJCh0YXJnZXQpLnBhcmVudCgpLm5leHQoKS5hbmltYXRlKCB7bGVmdCA6ICctPScrd2lkdGgrJ3B4J30sIDEwMDAsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICAgICAgICAgJCh0YXJnZXQpLnBhcmVudCgpLm5leHQoKS5jc3MoJ2xlZnQnLCAnMCcpLmZpbmQoJ2xpOmZpcnN0LWNoaWxkJykucmVtb3ZlKCk7XHJcbiAgICAgICAgICAgICAgICB9ICk7XHJcbiAgICAgICAgICAgIH1cclxuICAgIH1cclxuICAgIFxyXG4vL1RpbWVyXHJcbiAgICBmdW5jdGlvbiBBdXRvU2xpZGUoKXtcclxuICAgICAgICB2YXIgd2lkdGggPSAkKCd1bC5zbGlkZXIuYXV0bycpLmZpbmQoJ2xpJykub3V0ZXJXaWR0aCh0cnVlKTtcclxuICAgICAgICAkKCd1bC5zbGlkZXIuYXV0bycpLmZpbmQoJ2xpOmZpcnN0LWNoaWxkJykuY2xvbmUoKS5hcHBlbmRUbyggJCgndWwuc2xpZGVyLmF1dG8nKSApO1xyXG4gICAgICAgICQoJ3VsLnNsaWRlci5hdXRvJykuYW5pbWF0ZSgge2xlZnQgOiAnLT0nK3dpZHRoKydweCd9LCAxMDAwLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAkKCd1bC5zbGlkZXIuYXV0bycpLmNzcygnbGVmdCcsICcwJykuZmluZCgnbGk6Zmlyc3QtY2hpbGQnKS5yZW1vdmUoKTtcclxuICAgICAgICB9ICk7XHJcbiAgICB9XHJcbiAgICB2YXIgdGltZXIxID0gc2V0SW50ZXJ2YWwoIEF1dG9TbGlkZSAsIDYwMDAgKTtcclxuXHJcbiAgICBmdW5jdGlvbiBOZXdQcm9kdWN0KCl7XHJcbiAgICAgICAgdmFyIGluZGV4ID0gJCgnbmF2Lm5ld19wcm9kdWN0IGEuYWN0aXZlJykucGFyZW50KCdsaScpLmluZGV4KCkrMTtcclxuICAgICAgICBpZiggaW5kZXggPT0gNCApe1xyXG4gICAgICAgICAgICBpbmRleCA9IDA7XHJcbiAgICAgICAgfVxyXG4gICAgICAgICQoJ2Rpdi5tYWluUGFnZSBkaXYuc2xpZGVyJykuY3NzKCdsZWZ0JywgLTEwMCppbmRleCsnJScpO1xyXG4gICAgICAgICQoJ25hdi5uZXdfcHJvZHVjdCBhJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpLmZpbmQoJ2knKS5yZW1vdmVDbGFzcygnZmEtY2lyY2xlJykuYWRkQ2xhc3MoJ2ZhLWNpcmNsZS1vJylcclxuICAgICAgICAkKCduYXYubmV3X3Byb2R1Y3QgYScpLmVxKGluZGV4KS5hZGRDbGFzcygnYWN0aXZlJykuZmluZCgnaScpLnJlbW92ZUNsYXNzKCdmYS1jaXJjbGUtbycpLmFkZENsYXNzKCdmYS1jaXJjbGUnKTtcclxuICAgIH1cclxuICAgIHZhciB0aW1lcjIgPSBzZXRJbnRlcnZhbCggTmV3UHJvZHVjdCAsIDYwMDAgKTtcclxuICAgIFxyXG4gICAgZnVuY3Rpb24gU2V0VGltZXIoICR0YXJnZXQxLCAkdGFyZ2V0MiwgJGZ1bmN0aW9uLCAkdGltZXIsICR0aW1lICl7XHJcbiAgICAgICAgJCgkdGFyZ2V0MSkub24oIHtcclxuICAgICAgICAgICAgbW91c2VlbnRlciA6IGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgIGNsZWFySW50ZXJ2YWwoICR0aW1lciApO1xyXG4gICAgICAgICAgICB9LCBcclxuICAgICAgICAgICAgbW91c2VsZWF2ZSA6IGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICR0aW1lciA9IHNldEludGVydmFsKCAkZnVuY3Rpb24sICR0aW1lICk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgICAgICAkKCR0YXJnZXQyKS5vbigge1xyXG4gICAgICAgICAgICBtb3VzZWVudGVyIDogZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgY2xlYXJJbnRlcnZhbCggJHRpbWVyICk7XHJcbiAgICAgICAgICAgIH0sIFxyXG4gICAgICAgICAgICBtb3VzZWxlYXZlIDogZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgJHRpbWVyID0gc2V0SW50ZXJ2YWwoICRmdW5jdGlvbiwgJHRpbWUgKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG4gICAgU2V0VGltZXIoICd1bC5zbGlkZXIuYXV0bycsICduYXYubmF2LXNsaWRlcicsIEF1dG9TbGlkZSwgdGltZXIxLCA2MDAwICk7XHJcbiAgICBTZXRUaW1lciggJ2Rpdi5pdGVtJywgJ25hdi5uZXdfcHJvZHVjdCcsIE5ld1Byb2R1Y3QgLCB0aW1lcjIsIDYwMDAgKTtcclxuICAgIFxyXG5cclxuLy9TaG9wQXBwbHlcclxuXHJcbiAgICAkKCdkaXYubm90aWNlLWdyb3VwIGEnKS5vbignY2xpY2snLGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJCgnZGl2LnNsaWRlJykucmVtb3ZlQ2xhc3MoJ2ZhZGVpbicpO1xyXG4gICAgICAgICQodGhpcykucGFyZW50KCkucGFyZW50KCkubmV4dCgpLnRvZ2dsZUNsYXNzKCdmYWRlaW4nKTtcclxuICAgIH0pO1xyXG5cclxuLy9mYXYgQWpheFxyXG4gICAgJChcImEuYm9va21hcmtcIikub24oJ2NsaWNrJyxmdW5jdGlvbigpIHtcclxuICAgICAgICBib29rbWFyayggJCh0aGlzKSwgJ2Jvb2ttYXJrJyAsICdzaG9wX2lkJyApO1xyXG4gICAgfSk7XHJcblxyXG4gICAgJChcImEuZmF2XCIpLm9uKCdjbGljaycsZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgYm9va21hcmsoICQodGhpcyksICdmYXZvcml0ZScgLCAncHJvZHVjdF9pZCcgKTtcclxuICAgIH0pO1xyXG5cclxuICAgICQoXCJhLmZhdi1kZXRhaWxcIikub24oJ2NsaWNrJyxmdW5jdGlvbigpIHtcclxuICAgICAgICBib29rbWFyayggJCh0aGlzKSwgJy4uL2Zhdm9yaXRlJyAsICdwcm9kdWN0X2lkJyApO1xyXG4gICAgfSk7XHJcblxyXG4gICAgZnVuY3Rpb24gYm9va21hcmsoYVRhcmdldCwgcm91dGUgLCB1cmxUYXJnZXQpIHtcclxuICAgICAgICB2YXIgdmFsID0gYVRhcmdldC5wYXJlbnQoKS5uZXh0KCkuaHRtbCgpO1xyXG4gICAgICAgIHZhciBmb3JtRGF0YSA9IHsgdXJsVGFyZ2V0IDogdmFsfTtcclxuICAgICAgICBcclxuICAgICAgICAkLmFqYXhTZXR1cCh7XHJcbiAgICAgICAgICAgIGhlYWRlcnM6IHtcclxuICAgICAgICAgICAgICAgICdYLUNTUkYtVE9LRU4nOiAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgJC5hamF4KHtcclxuICAgICAgICAgICAgdXJsOiByb3V0ZStcIi9cIit2YWwsXHJcbiAgICAgICAgICAgIHR5cGU6IFwiUE9TVFwiLFxyXG4gICAgICAgICAgICBkYXRhOiBmb3JtRGF0YSxcclxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24oZGF0YSl7XHJcbiAgICAgICAgICAgICAgICBhVGFyZ2V0LmZpbmQoJ2knKS50b2dnbGVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgICAgICAgICBpZiggYVRhcmdldC5maW5kKCdlbScpICl7XHJcbiAgICAgICAgICAgICAgICAgICAgYVRhcmdldC5maW5kKCdlbScpLnRvZ2dsZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgZXJyb3I6IGZ1bmN0aW9uKHJlc3BvbnNlRGF0YSwgdGV4dFN0YXR1cyl7XHJcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyh0ZXh0U3RhdHVzKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG4vL2ZpbHRlci1JbmZvXHJcbiAgICAkKCdkaXYuaW5mb19ncm91cCcpLmZpbmQoJ2EnKS5vbih7IGZvY3VzIDogZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgIHZhciBjbGFzc05hbWUgPSAkKHRoaXMpLmF0dHIoJ2NsYXNzJyk7XHJcbiAgICAgICAgJCgnZGl2LnBvcHVwJykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICQoJ2Rpdi5wb3B1cC4nK2NsYXNzTmFtZSkucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgfSwgZm9jdXNvdXQgOiBmdW5jdGlvbihlKXtcclxuICAgICAgICBpZiggISQoJ2Rpdi5wb3B1cCcpLmlzKCc6Zm9jdXMnKSApe1xyXG4gICAgICAgICAgICB2YXIgY2xhc3NOYW1lID0gJCh0aGlzKS5hdHRyKCdjbGFzcycpO1xyXG4gICAgICAgICAgICAkKCdkaXYucG9wdXAuJytjbGFzc05hbWUpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICB9XHJcbiAgICB9fSk7XHJcbi8vUHJvZHVjdCBzb3J0XHJcbiAgICAkKCd1bC5zb3J0LWxpc3QgbGknKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLmZpbmQoJ2xpJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQodGhpcykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQoJ2lucHV0I3NvcnRCeScpLnZhbCggJCh0aGlzKS5hdHRyKCduYW1lJykgKS5yZW1vdmVBdHRyKCdkaXNhYmxlZCcpO1xyXG4gICAgICAgICQoJ2lucHV0I3NvcnRCeScpLnBhcmVudCgpLnBhcmVudCgpLnN1Ym1pdCgpO1xyXG4gICAgfSk7XHJcblxyXG4gICAgJCgnZGl2LmZpbHRlci1ncm91cCBsYWJlbCcpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgaWYoICQodGhpcykubmV4dCgpLmhhc0NsYXNzKCdwdXJwb3NlJykgfHwgJCh0aGlzKS5uZXh0KCkuaXMoJ2lucHV0W3R5cGU9XCJjaGVja2JveFwiXScpICl7XHJcbiAgICAgICAgICAgICQodGhpcykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICBpZiggJCh0aGlzKS5hdHRyKCdjbGFzcycpPT0nYWN0aXZlJyApe1xyXG4gICAgICAgICAgICAgICAgdmFyIGlkID0gJCh0aGlzKS5uZXh0KCdpbnB1dCcpLmF0dHIoJ2lkJyk7XHJcbiAgICAgICAgICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChpZCkuZGlzYWJsZWQgPSB0cnVlO1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgZWxzZXtcclxuICAgICAgICAgICAgICAgIHZhciBpZCA9ICQodGhpcykubmV4dCgnaW5wdXQnKS5hdHRyKCdpZCcpO1xyXG4gICAgICAgICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoaWQpLmRpc2FibGVkID0gZmFsc2U7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLmZpbmQoJ2xhYmVsJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9O1xyXG4gICAgfSk7XHJcblxyXG4gICAgJCgnbGFiZWwudW5jaGVjaycpLm9uKCdjbGljaycsZnVuY3Rpb24oKXtcclxuICAgICAgICB2YXIgaWQgPSAkKHRoaXMpLm5leHQoJ2lucHV0JykuYXR0cignaWQnKTtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChpZCkuY2hlY2tlZCA9IHRydWU7XHJcbiAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoaWQpLmRpc2FibGVkID0gdHJ1ZTtcclxuICAgIH0pO1xyXG5cclxuLy9TZWFyY2hcclxuICAgICQoJ2lucHV0W25hbWU9c2VhcmNoXScpLm9uKCdrZXlwcmVzcycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGlmKCBlLmtleUNvZGUgPT0gMTMgKXtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPXNlYXJjaEZvcm1dJykuc3VibWl0KCk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbiAgICAkKCdpbnB1dFtuYW1lPXNlYXJjaF0nKS5mb2N1cyhmdW5jdGlvbigpe1xyXG4gICAgJCh0aGlzKS5wYXJlbnQoJ2RpdicpLmNzcygnYm9yZGVyJywgJzFweCBzb2xpZCByZ2JhKDQzLDIyMiwxMTUsMS4wKScpLmNzcygnYm94LXNoYWRvdycsICcwIDAgMTVweCByZ2JhKDQzLDIyMiwxMTUsMC4zKScpO1xyXG4gICAgfSkuYmx1cihmdW5jdGlvbigpe1xyXG4gICAgICAgICQodGhpcykucGFyZW50KCdkaXYnKS5jc3MoJ2JvcmRlcicsICcxcHggc29saWQgI2NjYycpLmNzcygnYm94LXNoYWRvdycsICdub25lJyk7XHJcbiAgICB9KTtcclxuLy9EZXRhaWwgQWpheFxyXG4gICAgJCgnYS5nb191cmwnKS5vbignY2xpY2snLGZ1bmN0aW9uKCkge1xyXG4gICAgICAgIHZhciBwcm9kdWN0SWQgPSAkKCdpbnB1dC5wcm9kdWN0LWlkJykudmFsKCk7XHJcbiAgICAgICAgdmFyIGZvcm1EYXRhID0geyAncHJvZHVjdF9pZCcgOiBwcm9kdWN0SWQgfTtcclxuICAgICAgICAkLmFqYXhTZXR1cCh7XHJcbiAgICAgICAgICAgIGhlYWRlcnM6IHtcclxuICAgICAgICAgICAgICAgICdYLUNTUkYtVE9LRU4nOiAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgICAgICAkLmFqYXgoe1xyXG4gICAgICAgICAgICB1cmw6IFwiLi4vdmlld2NvdW50L1wiK3Byb2R1Y3RJZCxcclxuICAgICAgICAgICAgdHlwZTogXCJQT1NUXCIsXHJcbiAgICAgICAgICAgIGRhdGE6IGZvcm1EYXRhLCBcclxuICAgICAgICAgICAgc3VjY2VzczogZnVuY3Rpb24oZGF0YSl7XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGVycm9yOiBmdW5jdGlvbihyZXNwb25zZURhdGEsIHRleHRTdGF0dXMpe1xyXG4gICAgICAgICAgICAgICAgYWxlcnQodGV4dFN0YXR1cyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH0pO1xyXG4vL015UHJvZHVjdFxyXG5cclxuICAgICQoJ2lucHV0W25hbWU9XCJwdXJwb3NlXCJdJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICBpZigkKHRoaXMpLnZhbCgpID09ICfqsozsnoTsmqknKXtcclxuICAgICAgICAgICAgJCgndWwuZm9yX2dhbWVfY2hlY2snKS5jc3MoJ29wYWNpdHknLCcxLjAnKS5maW5kKCdpbnB1dFt0eXBlPVwiY2hlY2tib3hcIl0nKS5yZW1vdmVBdHRyKCdkaXNhYmxlZCcpO1xyXG4gICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAkKCd1bC5mb3JfZ2FtZV9jaGVjaycpLmNzcygnb3BhY2l0eScsJzAuNycpLmZpbmQoJ2lucHV0W3R5cGU9XCJjaGVja2JveFwiXScpLmF0dHIoJ2Rpc2FibGVkJywgJ2Rpc2FibGVkJyk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbiAgICAkKCdpbnB1dCNuby1tb25pdG9yJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICBpZiggJCh0aGlzKS5pcygnOmNoZWNrZWQnKSApe1xyXG4gICAgICAgICAgICAkKCdpbnB1dFtuYW1lPVwibW9uaXRvclwiXScpLmF0dHIoJ2Rpc2FibGVkJywgJ2Rpc2FibGVkJykudmFsKCcnKTtcclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgJCgnaW5wdXRbbmFtZT1cIm1vbml0b3JcIl0nKS5yZW1vdmVBdHRyKCdkaXNhYmxlZCcpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuXHJcblxyXG5cblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9zY3JpcHQuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7O0FBR0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);