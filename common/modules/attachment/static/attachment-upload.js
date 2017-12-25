function ajaxUpload(obj, res, options)
{
	console.log(options);
	var file =  obj.files[0];
	if (file=='') {
		return;
	}

	if (!/image\/\w+/.test(file.type)) {
		return;
	}
	
	//console.log(file);return;
	var reader = new FileReader();//提供HTML5 FileReader 说明 https://www.cnblogs.com/access520/p/5672435.html
	//将文件以Data URL 形式读入页面
	reader.readAsDataURL(file);
	reader.onload = function(e) {
		//如果这里使用Ajax异步上传也是可以的，逻辑代码就是将提交的代码复制过来
		var resObj = document.getElementById(res);
		var newObj = document.createElement('div');
		newObj.style.cssFloat = 'left';
		newObj.style.paddingRight = '10px';
		newObj.innerHTML = '<img src=\'' + this.result + '\' width=\'150\' height=\'150\'/><input type=\'hidden\' name=\'files[]\' value=\'' + this.result + '\'/>';
		resObj.parentNode.insertBefore(newObj,resObj);
	}
}