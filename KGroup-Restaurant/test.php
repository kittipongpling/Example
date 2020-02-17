<HTML>
<HEAD>
<TITLE>Test</TITLE>
<script>
  function SaveScrollXY() {
    document.Form1.ScrollX.value = document.body.scrollLeft;
    document.Form1.ScrollY.value = document.body.scrollTop;
  }
  function ResetScrollPosition() {
    var hidx, hidy;
    hidx = document.Form1.ScrollX;
    hidy = document.Form1.ScrollY;
    if (typeof hidx != 'undefined' && typeof hidy != 'undefined') {
      window.scrollTo(hidx.value, hidy.value);
    }
  }
</script>
</HEAD>
<BODY onload="ResetScrollPosition()">
  <form name="Form1" id="Form1" method="post"
    onsubmit="SaveScrollXY()" action="#">
    <input name="ScrollX" id="ScrollX" type="hidden"
      value="<?php echo $_REQUEST['ScrollX'] ?>" />
    <input name="ScrollY" id="ScrollY" type="hidden"
      value="<?php echo $_REQUEST['ScrollY'] ?>" />
    <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
      
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
      
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
        <p>This is just a paragraph to make a very long page.</p>
    …
    <P>This is just a paragraph to make a very long page.</P>
      
    <P>
      
    <P>
      <input type="submit" name="Button1" value="Post Form"
        id="Button1" /></P>
  </form>
</BODY>
</HTML>
