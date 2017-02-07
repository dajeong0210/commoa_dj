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

eval("//Nav\r\n    $('a.menu_btn').on('click', function(){\r\n        $('ul.nav-group').toggleClass('show');\r\n        $(this).parent().addClass('active');\r\n    });\r\n    $('nav.admin-nav ul.nav-group > li > a').on('click', function(e){\r\n        e.preventDefault();\r\n        $(this).next('ul').toggleClass('not-show').toggleClass('hidden');\r\n    })\r\n//tab\r\n    $('ul.sort-list li').on('click', function(){\r\n        $(this).parent().find('li').removeClass('active');\r\n        $(this).addClass('active');\r\n        $('input#sortBy').val( $(this).attr('name') );\r\n        $('input#sortBy').parent().parent().submit();\r\n    });\r\n//Search\r\n    $('input[name=search]').on('keypress', function(e){\r\n        if( e.keyCode == 13 ){\r\n            $('form[name=searchForm]').submit();\r\n        }\r\n    });\r\n    $('input[name=search]').focus(function(){\r\n    $(this).parent('div').css('border', '1px solid rgba(43,222,115,1.0)').css('box-shadow', '0 0 15px rgba(43,222,115,0.3)');\r\n    }).blur(function(){\r\n        $(this).parent('div').css('border', '1px solid #ccc').css('box-shadow', 'none');\r\n    });\r\n//Category\r\n    //modify\r\n        $('div.category').on('click', 'em', function(){\r\n            $('input.modify').addClass('hidden');\r\n            $('div.category em').removeClass('hidden');\r\n            $(this).toggleClass('hidden');\r\n            $(this).next().toggleClass('hidden').focus();\r\n        });\r\n        $('li').on('focusout', 'input.modify', function(){\r\n            $nth = $(this).prev().prev().html();\r\n            $('input.modify').addClass('hidden');\r\n            $('div.category em').removeClass('hidden');\r\n            $(this).prev('em').html( $(this).val().replace(/(\\s*)/g, \"\") );\r\n            $('input[name=\"category'+$nth+'\"]').val($(this).val());\r\n        }).on('keypress', 'input.modify', function(e){\r\n            if(e.keyCode == 13){\r\n                $(this).focusout();\r\n                return false;\r\n            }\r\n        });\r\n        function Submit($target, $name){\r\n            $target.click(function(){\r\n                $('form[name=\"'+$name+'\"]').submit();\r\n            });\r\n        }\r\n        Submit( $('input.modify-btn'), 'modify' );\r\n\r\n    //delete\r\n        $('li').on('click', 'a.delete', function(e){\r\n            e.preventDefault();\r\n            if( $(this).parent('li').hasClass('create') ){\r\n                $(this).parent('li').remove();\r\n            }else{\r\n                $nth = $(this).prev().prev().prev().html();\r\n                var categoryId = { 'categoryId' : $nth }\r\n                $.ajaxSetup({\r\n                    headers: {\r\n                        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n                    }\r\n                });\r\n                $.ajax({\r\n                    type:'POST',\r\n                    url:'/categorycnt/'+$nth,\r\n                    data:categoryId,\r\n                    success:function(data){\r\n                        if( data == 0 ){\r\n                            if( confirm('정말 삭제하겠습니까?') == false ){\r\n                                return false;\r\n                            }\r\n                            $('form.delete'+$nth).submit();\r\n                        }else{\r\n                            alert('카테고리에 상품이 남아있어 지울 수 없습니다!');\r\n                        }\r\n                    },error:function(){\r\n\r\n                    }\r\n                });\r\n            }\r\n        });\r\n    //create\r\n        $('a.create').on('click', function(){\r\n            $(this).next('input').toggleClass('hidden');\r\n            $('input.create').focus();\r\n        });\r\n        $('input.create').on('focusout', function(){\r\n            if( $(this).val() != '' ){\r\n                // $(this).parent().parent().before('<li class=\"create\"><span>└</span><em class=\"name\">'+$(this).val()+'</em><input type=\"text\" class=\"modify hidden\" value=\"'+$(this).val()+'\"><a href=\"#\" class=\"delete\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></li>');\r\n                $('input[type=\"submit\"]').before('<input type=\"hidden\" class=\"modify hidden\" name=\"create[]\" value=\"'+$(this).val()+'\">');\r\n                $(this).val('');\r\n                $('form[name=\"modify\"]').submit();\r\n            }\r\n            $(this).addClass('hidden');\r\n        }).on('keypress', function(e){\r\n            if( e.keyCode == 13 ){\r\n                e.preventDefault();\r\n                $(this).focusout();\r\n            }\r\n        });\r\n//Cpu-vga\r\n    $('a.folder').on('click', function(e){\r\n        e.preventDefault();\r\n        $('a').removeClass('active');\r\n        $(this).parent().next().toggleClass('hidden');\r\n    })\r\n    $('a.create').on('click', function(e){\r\n        e.preventDefault();\r\n        $url = window.location.protocol+'//'+window.location.host;\r\n        $('a').removeClass('active');\r\n        $(this).addClass('active');\r\n        if( $(this).parent().hasClass('cpu') ){\r\n            $('form[name=\"cpuForm\"]').find('input[name=\"_method\"]').remove();\r\n            $('form[name=\"cpuForm\"] h3').html('CPU :: 추가하기');\r\n            $('form[name=\"cpuForm\"] input').not('[name=\"_token\"]').val('');\r\n            $('select[name=\"cpu_level\"] option').eq(0).prop(\"selected\", true);\r\n            $('form[name=\"cpuForm\"]').removeClass('hidden').attr('action' , $url+'/cpu').find('input[type=\"submit\"]').val('추가하기');\r\n            $('form[name=\"vgaForm\"]').addClass('hidden');\r\n        }else{\r\n            $('form[name=\"vgaForm\"]').find('input[name=\"_method\"]').remove();\r\n            $('form[name=\"vgaForm\"] h3').html('VGA :: 추가하기');\r\n            $('form[name=\"vgaForm\"] input').not('[name=\"_token\"]').val('');\r\n            $('select[name=\"vga_level\"] option').eq(0).prop(\"selected\", true);\r\n            $('form[name=\"vgaForm\"]').removeClass('hidden').attr('action' , $url+'/vga').find('input[type=\"submit\"]').val('추가하기');\r\n            $('form[name=\"cpuForm\"]').addClass('hidden');\r\n        }\r\n    })\r\n    //ajax -- form action && input value 값 각각 넣어주고 마지막에 submit\r\n    $('a.name').on('click', function(e){\r\n        e.preventDefault();\r\n        $('a').removeClass('active');\r\n        $(this).addClass('active');\r\n        $type = $(this).parent().attr('class');\r\n        $targetId = $(this).prev().html();\r\n        $url = window.location.protocol+'//'+window.location.host;\r\n        var dataArr = { 'type' : $type ,\r\n                        'id' : $targetId }\r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n        $.ajax({\r\n            type:'POST',\r\n            url:'/'+$type+'/'+$targetId,\r\n            data:dataArr,\r\n            success:function(data){\r\n                var dataArr = JSON.parse(data);\r\n                if( $type == 'cpu' ){\r\n                    $('form[name=\"cpuForm\"]').prepend('<input type=\"hidden\" name=\"_method\" value=\"put\">');\r\n                    $('form[name=\"cpuForm\"] h3').html('CPU :: '+dataArr.name);\r\n                    $('input[name=\"cpu_name\"]').val(dataArr.name);\r\n                    $('input[name=\"cpu_brand\"]').val(dataArr.brand);\r\n                    $('input[name=\"cpu_core\"]').val(dataArr.cores);\r\n                    $('select[name=\"cpu_level\"]').val(dataArr.level).prop(\"selected\", true);\r\n                    $('form[name=\"cpuForm\"]').removeClass('hidden').attr('action' , $url+'/cpu-edit/'+$targetId).find('input[type=\"submit\"]').val('수정하기');\r\n                    $('form[name=\"vgaForm\"]').addClass('hidden');\r\n                }else{\r\n                    $('form[name=\"vgaForm\"]').prepend('<input type=\"hidden\" name=\"_method\" value=\"put\">');\r\n                    $('form[name=\"vgaForm\"] h3').html('VGA :: '+dataArr.name);\r\n                    $('input[name=\"vga_name\"]').val(dataArr.name);\r\n                    $('input[name=\"vga_brand\"]').val(dataArr.brand);\r\n                    $('select[name=\"vga_level\"]').val(dataArr.level).prop(\"selected\", true);\r\n                    $('form[name=\"vgaForm\"]').removeClass('hidden').attr('action' , $url+'/vga-edit/'+$targetId);\r\n                    $('form[name=\"cpuForm\"]').addClass('hidden');\r\n                }\r\n            },error:function(){\r\n                console.log('error');\r\n            }\r\n        });\r\n    });\r\n    $('a.del').on('click', function(e){\r\n        e.preventDefault();\r\n        $nth = $(this).prev().prev().prev().html();\r\n        console.log($nth);\r\n        var dataArr = { 'targetId' : $nth }\r\n        $.ajaxSetup({\r\n            headers: {\r\n                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\r\n            }\r\n        });\r\n        if( $(this).parent('li').hasClass('cpu') ){\r\n            deleteAjax('cpu', dataArr, 'CPU');\r\n        }else{\r\n            deleteAjax('vga', dataArr, 'VGA');\r\n        }\r\n        function deleteAjax( $target, dataArr, $print){\r\n            $.ajax({\r\n                type:'POST',\r\n                url:'/'+$target+'-delete/'+$nth,\r\n                data:dataArr,\r\n                success:function(data){\r\n                    if( data == 0 ){\r\n                        if( confirm('정말 삭제하겠습니까?') == false ){\r\n                            return false;\r\n                        }\r\n                        $('form.'+$target+$nth).submit();\r\n                    }else{\r\n                        alert($print+'에 상품이 남아있어 지울 수 없습니다!');\r\n                    }\r\n                },error:function(){\r\n\r\n                }\r\n            });\r\n        }\r\n    });\r\n\r\n//Main\r\n    $('div.nth input').on('click', function(){\r\n        $nth = $(this).attr('id');\r\n        $('div.slider ul li.'+$nth).removeClass('hidden');\r\n        $('div.slider ul li').not('.'+$nth).addClass('hidden');\r\n        $url = window.location.protocol+'//'+window.location.host;\r\n        $('form[name=\"main-edit\"]').attr('action', $url+'/admin/banner/'+$nth.charAt(4));\r\n        $type = $('ul.slider li.'+$nth).find('span:first-child').html();\r\n        $title = $('ul.slider li.'+$nth).find('h3').html();\r\n        $content = $('ul.slider li.'+$nth).find('p').html();\r\n        $url = $('ul.slider li.'+$nth).find('a').attr('href');\r\n        $align = $('ul.slider li.'+$nth).find('span.hidden').html();\r\n        $('input[value=\"'+$type+'\"]').prop('checked', true);\r\n        $('textarea[name=\"title\"]').html($title.replace('<br>',''));\r\n        $('textarea[name=\"content\"]').html($content.replace('<br>',''));\r\n        $('input[name=\"url\"]').val($url);\r\n        $('input[value=\"'+$align+'\"]').prop('checked', true);\r\n    });\r\n    $('a.preview').on('click', function(e){\r\n        e.preventDefault();\r\n        $nth = $('div.nth').find('input:checked').attr('id');\r\n        $type = $('div.type').find('input:checked').prev().html();\r\n        $title = $('textarea[name=\"title\"]').val();\r\n        $content = $('textarea[name=\"content\"]').val();\r\n        $url = $('input[name=\"url\"]').val();\r\n        $('div.slider ul li.'+$nth).find('span').html($type);\r\n        $('div.slider ul li.'+$nth).find('h3').html($title.replace(/\\n/g, '<br/>'));\r\n        $('div.slider ul li.'+$nth).find('p').html($content.replace(/\\n/g, '<br/>'));\r\n        $('div.slider ul li.'+$nth).find('a').attr('href', $url);\r\n    });\r\n    $('input.image').on('change', function(){\r\n        var image = $(this).val();\r\n        var imageonly = image.toLowerCase().split(\".\");\r\n        if( image != '' ){\r\n            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){\r\n                alert('이미지 파일만 업로드 가능합니다!');\r\n                $(this).val('');\r\n            }else{\r\n                $nth = $('div.nth').find('input:checked').attr('id');\r\n                var reader = new FileReader();\r\n                reader.onload = function(e){\r\n                    $('div.slider ul li.'+$nth).attr('style', 'background:url('+e.target.result+') no-repeat; background-size:cover;');\r\n                }\r\n                reader.readAsDataURL(this.files[0]);\r\n            }\r\n        }else{\r\n            if( !$('div.image-logo').is('img') ){\r\n                $('div.image-logo img').remove();\r\n            }else{\r\n                $('div.image-logo img').attr('src', originImg);\r\n            }\r\n        }\r\n    });\r\n//Recommend\r\nfunction Recommend($target, $inputname){\r\n    $('a.'+$target).on('click', function(e){\r\n        console.log('dpd');\r\n        e.preventDefault();\r\n        var imgSrc = $(this).parent().parent().prev().prev().find('img').attr('src'); \r\n        var productId = $(this).next().html();\r\n        opener.document.getElementById($target).src=imgSrc;\r\n        opener.document.getElementsByName($inputname).value=productId;\r\n        self.close();\r\n    });\r\n}\r\nRecommend('recommend1', 'productId1');\r\nRecommend('recommend2', 'productId2');\r\nRecommend('recommend3', 'productId3');\r\nRecommend('recommend4', 'productId4');//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2FkbWluU2NyaXB0LmpzPzcwMmYiXSwic291cmNlc0NvbnRlbnQiOlsiLy9OYXZcclxuICAgICQoJ2EubWVudV9idG4nKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICQoJ3VsLm5hdi1ncm91cCcpLnRvZ2dsZUNsYXNzKCdzaG93Jyk7XHJcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcbiAgICB9KTtcclxuICAgICQoJ25hdi5hZG1pbi1uYXYgdWwubmF2LWdyb3VwID4gbGkgPiBhJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICQodGhpcykubmV4dCgndWwnKS50b2dnbGVDbGFzcygnbm90LXNob3cnKS50b2dnbGVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICB9KVxyXG4vL3RhYlxyXG4gICAgJCgndWwuc29ydC1saXN0IGxpJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLmZpbmQoJ2xpJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQodGhpcykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQoJ2lucHV0I3NvcnRCeScpLnZhbCggJCh0aGlzKS5hdHRyKCduYW1lJykgKTtcclxuICAgICAgICAkKCdpbnB1dCNzb3J0QnknKS5wYXJlbnQoKS5wYXJlbnQoKS5zdWJtaXQoKTtcclxuICAgIH0pO1xyXG4vL1NlYXJjaFxyXG4gICAgJCgnaW5wdXRbbmFtZT1zZWFyY2hdJykub24oJ2tleXByZXNzJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgaWYoIGUua2V5Q29kZSA9PSAxMyApe1xyXG4gICAgICAgICAgICAkKCdmb3JtW25hbWU9c2VhcmNoRm9ybV0nKS5zdWJtaXQoKTtcclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuICAgICQoJ2lucHV0W25hbWU9c2VhcmNoXScpLmZvY3VzKGZ1bmN0aW9uKCl7XHJcbiAgICAkKHRoaXMpLnBhcmVudCgnZGl2JykuY3NzKCdib3JkZXInLCAnMXB4IHNvbGlkIHJnYmEoNDMsMjIyLDExNSwxLjApJykuY3NzKCdib3gtc2hhZG93JywgJzAgMCAxNXB4IHJnYmEoNDMsMjIyLDExNSwwLjMpJyk7XHJcbiAgICB9KS5ibHVyKGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoJ2RpdicpLmNzcygnYm9yZGVyJywgJzFweCBzb2xpZCAjY2NjJykuY3NzKCdib3gtc2hhZG93JywgJ25vbmUnKTtcclxuICAgIH0pO1xyXG4vL0NhdGVnb3J5XHJcbiAgICAvL21vZGlmeVxyXG4gICAgICAgICQoJ2Rpdi5jYXRlZ29yeScpLm9uKCdjbGljaycsICdlbScsIGZ1bmN0aW9uKCl7XHJcbiAgICAgICAgICAgICQoJ2lucHV0Lm1vZGlmeScpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgJCgnZGl2LmNhdGVnb3J5IGVtJykucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAkKHRoaXMpLnRvZ2dsZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgJCh0aGlzKS5uZXh0KCkudG9nZ2xlQ2xhc3MoJ2hpZGRlbicpLmZvY3VzKCk7XHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgJCgnbGknKS5vbignZm9jdXNvdXQnLCAnaW5wdXQubW9kaWZ5JywgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgJG50aCA9ICQodGhpcykucHJldigpLnByZXYoKS5odG1sKCk7XHJcbiAgICAgICAgICAgICQoJ2lucHV0Lm1vZGlmeScpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgJCgnZGl2LmNhdGVnb3J5IGVtJykucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAkKHRoaXMpLnByZXYoJ2VtJykuaHRtbCggJCh0aGlzKS52YWwoKS5yZXBsYWNlKC8oXFxzKikvZywgXCJcIikgKTtcclxuICAgICAgICAgICAgJCgnaW5wdXRbbmFtZT1cImNhdGVnb3J5JyskbnRoKydcIl0nKS52YWwoJCh0aGlzKS52YWwoKSk7XHJcbiAgICAgICAgfSkub24oJ2tleXByZXNzJywgJ2lucHV0Lm1vZGlmeScsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgICAgICBpZihlLmtleUNvZGUgPT0gMTMpe1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS5mb2N1c291dCgpO1xyXG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgZnVuY3Rpb24gU3VibWl0KCR0YXJnZXQsICRuYW1lKXtcclxuICAgICAgICAgICAgJHRhcmdldC5jbGljayhmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwiJyskbmFtZSsnXCJdJykuc3VibWl0KCk7XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH1cclxuICAgICAgICBTdWJtaXQoICQoJ2lucHV0Lm1vZGlmeS1idG4nKSwgJ21vZGlmeScgKTtcclxuXHJcbiAgICAvL2RlbGV0ZVxyXG4gICAgICAgICQoJ2xpJykub24oJ2NsaWNrJywgJ2EuZGVsZXRlJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgaWYoICQodGhpcykucGFyZW50KCdsaScpLmhhc0NsYXNzKCdjcmVhdGUnKSApe1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS5wYXJlbnQoJ2xpJykucmVtb3ZlKCk7XHJcbiAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgJG50aCA9ICQodGhpcykucHJldigpLnByZXYoKS5wcmV2KCkuaHRtbCgpO1xyXG4gICAgICAgICAgICAgICAgdmFyIGNhdGVnb3J5SWQgPSB7ICdjYXRlZ29yeUlkJyA6ICRudGggfVxyXG4gICAgICAgICAgICAgICAgJC5hamF4U2V0dXAoe1xyXG4gICAgICAgICAgICAgICAgICAgIGhlYWRlcnM6IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgICQuYWpheCh7XHJcbiAgICAgICAgICAgICAgICAgICAgdHlwZTonUE9TVCcsXHJcbiAgICAgICAgICAgICAgICAgICAgdXJsOicvY2F0ZWdvcnljbnQvJyskbnRoLFxyXG4gICAgICAgICAgICAgICAgICAgIGRhdGE6Y2F0ZWdvcnlJZCxcclxuICAgICAgICAgICAgICAgICAgICBzdWNjZXNzOmZ1bmN0aW9uKGRhdGEpe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBpZiggZGF0YSA9PSAwICl7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBpZiggY29uZmlybSgn7KCV66eQIOyCreygnO2VmOqyoOyKteuLiOq5jD8nKSA9PSBmYWxzZSApe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICQoJ2Zvcm0uZGVsZXRlJyskbnRoKS5zdWJtaXQoKTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBhbGVydCgn7Lm07YWM6rOg66as7JeQIOyDge2SiOydtCDrgqjslYTsnojslrQg7KeA7Jq4IOyImCDsl4bsirXri4jri6QhJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9LGVycm9yOmZ1bmN0aW9uKCl7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICAvL2NyZWF0ZVxyXG4gICAgICAgICQoJ2EuY3JlYXRlJykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgJCh0aGlzKS5uZXh0KCdpbnB1dCcpLnRvZ2dsZUNsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgJCgnaW5wdXQuY3JlYXRlJykuZm9jdXMoKTtcclxuICAgICAgICB9KTtcclxuICAgICAgICAkKCdpbnB1dC5jcmVhdGUnKS5vbignZm9jdXNvdXQnLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICBpZiggJCh0aGlzKS52YWwoKSAhPSAnJyApe1xyXG4gICAgICAgICAgICAgICAgLy8gJCh0aGlzKS5wYXJlbnQoKS5wYXJlbnQoKS5iZWZvcmUoJzxsaSBjbGFzcz1cImNyZWF0ZVwiPjxzcGFuPuKUlDwvc3Bhbj48ZW0gY2xhc3M9XCJuYW1lXCI+JyskKHRoaXMpLnZhbCgpKyc8L2VtPjxpbnB1dCB0eXBlPVwidGV4dFwiIGNsYXNzPVwibW9kaWZ5IGhpZGRlblwiIHZhbHVlPVwiJyskKHRoaXMpLnZhbCgpKydcIj48YSBocmVmPVwiI1wiIGNsYXNzPVwiZGVsZXRlXCI+PGkgY2xhc3M9XCJmYSBmYS10aW1lc1wiIGFyaWEtaGlkZGVuPVwidHJ1ZVwiPjwvaT48L2E+PC9saT4nKTtcclxuICAgICAgICAgICAgICAgICQoJ2lucHV0W3R5cGU9XCJzdWJtaXRcIl0nKS5iZWZvcmUoJzxpbnB1dCB0eXBlPVwiaGlkZGVuXCIgY2xhc3M9XCJtb2RpZnkgaGlkZGVuXCIgbmFtZT1cImNyZWF0ZVtdXCIgdmFsdWU9XCInKyQodGhpcykudmFsKCkrJ1wiPicpO1xyXG4gICAgICAgICAgICAgICAgJCh0aGlzKS52YWwoJycpO1xyXG4gICAgICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwibW9kaWZ5XCJdJykuc3VibWl0KCk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgfSkub24oJ2tleXByZXNzJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgICAgIGlmKCBlLmtleUNvZGUgPT0gMTMgKXtcclxuICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcclxuICAgICAgICAgICAgICAgICQodGhpcykuZm9jdXNvdXQoKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4vL0NwdS12Z2FcclxuICAgICQoJ2EuZm9sZGVyJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICQoJ2EnKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5uZXh0KCkudG9nZ2xlQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgfSlcclxuICAgICQoJ2EuY3JlYXRlJykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICR1cmwgPSB3aW5kb3cubG9jYXRpb24ucHJvdG9jb2wrJy8vJyt3aW5kb3cubG9jYXRpb24uaG9zdDtcclxuICAgICAgICAkKCdhJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgICQodGhpcykuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xyXG4gICAgICAgIGlmKCAkKHRoaXMpLnBhcmVudCgpLmhhc0NsYXNzKCdjcHUnKSApe1xyXG4gICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJjcHVGb3JtXCJdJykuZmluZCgnaW5wdXRbbmFtZT1cIl9tZXRob2RcIl0nKS5yZW1vdmUoKTtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwiY3B1Rm9ybVwiXSBoMycpLmh0bWwoJ0NQVSA6OiDstpTqsIDtlZjquLAnKTtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwiY3B1Rm9ybVwiXSBpbnB1dCcpLm5vdCgnW25hbWU9XCJfdG9rZW5cIl0nKS52YWwoJycpO1xyXG4gICAgICAgICAgICAkKCdzZWxlY3RbbmFtZT1cImNwdV9sZXZlbFwiXSBvcHRpb24nKS5lcSgwKS5wcm9wKFwic2VsZWN0ZWRcIiwgdHJ1ZSk7XHJcbiAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cImNwdUZvcm1cIl0nKS5yZW1vdmVDbGFzcygnaGlkZGVuJykuYXR0cignYWN0aW9uJyAsICR1cmwrJy9jcHUnKS5maW5kKCdpbnB1dFt0eXBlPVwic3VibWl0XCJdJykudmFsKCfstpTqsIDtlZjquLAnKTtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwidmdhRm9ybVwiXScpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwidmdhRm9ybVwiXScpLmZpbmQoJ2lucHV0W25hbWU9XCJfbWV0aG9kXCJdJykucmVtb3ZlKCk7XHJcbiAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cInZnYUZvcm1cIl0gaDMnKS5odG1sKCdWR0EgOjog7LaU6rCA7ZWY6riwJyk7XHJcbiAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cInZnYUZvcm1cIl0gaW5wdXQnKS5ub3QoJ1tuYW1lPVwiX3Rva2VuXCJdJykudmFsKCcnKTtcclxuICAgICAgICAgICAgJCgnc2VsZWN0W25hbWU9XCJ2Z2FfbGV2ZWxcIl0gb3B0aW9uJykuZXEoMCkucHJvcChcInNlbGVjdGVkXCIsIHRydWUpO1xyXG4gICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJ2Z2FGb3JtXCJdJykucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpLmF0dHIoJ2FjdGlvbicgLCAkdXJsKycvdmdhJykuZmluZCgnaW5wdXRbdHlwZT1cInN1Ym1pdFwiXScpLnZhbCgn7LaU6rCA7ZWY6riwJyk7XHJcbiAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cImNwdUZvcm1cIl0nKS5hZGRDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgfVxyXG4gICAgfSlcclxuICAgIC8vYWpheCAtLSBmb3JtIGFjdGlvbiAmJiBpbnB1dCB2YWx1ZSDqsJIg6rCB6rCBIOuEo+yWtOyjvOqzoCDrp4jsp4Drp4nsl5Agc3VibWl0XHJcbiAgICAkKCdhLm5hbWUnKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgJCgnYScpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxuICAgICAgICAkdHlwZSA9ICQodGhpcykucGFyZW50KCkuYXR0cignY2xhc3MnKTtcclxuICAgICAgICAkdGFyZ2V0SWQgPSAkKHRoaXMpLnByZXYoKS5odG1sKCk7XHJcbiAgICAgICAgJHVybCA9IHdpbmRvdy5sb2NhdGlvbi5wcm90b2NvbCsnLy8nK3dpbmRvdy5sb2NhdGlvbi5ob3N0O1xyXG4gICAgICAgIHZhciBkYXRhQXJyID0geyAndHlwZScgOiAkdHlwZSAsXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICdpZCcgOiAkdGFyZ2V0SWQgfVxyXG4gICAgICAgICQuYWpheFNldHVwKHtcclxuICAgICAgICAgICAgaGVhZGVyczoge1xyXG4gICAgICAgICAgICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0pO1xyXG4gICAgICAgICQuYWpheCh7XHJcbiAgICAgICAgICAgIHR5cGU6J1BPU1QnLFxyXG4gICAgICAgICAgICB1cmw6Jy8nKyR0eXBlKycvJyskdGFyZ2V0SWQsXHJcbiAgICAgICAgICAgIGRhdGE6ZGF0YUFycixcclxuICAgICAgICAgICAgc3VjY2VzczpmdW5jdGlvbihkYXRhKXtcclxuICAgICAgICAgICAgICAgIHZhciBkYXRhQXJyID0gSlNPTi5wYXJzZShkYXRhKTtcclxuICAgICAgICAgICAgICAgIGlmKCAkdHlwZSA9PSAnY3B1JyApe1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cImNwdUZvcm1cIl0nKS5wcmVwZW5kKCc8aW5wdXQgdHlwZT1cImhpZGRlblwiIG5hbWU9XCJfbWV0aG9kXCIgdmFsdWU9XCJwdXRcIj4nKTtcclxuICAgICAgICAgICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJjcHVGb3JtXCJdIGgzJykuaHRtbCgnQ1BVIDo6ICcrZGF0YUFyci5uYW1lKTtcclxuICAgICAgICAgICAgICAgICAgICAkKCdpbnB1dFtuYW1lPVwiY3B1X25hbWVcIl0nKS52YWwoZGF0YUFyci5uYW1lKTtcclxuICAgICAgICAgICAgICAgICAgICAkKCdpbnB1dFtuYW1lPVwiY3B1X2JyYW5kXCJdJykudmFsKGRhdGFBcnIuYnJhbmQpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2lucHV0W25hbWU9XCJjcHVfY29yZVwiXScpLnZhbChkYXRhQXJyLmNvcmVzKTtcclxuICAgICAgICAgICAgICAgICAgICAkKCdzZWxlY3RbbmFtZT1cImNwdV9sZXZlbFwiXScpLnZhbChkYXRhQXJyLmxldmVsKS5wcm9wKFwic2VsZWN0ZWRcIiwgdHJ1ZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwiY3B1Rm9ybVwiXScpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKS5hdHRyKCdhY3Rpb24nICwgJHVybCsnL2NwdS1lZGl0LycrJHRhcmdldElkKS5maW5kKCdpbnB1dFt0eXBlPVwic3VibWl0XCJdJykudmFsKCfsiJjsoJXtlZjquLAnKTtcclxuICAgICAgICAgICAgICAgICAgICAkKCdmb3JtW25hbWU9XCJ2Z2FGb3JtXCJdJykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwidmdhRm9ybVwiXScpLnByZXBlbmQoJzxpbnB1dCB0eXBlPVwiaGlkZGVuXCIgbmFtZT1cIl9tZXRob2RcIiB2YWx1ZT1cInB1dFwiPicpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cInZnYUZvcm1cIl0gaDMnKS5odG1sKCdWR0EgOjogJytkYXRhQXJyLm5hbWUpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2lucHV0W25hbWU9XCJ2Z2FfbmFtZVwiXScpLnZhbChkYXRhQXJyLm5hbWUpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2lucHV0W25hbWU9XCJ2Z2FfYnJhbmRcIl0nKS52YWwoZGF0YUFyci5icmFuZCk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnc2VsZWN0W25hbWU9XCJ2Z2FfbGV2ZWxcIl0nKS52YWwoZGF0YUFyci5sZXZlbCkucHJvcChcInNlbGVjdGVkXCIsIHRydWUpO1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2Zvcm1bbmFtZT1cInZnYUZvcm1cIl0nKS5yZW1vdmVDbGFzcygnaGlkZGVuJykuYXR0cignYWN0aW9uJyAsICR1cmwrJy92Z2EtZWRpdC8nKyR0YXJnZXRJZCk7XHJcbiAgICAgICAgICAgICAgICAgICAgJCgnZm9ybVtuYW1lPVwiY3B1Rm9ybVwiXScpLmFkZENsYXNzKCdoaWRkZW4nKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfSxlcnJvcjpmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgY29uc29sZS5sb2coJ2Vycm9yJyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH0pO1xyXG4gICAgJCgnYS5kZWwnKS5vbignY2xpY2snLCBmdW5jdGlvbihlKXtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgJG50aCA9ICQodGhpcykucHJldigpLnByZXYoKS5wcmV2KCkuaHRtbCgpO1xyXG4gICAgICAgIGNvbnNvbGUubG9nKCRudGgpO1xyXG4gICAgICAgIHZhciBkYXRhQXJyID0geyAndGFyZ2V0SWQnIDogJG50aCB9XHJcbiAgICAgICAgJC5hamF4U2V0dXAoe1xyXG4gICAgICAgICAgICBoZWFkZXJzOiB7XHJcbiAgICAgICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogJCgnbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmF0dHIoJ2NvbnRlbnQnKVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSk7XHJcbiAgICAgICAgaWYoICQodGhpcykucGFyZW50KCdsaScpLmhhc0NsYXNzKCdjcHUnKSApe1xyXG4gICAgICAgICAgICBkZWxldGVBamF4KCdjcHUnLCBkYXRhQXJyLCAnQ1BVJyk7XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIGRlbGV0ZUFqYXgoJ3ZnYScsIGRhdGFBcnIsICdWR0EnKTtcclxuICAgICAgICB9XHJcbiAgICAgICAgZnVuY3Rpb24gZGVsZXRlQWpheCggJHRhcmdldCwgZGF0YUFyciwgJHByaW50KXtcclxuICAgICAgICAgICAgJC5hamF4KHtcclxuICAgICAgICAgICAgICAgIHR5cGU6J1BPU1QnLFxyXG4gICAgICAgICAgICAgICAgdXJsOicvJyskdGFyZ2V0KyctZGVsZXRlLycrJG50aCxcclxuICAgICAgICAgICAgICAgIGRhdGE6ZGF0YUFycixcclxuICAgICAgICAgICAgICAgIHN1Y2Nlc3M6ZnVuY3Rpb24oZGF0YSl7XHJcbiAgICAgICAgICAgICAgICAgICAgaWYoIGRhdGEgPT0gMCApe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBpZiggY29uZmlybSgn7KCV66eQIOyCreygnO2VmOqyoOyKteuLiOq5jD8nKSA9PSBmYWxzZSApe1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICQoJ2Zvcm0uJyskdGFyZ2V0KyRudGgpLnN1Ym1pdCgpO1xyXG4gICAgICAgICAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBhbGVydCgkcHJpbnQrJ+yXkCDsg4HtkojsnbQg64Ko7JWE7J6I7Ja0IOyngOyauCDsiJgg7JeG7Iq164uI64ukIScpO1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIH0sZXJyb3I6ZnVuY3Rpb24oKXtcclxuXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG5cclxuLy9NYWluXHJcbiAgICAkKCdkaXYubnRoIGlucHV0Jykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICAkbnRoID0gJCh0aGlzKS5hdHRyKCdpZCcpO1xyXG4gICAgICAgICQoJ2Rpdi5zbGlkZXIgdWwgbGkuJyskbnRoKS5yZW1vdmVDbGFzcygnaGlkZGVuJyk7XHJcbiAgICAgICAgJCgnZGl2LnNsaWRlciB1bCBsaScpLm5vdCgnLicrJG50aCkuYWRkQ2xhc3MoJ2hpZGRlbicpO1xyXG4gICAgICAgICR1cmwgPSB3aW5kb3cubG9jYXRpb24ucHJvdG9jb2wrJy8vJyt3aW5kb3cubG9jYXRpb24uaG9zdDtcclxuICAgICAgICAkKCdmb3JtW25hbWU9XCJtYWluLWVkaXRcIl0nKS5hdHRyKCdhY3Rpb24nLCAkdXJsKycvYWRtaW4vYmFubmVyLycrJG50aC5jaGFyQXQoNCkpO1xyXG4gICAgICAgICR0eXBlID0gJCgndWwuc2xpZGVyIGxpLicrJG50aCkuZmluZCgnc3BhbjpmaXJzdC1jaGlsZCcpLmh0bWwoKTtcclxuICAgICAgICAkdGl0bGUgPSAkKCd1bC5zbGlkZXIgbGkuJyskbnRoKS5maW5kKCdoMycpLmh0bWwoKTtcclxuICAgICAgICAkY29udGVudCA9ICQoJ3VsLnNsaWRlciBsaS4nKyRudGgpLmZpbmQoJ3AnKS5odG1sKCk7XHJcbiAgICAgICAgJHVybCA9ICQoJ3VsLnNsaWRlciBsaS4nKyRudGgpLmZpbmQoJ2EnKS5hdHRyKCdocmVmJyk7XHJcbiAgICAgICAgJGFsaWduID0gJCgndWwuc2xpZGVyIGxpLicrJG50aCkuZmluZCgnc3Bhbi5oaWRkZW4nKS5odG1sKCk7XHJcbiAgICAgICAgJCgnaW5wdXRbdmFsdWU9XCInKyR0eXBlKydcIl0nKS5wcm9wKCdjaGVja2VkJywgdHJ1ZSk7XHJcbiAgICAgICAgJCgndGV4dGFyZWFbbmFtZT1cInRpdGxlXCJdJykuaHRtbCgkdGl0bGUucmVwbGFjZSgnPGJyPicsJycpKTtcclxuICAgICAgICAkKCd0ZXh0YXJlYVtuYW1lPVwiY29udGVudFwiXScpLmh0bWwoJGNvbnRlbnQucmVwbGFjZSgnPGJyPicsJycpKTtcclxuICAgICAgICAkKCdpbnB1dFtuYW1lPVwidXJsXCJdJykudmFsKCR1cmwpO1xyXG4gICAgICAgICQoJ2lucHV0W3ZhbHVlPVwiJyskYWxpZ24rJ1wiXScpLnByb3AoJ2NoZWNrZWQnLCB0cnVlKTtcclxuICAgIH0pO1xyXG4gICAgJCgnYS5wcmV2aWV3Jykub24oJ2NsaWNrJywgZnVuY3Rpb24oZSl7XHJcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG4gICAgICAgICRudGggPSAkKCdkaXYubnRoJykuZmluZCgnaW5wdXQ6Y2hlY2tlZCcpLmF0dHIoJ2lkJyk7XHJcbiAgICAgICAgJHR5cGUgPSAkKCdkaXYudHlwZScpLmZpbmQoJ2lucHV0OmNoZWNrZWQnKS5wcmV2KCkuaHRtbCgpO1xyXG4gICAgICAgICR0aXRsZSA9ICQoJ3RleHRhcmVhW25hbWU9XCJ0aXRsZVwiXScpLnZhbCgpO1xyXG4gICAgICAgICRjb250ZW50ID0gJCgndGV4dGFyZWFbbmFtZT1cImNvbnRlbnRcIl0nKS52YWwoKTtcclxuICAgICAgICAkdXJsID0gJCgnaW5wdXRbbmFtZT1cInVybFwiXScpLnZhbCgpO1xyXG4gICAgICAgICQoJ2Rpdi5zbGlkZXIgdWwgbGkuJyskbnRoKS5maW5kKCdzcGFuJykuaHRtbCgkdHlwZSk7XHJcbiAgICAgICAgJCgnZGl2LnNsaWRlciB1bCBsaS4nKyRudGgpLmZpbmQoJ2gzJykuaHRtbCgkdGl0bGUucmVwbGFjZSgvXFxuL2csICc8YnIvPicpKTtcclxuICAgICAgICAkKCdkaXYuc2xpZGVyIHVsIGxpLicrJG50aCkuZmluZCgncCcpLmh0bWwoJGNvbnRlbnQucmVwbGFjZSgvXFxuL2csICc8YnIvPicpKTtcclxuICAgICAgICAkKCdkaXYuc2xpZGVyIHVsIGxpLicrJG50aCkuZmluZCgnYScpLmF0dHIoJ2hyZWYnLCAkdXJsKTtcclxuICAgIH0pO1xyXG4gICAgJCgnaW5wdXQuaW1hZ2UnKS5vbignY2hhbmdlJywgZnVuY3Rpb24oKXtcclxuICAgICAgICB2YXIgaW1hZ2UgPSAkKHRoaXMpLnZhbCgpO1xyXG4gICAgICAgIHZhciBpbWFnZW9ubHkgPSBpbWFnZS50b0xvd2VyQ2FzZSgpLnNwbGl0KFwiLlwiKTtcclxuICAgICAgICBpZiggaW1hZ2UgIT0gJycgKXtcclxuICAgICAgICAgICAgaWYoIGltYWdlb25seVsxXSAhPSAnanBnJyAmJiBpbWFnZW9ubHlbMV0gIT0gJ3BuZycgJiYgaW1hZ2Vvbmx5WzFdICE9ICdqcGVnJyAmJiBpbWFnZW9ubHlbMV0gIT0gJ2dpZicgJiYgaW1hZ2Vvbmx5WzFdICE9ICdibXAnKXtcclxuICAgICAgICAgICAgICAgIGFsZXJ0KCfsnbTrr7jsp4Ag7YyM7J2866eMIOyXheuhnOuTnCDqsIDriqXtlanri4jri6QhJyk7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXMpLnZhbCgnJyk7XHJcbiAgICAgICAgICAgIH1lbHNle1xyXG4gICAgICAgICAgICAgICAgJG50aCA9ICQoJ2Rpdi5udGgnKS5maW5kKCdpbnB1dDpjaGVja2VkJykuYXR0cignaWQnKTtcclxuICAgICAgICAgICAgICAgIHZhciByZWFkZXIgPSBuZXcgRmlsZVJlYWRlcigpO1xyXG4gICAgICAgICAgICAgICAgcmVhZGVyLm9ubG9hZCA9IGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgICAgICAgICAgICAgICQoJ2Rpdi5zbGlkZXIgdWwgbGkuJyskbnRoKS5hdHRyKCdzdHlsZScsICdiYWNrZ3JvdW5kOnVybCgnK2UudGFyZ2V0LnJlc3VsdCsnKSBuby1yZXBlYXQ7IGJhY2tncm91bmQtc2l6ZTpjb3ZlcjsnKTtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgIHJlYWRlci5yZWFkQXNEYXRhVVJMKHRoaXMuZmlsZXNbMF0pO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfWVsc2V7XHJcbiAgICAgICAgICAgIGlmKCAhJCgnZGl2LmltYWdlLWxvZ28nKS5pcygnaW1nJykgKXtcclxuICAgICAgICAgICAgICAgICQoJ2Rpdi5pbWFnZS1sb2dvIGltZycpLnJlbW92ZSgpO1xyXG4gICAgICAgICAgICB9ZWxzZXtcclxuICAgICAgICAgICAgICAgICQoJ2Rpdi5pbWFnZS1sb2dvIGltZycpLmF0dHIoJ3NyYycsIG9yaWdpbkltZyk7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9KTtcclxuLy9SZWNvbW1lbmRcclxuZnVuY3Rpb24gUmVjb21tZW5kKCR0YXJnZXQsICRpbnB1dG5hbWUpe1xyXG4gICAgJCgnYS4nKyR0YXJnZXQpLm9uKCdjbGljaycsIGZ1bmN0aW9uKGUpe1xyXG4gICAgICAgIGNvbnNvbGUubG9nKCdkcGQnKTtcclxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XHJcbiAgICAgICAgdmFyIGltZ1NyYyA9ICQodGhpcykucGFyZW50KCkucGFyZW50KCkucHJldigpLnByZXYoKS5maW5kKCdpbWcnKS5hdHRyKCdzcmMnKTsgXHJcbiAgICAgICAgdmFyIHByb2R1Y3RJZCA9ICQodGhpcykubmV4dCgpLmh0bWwoKTtcclxuICAgICAgICBvcGVuZXIuZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJHRhcmdldCkuc3JjPWltZ1NyYztcclxuICAgICAgICBvcGVuZXIuZG9jdW1lbnQuZ2V0RWxlbWVudHNCeU5hbWUoJGlucHV0bmFtZSkudmFsdWU9cHJvZHVjdElkO1xyXG4gICAgICAgIHNlbGYuY2xvc2UoKTtcclxuICAgIH0pO1xyXG59XHJcblJlY29tbWVuZCgncmVjb21tZW5kMScsICdwcm9kdWN0SWQxJyk7XHJcblJlY29tbWVuZCgncmVjb21tZW5kMicsICdwcm9kdWN0SWQyJyk7XHJcblJlY29tbWVuZCgncmVjb21tZW5kMycsICdwcm9kdWN0SWQzJyk7XHJcblJlY29tbWVuZCgncmVjb21tZW5kNCcsICdwcm9kdWN0SWQ0Jyk7XG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvYWRtaW5TY3JpcHQuanMiXSwibWFwcGluZ3MiOiJBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7OztBQUdBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);