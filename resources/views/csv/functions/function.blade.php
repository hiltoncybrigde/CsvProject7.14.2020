<div class="container">
<label for="page">Sort</label>

<select name="page" id="lala">
  <option name="sortpage" value="a">a</option>
  <option name="sortpage"value="b">b</option>
  <option name="sortpage"value="c">c</option>
  <option name="sortpage"value="d">d</option>
  <option name="sortpage"value="e">e</option>
  <option name="sortpage"value="f">f</option>
  <option name="sortpage"value="g">g</option>
  <option name="sortpage"value="h">h</option>
  <option name="sortpage"value="i">i</option>
  <option name="sortpage"value="j">j</option>
  <option name="sortpage"value="k">k</option>
  <option name="sortpage"value="l">l</option>
  <option name="sortpage"value="m">m</option>
  <option name="sortpage"value="n">n</option>
  <option name="sortpage"value="o">o</option>
  <option name="sortpage"value="p">p</option>
  <option name="sortpage"value="q">q</option>
  <option name="sortpage"value="r">r</option>
  <option name="sortpage"value="s">s</option>
  <option name="sortpage"value="t">t</option>
  <option name="sortpage"value="u">u</option>
  <option name="sortpage"value="v">v</option>
  <option name="sortpage"value="w">w</option>
  <option name="sortpage"value="x">x</option>
  <option name="sortpage"value="y">y</option>
  <option name="sortpage"value="z">z</option>
</select>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script type="text/javascript">
  $('#lala').on('change', function(){
  	var id = $("select[name=page]").val();
        console.log(id);
        var post_url ='/admin/sort/'+id;
        console.log(post_url);
 	 window.location.href = post_url;
      
});
</script>
<a class="btn btn-info" href="{{ route('admin.export') }}"> Export File</a>
</div>