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

eval("//Nav\r\n    $('a.menu_btn').on('click', function(){\r\n        $('ul.nav-group.menu').toggleClass('show');\r\n        $(this).parent().addClass('active');\r\n    });\r\n    $('nav.admin-nav ul.nav-group > li > a').on('click', function(e){\r\n        e.preventDefault();\r\n        $(this).next('ul').toggleClass('not-show').toggleClass('hidden');\r\n    })\r\n//tab\r\n    $('ul.sort-list li').on('click', function(){\r\n        $(this).parent().find('li').removeClass('active');\r\n        $(this).addClass('active');\r\n        $('input#sortBy').val( $(this).attr('name') );\r\n        $('input#sortBy').parent().parent().submit();\r\n    });\r\n//Search\r\n    $('input[name=search]').on('keypress', function(e){\r\n        if( e.keyCode == 13 ){\r\n            $('form[name=searchForm]').submit();\r\n        }\r\n    });\r\n    $('input[name=search]').focus(function(){\r\n    $(this).parent('div').css('border', '1px solid rgba(43,222,115,1.0)').css('box-shadow', '0 0 15px rgba(43,222,115,0.3)');\r\n    }).blur(function(){\r\n        $(this).parent('div').css('border', '1px solid #ccc').css('box-shadow', 'none');\r\n    });\r\n//Category\r\n    //modify\r\n        $('div.category').on('click', 'em', function(){\r\n            $('input.modify').addClass('hidden');\r\n            $('div.category em').removeClass('hidden');\r\n            $(this).toggleClass('hidden');\r\n            $(this).next().toggleClass('hidden').focus();\r\n        });\r\n        $('li').on('focusout', 'input.modify', function(){\r\n            $nth = $(this).prev().prev().html();\r\n            $('input.modify').addClass('hidden');\r\n            $('div.category em').removeClass('hidden');\r\n            $(this).prev('em').html( $(this).val().replace(/(\\s*)/g, \"\") );\r\n            $('input[name=\"category'+$nth+'\"]').val($(this).val());\r\n        }).on('keypress', 'input.modify', function(e){\r\n            if(e.keyCode == 13){\r\n                $(this).focusout();\r\n                return false;\r\n            }\r\n        });\r\n        function Submit($target, $name){\r\n            $target.click(function(){\r\n                $('form[name=\"'+$name+'\"]').submit();\r\n            });\r\n        }\r\n        Submit( $('input.modify-btn'), 'modify' );\r\n\r\n    //delete\r\n        $('li').on('click', 'a.delete', function(e){\r\n            e.preventDefault();\r\n            if( $(this).parent('li').hasClass('create') ){\r\n                $(this).parent('li').remove();\r\n            }else{\r\n                $nth = $(this).prev().prev().prev().html();\r\n                var categoryId = { 'categoryId' : $nth }\r\n                $.ajaxSetup({\r\n                    headers: {\r\n                        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n                    }\r\n                });\r\n                $.ajax({\r\n                    type:'POST',\r\n                    url:'/categorycnt/'+$nth,\r\n                    data:categoryId,\r\n                    success:function(data){\r\n                        if( data == 0 ){\r\n                            if( confirm('정말 삭제하겠습니까?') == false ){\r\n                                return false;\r\n                            }\r\n                            $('form.delete'+$nth).submit();\r\n                        }else{\r\n                            alert('카테고리에 상품이 남아있어 지울 수 없습니다!');\r\n                        }\r\n                    },error:function(){\r\n\r\n                    }\r\n                });\r\n            }\r\n        });\r\n    //create\r\n        $('a.create').on('click', function(){\r\n            $(this).next('input').toggleClass('hidden');\r\n            $('input.create').focus();\r\n        });\r\n        $('input.create').on('focusout', function(){\r\n            if( $(this).val() != '' ){\r\n                // $(this).parent().parent().before('<li class=\"create\"><span>└</span><em class=\"name\">'+$(this).val()+'</em><input type=\"text\" class=\"modify hidden\" value=\"'+$(this).val()+'\"><a href=\"#\" class=\"delete\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></li>');\r\n                $('input[type=\"submit\"]').before('<input type=\"hidden\" class=\"modify hidden\" name=\"create[]\" value=\"'+$(this).val()+'\">');\r\n                $(this).val('');\r\n                $('form[name=\"modify\"]').submit();\r\n            }\r\n            $(this).addClass('hidden');\r\n        }).on('keypress', function(e){\r\n            if( e.keyCode == 13 ){\r\n                e.preventDefault();\r\n                $(this).focusout();\r\n            }\r\n        });\r\n//Cpu-vga\r\n    $('a.folder').on('click', function(e){\r\n        e.preventDefault();\r\n        $('a').removeClass('active');\r\n        $(this).parent().next().toggleClass('hidden');\r\n    })\r\n    $('a.create').on('click', function(e){\r\n        e.preventDefault();\r\n        $url = window.location.protocol+'//'+window.location.host;\r\n        $('a').removeClass('active');\r\n        $(this).addClass('active');\r\n        if( $(this).parent().hasClass('cpu') ){\r\n            $('form[name=\"cpuForm\"]').find('input[name=\"_method\"]').remove();\r\n            $('form[name=\"cpuForm\"] h3').html('CPU :: 추가하기');\r\n            $('form[name=\"cpuForm\"] input').not('[name=\"_token\"]').val('');\r\n            $('select[name=\"cpu_level\"] option').eq(0).prop(\"selected\", true);\r\n            $('form[name=\"cpuForm\"]').removeClass('hidden').attr('action' , $url+'/cpu').find('input[type=\"submit\"]').val('추가하기');\r\n            $('form[name=\"vgaForm\"]').addClass('hidden');\r\n        }else{\r\n            $('form[name=\"vgaForm\"]').find('input[name=\"_method\"]').remove();\r\n            $('form[name=\"vgaForm\"] h3').html('VGA :: 추가하기');\r\n            $('form[name=\"vgaForm\"] input').not('[name=\"_token\"]').val('');\r\n            $('select[name=\"vga_level\"] option').eq(0).prop(\"selected\", true);\r\n            $('form[name=\"vgaForm\"]').removeClass('hidden').attr('action' , $url+'/vga').find('input[type=\"submit\"]').val('추가하기');\r\n            $('form[name=\"cpuForm\"]').addClass('hidden');\r\n        }\r\n    })\r\n    //ajax -- form action && input value 값 각각 넣어주고 마지막에 submit\r\n    $('a.name').on('click', function(e){\r\n        e.preventDefault();\r\n        $('a').removeClass('active');\r\n        $(this).addClass('active');\r\n        $type = $(this).parent().attr('class');\r\n        $targetId = $(this).prev().html();\r\n        $url = window.location.protocol+'//'+window.location.host;\r\n        var dataArr = { 'type' : $type ,\r\n                        'id' : $targetId }\r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n        $.ajax({\r\n            type:'POST',\r\n            url:'/'+$type+'/'+$targetId,\r\n            data:dataArr,\r\n            success:function(data){\r\n                var dataArr = JSON.parse(data);\r\n                if( $type == 'cpu' ){\r\n                    $('form[name=\"cpuForm\"]').prepend('<input type=\"hidden\" name=\"_method\" value=\"put\">');\r\n                    $('form[name=\"cpuForm\"] h3').html('CPU :: '+dataArr.name);\r\n                    $('input[name=\"cpu_name\"]').val(dataArr.name);\r\n                    $('input[name=\"cpu_brand\"]').val(dataArr.brand);\r\n                    $('input[name=\"cpu_core\"]').val(dataArr.cores);\r\n                    $('select[name=\"cpu_level\"]').val(dataArr.level).prop(\"selected\", true);\r\n                    $('form[name=\"cpuForm\"]').removeClass('hidden').attr('action' , $url+'/cpu-edit/'+$targetId).find('input[type=\"submit\"]').val('수정하기');\r\n                    $('form[name=\"vgaForm\"]').addClass('hidden');\r\n                }else{\r\n                    $('form[name=\"vgaForm\"]').prepend('<input type=\"hidden\" name=\"_method\" value=\"put\">');\r\n                    $('form[name=\"vgaForm\"] h3').html('VGA :: '+dataArr.name);\r\n                    $('input[name=\"vga_name\"]').val(dataArr.name);\r\n                    $('input[name=\"vga_brand\"]').val(dataArr.brand);\r\n                    $('select[name=\"vga_level\"]').val(dataArr.level).prop(\"selected\", true);\r\n                    $('form[name=\"vgaForm\"]').removeClass('hidden').attr('action' , $url+'/vga-edit/'+$targetId);\r\n                    $('form[name=\"cpuForm\"]').addClass('hidden');\r\n                }\r\n            },error:function(){\r\n                console.log('error');\r\n            }\r\n        });\r\n    });\r\n    $('a.del').on('click', function(e){\r\n        e.preventDefault();\r\n        $nth = $(this).prev().prev().prev().html();\r\n        console.log($nth);\r\n        var dataArr = { 'targetId' : $nth }\r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n        if( $(this).parent('li').hasClass('cpu') ){\r\n            deleteAjax('cpu', dataArr, 'CPU');\r\n        }else{\r\n            deleteAjax('vga', dataArr, 'VGA');\r\n        }\r\n        function deleteAjax( $target, dataArr, $print){\r\n            $.ajax({\r\n                type:'POST',\r\n                url:'/'+$target+'-delete/'+$nth,\r\n                data:dataArr,\r\n                success:function(data){\r\n                    if( data == 0 ){\r\n                        if( confirm('정말 삭제하겠습니까?') == false ){\r\n                            return false;\r\n                        }\r\n                        $('form.'+$target+$nth).submit();\r\n                    }else{\r\n                        alert($print+'에 상품이 남아있어 지울 수 없습니다!');\r\n                    }\r\n                },error:function(){\r\n\r\n                }\r\n            });\r\n        }\r\n    });\r\n\r\n//Main\r\n    $('div.nth input').on('click', function(){\r\n        $nth = $(this).attr('id');\r\n        $('div.slider ul li.'+$nth).removeClass('hidden');\r\n        $('div.slider ul li').not('.'+$nth).addClass('hidden');\r\n        $url = window.location.protocol+'//'+window.location.host;\r\n        $('form[name=\"main-edit\"]').attr('action', $url+'/admin/banner/'+$nth.charAt(4));\r\n        $type = $('ul.slider li.'+$nth).find('span:first-child').html();\r\n        $title = $('ul.slider li.'+$nth).find('h3').html();\r\n        $content = $('ul.slider li.'+$nth).find('p').html();\r\n        $url = $('ul.slider li.'+$nth).find('a').attr('href');\r\n        $align = $('ul.slider li.'+$nth).find('span.hidden').html();\r\n        $('input[value=\"'+$type+'\"]').prop('checked', true);\r\n        $('textarea[name=\"title\"]').html($title.replace('<br>',''));\r\n        $('textarea[name=\"content\"]').html($content.replace('<br>',''));\r\n        $('input[name=\"url\"]').val($url);\r\n        $('input[value=\"'+$align+'\"]').prop('checked', true);\r\n    });\r\n    $('a.preview').on('click', function(e){\r\n        e.preventDefault();\r\n        $nth = $('div.nth').find('input:checked').attr('id');\r\n        $type = $('div.type').find('input:checked').prev().html();\r\n        $title = $('textarea[name=\"title\"]').val();\r\n        $content = $('textarea[name=\"content\"]').val();\r\n        $url = $('input[name=\"url\"]').val();\r\n        $('div.slider ul li.'+$nth).find('span').html($type);\r\n        $('div.slider ul li.'+$nth).find('h3').html($title.replace(/\\n/g, '<br/>'));\r\n        $('div.slider ul li.'+$nth).find('p').html($content.replace(/\\n/g, '<br/>'));\r\n        $('div.slider ul li.'+$nth).find('a').attr('href', $url);\r\n    });\r\n    $('input.image').on('change', function(){\r\n        var image = $(this).val();\r\n        var imageonly = image.toLowerCase().split(\".\");\r\n        if( image != '' ){\r\n            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){\r\n                alert('이미지 파일만 업로드 가능합니다!');\r\n                $(this).val('');\r\n            }else{\r\n                $nth = $('div.nth').find('input:checked').attr('id');\r\n                var reader = new FileReader();\r\n                reader.onload = function(e){\r\n                    $('div.slider ul li.'+$nth).attr('style', 'background:url('+e.target.result+') no-repeat; background-size:cover;');\r\n                }\r\n                reader.readAsDataURL(this.files[0]);\r\n            }\r\n        }else{\r\n            if( !$('div.image-logo').is('img') ){\r\n                $('div.image-logo img').remove();\r\n            }else{\r\n                $('div.image-logo img').attr('src', originImg);\r\n            }\r\n        }\r\n    });\r\n//Recommend\r\n    function Recommend($target, $inputname, $product, $shop){\r\n        $('a.'+$target).on('click', function(e){\r\n            e.preventDefault();\r\n            var imgSrc = $(this).parent().parent().prev().prev().find('img').attr('src');\r\n            var prodName = $(this).parent().parent().prev().find('a').html();\r\n            var shopName = $(this).parent().parent().prev().find('p.shop-name').html();\r\n            var productId = $(this).next().html();\r\n            opener.document.getElementById($target).style=\"background:url(\"+imgSrc+\") center no-repeat; background-size:cover;\";\r\n            opener.document.getElementById($product).innerHTML=prodName;\r\n            opener.document.getElementById($shop).innerHTML=shopName;\r\n            opener.document.getElementById($inputname).value=productId;\r\n            self.close();\r\n        });\r\n    }\r\n    Recommend('recommend1', 'productId1', 'prodName1', 'shopName1');\r\n    Recommend('recommend2', 'productId2', 'prodName2', 'shopName2');\r\n    Recommend('recommend3', 'productId3', 'prodName3', 'shopName3');\r\n    Recommend('recommend4', 'productId4', 'prodName4', 'shopName4');\r\n    $('a.rcm-submit').click(function(){\r\n        $('form[name=\"newRecommend\"]').submit();\r\n    });\r\n    $('a.rcm-delete').click(function(){\r\n        $('form[name=\"recommend-del\"]').submit();\r\n    });//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FkbWluU2NyaXB0LmpzPzcwMmYiXSwic291cmNlc0NvbnRlbnQiOlsiLy9OYXZcclxuICAgICQoJ2EubWVudV9idG4nKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICQoJ3VsLm5hdi1ncm91cC5tZW51JykudG9nZ2xlQ2xhc3MoJ3Nob3cnKTtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgIH0pO1xyXG4gICAgJCgnbmF2LmFkbWluLW5hdiB1bC5uYXYtZ3JvdXAgPiBsaSA+IGEnKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgJCh0aGlzKS5uZXh0KCd1bCcpLnRvZ2dsZUNsYXNzKCdub3Qtc2hvdycpLnRvZ2dsZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgIH0pXHJcbi8vdGFiXHJcbiAgICAkKCd1bC5zb3J0LWxpc3QgbGknKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICQodGhpcykucGFyZW50KCkuZmluZCgnbGknKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCgnaW5wdXQjc29ydEJ5JykudmFsKCAkKHRoaXMpLmF0dHIoJ25hbWUnKSApO1xyXG4gICAgICAgICQoJ2lucHV0I3NvcnRCeScpLnBhcmVudCgpLnBhcmVudCgpLnN1Ym1pdCgpO1xyXG4gICAgfSk7XHJcbi8vU2VhcmNoXHJcbiAgICAkKCdpbnB1dFtuYW1lPXNlYXJjaF0nKS5vbigna2V5cHJlc3MnLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBpZiggZS5rZXlDb2RlID09IDEzICl7XHJcbiAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1zZWFyY2hGb3JtXScpLnN1Ym1pdCgpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG4gICAgJCgnaW5wdXRbbmFtZT1zZWFyY2hdJykuZm9jdXMoZnVuY3Rpb24oKXtcclxuICAgICQodGhpcykucGFyZW50KCdkaXYnKS5jc3MoJ2JvcmRlcicsICcxcHggc29saWQgcmdiYSg0MywyMjIsMTE1LDEuMCknKS5jc3MoJ2JveC1zaGFkb3cnLCAnMCAwIDE1cHggcmdiYSg0MywyMjIsMTE1LDAuMyknKTtcclxuICAgIH0pLmJsdXIoZnVuY3Rpb24oKXtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgnZGl2JykuY3NzKCdib3JkZXInLCAnMXB4IHNvbGlkICNjY2MnKS5jc3MoJ2JveC1zaGFkb3cnLCAnbm9uZScpO1xyXG4gICAgfSk7XHJcbi8vQ2F0ZWdvcnlcclxuICAgIC8vbW9kaWZ5XHJcbiAgICAgICAgJCgnZGl2LmNhdGVnb3J5Jykub24oJ2NsaWNrJywgJ2VtJywgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgJCgnaW5wdXQubW9kaWZ5JykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAkKCdkaXYuY2F0ZWdvcnkgZW0nKS5yZW1vdmVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgICAgICQodGhpcykudG9nZ2xlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAkKHRoaXMpLm5leHQoKS50b2dnbGVDbGFzcygnaGlkZGVuJykuZm9jdXMoKTtcclxuICAgICAgICB9KTtcclxuICAgICAgICAkKCdsaScpLm9uKCdmb2N1c291dCcsICdpbnB1dC5tb2RpZnknLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAkbnRoID0gJCh0aGlzKS5wcmV2KCkucHJldigpLmh0bWwoKTtcclxuICAgICAgICAgICAgJCgnaW5wdXQubW9kaWZ5JykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAkKCdkaXYuY2F0ZWdvcnkgZW0nKS5yZW1vdmVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgICAgICQodGhpcykucHJldignZW0nKS5odG1sKCAkKHRoaXMpLnZhbCgpLnJlcGxhY2UoLyhcXHMqKS9nLCBcIlwiKSApO1xyXG4gICAgICAgICAgICAkKCdpbnB1dFtuYW1lPVwiY2F0ZWdvcnknKyRudGgrJ1wiXScpLnZhbCgkKHRoaXMpLnZhbCgpKTtcclxuICAgICAgICB9KS5vbigna2V5cHJlc3MnLCAnaW5wdXQubW9kaWZ5JywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgICAgIGlmKGUua2V5Q29kZSA9PSAxMyl7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLmZvY3Vzb3V0KCk7XHJcbiAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgICAgICBmdW5jdGlvbiBTdWJtaXQoJHRhcmdldCwgJG5hbWUpe1xyXG4gICAgICAgICAgICAkdGFyZ2V0LmNsaWNrKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICAgICAkKCdmb3JtW25hbWU9XCInKyRuYW1lKydcIl0nKS5zdWJtaXQoKTtcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIFN1Ym1pdCggJCgnaW5wdXQubW9kaWZ5LWJ0bicpLCAnbW9kaWZ5JyApO1xyXG5cclxuICAgIC8vZGVsZXRlXHJcbiAgICAgICAgJCgnbGknKS5vbignY2xpY2snLCAnYS5kZWxldGUnLCBmdW5jdGlvbihlKXtcclxuICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICBpZiggJCh0aGlzKS5wYXJlbnQoJ2xpJykuaGFzQ2xhc3MoJ2NyZWF0ZScpICl7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgnbGknKS5yZW1vdmUoKTtcclxuICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAkbnRoID0gJCh0aGlzKS5wcmV2KCkucHJldigpLnByZXYoKS5odG1sKCk7XHJcbiAgICAgICAgICAgICAgICB2YXIgY2F0ZWdvcnlJZCA9IHsgJ2NhdGVnb3J5SWQnIDogJG50aCB9XHJcbiAgICAgICAgICAgICAgICAkLmFqYXhTZXR1cCh7XHJcbiAgICAgICAgICAgICAgICAgICAgaGVhZGVyczoge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAgICAgJC5hamF4KHtcclxuICAgICAgICAgICAgICAgICAgICB0eXBlOidQT1NUJyxcclxuICAgICAgICAgICAgICAgICAgICB1cmw6Jy9jYXRlZ29yeWNudC8nKyRudGgsXHJcbiAgICAgICAgICAgICAgICAgICAgZGF0YTpjYXRlZ29yeUlkLFxyXG4gICAgICAgICAgICAgICAgICAgIHN1Y2Nlc3M6ZnVuY3Rpb24oZGF0YSl7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmKCBkYXRhID09IDAgKXtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlmKCBjb25maXJtKCfsoJXrp5Ag7IKt7KCc7ZWY6rKg7Iq164uI6rmMPycpID09IGZhbHNlICl7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJCgnZm9ybS5kZWxldGUnKyRudGgpLnN1Ym1pdCgpO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGFsZXJ0KCfsubTthYzqs6Drpqzsl5Ag7IOB7ZKI7J20IOuCqOyVhOyeiOyWtCDsp4Dsmrgg7IiYIOyXhuyKteuLiOuLpCEnKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH0sZXJyb3I6ZnVuY3Rpb24oKXtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIC8vY3JlYXRlXHJcbiAgICAgICAgJCgnYS5jcmVhdGUnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAkKHRoaXMpLm5leHQoJ2lucHV0JykudG9nZ2xlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAkKCdpbnB1dC5jcmVhdGUnKS5mb2N1cygpO1xyXG4gICAgICAgIH0pO1xyXG4gICAgICAgICQoJ2lucHV0LmNyZWF0ZScpLm9uKCdmb2N1c291dCcsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgIGlmKCAkKHRoaXMpLnZhbCgpICE9ICcnICl7XHJcbiAgICAgICAgICAgICAgICAvLyAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpLmJlZm9yZSgnPGxpIGNsYXNzPVwiY3JlYXRlXCI+PHNwYW4+4pSUPC9zcGFuPjxlbSBjbGFzcz1cIm5hbWVcIj4nKyQodGhpcykudmFsKCkrJzwvZW0+PGlucHV0IHR5cGU9XCJ0ZXh0XCIgY2xhc3M9XCJtb2RpZnkgaGlkZGVuXCIgdmFsdWU9XCInKyQodGhpcykudmFsKCkrJ1wiPjxhIGhyZWY9XCIjXCIgY2xhc3M9XCJkZWxldGVcIj48aSBjbGFzcz1cImZhIGZhLXRpbWVzXCIgYXJpYS1oaWRkZW49XCJ0cnVlXCI+PC9pPjwvYT48L2xpPicpO1xyXG4gICAgICAgICAgICAgICAgJCgnaW5wdXRbdHlwZT1cInN1Ym1pdFwiXScpLmJlZm9yZSgnPGlucHV0IHR5cGU9XCJoaWRkZW5cIiBjbGFzcz1cIm1vZGlmeSBoaWRkZW5cIiBuYW1lPVwiY3JlYXRlW11cIiB2YWx1ZT1cIicrJCh0aGlzKS52YWwoKSsnXCI+Jyk7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLnZhbCgnJyk7XHJcbiAgICAgICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJtb2RpZnlcIl0nKS5zdWJtaXQoKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICB9KS5vbigna2V5cHJlc3MnLCBmdW5jdGlvbihlKXtcclxuICAgICAgICAgICAgaWYoIGUua2V5Q29kZSA9PSAxMyApe1xyXG4gICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS5mb2N1c291dCgpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbi8vQ3B1LXZnYVxyXG4gICAgJCgnYS5mb2xkZXInKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgJCgnYScpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLm5leHQoKS50b2dnbGVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICB9KVxyXG4gICAgJCgnYS5jcmVhdGUnKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgJHVybCA9IHdpbmRvdy5sb2NhdGlvbi5wcm90b2NvbCsnLy8nK3dpbmRvdy5sb2NhdGlvbi5ob3N0O1xyXG4gICAgICAgICQoJ2EnKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgaWYoICQodGhpcykucGFyZW50KCkuaGFzQ2xhc3MoJ2NwdScpICl7XHJcbiAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cImNwdUZvcm1cIl0nKS5maW5kKCdpbnB1dFtuYW1lPVwiX21ldGhvZFwiXScpLnJlbW92ZSgpO1xyXG4gICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJjcHVGb3JtXCJdIGgzJykuaHRtbCgnQ1BVIDo6IOy2lOqwgO2VmOq4sCcpO1xyXG4gICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJjcHVGb3JtXCJdIGlucHV0Jykubm90KCdbbmFtZT1cIl90b2tlblwiXScpLnZhbCgnJyk7XHJcbiAgICAgICAgICAgICQoJ3NlbGVjdFtuYW1lPVwiY3B1X2xldmVsXCJdIG9wdGlvbicpLmVxKDApLnByb3AoXCJzZWxlY3RlZFwiLCB0cnVlKTtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwiY3B1Rm9ybVwiXScpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKS5hdHRyKCdhY3Rpb24nICwgJHVybCsnL2NwdScpLmZpbmQoJ2lucHV0W3R5cGU9XCJzdWJtaXRcIl0nKS52YWwoJ+y2lOqwgO2VmOq4sCcpO1xyXG4gICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJ2Z2FGb3JtXCJdJykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJ2Z2FGb3JtXCJdJykuZmluZCgnaW5wdXRbbmFtZT1cIl9tZXRob2RcIl0nKS5yZW1vdmUoKTtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwidmdhRm9ybVwiXSBoMycpLmh0bWwoJ1ZHQSA6OiDstpTqsIDtlZjquLAnKTtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwidmdhRm9ybVwiXSBpbnB1dCcpLm5vdCgnW25hbWU9XCJfdG9rZW5cIl0nKS52YWwoJycpO1xyXG4gICAgICAgICAgICAkKCdzZWxlY3RbbmFtZT1cInZnYV9sZXZlbFwiXSBvcHRpb24nKS5lcSgwKS5wcm9wKFwic2VsZWN0ZWRcIiwgdHJ1ZSk7XHJcbiAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cInZnYUZvcm1cIl0nKS5yZW1vdmVDbGFzcygnaGlkZGVuJykuYXR0cignYWN0aW9uJyAsICR1cmwrJy92Z2EnKS5maW5kKCdpbnB1dFt0eXBlPVwic3VibWl0XCJdJykudmFsKCfstpTqsIDtlZjquLAnKTtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwiY3B1Rm9ybVwiXScpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICB9XHJcbiAgICB9KVxyXG4gICAgLy9hamF4IC0tIGZvcm0gYWN0aW9uICYmIGlucHV0IHZhbHVlIOqwkiDqsIHqsIEg64Sj7Ja07KO86rOgIOuniOyngOunieyXkCBzdWJtaXRcclxuICAgICQoJ2EubmFtZScpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAkKCdhJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQodGhpcykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICR0eXBlID0gJCh0aGlzKS5wYXJlbnQoKS5hdHRyKCdjbGFzcycpO1xyXG4gICAgICAgICR0YXJnZXRJZCA9ICQodGhpcykucHJldigpLmh0bWwoKTtcclxuICAgICAgICAkdXJsID0gd2luZG93LmxvY2F0aW9uLnByb3RvY29sKycvLycrd2luZG93LmxvY2F0aW9uLmhvc3Q7XHJcbiAgICAgICAgdmFyIGRhdGFBcnIgPSB7ICd0eXBlJyA6ICR0eXBlICxcclxuICAgICAgICAgICAgICAgICAgICAgICAgJ2lkJyA6ICR0YXJnZXRJZCB9XHJcbiAgICAgICAgJC5hamF4U2V0dXAoe1xyXG4gICAgICAgICAgICBoZWFkZXJzOiB7XHJcbiAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgJC5hamF4KHtcclxuICAgICAgICAgICAgdHlwZTonUE9TVCcsXHJcbiAgICAgICAgICAgIHVybDonLycrJHR5cGUrJy8nKyR0YXJnZXRJZCxcclxuICAgICAgICAgICAgZGF0YTpkYXRhQXJyLFxyXG4gICAgICAgICAgICBzdWNjZXNzOmZ1bmN0aW9uKGRhdGEpe1xyXG4gICAgICAgICAgICAgICAgdmFyIGRhdGFBcnIgPSBKU09OLnBhcnNlKGRhdGEpO1xyXG4gICAgICAgICAgICAgICAgaWYoICR0eXBlID09ICdjcHUnICl7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwiY3B1Rm9ybVwiXScpLnByZXBlbmQoJzxpbnB1dCB0eXBlPVwiaGlkZGVuXCIgbmFtZT1cIl9tZXRob2RcIiB2YWx1ZT1cInB1dFwiPicpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cImNwdUZvcm1cIl0gaDMnKS5odG1sKCdDUFUgOjogJytkYXRhQXJyLm5hbWUpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2lucHV0W25hbWU9XCJjcHVfbmFtZVwiXScpLnZhbChkYXRhQXJyLm5hbWUpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2lucHV0W25hbWU9XCJjcHVfYnJhbmRcIl0nKS52YWwoZGF0YUFyci5icmFuZCk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnaW5wdXRbbmFtZT1cImNwdV9jb3JlXCJdJykudmFsKGRhdGFBcnIuY29yZXMpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ3NlbGVjdFtuYW1lPVwiY3B1X2xldmVsXCJdJykudmFsKGRhdGFBcnIubGV2ZWwpLnByb3AoXCJzZWxlY3RlZFwiLCB0cnVlKTtcclxuICAgICAgICAgICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJjcHVGb3JtXCJdJykucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpLmF0dHIoJ2FjdGlvbicgLCAkdXJsKycvY3B1LWVkaXQvJyskdGFyZ2V0SWQpLmZpbmQoJ2lucHV0W3R5cGU9XCJzdWJtaXRcIl0nKS52YWwoJ+yImOygle2VmOq4sCcpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cInZnYUZvcm1cIl0nKS5hZGRDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJ2Z2FGb3JtXCJdJykucHJlcGVuZCgnPGlucHV0IHR5cGU9XCJoaWRkZW5cIiBuYW1lPVwiX21ldGhvZFwiIHZhbHVlPVwicHV0XCI+Jyk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwidmdhRm9ybVwiXSBoMycpLmh0bWwoJ1ZHQSA6OiAnK2RhdGFBcnIubmFtZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnaW5wdXRbbmFtZT1cInZnYV9uYW1lXCJdJykudmFsKGRhdGFBcnIubmFtZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnaW5wdXRbbmFtZT1cInZnYV9icmFuZFwiXScpLnZhbChkYXRhQXJyLmJyYW5kKTtcclxuICAgICAgICAgICAgICAgICAgICAkKCdzZWxlY3RbbmFtZT1cInZnYV9sZXZlbFwiXScpLnZhbChkYXRhQXJyLmxldmVsKS5wcm9wKFwic2VsZWN0ZWRcIiwgdHJ1ZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwidmdhRm9ybVwiXScpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKS5hdHRyKCdhY3Rpb24nICwgJHVybCsnL3ZnYS1lZGl0LycrJHRhcmdldElkKTtcclxuICAgICAgICAgICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJjcHVGb3JtXCJdJykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LGVycm9yOmZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygnZXJyb3InKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcbiAgICAkKCdhLmRlbCcpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAkbnRoID0gJCh0aGlzKS5wcmV2KCkucHJldigpLnByZXYoKS5odG1sKCk7XHJcbiAgICAgICAgY29uc29sZS5sb2coJG50aCk7XHJcbiAgICAgICAgdmFyIGRhdGFBcnIgPSB7ICd0YXJnZXRJZCcgOiAkbnRoIH1cclxuICAgICAgICAkLmFqYXhTZXR1cCh7XHJcbiAgICAgICAgICAgIGhlYWRlcnM6IHtcclxuICAgICAgICAgICAgICAgICdYLUNTUkYtVE9LRU4nOiAkKCdtZXRhW25hbWU9XCJjc3JmLXRva2VuXCJdJykuYXR0cignY29udGVudCcpXHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgICAgICBpZiggJCh0aGlzKS5wYXJlbnQoJ2xpJykuaGFzQ2xhc3MoJ2NwdScpICl7XHJcbiAgICAgICAgICAgIGRlbGV0ZUFqYXgoJ2NwdScsIGRhdGFBcnIsICdDUFUnKTtcclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgZGVsZXRlQWpheCgndmdhJywgZGF0YUFyciwgJ1ZHQScpO1xyXG4gICAgICAgIH1cclxuICAgICAgICBmdW5jdGlvbiBkZWxldGVBamF4KCAkdGFyZ2V0LCBkYXRhQXJyLCAkcHJpbnQpe1xyXG4gICAgICAgICAgICAkLmFqYXgoe1xyXG4gICAgICAgICAgICAgICAgdHlwZTonUE9TVCcsXHJcbiAgICAgICAgICAgICAgICB1cmw6Jy8nKyR0YXJnZXQrJy1kZWxldGUvJyskbnRoLFxyXG4gICAgICAgICAgICAgICAgZGF0YTpkYXRhQXJyLFxyXG4gICAgICAgICAgICAgICAgc3VjY2VzczpmdW5jdGlvbihkYXRhKXtcclxuICAgICAgICAgICAgICAgICAgICBpZiggZGF0YSA9PSAwICl7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmKCBjb25maXJtKCfsoJXrp5Ag7IKt7KCc7ZWY6rKg7Iq164uI6rmMPycpID09IGZhbHNlICl7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgJCgnZm9ybS4nKyR0YXJnZXQrJG50aCkuc3VibWl0KCk7XHJcbiAgICAgICAgICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGFsZXJ0KCRwcmludCsn7JeQIOyDge2SiOydtCDrgqjslYTsnojslrQg7KeA7Jq4IOyImCDsl4bsirXri4jri6QhJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSxlcnJvcjpmdW5jdGlvbigpe1xyXG5cclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcblxyXG4vL01haW5cclxuICAgICQoJ2Rpdi5udGggaW5wdXQnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICRudGggPSAkKHRoaXMpLmF0dHIoJ2lkJyk7XHJcbiAgICAgICAgJCgnZGl2LnNsaWRlciB1bCBsaS4nKyRudGgpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAkKCdkaXYuc2xpZGVyIHVsIGxpJykubm90KCcuJyskbnRoKS5hZGRDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgJHVybCA9IHdpbmRvdy5sb2NhdGlvbi5wcm90b2NvbCsnLy8nK3dpbmRvdy5sb2NhdGlvbi5ob3N0O1xyXG4gICAgICAgICQoJ2Zvcm1bbmFtZT1cIm1haW4tZWRpdFwiXScpLmF0dHIoJ2FjdGlvbicsICR1cmwrJy9hZG1pbi9iYW5uZXIvJyskbnRoLmNoYXJBdCg0KSk7XHJcbiAgICAgICAgJHR5cGUgPSAkKCd1bC5zbGlkZXIgbGkuJyskbnRoKS5maW5kKCdzcGFuOmZpcnN0LWNoaWxkJykuaHRtbCgpO1xyXG4gICAgICAgICR0aXRsZSA9ICQoJ3VsLnNsaWRlciBsaS4nKyRudGgpLmZpbmQoJ2gzJykuaHRtbCgpO1xyXG4gICAgICAgICRjb250ZW50ID0gJCgndWwuc2xpZGVyIGxpLicrJG50aCkuZmluZCgncCcpLmh0bWwoKTtcclxuICAgICAgICAkdXJsID0gJCgndWwuc2xpZGVyIGxpLicrJG50aCkuZmluZCgnYScpLmF0dHIoJ2hyZWYnKTtcclxuICAgICAgICAkYWxpZ24gPSAkKCd1bC5zbGlkZXIgbGkuJyskbnRoKS5maW5kKCdzcGFuLmhpZGRlbicpLmh0bWwoKTtcclxuICAgICAgICAkKCdpbnB1dFt2YWx1ZT1cIicrJHR5cGUrJ1wiXScpLnByb3AoJ2NoZWNrZWQnLCB0cnVlKTtcclxuICAgICAgICAkKCd0ZXh0YXJlYVtuYW1lPVwidGl0bGVcIl0nKS5odG1sKCR0aXRsZS5yZXBsYWNlKCc8YnI+JywnJykpO1xyXG4gICAgICAgICQoJ3RleHRhcmVhW25hbWU9XCJjb250ZW50XCJdJykuaHRtbCgkY29udGVudC5yZXBsYWNlKCc8YnI+JywnJykpO1xyXG4gICAgICAgICQoJ2lucHV0W25hbWU9XCJ1cmxcIl0nKS52YWwoJHVybCk7XHJcbiAgICAgICAgJCgnaW5wdXRbdmFsdWU9XCInKyRhbGlnbisnXCJdJykucHJvcCgnY2hlY2tlZCcsIHRydWUpO1xyXG4gICAgfSk7XHJcbiAgICAkKCdhLnByZXZpZXcnKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgJG50aCA9ICQoJ2Rpdi5udGgnKS5maW5kKCdpbnB1dDpjaGVja2VkJykuYXR0cignaWQnKTtcclxuICAgICAgICAkdHlwZSA9ICQoJ2Rpdi50eXBlJykuZmluZCgnaW5wdXQ6Y2hlY2tlZCcpLnByZXYoKS5odG1sKCk7XHJcbiAgICAgICAgJHRpdGxlID0gJCgndGV4dGFyZWFbbmFtZT1cInRpdGxlXCJdJykudmFsKCk7XHJcbiAgICAgICAgJGNvbnRlbnQgPSAkKCd0ZXh0YXJlYVtuYW1lPVwiY29udGVudFwiXScpLnZhbCgpO1xyXG4gICAgICAgICR1cmwgPSAkKCdpbnB1dFtuYW1lPVwidXJsXCJdJykudmFsKCk7XHJcbiAgICAgICAgJCgnZGl2LnNsaWRlciB1bCBsaS4nKyRudGgpLmZpbmQoJ3NwYW4nKS5odG1sKCR0eXBlKTtcclxuICAgICAgICAkKCdkaXYuc2xpZGVyIHVsIGxpLicrJG50aCkuZmluZCgnaDMnKS5odG1sKCR0aXRsZS5yZXBsYWNlKC9cXG4vZywgJzxici8+JykpO1xyXG4gICAgICAgICQoJ2Rpdi5zbGlkZXIgdWwgbGkuJyskbnRoKS5maW5kKCdwJykuaHRtbCgkY29udGVudC5yZXBsYWNlKC9cXG4vZywgJzxici8+JykpO1xyXG4gICAgICAgICQoJ2Rpdi5zbGlkZXIgdWwgbGkuJyskbnRoKS5maW5kKCdhJykuYXR0cignaHJlZicsICR1cmwpO1xyXG4gICAgfSk7XHJcbiAgICAkKCdpbnB1dC5pbWFnZScpLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbigpe1xyXG4gICAgICAgIHZhciBpbWFnZSA9ICQodGhpcykudmFsKCk7XHJcbiAgICAgICAgdmFyIGltYWdlb25seSA9IGltYWdlLnRvTG93ZXJDYXNlKCkuc3BsaXQoXCIuXCIpO1xyXG4gICAgICAgIGlmKCBpbWFnZSAhPSAnJyApe1xyXG4gICAgICAgICAgICBpZiggaW1hZ2Vvbmx5WzFdICE9ICdqcGcnICYmIGltYWdlb25seVsxXSAhPSAncG5nJyAmJiBpbWFnZW9ubHlbMV0gIT0gJ2pwZWcnICYmIGltYWdlb25seVsxXSAhPSAnZ2lmJyAmJiBpbWFnZW9ubHlbMV0gIT0gJ2JtcCcpe1xyXG4gICAgICAgICAgICAgICAgYWxlcnQoJ+ydtOuvuOyngCDtjIzsnbzrp4wg7JeF66Gc65OcIOqwgOuKpe2VqeuLiOuLpCEnKTtcclxuICAgICAgICAgICAgICAgICQodGhpcykudmFsKCcnKTtcclxuICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAkbnRoID0gJCgnZGl2Lm50aCcpLmZpbmQoJ2lucHV0OmNoZWNrZWQnKS5hdHRyKCdpZCcpO1xyXG4gICAgICAgICAgICAgICAgdmFyIHJlYWRlciA9IG5ldyBGaWxlUmVhZGVyKCk7XHJcbiAgICAgICAgICAgICAgICByZWFkZXIub25sb2FkID0gZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnZGl2LnNsaWRlciB1bCBsaS4nKyRudGgpLmF0dHIoJ3N0eWxlJywgJ2JhY2tncm91bmQ6dXJsKCcrZS50YXJnZXQucmVzdWx0KycpIG5vLXJlcGVhdDsgYmFja2dyb3VuZC1zaXplOmNvdmVyOycpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwodGhpcy5maWxlc1swXSk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgaWYoICEkKCdkaXYuaW1hZ2UtbG9nbycpLmlzKCdpbWcnKSApe1xyXG4gICAgICAgICAgICAgICAgJCgnZGl2LmltYWdlLWxvZ28gaW1nJykucmVtb3ZlKCk7XHJcbiAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgJCgnZGl2LmltYWdlLWxvZ28gaW1nJykuYXR0cignc3JjJywgb3JpZ2luSW1nKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG4vL1JlY29tbWVuZFxyXG4gICAgZnVuY3Rpb24gUmVjb21tZW5kKCR0YXJnZXQsICRpbnB1dG5hbWUsICRwcm9kdWN0LCAkc2hvcCl7XHJcbiAgICAgICAgJCgnYS4nKyR0YXJnZXQpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgICAgIHZhciBpbWdTcmMgPSAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpLnByZXYoKS5wcmV2KCkuZmluZCgnaW1nJykuYXR0cignc3JjJyk7XHJcbiAgICAgICAgICAgIHZhciBwcm9kTmFtZSA9ICQodGhpcykucGFyZW50KCkucGFyZW50KCkucHJldigpLmZpbmQoJ2EnKS5odG1sKCk7XHJcbiAgICAgICAgICAgIHZhciBzaG9wTmFtZSA9ICQodGhpcykucGFyZW50KCkucGFyZW50KCkucHJldigpLmZpbmQoJ3Auc2hvcC1uYW1lJykuaHRtbCgpO1xyXG4gICAgICAgICAgICB2YXIgcHJvZHVjdElkID0gJCh0aGlzKS5uZXh0KCkuaHRtbCgpO1xyXG4gICAgICAgICAgICBvcGVuZXIuZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJHRhcmdldCkuc3R5bGU9XCJiYWNrZ3JvdW5kOnVybChcIitpbWdTcmMrXCIpIGNlbnRlciBuby1yZXBlYXQ7IGJhY2tncm91bmQtc2l6ZTpjb3ZlcjtcIjtcclxuICAgICAgICAgICAgb3BlbmVyLmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCRwcm9kdWN0KS5pbm5lckhUTUw9cHJvZE5hbWU7XHJcbiAgICAgICAgICAgIG9wZW5lci5kb2N1bWVudC5nZXRFbGVtZW50QnlJZCgkc2hvcCkuaW5uZXJIVE1MPXNob3BOYW1lO1xyXG4gICAgICAgICAgICBvcGVuZXIuZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJGlucHV0bmFtZSkudmFsdWU9cHJvZHVjdElkO1xyXG4gICAgICAgICAgICBzZWxmLmNsb3NlKCk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcbiAgICBSZWNvbW1lbmQoJ3JlY29tbWVuZDEnLCAncHJvZHVjdElkMScsICdwcm9kTmFtZTEnLCAnc2hvcE5hbWUxJyk7XHJcbiAgICBSZWNvbW1lbmQoJ3JlY29tbWVuZDInLCAncHJvZHVjdElkMicsICdwcm9kTmFtZTInLCAnc2hvcE5hbWUyJyk7XHJcbiAgICBSZWNvbW1lbmQoJ3JlY29tbWVuZDMnLCAncHJvZHVjdElkMycsICdwcm9kTmFtZTMnLCAnc2hvcE5hbWUzJyk7XHJcbiAgICBSZWNvbW1lbmQoJ3JlY29tbWVuZDQnLCAncHJvZHVjdElkNCcsICdwcm9kTmFtZTQnLCAnc2hvcE5hbWU0Jyk7XHJcbiAgICAkKCdhLnJjbS1zdWJtaXQnKS5jbGljayhmdW5jdGlvbigpe1xyXG4gICAgICAgICQoJ2Zvcm1bbmFtZT1cIm5ld1JlY29tbWVuZFwiXScpLnN1Ym1pdCgpO1xyXG4gICAgfSk7XHJcbiAgICAkKCdhLnJjbS1kZWxldGUnKS5jbGljayhmdW5jdGlvbigpe1xyXG4gICAgICAgICQoJ2Zvcm1bbmFtZT1cInJlY29tbWVuZC1kZWxcIl0nKS5zdWJtaXQoKTtcclxuICAgIH0pO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2FkbWluU2NyaXB0LmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);