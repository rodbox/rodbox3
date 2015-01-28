<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="modal-title" class="modal-title">Export</h4>
      </div>
      <div id="modal-body"  class="modal-body">

<form action="exec/config-save.php" id="config-pdf">
<table class="table text-center">
	<tr>
		<td colspan="2">
			<div class="text-center w-100"><label for="" class="marg-label">Supérieur</label><br/><input type="text" name="marginTop" placeholder="off"  autocapitalize="off" autocomplete="off" autocorrect="off" value="17"  /><br/>
			<label for="" class="marg-label">Gauche</label> <input type="text" class="margv-2" name="marginLeft" placeholder="off"  autocapitalize="off" autocomplete="off" autocorrect="off" value="8"  />
			<input type="text" class="margv-2" name="marginRight" placeholder="off"  autocapitalize="off" autocomplete="off" autocorrect="off" value="8"  /> <label for="" class="marg-label">Droite</label><br/>
			<input type="text" name="marginBottom" placeholder="off"  autocapitalize="off" autocomplete="off" autocorrect="off" value="8"  /><br/> <label for="" class="marg-label">Inférieur</label>
			</div>
		</td>
	</tr>
	<tr>
		<td><label for="fontSizeRatio">Ratio</label><br/>
		<input type="text" name="fontSizeRatio" id="fontSizeRatio" placeholder="off"  autocapitalize="off" autocomplete="off" autocorrect="off" value="1"  />
		</td>
		<td>
			<label for="tcellpadding">Padding</label><br/>
			<input type="number" id="tcellpadding" name="tcellpadding" value="4"/>
		</td>
	</tr>
	<tr>
		<td>
			<label for="nbCol">Nombre de colonne</label>
			<input type="number" id="nbCol" name="nbCol" value="11"/></td>
		<td>
			<label for="strLimit">Limite de l'extrait de code</label>
			<input type="number" id="strLimit" name="strLimit" value="36"/>
		</td>
	</tr>
	<tr>
		<td>
			<label>Orientation</label><br/>
			<input type="radio" name="orientation" id="orientation-L" checked value="L"/> <label for="orientation-L" class="forradio">L</label>
			<input type="radio" name="orientation" id="orientation-P" value="P"/> <label for="orientation-P" class="forradio">P</label>
		</td>
		<td>
			<label>Format</label><br/>
			<div>
			<input type="radio" name="format" id="format-A4" checked value="A4"/> <label for="format-A4" class="forradio">A4</label>
			<input type="radio" name="format" id="format-A5" value="A5"/> <label for="format-A5" class="forradio">A5</label>
			<input type="radio" name="format" id="format-A3" value="A3"/> <label for="format-A3" class="forradio">A3</label>
			</div>
		</td>
	</tr>
</table>
<hr/>
<a href="exec/pdf.php" id="snippets-pdf" class="btn btn-primary w-100">Exporter</a>
</form>
 </div>