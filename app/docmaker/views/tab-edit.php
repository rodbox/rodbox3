<ul class="no-padh maxH">
	<li>
		<?php  paletteList("","bg-8 c-4");?>
	</li>
	<li>
		<label for="styleCss" class="block codemirror" data-mode="css">Styles</label>
		<textarea name="stylesCss" id="stylesCss" rows="15"></textarea>
	</li>
	<li>
		<label for="docHeader" class="block">header</label>
		<label class="small light" for="bgHeader">bgHeader :</label><input type="text" name="bgHeader" id="bgHeader" />
		<label class="small light" for="cHeader">cHeader :</label><input type="text" name="cHeader" id="cHeader" />
		<textarea name="docHeader" id="docHeader" class="codemirror" rows="15"  data-mode="php"></textarea>
	</li>
	<li>
		<label for="docHeader" class="block codemirror" >content</label>
		<label class="small light" for="bgContent">bgContent :</label><input type="text" name="bgContent" id="bgContent" />
		<label class="small light" for="cContent">cContent :</label><input type="text" name="cContent" id="cContent" />
	</li>
	<li>
		<label for="docFooter" class="block ">Footer</label>
		<label class="small light" for="bgFooter">bgFooter :</label><input type="text" name="bgFooter" id="bgFooter" />
		<label class="small light" for="cFooter">cFooter :</label><input type="text" name="cFooter" id="cFooter" />
		<textarea name="docFooter" id="docFooter" class="codemirror" rows="15" data-mode="php"></textarea>
	</li>
</ul>
