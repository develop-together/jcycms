<?php
	use frontend\assets\CropperAsset;

	CropperAsset::register($this);
 ?>
<div class="col-md-9">
	<div class="ibox">
		<div class="ibox-title">
			<h5>头像设置</h5>
		</div>
		<div class="ibox-content">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="image-group">
		               <img id="image" src="https://fengyuanchen.github.io/cropperjs/images/picture.jpg" class="cropper-hidden">
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<h4>图片预览：</h4>
					<div id="result" class="img-preview img-preview-sm">

					</div>
					<h4>说明：</h4>
					<p>你可以选择新图片上传，然后下载裁剪后的图片</p>
					<div class="btn-group">
						<label title="上传图片" for="inputImage" class="btn btn-primary">
						<input type="file" accept="image/*" name="file" id="inputImage" class="hide">
						上传新图片
						</label>
						<label title="下载图片" id="download" class="btn btn-primary">下载</label>
					</div>
					<div class="btn-group">
						<button class="btn btn-white" id="zoomIn" type="button">放大</button>
						<button class="btn btn-white" id="zoomOut" type="button">缩小</button>
						<button class="btn btn-white" id="rotateLeft" type="button">左旋转</button>
						<button class="btn btn-white" id="rotateRight" type="button">右旋转</button>
						<button class="btn btn-warning" id="setDrag" type="button">裁剪</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function getRoundedCanvas(sourceCanvas) {
      var canvas = document.createElement('canvas');
      var context = canvas.getContext('2d');
      var width = sourceCanvas.width;
      var height = sourceCanvas.height;

      canvas.width = width;
      canvas.height = height;
      context.imageSmoothingEnabled = true;
      context.drawImage(sourceCanvas, 0, 0, width, height);
      context.globalCompositeOperation = 'destination-in';
      context.beginPath();
      context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
      context.fill();
      return canvas;
    }

    window.addEventListener('DOMContentLoaded', function () {
      var image = document.getElementById('image');
      var button = document.getElementById('setDrag');
      var result = document.getElementById('result');
      var croppable = false;
      var cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 1,
        ready: function () {
          croppable = true;
        },
      });

      button.onclick = function () {
        var croppedCanvas;
        var roundedCanvas;
        var roundedImage;

        if (!croppable) {
          return;
        }

        // Crop
        croppedCanvas = cropper.getCroppedCanvas();

        // Round
        roundedCanvas = getRoundedCanvas(croppedCanvas);

        // Show
        roundedImage = document.createElement('img');
        roundedImage.src = roundedCanvas.toDataURL()
        result.innerHTML = '';
        result.appendChild(roundedImage);
      };
    });
  </script>