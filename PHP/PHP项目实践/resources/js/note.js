$(document).ready(function(){
	setUserId();

	//为连接加上userId值
	function setUserId(){
		var userId = getUrlParam('userId');
		$('#HTML-home').attr('href', 'home.html?userId='+userId);
		$('#HTML-user').attr('href', 'user.html?userId='+userId);
		$('#HTML-note').attr('href', 'note.html?userId='+userId);
	}
	
// ------------------------笔记左边导航-----------------------------------
	//生成笔记预览界面
	$(document).on('click', '#note-preview',function () {
		var userId = getUrlParam('userId');
		listClickChange($(this));
		var noteTotalNum = 0;         //该用户的笔记总条数
		//获取该用户的笔记总条数
		$.ajax({
	        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getNoteNum',
	        type: 'GET', 
	        async : false ,            //全局变量赋值，同步
	        data:{},
	        success:function(data){
	        	data=JSON.parse(data);
	            if(data.resultCode == 1){
	            	noteTotalNum = data.data;
	            }else{
	            	alert("获取该用户的笔记总条数失败〒_〒！")
	            }
	        },
	        error:function(){
	            alert("请求失败！");
	        }
	    });
		var note_preview_empty_text = '<div id="right">'
		+'	<div class="right-title">笔记预览</div>'
		+'	<div id="note-preview-body">'
		+'		<div id="note-empty">'
		+'			<img src="images/note/haizeiwang.png"  width="420px" height="420px">'
		+'		</div>'
		+'	</div>'
		+'</div>';
		var note_preview_text = '<div id="right">'
		+'	<div class="right-title">笔记预览</div>'
		+'	<div id="note-preview-body">'
		+'		<table id="right-search" width="100%">'
		+'			<tr id="search-choose">	'
		+'				<td>'
		+'					<li class="no-selected"><span id="search-all">全部</span></li>'
		+'					<li class="no-selected"><span id="search-by-notebook">按笔记本</span></li>'
		+'					<li class="no-selected"><span id="search-by-label">按标签</span></li>'
		+'				</td>'						
		+'			</tr>'	
		+'		</table>'
		+'		<hr id="h" align="center" width="100%" color="#f1f5eb" size="1px">'
		+'		<div id="note-preview-content"></div>'
		+'		<div id="selector"></div>'
		+'	</div>'
		+'</div>';
		if(noteTotalNum==0){
			$('#left').after(note_preview_empty_text);
		}else{
			$('#left').after(note_preview_text);
		}
		$('#search-all').click();
	});
	$('#note-preview').click();

	//生成编辑笔记界面
	$(document).on('click', '#note-edit',function () {
		listClickChange($(this));
		var userId = getUrlParam('userId');
		var note_edit_text = '<div id="right">'
		+'	<div class="right-title">随堂笔记</div>'
		+'		<iframe id="iframe-page" src="note-edit-summernote.html?userId='+userId+'" height="560px" width="100%" scrolling="no"></iframe>'
		+'	</div>'	
		+'</div>';
		$('#left').after(note_edit_text);
	});
 	//----------------------公共调用函数部分----------------------
	//个人设置页面的左边导航栏，选中和不选中的样式改变
	function listClickChange(a){
		$('.no-chose').removeClass('chose');
		a.children().addClass('chose');
		$('#right').remove();
	}


// ------------------------笔记右边内容-----------------------------------
// ------------笔记右边内容-笔记预览----------------
	//搜索该用户的所有笔记信息
	$(document).on('click', '#search-all',function () {
		listSelectChange($(this));	
		var userId = getUrlParam('userId');    
		var numPerPage = 4;           //每页显示的条数
		var noteTotalNum = 0;         //该用户的笔记总条数
		//获取该用户的笔记总条数
		$.ajax({
	        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getNoteNum',
	        type: 'GET', 
	        async : false ,            //全局变量赋值，同步
	        data:{},
	        success:function(data){
	        	data=JSON.parse(data);
	            if(data.resultCode == 1){
	            	noteTotalNum = data.data;
	            }else{
	            	alert("获取该用户的笔记总条数失败〒_〒！")
	            }
	        },
	        error:function(){
	            alert("请求失败！");
	        }
	    });

		//分页
		pageStyle();                                //调用分页的公共样式
		$(selector).pagination({
	        items: noteTotalNum,                    //总项目数
	        itemsOnPage: parseInt(numPerPage),      //每页上显示的项目数，依据这两个参数可以得出总页数
	        onPageClick(pageNumber, event){         //点击触发函数 ，pageNumber:当前页，event：init(初始化)，change（改变）
			    // alert('userId:'+userId+'numPerPage:'+numPerPage);
			    $('#note-preview-content li').remove();
			    var begin = (pageNumber-1)*4;
			    $.ajax({
			        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getAllNotePage/'+numPerPage+'/'+begin,
			        type: 'GET',       
			        data:{},
			        success:function(data){
			        	listOfNote(data);           //调用函数生成笔记预览表
			        },
			        error:function(){
			            alert("请求失败！");
			        }
			    });
			}
	    });
		$(selector).pagination('selectPage', 1);
	});
	$('#search-all').click();

	//生成用户的所以笔记本标签
	$(document).on('click', '#search-by-notebook',function () {
		var userId = getUrlParam('userId');
		listSelectChange($(this));	
		//查询该用户所有笔记本
		$.ajax({
	        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getNoteBook',
	        type: 'GET',       
	        data:{},
	        success:function(data){
	        	data = JSON.parse(data);
	        	data = data.data;
	        	var choose_notebook_text1 = '<tr id="notebook-choose" class="choose-two">'
				+'	<td>'
				+'	</td>'
				+'</tr>';
				$('#search-choose').after(choose_notebook_text1);
				for(var i=0; i<data.length; i++){
					var note_preview_text2 = '<li class="no-selected-2">'
					+'	<span id=notebook-'+i+'>'+data[i].notebook+'</span>'
					+'	<input value='+data[i].num+' type="hidden">'
					+'</li>';
					$('#notebook-choose td').append(note_preview_text2);
				}	        	
	        },
	        error:function(){
	            alert("请求失败！");
	        }
	    });
	});

	//通过笔记本搜索该用户的笔记信息
	$(document).on('click', '.no-selected-2',function () {
		listSelectChange2($(this));	
		var userId = getUrlParam('userId');
		var numPerPage = 4;                                    //每页显示的条数
		var notebook = $(this).find('span').html();            //获取笔记本名
		var noteTotalNum = $(this).find('span').next().val();  //这个笔记本下的所有笔记数目

		//分页
		pageStyle();                                //调用分页的公共样式
		$(selector).pagination({
	        items: noteTotalNum,                    //总项目数
	        itemsOnPage: parseInt(numPerPage),      //每页上显示的项目数，依据这两个参数可以得出总页数       
	        onPageClick(pageNumber, event){         //点击触发函数 ，pageNumber:当前页，event：init(初始化)，change（改变）
			    // alert('userId:'+userId+'numPerPage:'+numPerPage+'notebook:'+notebook);
			    $('#note-preview-content li').remove();
			    var begin = (pageNumber-1)*4;
			    $.ajax({
			        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getNoteByNotebookPage/'+numPerPage+'/'+begin,
			        type: 'POST',       
			        data:{
			        	notebook:notebook
			        },
			        success:function(data){
			        	listOfNote(data);         //调用函数生成笔记预览表
			        },
			        error:function(){
			            alert("请求失败！");
			        }
			    });
			}
	    });
		$(selector).pagination('selectPage', 1);
	});

	//通过标签搜索该用户的笔记信息
	$(document).on('click', '#search-by-label',function () {
		var userId = getUrlParam('userId');
		listSelectChange($(this));	
		var choose_label_text = '<tr id="search-choose" class="choose-two">'
		+'	<td>'
		+'		<input id="ip-note-label" type="search" name="search-label" placeholder="--请输入标签名--">'
		+'		<img src="images/note/i-search.png" alt="search" id="search-label-tab" height="32" width="32">'
		+'	</td>'
		+'</tr>';
		$('#search-choose').after(choose_label_text);
	});

	//通过标签搜索该用户的笔记信息
	$(document).on('click', '#search-label-tab',function () {
		var label = $('#ip-note-label').val();        //获取标签名
		if(label == ''){
			alert('请先填写好你要查找的标签哦o(*￣▽￣*)ブ！')
		}else{
			var userId = getUrlParam('userId');
			var numPerPage = 4;               //每页显示的条数
			var noteTotalNum = 0;             //这个标签下的所有笔记数目

			//获取该用户这个标签下的所有笔记数目
			$.ajax({
		        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getNoteNumByLabel',
		        type: 'POST', 
		        async : false ,            //全局变量赋值，同步
		        data:{
		        	label:label
		        },
		        success:function(data){
		        	data=JSON.parse(data);
		            if(data.resultCode == 1){
		            	noteTotalNum = data.data;
		            }else{
		            	alert("获取该用户的笔记总条数失败〒_〒！")
		            }
		        },
		        error:function(){
		            alert("请求失败！");
		        }
		    });
			//分页
			pageStyle();                                //调用分页的公共样式
			$(selector).pagination({
		        items: noteTotalNum,                    //总项目数
		        itemsOnPage: parseInt(numPerPage),      //每页上显示的项目数，依据这两个参数可以得出总页数       
		        onPageClick(pageNumber, event){         //点击触发函数 ，pageNumber:当前页，event：init(初始化)，change（改变）
				    // alert('userId:'+userId+'numPerPage:'+numPerPage+'notebook:'+notebook);
				    $('#note-preview-content li').remove();
				    var begin = (pageNumber-1)*4;
				    $.ajax({
				        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getNoteByLabelPage/'+numPerPage+'/'+begin,
				        type: 'POST',       
				        data:{
				        	label:label
				        },
				        success:function(data){
				        	listOfNote(data);         //调用函数生成笔记预览表
				        },
				        error:function(){
				            alert("请求失败！");
				        }
				    });
				}
		    });
			$(selector).pagination('selectPage', 1);
		}
	});

	// $(document).on('click', '#search-by-reviseTime',function () {
	// 	listSelectChange($(this));	
	// });

//----------------------公共调用函数部分----------------------
	//笔记页面的选择导航栏，选中和不选中的样式改变
	function listSelectChange(a){
		$('.no-selected').removeClass('selected');
		a.parent().addClass('selected');
		$('.choose-two').remove();
	}

	//笔记页面的按笔记本选择，选中和不选中的样式改变
	function listSelectChange2(a){
		$('.no-selected-2').removeClass('selected-2');
		a.addClass('selected-2');
	}

	//分页栏的基本公共样式
    function pageStyle(){
    	$(selector).pagination({
	        displayedPages:6,                       //有多少页码是导航时可见，默认：5；
	        edges:2,                                //多少个页码的分页的开始/结束可见,默认2；
	        prevText:'上一页',            
	        nextText:'下一页',
	        cssStyle: 'light-theme', 
	    });
    }

	//生成笔记预览表
	function listOfNote(data){
		data = JSON.parse(data);
    	data = data.data;
    	for(var i=0; i<4; i++){
    		var note_preview_text = '<li class="blur">'
			+'	<div class="note-book-title" id="notebook-'+data[i].noteId+'">'+data[i].notebook+'</div>'
			+'	<div class="content">'
			+'		<p class="tab" align="left" id="label-'+data[i].noteId+'">'+data[i].label+'<img src="images/note/i-biaoqian.png" height="16px" width="16"></p>'
			+'		<p class="note-title" id="title-'+data[i].noteId+'">'+data[i].title+'</p>'
			+'		<p class="time">'+data[i].createdTime+'</p>'
			+'		<div class="note-content" id="content-'+data[i].noteId+'">'+data[i].content+'</div>'
			+'		<p>'
			+'			<span class="editNote">编辑</span>'
			+'			<span class="deleteNote">删除</span>'
			+'          <input type="hidden" value='+data[i].noteId+'>'
			+'		</p>'
			+'	</div>'
			+'</li>';
   			$('#note-preview-content').append(note_preview_text);
        }
    }

// ------------------------------删除笔记-----------------------------------
	
	$(document).on('click', '.deleteNote',function () {
		if(confirm('真的要删除吗〒_〒？')){
			var userId = getUrlParam('userId');
			var noteId = $(this).next().val();
			$.ajax({
		        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/deleteNote/'+noteId,
		        type: 'POST',       
		        data:{},
		        success:function(data){
		        	data = JSON.parse(data);
		        	alert(data.message);  
		        },
		        error:function(){
		            alert("请求失败！");
		        }
		    });	
		}
	});

// ------------------------------编辑笔记-----------------------------------
	//生成编辑笔记页面
	$(document).on('click', '.editNote',function () {
		var userId = getUrlParam('userId');
		var noteId = $(this).next().next().val();		
		if($('#right-update').length != 0){
			alert('请先保存上一个笔记哦(￣▽￣)"！');
		}else{
			var note_edit_text = '<div id="right-update">'
			+'	<div class="right-title">编辑笔记<label id="bt-note-update-return">返回</label></div>'
			+'		<input id="noteId-update-hidden" type="hidden" value="">'
			+'		<iframe id="iframe-page" src="note-update-summernote.html?noteId='+noteId+'&userId='+userId+'" height="560px" width="100%" scrolling="no"></iframe>'
			+'	</div>'	
			+'</div>';
			$('#left').after(note_edit_text);	
			$('#noteId-update-hidden').val(noteId);
		}
	});

	$(document).on('click', '#note-eidt-show-hidden',function () {	
		var noteId = getUrlParam('noteId');
		var userId = getUrlParam('userId');
		//获取对应笔记信息
		$.ajax({
	        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/getNoteByNoteId/'+noteId,
	        type: 'POST',       
	        data:{},
	        success:function(data){
	        	data = JSON.parse(data);
	        	$('#ip-notebook-update').val(data.notebook);
				$('#ip-label-update').val(data.label);
				$('#ip-title-update').val(data.title);
				$('#summernote-editor').code(data.content);      	
	        },
	        error:function(){
	            alert("请求失败！");
	        }
	    });	
	});

	//获取url中的参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }

	//更新笔记
	$(document).on('click', '#bt-note-update',function () {
		var noteId = getUrlParam('noteId');
		var userId = getUrlParam('userId');
		var notebook = $('#ip-notebook-update').val();
		var label = $('#ip-label-update').val();
		var title = $('#ip-title-update').val();
		var content = $('#summernote-editor').code();
		if(notebook == '' || label == '' || title == '' || content == ''){
			alert('请认真填写好每一个字段哦，有利于后期的管理o(^▽^)o！')
		}else{
			//更新笔记
			$.ajax({
		        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/updateNote/'+noteId,
		        type: 'POST',       
		        data:{
		        	notebook:notebook,
		        	label:label,
		        	title:title,
		        	content:content
		        },
		        success:function(data){
		        	data = JSON.parse(data);
		        	alert(data.message);       	
		        },
		        error:function(){
		            alert("请求失败！");
		        }
		    });
		}
	});

	//更新笔记返回
	$(document).on('click', '#bt-note-update-return',function () {
		$('#right-update').remove();
		location.reload();
	});
// ------------------------------创建笔记---------------------------------
	//添加笔记
	$(document).on('click', '#bt-note-edit-save',function () {
		var userId = getUrlParam('userId');
		var notebook = $('#ip-notebook').val();
		var label = $('#ip-label').val();
		var title = $('#ip-title').val();
		var content = $('#summernote-editor').code();
		alert('u:'+userId+'n:'+notebook+'l:'+label+'t'+title+'c:'+content);
		if(notebook == '' || label == '' || title == '' || content == ''){
			alert('请认真填写好每一个字段哦，有利于后期的管理o(^▽^)o！')
		}else{
			//添加笔记
			$.ajax({
		        url: 'http://localhost:8080/GoodGoodStudy/User/'+userId+'/addNote',
		        type: 'POST',       
		        data:{
		        	notebook:notebook,
		        	label:label,
		        	title:title,
		        	content:content
		        },
		        success:function(data){
		        	data = JSON.parse(data);
		        	alert(data.message);        	
		        },
		        error:function(){
		            alert("请求失败！");
		        }
		    });
		}
	});

	//初始化编辑器
	$('#summernote-editor').summernote({           //这个有报错，放到后面
		height: 450,
		minHeight:300,
		maxHeight:450,
		toolbar: [
		    //[groupname, [button list]]
		    ['style', ['bold', 'italic','underline']],
		    ['fontname', ['fontname']],
		    ['fontsize', ['fontsize']],
		    ['color', ['color']],
		    ['layout', ['ul', 'ol', 'paragraph']],
		    ['height', ['height']],
		    // ['picture', ['picture']],
		    // ['link', ['link']],
		    ['table', ['table']],
		    ['misc', ['undo','redo']],
		    ['misc', ['help']],

		]
		// onImageUpload: function(files, editor, welEditable) {
		// 	sendFile(files[0], editor, welEditable);
		// }
	});
});