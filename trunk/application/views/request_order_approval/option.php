<select name="sweets" multiple="multiple">
  <option>Chocolate</option>
  <option selected="selected">Candy</option>
  <option>Taffy</option>
  <option selected="selected">Caramel</option>
  <option>Fudge</option>
  <option>Cookie</option>
</select>

<textarea name="fname"></textarea>
<script>
function select_item(item)
{
targetitem.value = item;
top.close();
return false;
}
</script>
 
 
 
<table border="1" cellpadding="2">
    <tr>
        <td>No.</td>
        <td>Nama</td>
        <td>&nbsp;</td>    
    </tr>
    <tr>
        <td>No.</td>
        <td>Canis</td>
        <td><input type="button" onClick='return select_item("Canis")' value="Choose" /></td>    
    </tr>
    <tr>
        <td>No.</td>
        <td>Canis</td>
        <td><input type="button" onClick='return select_item("Felis")' value="Choose" /></td>    
    </tr>
</table>
- See more at: http://blog.canisnfelis.com/2012/06/28/memasukkan-nilai-variable-dari-pop-up-ke-dalam-form/#sthash.kveWQGL2.dpuf