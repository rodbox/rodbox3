<?php $rand	= substr( md5(rand()), 0, 8); ?>
<div class="text-center">
<div class="absolute right"><ul class="no-marg no-pad sc-2">
<li class="pad-3"><a id="zoom-in" href="#" class="big-1 crop-tool" data-option="zoom" data-value="0.1"><i class="icomoon-zoom-in2"></i></a></li>
<li class="pad-3"><a id="zoom-out" href="#" class="big-1 crop-tool" data-option="zoom" data-value="-0.1"><i class="icomoon-zoom-out2"></i></a></li>
<li class="pad-3"><a href="#" class="crop-tool" data-option="reset" data-value="">100%</a></li>

<li class="pad-3"><a id="zoom-out" href="#" class="big-1 crop-tool" data-option="rotate" data-value="-5"><i class="icomoon-rotate-ccw3"></i></a></li>
<li class="pad-3"><a id="zoom-out" href="#" class="big-1 crop-tool" data-option="rotate" data-value="5"><i class="icomoon-rotate-cw3"></i></a></li>
</ul></div>
<div class="cropper">
<img src="<?php echo WEB_MY.'/log-ref.jpg?rand='.$rand; ?>" />
</div></div>
<div class="footer text-center">
<div class="preview inline-block" style="width: 64px; height: 64px; overflow:hidden;"></div>
<hr>
	<a href="#" id="cropValid" class="big-5 pad-5"><i class="icomoon-checkmark"></i></a>
	<div class="meta">
		
	</div>
</div>